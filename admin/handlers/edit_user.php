<?php
require('../connect.php');
require('../function.php');
check_permissions();
check_admin();
$id=$_GET['id'];
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
if(!isset($_FILES['upload']['name']) || empty($_FILES['upload']['name'])){
	if(mysqli_query($con,"UPDATE users SET user_status='".$activate."',user_login='".$email."',user_type='".$user_type."',user_sex='".$user_sex."',date_born='".$date_born."',user_fname='".$fname."',user_sname='".$lname."',user_faculty='".$faculty."',user_group='".$group."',user_admin='".$lvl."',country='".$country."',patronymic='".$patronymic."' WHERE user_id='".$id."'")){
		header('Location: /admin/users.php');
	}
}else{
	$ext=array_pop(explode('.',$_FILES['upload']['name']));
	$file=$email.'.'.$ext;
	$link='/app/img/profiles/'.$file;
if(move_uploaded_file($_FILES['upload']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].$link)){
	if(mysqli_query($con,"UPDATE users SET user_status='".$activate."',user_login='".$email."',user_type='".$user_type."',user_sex='".$user_sex."',date_born='".$date_born."',user_fname='".$fname."',user_sname='".$lname."',user_faculty='".$faculty."',user_group='".$group."',user_admin='".$lvl."',user_photo='".$site_link.$link."',country='".$country."',patronymic='".$patronymic."' WHERE user_id='".$id."'")){
		header('Location: /admin/users.php');
	}
}
}
?>