<?php
require('../connect.php');
require('../function.php');
check_admin();
$id=$_GET['id'];
$title=$_POST['news_title'];
$content=$_POST['news_content'];
$section=$_POST['news_section'];
if($section=='news_faculty'){
	$faculty=$_POST['faculty_news'];
	$query="UPDATE news SET news_title='".$title."',news_content='".$content."',news_section='".$section."',news_faculty='".$faculty."' WHERE news_id='".$id."'";
}else{
	$query="UPDATE news SET news_title='".$title."',news_content='".$content."',news_section='".$section."' WHERE news_id='".$id."'";
}
if(mysqli_query($con,$query)){
	if(isset($_FILES['news_photos']['name'][0]) && !empty($_FILES['news_photos']['name'][0])){
		$total = count($_FILES['news_photos']['name']);
		for($i=0; $i<$total; $i++) {	
			$tmp=$_FILES['news_photos']['tmp_name'][$i];	
			$link='/app/img/news/'.$_FILES['news_photos']['name'][$i];
			$full_link=$site_link.$link;
			if(!empty($tmp)){
	  			if(move_uploaded_file($tmp,$_SERVER['DOCUMENT_ROOT'].$link)){
	  				echo "ok";
	  				if(mysqli_query($con,"INSERT INTO `news-photo`(news_id,photo) VALUES('".$id."','".$full_link."')") or die(mysqli_error())){
	  					header('Location:/admin/single-news.php?id='.$id);
	  				}
	  			}
	  		}
		}
	}else{
		echo "OK";
		header('Location:/admin/single-news.php?id='.$id);
	}	
}else{
		header('Location:/admin/single-news.php?id='.$id);
	}	
?>