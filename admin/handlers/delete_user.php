<?php
require('../connect.php');
require('../function.php');
check_permissions();
check_admin();
$id=$_POST['id'];
$rez=mysqli_query($con,"SELECT COUNT(user_admin) as kol_adm FROM users WHERE user_admin=1");
$row=mysqli_fetch_assoc($rez);
$rez2=mysqli_query($con,"SELECT user_login,user_admin FROM users WHERE user_id='".$id."'");
$row2=mysqli_fetch_assoc($rez2);
if($row['kol_adm']>1){
	mysqli_query($con,"DELETE FROM users WHERE user_id='".$id."'");
	if($_SESSION['admin']['login']==$row2['user_login']){
		unset($_SESSION['admin']['login']);
	}
}else{
	if($row2['user_admin']==1){
		echo $id;
	}else{
		mysqli_query($con,"DELETE FROM users WHERE user_id='".$id."'");
		if($_SESSION['admin']['login']==$row2['user_login']){
			unset($_SESSION['admin']['login']);
		}
	}
}
?>