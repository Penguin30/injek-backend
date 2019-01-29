<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require('../connect.php');
require('../function.php');
check_permissions();
check_admin();
$email=$_POST['email'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$user_type=$_POST['user_type'];
if($user_type=='student'){
	$faculty=$_POST['faculty'];
	$group=$_POST['group'];
}
if($user_type=='f_student'){
	$country=$_POST['country'];
	$group=$_POST['group'];
}
if($user_type=='teacher'){
	$patronymic=$_POST['patronymic'];
}
if($user_type=='enrollee'){

}
$user_sex=$_POST['user_sex'];
$activate=$_POST['activate'];
$date_born=$_POST['date_born'];
$lvl=$_POST['lvl'];
$pass=$_POST['pass'];
if(!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])){
	if(mysqli_query($con,"INSERT INTO users(user_status,user_login,user_type,user_sex,date_born,user_fname,user_sname,user_faculty,user_group,user_admin,user_pass,patronymic,country) VALUES('".$activate."','".$email."','".$user_type."','".$user_sex."','".$date_born."','".$fname."','".$lname."','".$faculty."','".$group."','".$lvl."','".md5($pass)."','".$patronymic."','".$country."')")){
		header('Location: /admin/users.php');
	}
}else{
	$ext=array_pop(explode('.',$_FILES['upload']['name']));
	$file=$email.'.'.$ext;
	$link='/app/img/profiles/'.$file;
if(move_uploaded_file($_FILES['upload']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].$link)){
	if(mysqli_query($con,"INSERT INTO users(user_status,user_login,user_type,user_sex,date_born,user_fname,user_sname,user_faculty,user_group,user_admin,user_photo,user_pass) VALUES('".$activate."','".$email."','".$user_type."','".$user_sex."','".$date_born."','".$fname."','".$lname."','".$faculty."','".$group."','".$lvl."','".$site_link.$link."','".md5($pass)."')")){
		header('Location: /admin/users.php');
	}
}
}
?>