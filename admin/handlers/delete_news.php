<?php
	require('../connect.php');
	require('../function.php');
	check_admin();
	$id=$_GET['id'];
	$rez=mysqli_query($con,"SELECT photo FROM `news-photo` WHERE news_id='".$id."'");
	while($row=mysqli_fetch_assoc($rez)){
		$link=str_replace($site_link.'/', "",$row['photo']);
		if(file_exists('../../'.$link)){
			if(unlink('../../'.$link)){
				mysqli_query($con,"DELETE FROM `news-photo` WHERE news_id='".$id."'");	
			}
		}
	}	
	if(mysqli_query($con,"DELETE FROM news WHERE news_id='".$id."'")){
		header('Location:'.$_SERVER['HTTP_REFERER']);
	}

?>