<?php
require('../connect.php');
require('../function.php');
check_admin();
$email=$_POST['email'];
$rez=mysqli_query($con,"SELECT * FROM codes WHERE user_login='".$email."'");
$row=mysqli_fetch_assoc($rez);
if(mysqli_num_rows($rez)>0){
	echo $row['code'];
	die;
}
$rez=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$email."'");
if(mysqli_num_rows($rez)>0){
	echo 'Этот пользователь уже зарегистрирован!';
	die;
}
$symbols='0123456789abcdefghijklmnopqrstuvwxyz';
$length = 10;
$code = '';
for( $i = 0; $i < $length; $i++ )
{
    $num = rand(1, strlen($symbols));
    $code .= substr( $symbols, $num, 1 );   
}               
if(mysqli_query($con,"INSERT INTO codes(user_login,code) VALUES('".$email."','".$code."')")){
	echo $code;
}

?>