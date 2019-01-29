<?php
session_start();
session_id('7rj3m9ndo4vnj6aanob76u9507');
require('connect.php');
require('function.php');
$id=$_GET['id'];
if(!isset($id) && empty($id)){
	$mas['code']=2;
	$mas['status']='Error';
	$mas['form_errors']['id']='Empty id';
	echo json_encode($mas);
	die;
}
$rez=mysqli_query($con,"SELECT * FROM news WHERE news_id='".$id."'");
while($row=mysqli_fetch_assoc($rez)){
	$rez2=mysqli_query($con,"SELECT * FROM `news-photo` WHERE news_id='".$row['news_id']."'");
	if(mysqli_num_rows($rez2)==0){
		$mas['data']['images'][]='';
	}else{
		while($row2=mysqli_fetch_assoc($rez2)){
			$mas['data']['images'][]=$row2['photo'];
			$mas['data']['images'][]=$row['id'];
		}	
	}
	$mas['data'][]=$row['news_id'];
	$mas['data']['text']=str_replace("&nbsp;",' ',strip_tags($row['news_content']));	
	$mas['data'][]=$row['news_title'];
	$mas['data'][]=$row['date_create'];
	$mas['code']=1;
	$mas['status']='Ok';
}
echo json_encode($mas, JSON_UNESCAPED_UNICODE);
?>
