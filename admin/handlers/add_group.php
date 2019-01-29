<?php
require('../connect.php');
require('../function.php');
check_permissions();
check_admin();
$name=$_POST['name'];
$faculty_id=$_POST['faculty'];
$short_name=$_POST['short'];
$num=$_POST['num'];
mysqli_query($con,"INSERT INTO groups(group_name,group_short_name,group_number,faculty_id) VALUES('".$name."','".$short_name."','".$num."','".$faculty_id."')");
?>