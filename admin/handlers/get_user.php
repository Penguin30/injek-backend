<?php
require('../connect.php');
require('../function.php');
check_admin();
$id=$_POST['id'];
$rez=mysqli_query($con,"SELECT * FROM users WHERE user_id='".$id."'");
$row=mysqli_fetch_assoc($rez);
echo json_encode($row);
?>