<?php
session_start();
require('connect.php');
require('function.php');
check_permissions();
check_admin();
require('header.php');
require('menu.php');
?>
<title>Консоль</title>
<div class="container-fluid">
      <div class="row">
        <?php require('sidebar.php'); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Консоль</h1>
          </div>
          <h2>Новости</h2>
            <ul class="event-list">
        <?php 
          $rez=mysqli_query($con,"SELECT news_id,news_title,news_content,date_create,YEAR(date_create) as y,DAY(date_create) as d,MONTHNAME(date_create) as m FROM news ORDER BY news_id DESC LIMIT 4");
          while($row=mysqli_fetch_assoc($rez)){
            $rez2=mysqli_query($con,"SELECT photo FROM `news-photo` WHERE news_id='".$row['news_id']."' LIMIT 1");
            $row2=mysqli_fetch_assoc($rez2);
        ?>
          <li>
            <time datetime="<?php echo $row['date_create']; ?>">
              <span class="day"><?php echo $row['d']; ?></span>
              <span class="month"><?php echo $row['m']; ?></span>
              <span class="year"><?php echo $row['y']; ?></span>
              <span class="time">Все дни</span>
            </time>
            <img alt="<?php echo shorten_text($row['news_title'],20,'',true); ?>" src="<?php echo $row2['photo']; ?>" />
            <div class="info">
              <h2 class="title"><a href="single-news.php?id=<?php echo $row['news_id'];?>"><?php echo shorten_text($row['news_title'],50,'',true); ?></a></h2>
              <p class="desc"><?php echo shorten_text(strip_tags($row['news_content']),200,'',true); ?></p>
            </div>          
          </li>
        <?php } ?>
      </ul>
          <h2>Пользователи</h2>
          <ul class="list-group">
          <?php $rez=mysqli_query($con,"SELECT * FROM users ORDER BY user_id DESC LIMIT 5"); ?>
          <?php while($row=mysqli_fetch_assoc($rez)){ ?>
          <?php $rez2=mysqli_query($con,"SELECT faculty_name FROM faculties WHERE faculty_id='".$row['user_faculty']."'");
          $row2=mysqli_fetch_assoc($rez2);
          $rez3=mysqli_query($con,"SELECT group_name FROM groups WHERE group_id='".$row['user_group']."'");
          $row3=mysqli_fetch_assoc($rez3);
          ?>
          <li class="list-group-item">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12">             
                <a href="user.php?id=<?php echo $row['user_id']; ?>"><p><?php echo $row['user_fname'].' '.$row['user_lname']; ?></p></a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12">
                <p>
                  <?php 
                    switch ($row['user_type']) {
                      case 'student':
                        echo 'Студент';
                        break;
                      case 'f_student':
                        echo 'Иностранный студент';
                        break;
                      case 'teacher':
                        echo 'Преподователь';
                        break;
                      case 'enrollee':
                        echo 'Абитуриент';
                        break;
                      default:                    
                        break;
                    }
                  ?>
                </p>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12">
                <p><?php echo $row2['faculty_name']; ?></p>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12">
                <p><?php echo $row3['group_name']; ?></p>
              </div>
            </div>
          </li>   
        <?php } ?>
      </ul>
        </main>
      </div>
    </div>
<?php require('footer.php');?>