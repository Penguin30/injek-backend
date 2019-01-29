<?php
session_id('7rj3m9ndo4vnj6aanob76u9507');
session_start();
session_id('7rj3m9ndo4vnj6aanob76u9507');
require('connect.php');
$token=$_GET['token'];
if(!isset($token) || empty($token)){
	$mas['code']=6;
	$mas['status']='Error';
	echo json_encode($mas, JSON_PRETTY_PRINT);
	die();
}
$login=$_SESSION[$token]['login'];
	if(empty($login)){
		$mas['code']=1;
		$mas['status']='ok';
		echo json_encode($mas);	
		die;
	}
	$rez=mysqli_query("SELECT user_id FROM users WHERE user_login='".$login."'");
	$row=mysqli_fetch_assoc($rez);
	if($_SESSION[$login]['token']==$token){
		unset($_SESSION[$token]['login']);
		unset($_SESSION[$login]['token']);
		$mas['code']=1;
		$mas['status']='ok';
		echo json_encode($mas, JSON_PRETTY_PRINT);
	}else{
		$mas['code']=1;
		$mas['status']='ok';
		echo json_encode($mas, JSON_PRETTY_PRINT);
	}
?>