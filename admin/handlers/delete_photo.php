<?php
	require('../connect.php');
	require('../function.php');
	check_admin();
	$id=$_GET['id'];
	$rez=mysqli_query($con,"SELECT photo FROM `news-photo` WHERE id='".$id."'");
	$row=mysqli_fetch_assoc($rez);
	$link=str_replace($site_link.'/', "",$row['photo']);
	if(file_exists('../../'.$link)){
		if(unlink('../../'.$link)){
			if(mysqli_query($con,"DELETE FROM `news-photo` WHERE id='".$id."'")){
				header('Location:'.$_SERVER['HTTP_REFERER']);
			}
		}
	}	
?>