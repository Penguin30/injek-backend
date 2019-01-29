<?php 
require('../connect.php');
require('../function.php');
check_permissions();
check_admin();
$id=$_POST['faculty_id'];
$name=$_POST['faculty_name'];
$short=$_POST['faculty_short_name'];
if(mysqli_query($con,'UPDATE faculties SET faculty_name="'.$name.'", faculty_short_name="'.$short.'" WHERE faculty_id="'.$id.'"')){
	header('Location: /admin/faculties');
}
?>