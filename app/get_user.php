<?php session_start(); ?>

<?php require('connect.php'); ?>

<?php require('function.php'); ?>

<?php 

$token=$_GET['token'];

if(!isset($token) || empty($token)){

	$mas['code']=6;

	$mas['status']='Error';

	echo json_encode($mas,JSON_PRETTY_PRINT);

	die();

}

$login=$_SESSION[$token]['login'];

if(!isset($login) || empty($login)){

	$mas['code']=6;
	$mas['errors'][] = 1001;
	$mas['msg']='User is not loggined or token is not correct';

	echo json_encode($mas,JSON_PRETTY_PRINT);

}else{

	$rez=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$login."'");

	$row=mysqli_fetch_assoc($rez);

	if(isset($row) && !empty($row)){

	// $rez2=mysqli_query($con,"SELECT * FROM faculties WHERE faculty_id='".$row['user_faculty']."'");

	// $row2=mysqli_fetch_assoc($rez2);

	// $rez3=mysqli_query($con,"SELECT * FROM groups");

	// $row3=mysqli_fetch_assoc($rez3);

		$mas['code']=1;

		$mas['status']='OK';

		$mas['data']['fname']=$row['user_fname'];

		$mas['data']['lname']=$row['user_sname'];

		$mas['data']['type']=$row['user_type'];

		$mas['data']['sex']=$row['user_sex'];

		$mas['data']['login']=$row['user_login'];

		$mas['data']['faculty']=$row['user_faculty'];

		$mas['data']['group']=$row['user_group'];

		$mas['data']['date_born']=$row['date_born'];

		$mas['data']['photo']=$row['user_photo'];

		echo json_encode($mas,JSON_PRETTY_PRINT);

	}else{

		$mas['code']=3;

		$mas['msg']='Something went wrong';

	}

}