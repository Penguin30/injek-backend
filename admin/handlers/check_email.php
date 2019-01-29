<?php 
require('../connect.php');
require('../function.php');
check_admin();
$email=$_POST['email'];
$id=$_POST['id'];
if(empty($id)){
	$rez=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$email."'");
	if(mysqli_num_rows($rez)>0){
		echo "Error";
	}else{
		echo "Ok";
	}
}else{
	$rez=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$email."'");
	$rez2=mysqli_query($con,"SELECT * FROM users WHERE user_id='".$id."'");
	$row2=mysqli_fetch_assoc($rez2);
	if(mysqli_num_rows($rez)>0){
		if($row2['user_login']==$email){
			echo "Ok";
		}else{
			echo "Error";
		}
	}else{
		echo "Ok";
	}
}
?>