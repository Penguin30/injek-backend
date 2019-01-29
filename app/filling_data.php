<?php 

session_start();

session_id('7rj3m9ndo4vnj6aanob76u9507');

require('connect.php');

require('function.php');

$token=$_GET['token'];

if(empty($token) || !isset($token)){

	$mas['code']=6;

	$mas['status']='Error';

	echo json_encode($mas, JSON_PRETTY_PRINT);

	die();

}

$user_type=$_GET['user_type'];

if($user_type=='student'){

	$faculty=$_GET['faculty'];

	$group=$_GET['group'];

	if(empty($faculty) || !isset($faculty)){
		$mas['code']=2;

		$mas['status']='error';

		$mas['errors'][]=1007;

	}

	if(empty($group) || !isset($group)){
		$mas['code']=2;

		$mas['status']='error';
		
		$mas['errors'][]=1008;

	}

	echo json_encode($mas);
	die();

}

if($user_type=='f_student'){

	$country = trim($_GET['country']);

	if (!isset($country) || empty($country)) {
		$mas['code'] = 2;
		$mas['status'] = 'error';
		$mas['errors'][] = 1012;
	}

	if ($mas['code'] == 2) {
		echo json_encode($mas);
		die();

	} else {
		// TODO: do something with this data!

		$mas['code'] = 1;
		$mas['status'] = 'ok';

		echo json_encode($mas);
		die();
	}
}

// TODO: юзлес
if ($user_type=='teacher') {

	$code_ver = trim($_GET['code_ver']);
	$patronymic = trim($_GET['patronymic']);

	if (!isset($code_ver) || empty($code_ver)) {
		$mas['code'] = 2;
		$mas['status'] = 'error';
		$mas['errors'][] = 1013;
	}

	if (!isset($patronymic) || empty($patronymic)) {
		$mas['code'] = 2;
		$mas['status'] = 'error';
		$mas['errors'][] = 1014;
	}

	if ($mas['code'] == 2) {
		echo json_encode($mas);
		die();

	} else {
		// TODO: do something with this data!

		$mas['code'] = 1;
		$mas['status'] = 'ok';

		echo json_encode($mas);
		die();
	}

}

if($user_type=='enrolle'){

	

}

$sex=$_GET['sex'];

$date_b=$_GET['date_born'];

$fname=$_GET['fname'];

$lname=$_GET['lname'];

$photo=$_GET['photo'];

if(!isset($token) || !isset($user_type) || !isset($fname) || !isset($lname) || !isset($sex)){

	$mas['code']=2;

	// if(!isset($code))

	// 	$mas['errors'][]=1013;

	// if(!isset($country))

	// 	$mas['errors'][]=1012;

	if(!isset($sex))

		$mas['errors'][]=1004;

	if(!isset($user_type))

		$mas['errors'][]=1009;

	if(!isset($fname))

		$mas['errors'][]=1005;

	if(!isset($lname))

		$mas['errors'][]=1006;

	if(!isset($faculty))

		$mas['errors'][]=1007;

	if(!isset($group))

		$mas['errors'][]=1008;

	echo json_encode($mas, JSON_PRETTY_PRINT);

	die;

}

if(empty($token) || empty($user_type) || empty($fname) || empty($lname) || empty($sex)){

	$mas['code']=2;

	// if(empty($code))

	// 	$mas['errors'][]=1013;

	// if(empty($country))

	// 	$mas['errors'][]=1012;

	if(empty($sex))

		$mas['errors'][]=1004;

	if(empty($user_type))

		$mas['errors'][]=1009;

	if(empty($fname))

		$mas['errors'][]=1005;

	if(empty($lname))

		$mas['errors'][]=1006;

	if(empty($faculty))

		$mas['errors'][]=1007;

	if(empty($group))

		$mas['errors'][]=1008;

	echo json_encode($mas, JSON_PRETTY_PRINT);

	die;

}

// if($user_type=='teacher'){

// 	$rez=mysqli_query($con,"SELECT * FROM codes WHERE user_login='".$_SESSION[$token]['login']."'");

// 	$row=mysqli_fetch_asssoc($rez);

// 	if($code!=$row['code']){

// 		$mas['status']='error';

// 		$mas['errors'][]=1013;

// 		echo json_encode($mas);

// 		die;

// 	}else{

// 		mysqli_query($con,"DELETE FROM codes WHERE user_login='".$_SESSION[$token]['login']."'");

// 	}

// }

if(mysqli_query($con,"UPDATE users SET user_type='".$user_type."',user_sex='".$sex."',date_born='".$date_b."',user_fname='".$fname."',user_sname='".$lname."',user_faculty='".$faculty."',user_group='".$group."',county='".$county."',patronymic='".$patronymic."' WHERE user_login='".$_SESSION[$token]['login']."'")){

	if(isset($photo) && !empty($photo)){

		$file_name=$_SESSION[$photo]['name'];

		$path = 'img/profiles';

		$ext = array_pop(explode('.',$_SESSION[$photo]['name']));

		$new_name = $_SESSION[$token]['login'].'.'.$ext; // новое имя с расширением

		$link=$path.'/'.$new_name;

		$full_link=$site_link.'app/'.$link;

		if($_SESSION[$photo]['error'] == 0){

	    	if(rename($_SERVER["DOCUMENT_ROOT"].'/'.$_SESSION[$photo]['tmp_name'],$_SERVER["DOCUMENT_ROOT"].'/app/'.$link)){

	    		if(mysqli_query($con,"UPDATE users SET user_photo='".$full_link."' WHERE user_login='".$_SESSION[$token]['login']."'")){

	    			$rez5=mysqli_query($con,"SELECT user_id FROM users WHERE user_login='".$_SESSION[$token]['login']."'");

	    			$row5=mysqli_fetch_asssoc($rez5);

	    			unset($_SESSION[$photo]);

	    			$mas['code']=1;

					$mas['msg']='Registration completed';

					$conf_link = $site_link.'app/confirm_email?id='.$row5['user_id'];	

					mail($_SESSION[$token]['login'], 'Confirm your email',$conf_link);

					echo json_encode($mas, JSON_PRETTY_PRINT);

				}

	    	}

		}

	} else {

		$mas['code']=1;

		$mas['msg']='Registration completed';

		$conf_link = $site_link.'app/confirm_email?token='.$token;				

		mail($_SESSION[$token]['login'], 'Confirm your email',$conf_link);

		echo json_encode($mas, JSON_PRETTY_PRINT);
		die();
	}

}

?>

