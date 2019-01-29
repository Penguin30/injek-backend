<?php
require('../connect.php');
require('../function.php');
check_permissions();
check_admin();
$id=$_GET['id'];
if(mysqli_query($con,"DELETE FROM groups WHERE group_id='".$id."'")){
	header('Location: /admin/groups');
}
?>