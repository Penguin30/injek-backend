<?php
session_start();
session_id('7rj3m9ndo4vnj6aanob76u9507');
require('connect.php');
require('function.php');
$token=$_GET['token'];
if(!isset($token) || empty($token)){
	$mas['code']=6;
	$mas['status']='error';
	echo json_encode($mas);
	die;
}
$rez=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$_SESSION[$token]['login']."'");
$row=mysqli_fetch_assoc($rez);
$size=$_GET['size'];
$faculty=$row['user_faculty'];
$offset=$_GET['offset'];
if(!isset($size) || empty($size)){
	if(!isset($offset) || empty($offset)){
		$query="SELECT * FROM news WHERE news_section='news_university' OR news_faculty='".$faculty."'";		
	}else{
		$query="SELECT * FROM news WHERE news_section='news_university' OR news_faculty='".$faculty."'LIMIT $offset,999999";
	}
}else{
	if(!isset($offset) || empty($offset)){		
		$query="SELECT * FROM news WHERE news_section='news_university' OR news_faculty='".$faculty."' LIMIT $size";
	}else{
		$query="SELECT * FROM news WHERE news_section='news_university' OR news_faculty='".$faculty."' LIMIT $offset,$size";
	}
}
$rez=mysqli_query($con,$query);
$mas = new stdClass();
$mas->code = 1;
$mas->status = 'ok';
$mas->data = [];//new array();
$i=0;
$k=0;
while($row=mysqli_fetch_assoc($rez)){
	$item = new stdClass();
	if(2==$i){
			$i=0;
			if($k!=0){
				$query2="SELECT * FROM advertising ORDER BY id DESC LIMIT $k,1";
			}elseif($k==0){
				$query2="SELECT * FROM advertising ORDER BY id DESC LIMIT 1";
			}
			$rez3=mysqli_query($con,$query2);
			if(mysqli_num_rows($rez3)>0){
				$row3=mysqli_fetch_assoc($rez3);
				$item->type='adv';
				$item->text=$row3['text'];
				$item->title=$row3['name'];
				$item->id=$row3['id'];
				$item->link=$row3['link'];
				$item->image=$row3['banner'];	
				$k++;
				array_push($mas->data, $item);	
			}
		}
		$item = new stdClass();
	$rez2=mysqli_query($con,"SELECT * FROM `news-photo` WHERE news_id='".$row['news_id']."' LIMIT 1");
		if(mysqli_num_rows($rez2)>0){
			while($row2=mysqli_fetch_assoc($rez2)){
				$item->image=$row2['photo'];
			}
		}else{
			$item->photo='';
		}
		$item->type='news';
		$item->text=str_replace("&nbsp;",' ',strip_tags(shorten_text($row['news_content'],50,'...',true)));
		$item->title=$row['news_title'];
		$item->id=$row['news_id'];
		$item->date=$row['date_create'];
		array_push($mas->data, $item);
		
		
			$i++;
}				
echo json_encode($mas, JSON_UNESCAPED_UNICODE);
?>