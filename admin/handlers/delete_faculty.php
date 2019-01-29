<?php
require('../connect.php');
require('../function.php');
check_permissions();
check_admin();
$id=$_GET['id'];
if(mysqli_query($con,"DELETE FROM faculties WHERE faculty_id='".$id."'")){
	header('Location: /admin/faculties');
}
?>