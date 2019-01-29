<?php
session_id('7rj3m9ndo4vnj6aanob76u9507');
session_start();
session_id('7rj3m9ndo4vnj6aanob76u9507');
require('connect.php');
require('function.php');
$token=$_GET['token'];
$date=$_GET['date'];
if(!isset($token) || empty($token)){
	$mas['code']=6;
	$mas['status']='error';
	echo json_encode($mas);
	die;
}
if(!isset($date) || empty($date)){
	$mas['code']=2;
	$mas['status']='errors';
	$mas['errors'][]=1016;
	echo json_encode($mas);
	die;
}
$rez=mysqli_query($con,"SELECT user_group FROM users WHERE user_login='".$_SESSION[$token]['login']."'");
$row=mysqli_fetch_assoc($rez);
$rez3=mysqli_query($con,"SELECT shedule_id FROM shedule_groups WHERE group_id='".$row['user_group']."'");
$mas = new stdClass();
$mas->code = 1;
$mas->status = 'ok';
$mas->data = [];
while($row3=mysqli_fetch_assoc($rez3)){
	$rez2=mysqli_query($con,"SELECT * FROM shedule WHERE `date`='".$date."' AND id='".$row3['shedule_id']."'");
	while($row2=mysqli_fetch_assoc($rez2)){
		$item = new stdClass();
		$item->date=$row2['date'];
		$item->time_start=$row2['time_start'];
		$item->time_end=$row2['time_end'];
		$item->name=$row2['name_les'];
		$item->type=$row2['type_les'];
		$item->teacher=$row2['teacher_les'];
		$item->audience=$row2['audience'];
		$item->housing=$row2['housing'];
		array_push($mas->data, $item);
	}
}
echo json_encode($mas, JSON_UNESCAPED_UNICODE);
?>