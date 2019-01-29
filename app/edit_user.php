<?php session_id('7rj3m9ndo4vnj6aanob76u9507'); ?>
<?php session_start(); ?>
<?php session_id('7rj3m9ndo4vnj6aanob76u9507'); ?>
<?php require('connect.php'); ?>
<?php require('function.php'); ?>
<?php 
$token=$_GET['token'];
if(!isset($token) || empty($token)){
	$mas['code']=6;
	$mas['status']='Error';
	echo json_encode($mas, JSON_PRETTY_PRINT);
	die;
}
if(!isset($_SESSION[$token]['login']) || empty($_SESSION[$token]['login'])){
	$mas['code']=4;
	$mas['msg']='User is not loggined or invalid token';
	echo json_encode($mas, JSON_PRETTY_PRINT);
	die();
}
$fname=$_GET['fname'];
$lname=$_GET['lname'];
$login=$_GET['login'];
$rez=mysqli_query($con,"SELECT user_login FROM users WHERE user_login='".$_SESSION[$token]['login']."'");
$row=mysqli_fetch_assoc($rez);
$old_login=$row['user_login'];
if($login!=$old_login){
	$rez=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$login."'");
	if(mysqli_num_rows($rez)>0){
		$mas['code']=4;
		$mas['msg']='This login alredy exists';
		echo json_encode($mas, JSON_PRETTY_PRINT);
		die();
	}
}
$row2=mysqli_fetch_assoc($rez);
$user_type=$_GET['type'];
if($user_type=='student'){
	$faculty=$_GET['faculty'];
	$group=$_GET['group'];
	$mas['code']=2;
	$mas['status']='error';
	if(empty($faculty) || !isset($faculty)){
		$mas['code']=2;
		$mas['status']='error';
		$mas['errors'][]=1007;
		echo json_encode($mas);
		die;
	}
	if(empty($group) || !isset($group)){
		$mas['code']=2;
		$mas['status']='error';
		$mas['errors'][]=1008;
		echo json_encode($mas);
		die;
	}
}
if($user_type=='f_student'){
	$country=$_GET['country'];
	$group=$_GET['group'];	
	if(empty($country) || !isset($country)){
		$mas['code']=2;
		$mas['status']='error';
		$mas['errors'][]=1012;
		echo json_encode($mas);
		die;
	}
	if(empty($group) || !isset($group)){
		$mas['code']=2;
		$mas['status']='error';
		$mas['errors'][]=1008;
		echo json_encode($mas);
		die;
	}
}
if($user_type=='teacher'){
	$code=$_GET['code_ver'];
	$patronymic=$_GET['patronymic'];
	if(empty($code) || !isset($code)){
		$mas['code']=2;
		$mas['status']='error';
		$mas['errors'][]=1013;
		echo json_encode($mas);
		die;
	}
	if(empty($patronymic) || !isset($patronymic)){
		$mas['code']=2;
		$mas['status']='error';
		$mas['errors'][]=1014;
		echo json_encode($mas);
		die;
	}
}
if(!isset($login) || empty($login)){
	$login=$old_login;
}
if(!isset($_GET['pass']) || empty($_GET['pass'])){
	$rez=mysqli_query($con,"SELECT user_pass FROM users WHERE user_login='".$old_login."'");
	$row=mysqli_fetch_assoc($rez);
	$pass=$row['user_pass'];
}else{
	$pass=md5($_GET['pass']);
}
$photo=$_GET['photo'];
$sex=$_GET['sex'];
$date_born=$_GET['date_born'];
$faculty=$_GET['faculty'];
$group=$_GET['group'];
if(mysqli_query($con,"UPDATE users SET user_login='".$login."',user_pass='".$pass."',user_sex='".$sex."',date_born='".$date_born."',user_fname='".$fname."',user_type='".$user_type."',user_sname='".$lname."',user_faculty='".$faculty."',user_group='".$group."',country='".$country."',patronymic='".$patronymic."' WHERE user_login='".$old_login."'")){
	$_SESSION[$token]['login']=$login;
	$_SESSION[$login]['token']=$token;
	if(isset($photo) || !empty($photo)){
		$file_name=$_SESSION[$photo]['name'];
		$path = 'img/profiles';
		$ext = array_pop(explode('.',$_SESSION[$photo]['name']));
		$new_name = $login.'.'.$ext; // новое имя с расширением
		$link=$path.'/'.$new_name;
		$full_link=$site_link.'app/'.$link;
		if($_SESSION[$photo]['error'] == 0){
			// echo $_SERVER["DOCUMENT_ROOT"].'/app/'.$_SESSION[$photo]['tmp_name'];
			if(rename($_SERVER["DOCUMENT_ROOT"].'/app/'.$_SESSION[$photo]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].'/app/'.$link)){
	    		if(mysqli_query($con,"UPDATE users SET user_photo='".$full_link."' WHERE user_login='".$login."'")){
	    			unset($_SESSION[$photo]);
	    			$mas['code']=1;
					$mas['msg']='Data updated';
					echo json_encode($mas, JSON_PRETTY_PRINT);
				}else{
					$mas['code']=3;
	    			$mas['status']='error';
	    			$mas['msg']='Data did not update in DB';
	    			echo json_encode($mas);
				}
	    	}else{
	    		$mas['code']=3;
	    		$mas['status']='error';
	    		$mas['msg']='Photo did not upload';
	    		$mas['errors'][]=1015;
	    		echo json_encode($mas);
	    	}
	    }else{
	    	$mas['code']=3;
	    	$mas['status']='error';
	    	$mas['msg']='Error with photo';
	    	$mas['errors'][]=1015;
	    	echo json_encode($mas);
	    }
	}else{
		$mas['code']=1;
		$mas['msg']='Data updated';
		echo json_encode($mas, JSON_PRETTY_PRINT);
	}
}
?>