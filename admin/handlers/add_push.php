<?php
require('../connect.php');
require('../function.php');
check_admin();
$title=$_POST['name_push'];
$text=$_POST['push_text'];
$faculty=$_POST['faculty'];
$group=$_POST['group'];
$user=$_POST['user'];
if(mysqli_query($con,"INSERT INTO notifications SET title='".$title."',text='".$text."',date=NOW()")){
	$rez=mysqli_query($con,"SELECT * FROM notifications WHERE title='".$title."' AND text='".$text."' ORDER BY id LIMIT 1");
	$row=mysqli_fetch_assoc($rez);
	$id=$row['id'];
	if(mysqli_query($con,"INSERT INTO `notifications-for` SET not_id='".$id."',user_faculty='".$faculty."',user_group='".$group."',user='".$user."'")){
		header('Location: /admin/push.php');
	}
}
?>