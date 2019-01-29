<?php
	session_id('7rj3m9ndo4vnj6aanob76u9507');
	session_start();
	session_id('7rj3m9ndo4vnj6aanob76u9507');
	require('connect.php');
	require('function.php');
	$login=$_GET['login'];
	$pass=$_GET['pass'];
	if(!isset($login) || !isset($pass)){
		$mas=array();
		$mas['code']=2;
		$mas['status']='error';
		if(!isset($login))
			$mas['errors'][]=1002;
		if(!isset($pass))
			$mas['errors'][]=1003;
		echo json_encode($mas, JSON_PRETTY_PRINT);
		die;
	}
	if(empty($login) || empty($pass)){
		$mas=array();
		$mas['code']=4;
		$mas['status']='error';
		if(empty($pass))
			$mas['errors'][]=1003;
		if(empty($login))
			$mas['errors'][]=1002;
		echo json_encode($mas, JSON_PRETTY_PRINT);
		die;
	}
	$rez=mysqli_query($con,"SELECT user_id FROM users WHERE user_login='".$login."'");
	if(mysqli_num_rows($rez)>0){
		$mas=array();
		$mas['code']=4;
		$mas['status']='error';
		$mas['msg']='This login already exists';
		$mas['errors'][]=1010;
		echo json_encode($mas, JSON_PRETTY_PRINT);
		die;
		}
		$row=mysqli_fetch_assoc($rez);
		if($result=mysqli_query($con,"INSERT INTO users (user_login,user_pass) VALUES ('".$login."','".md5($pass)."')")){
			$mas['code']=1;
			$mas['status']='ok';
			$mas['msg']='You registered';
			$mas['data']['token']=gen_token();
			$token=$mas['data']['token'];
			$_SESSION[$login]['token']=$mas['token'];	
			$_SESSION[$token]['login']=$login;		
			// $conf_link = $site_link.'app/confirm_email?token='.$login;
			// mail($login, 'Confirm your email', 'Check');
			echo json_encode($mas, JSON_PRETTY_PRINT);				
		}
		else{
		 	$mas=array();
		 	$mas['code']=3;
		 	$mas['status']='error';
			if(mysqli_num_rows($rez)==0)
				$mas['errors'][]=1002;
			else
				$mas['errors'][]=1003;
		 	echo json_encode($mas, JSON_PRETTY_PRINT);
		}
?>