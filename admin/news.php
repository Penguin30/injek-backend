<?php
require('connect.php');
require('function.php');
check_admin();
require('header.php');
require('sidebar.php');
require('menu.php');
?>
<title>Новости</title>
<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="add_news.php"><i class="fas fa-plus"> Добавить новость</i></a>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-12">
			<h2 class="mb-2">Новости</h2>
			<ul class="event-list">
				<?php 
					$rez=mysqli_query($con,"SELECT news_id,news_title,news_content,date_create,YEAR(date_create) as y,DAY(date_create) as d,MONTHNAME(date_create) as m FROM news ORDER BY news_id DESC LIMIT 4");
					while($row=mysqli_fetch_assoc($rez)){
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

				<?php $id=$row['news_id']; } ?>
				<?php if(mysqli_num_rows($rez)>0){ ?>
					<div class="show_more_main text-center" id="show_more_main<?php echo $id; ?>">
	        			<span id="<?php echo $id; ?>" class="show_more" title="Load more posts">Показать еще</span>
	        			<span class="loding" style="display: none;"><span class="loding_txt">Загрузка...</span></span>
	    			</div>
	    		<?php }else{ ?>
					<span>Ничего нет!</span>
	    		<?php } ?>
			</ul>
		</div>
	</div>
</div>
<?php require('footer.php');?>