<?php
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
		if(!isset($login) || !isset($pass))
			$mas['errors'][]=1001;
		echo json_encode($mas, JSON_PRETTY_PRINT);
	}else{
	if(empty($login) || empty($pass)){
		$mas=array();
		$mas['code']=4;
		$mas['status']='error';
		if(empty($pass) || empty($login))
			$mas['errors'][]=1001;
		echo json_encode($mas, JSON_PRETTY_PRINT);
	}else{
		// if(isset($_SESSION[$login]['token']) && !empty($_SESSION[$login]['token'])){
		// $mas['code']=2;
		// $mas['msg']='User alredy loginned';
		// $mas['data']['token']=$_SESSION[$login]['token'];
		// $mas['errors'][]=1002;
		// echo json_encode($mas,JSON_PRETTY_PRINT);
		// die();
		// }
		$rez=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$login."'");
		$row=mysqli_fetch_assoc($rez);
		if($row['user_pass']==md5($pass)){
			$mas=array();
			$mas['code']=1;
			$mas['status']='ok';
			$mas['msg']='You loginned';
			$token=gen_token();
			$_SESSION[$login]['token']=$token;
			$_SESSION[$token]['login']=$login;
			$mas['data']['token']=$_SESSION[$login]['token'];
			echo json_encode($mas, JSON_PRETTY_PRINT);
		}else{
			$mas=array();
			$mas['code']=4;
			$mas['status']='error';
			if(mysqli_num_rows($rez)==0)
				$mas['errors'][]=1001;
			else
				$mas['errors'][]=1001;
			echo json_encode($mas, JSON_PRETTY_PRINT);
		}
	}
}
?>