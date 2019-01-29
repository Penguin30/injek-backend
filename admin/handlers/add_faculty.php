<?php 
require('../connect.php');
require('../function.php');
check_admin();
check_permissions();
$name=$_POST['name'];
$short=$_POST['short'];
mysqli_query($con,'INSERT INTO faculties(faculty_name,faculty_short_name) VALUES("'.$name.'","'.$short.'")');
?>