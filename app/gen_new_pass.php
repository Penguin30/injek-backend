<?php
require('connect.php'); 
require('function.php');
$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
$mas=10;
$size=StrLen($chars)-1; 
$pass=null; 
while($max--) 
	$pass.=$chars[rand(0,$size)]; 
if(mysqli_query($con,"UPDATE users SET user_pass='".md5($pass)."' WHERE user_login='".$_GET['email']."'")){
	mail($email,'New pass',$pass);
	$mas['code']=1;
	$mas['status']='ok';
	echo json_encode($mas);
}else{
	$mas['code']=3;
	$mas['status']='error';
	echo json_encode($mas);	
}
?>