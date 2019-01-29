<?php
if(!empty($_POST["id"])){
    require('../connect.php');
    require('../function.php');
    $rez = mysqli_query($con,"SELECT COUNT(*) as num_rows FROM news WHERE news_id < '".$_POST['id']."' ORDER BY news_id DESC");
    $row = mysqli_fetch_assoc($rez);
    $totalRowCount = $row['num_rows'];
    $showLimit = 4;
    $rez=mysqli_query($con,"SELECT news_id,news_title,news_content,date_create,YEAR(date_create) as y,DAY(date_create) as d, MONTHNAME(date_create) as m FROM news WHERE news_id < ".$_POST['id']." ORDER BY news_id DESC LIMIT $showLimit");
    if(mysqli_num_rows($rez) > 0){ 
        while($row = mysqli_fetch_assoc($rez)){
            $postID = $row['news_id'];
    $rez2=mysqli_query($con,"SELECT photo FROM `news-photo` WHERE news_id='".$row['news_id']."' LIMIT 1");
    $row2=mysqli_fetch_assoc($rez2);
                ?>
                    <li>
                        <time datetime="<?php echo $row['date_create']; ?>">
                            <a id="del_news" href="/admin/handlers/delete_news?id=<?php echo $row['news_id']; ?>"><i class="far fa-trash-alt"></i></a>
                            <span class="day"><?php echo $row['d']; ?></span>
                            <span class="month"><?php echo $row['m']; ?></span>
                            <span class="year"><?php echo $row['y']; ?></span>
                            <span class="time">ALL DAY</span>
                        </time>
                        <img alt="<?php echo shorten_text($row['news_title'],20,'',true); ?>" src="<?php echo $row2['photo']; ?>" />
                        <div class="info">
                            <h2 class="title"><a href="single-news.php?id=<?php echo $row['news_id'];?>"><?php echo shorten_text($row['news_title'],50,'',true); ?></a></h2>
                            <p class="desc"><?php echo shorten_text(strip_tags($row['news_content']),200,'',true); ?></p>
                        </div>                  
                    </li>
    <?php } ?>
    <?php if($totalRowCount > $showLimit){ ?>
        <div class="show_more_main text-center" id="show_more_main<?php echo $postID; ?>">
            <span id="<?php echo $postID; ?>" class="show_more" title="Load more posts">Показать еще</span>
            <span class="loding" style="display: none;"><span class="loding_txt">Загрузка...</span></span>
        </div>
    <?php } ?>
<?php
    }
}
?>