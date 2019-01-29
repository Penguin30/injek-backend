<?php
session_start();
session_id('7rj3m9ndo4vnj6aanob76u9507');
require('connect.php');
require('function.php');
$size=$_GET['size'];
$offset=$_GET['offset'];
$token=$_GET['token'];
if(empty($token) || !isset($token)){
	$mas['code']='6';
	$mas['status']='error';
	echo json_encode($mas);
}
$rez1=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$_SESSION[$token]['login']."'");
$row1=mysqli_fetch_assoc($rez1);
if(!isset($size) || empty($size)){
	if(!isset($offset) || empty($offset)){
		$query="SELECT n.title,n.text FROM notifications as n, `notifications-for` as f WHERE f.user_faculty='' OR f.user_faculty='".$row1['user_faculty']."' AND f.user_group='' OR f.user_group='".$row1['user_group']." AND f.user='' OR f.user='".$row1['user_login']."'";		
	}else{
		$query="SELECT n.title,n.text FROM notifications as n, `notifications-for` as f WHERE f.user_faculty='' OR f.user_faculty='".$row1['user_faculty']."' AND f.user_group='' OR f.user_group='".$row1['user_group']." AND f.user='' OR f.user='".$row1['user_login']."' LIMIT $offset,999999";
	}
}else{
	if(!isset($offset) || empty($offset)){		
		$query="SELECT n.title,n.text FROM notifications as n, `notifications-for` as f WHERE f.user_faculty='' OR f.user_faculty='".$row1['user_faculty']."' AND f.user_group='' OR f.user_group='".$row1['user_group']." AND f.user='' OR f.user='".$row1['user_login']."' LIMIT $size";
	}else{
		$query="SELECT n.title,n.text FROM notifications as n, `notifications-for` as f WHERE f.user_faculty='' OR f.user_faculty='".$row1['user_faculty']."' AND f.user_group='' OR f.user_group='".$row1['user_group']." AND f.user='' OR f.user='".$row1['user_login']."' LIMIT $offset,$size";
	}
}
$rez=mysqli_query($con,$query);
$mas = new stdClass();
$mas->code = 1;
$mas->status = 'ok';
$mas->data = [];
while($row=mysqli_fetch_assoc($rez)){
	$item=new stdClass();
	$item->title=$row['title'];
	$item->text=$row['text'];
	array_push($mas->data,$item);
}
echo json_encode($mas, JSON_UNESCAPED_UNICODE);