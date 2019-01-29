<?php session_start(); ?>
<?php require('../connect.php'); ?>
<?php
  $email=$_POST['email'];
  $pass=$_POST['pass'];
  if($_SESSION['admin']['login']==$_POST['email']){
    echo 'Loggined';
    die();
  }
  $rez=mysqli_query($con,"SELECT user_pass,user_admin FROM users WHERE user_login='$email'");
  if(mysqli_num_rows($rez)==0){
    echo "Не верный логин или пароль";
    die();
  }
  $row=mysqli_fetch_assoc($rez);
  if($row['user_admin']!=1 && $row['user_admin']!=2 && $row['user_admin']!=3){
    echo "У вас нет доступа";
    die();
  }
  if($row['user_pass']!=md5($pass)){
    echo "Не верный логин или пароль";
    die();
  }else{
    $_SESSION['admin']['login']=$email;
    $_SESSION['admin']['prem']=$row['user_admin'];
    echo "OK";
  }
?>