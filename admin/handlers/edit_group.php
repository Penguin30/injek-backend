<?php
require('../connect.php');
require('../function.php');
check_permissions();
check_admin();
$id=$_GET['id'];
$name=$_POST['g_name'];
$s_name=$_POST['s_g_name'];
$num=$_POST['num_g'];
$faculty=$_POST['group_faculty'];
if(mysqli_query($con,"UPDATE groups SET group_name='".$name."',group_short_name='".$s_name."',group_number='".$num."',faculty_id='".$faculty."' WHERE group_id='".$id."'")){
	header('Location:'.$_SERVER['HTTP_REFERER']);
}
?>