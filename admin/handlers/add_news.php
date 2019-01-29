<?php
require('../connect.php');
require('../function.php');
check_admin();
$title=$_POST['news_title'];
$content=$_POST['news_content'];
$section=$_POST['news_section'];
if($section=='news_faculty'){
	$faculty=$_POST['faculty_news'];
	$query="INSERT INTO news(news_title,news_content,date_create,news_section,news_faculty) VALUES('".$title."','".$content."',NOW(),'".$section."','".$faculty."')";
}else{
	$query="INSERT INTO news(news_title,news_content,date_create,news_section) VALUES('".$title."','".$content."',NOW(),'".$section."')";
}
if(mysqli_query($con,$query)){
	$rez=mysqli_query($con,"SELECT news_id FROM news WHERE news_title='".$title."' AND news_content='".$content."' ORDER BY news_id DESC LIMIT 1") or die(mysqli_error());
	$row=mysqli_fetch_assoc($rez);
	if(isset($_FILES['news_photos']['name'][0]) && !empty($_FILES['news_photos']['name'][0])){
		$total = count($_FILES['news_photos']['name']);
		for($i=0; $i<$total; $i++) {	
			$tmp=$_FILES['news_photos']['tmp_name'][$i];	
			$link='/app/img/news/'.$_FILES['news_photos']['name'][$i];
			$full_link=$site_link.$link;
			if(!empty($tmp)){
	  			if(move_uploaded_file($tmp,$_SERVER['DOCUMENT_ROOT'].$link)){
	  				if(mysqli_query($con,"INSERT INTO `news-photo`(news_id,photo) VALUES('".$row['news_id']."','".$full_link."')") or die(mysqli_error())){
	  					header('Location: /admin/news.php');
	  				}
	  			}
	  		}
		}
	}else{
		header('Location: /admin/news.php');
	}	
}else{
		header('Location: /admin/news.php');
	}	
?>