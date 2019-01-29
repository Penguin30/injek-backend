<?php
session_start();
session_id('7rj3m9ndo4vnj6aanob76u9507');
require('connect.php');
$token=$_GET['token'];
$login=$_GET['login'];
$mas=array();
if(!isset($token) || empty($token)){
	$mas['code']=6;
	$mas['status']='error';
	echo json_encode($mas, JSON_PRETTY_PRINT);
	die;
}
// if(!isset($login) || empty($login)){
// 	$mas['code']=2;
// 	$mas['status']='error';
// 	$mas['errors'][]=1002;
// 	echo json_encode($mas, JSON_PRETTY_PRINT);
// 	die;
// }
if($_SESSION[$login]['token']==$token){
	$mas['code']=1;
	$mas['status']='ok';
	echo json_encode($mas, JSON_PRETTY_PRINT);
}else{
	$mas['code']=6;
	$mas['status']='error';
	$mas['msg']='Token is invalid';
	echo json_encode($mas, JSON_PRETTY_PRINT);
}
?>
