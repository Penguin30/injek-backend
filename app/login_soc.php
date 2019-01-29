<?php

session_start();
//session_id('7rj3m9ndo4vnj6aanob76u9507');

require('connect.php');
require('function.php');

$socType = trim($_GET['soc_type']);
$accessToken = trim($_GET['access_token']);

$obj = new stdClass;

if (trim($_GET['dlt'])) {
	$userid = "go_113015183882603309945";
	$q = "DELETE FROM `users` WHERE `id`='".$userid."'";
			$rez = mysqli_query($con, $q);
}

switch ($socType) {
	case 'fb': loginFb($accessToken); break;
	case 'go': loginGoogle($accessToken); break;
	case 'tw': loginTwitter($accessToken); break;

	default: prepareErrorResponse(2, array(1001));
		// TODO: add an answer
}

echo json_encode($obj);

// if($_GET['soc_type']=='fb'){

// 	require_once __DIR__ . '/Facebook/autoload.php';

// 	$fb = new \Facebook\Facebook([

//   		'app_id' => '435271200318114',

//   		'app_secret' => '415c56693fad75ecb5bf7b3602f30949',

// 		'default_graph_version' => 'v2.10'

// 	]);

// 	try {

//   		$response = $fb->get('/me', $_GET['access_token']);

// 	} catch(\Facebook\Exceptions\FacebookResponseException $e) {

// 		$mas['code']=1;

// 		$mas['status']='error';

// 		$mas['errors'][]=1001;

// 		echo json_encode($mas);

//   		exit;

// 	} catch(\Facebook\Exceptions\FacebookSDKException $e) {

// 		$mas['code']=1;

// 		$mas['status']='error';

// 		$mas['errors'][]=1001;

// 		echo json_encode($mas);

//   		exit;

// 	}

// 	$me = $response->getGraphUser();

// 	$id=$me->getId();

// 	if(isset($id) && !empty($id)){

// 	$rez=mysqli_query($con,"SELECT * FROM users WHERE user_login='fb_".$id."'");

// 	if(mysqli_num_rows($rez)>0){

// 		$mas['code']=1;

// 		$mas['status']='ok';

// 		$mas['data']['token']=md5($id);

// 		$_SESSION[$login]['token']=md5($id);

// 		$_SESSION[$token]['login']=$id;

// 		echo json_encode($mas);

// 	}else{

// 		if(mysqli_query($con,"INSERT INTO users(user_login,user_pass,from_soc) VALUES('fb_".$id."','".md5($pass)."',1)")){

// 			$mas['code']=1;

// 			$mas['status']='ok';

// 			$mas['data']['token']=md5($id);

// 			$_SESSION[$login]['token']=md5($id);

// 			$_SESSION[$token]['login']=$id;

// 			echo json_encode($mas);

// 		}

// 	}

// 	}else{

// 		$mas['code']=1;

// 		$mas['status']='error';

// 		$mas['errors'][]=1001;

// 		echo json_encode($mas);

// 	}

// }elseif($_GET['soc_type']=='go'){



// }elseif($_GET['soc_type']=='tw'){

	

// }

function loginFb($accessToken) {
	global $obj;
	global $con;

	require_once __DIR__ . '/Facebook/autoload.php';

	$fb = new \Facebook\Facebook([
		'app_id' => '435271200318114',
		'app_secret' => '415c56693fad75ecb5bf7b3602f30949',
		'default_graph_version' => 'v2.10'
	]);

	try {
  		$response = $fb->get('/me', $accessToken);

	} catch(\Facebook\Exceptions\FacebookResponseException $e) {
		prepareErrorResponse(1, array(1001));

		return;
	} catch(\Facebook\Exceptions\FacebookSDKException $e) {
		prepareErrorResponse(1, array(1001));

		return;
	}

	$me = $response->getGraphUser();
	$id = $me->getId();
	$photo = 'https://graph.facebook.com/'.$id.'/picture?type=large';
	$fullName = $me->getName();
	$fname = '';
	$lname = '';

	if (isset($fullName) && !empty($fullName)) {
		$fullName = explode(' ', $fullName);
		$fname = $fullName[0];
		$lname = $fullName[1];
	}

	$login = 'fb_' . $id;

	if(isset($id) && !empty($id)) {

		$rez=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$login."'");

		if(mysqli_num_rows($rez)>0) {
			
			$token = gen_token();

			$obj->code = 1;
			$obj->status = 'ok';
			$obj->data = array(
				"token" => $token,
				"login" => $login
			);

			$_SESSION[$login]['token'] = $token;
			$_SESSION[$token]['login'] = $login;

			return;
		} else {
			$content = file_get_contents($photo);
			$pathToCopy = $_SERVER["DOCUMENT_ROOT"] . '/app/img/profiles/' . $login . '.jpg';
			$pathToLocalPhoto = 'https://' . $_SERVER['HTTP_HOST'] . '/app/img/profiles/' . $login . '.jpg';
			
			if (!file_exists($pathToCopy)) {
				$fp = fopen($pathToCopy, "w");
				fwrite($fp, $content);
				fclose($fp);
			}

			$q = "INSERT INTO `users` (`user_login`, `user_pass`, `user_fname`, `user_sname`, `user_photo`) VALUES ('$login', 'randomPass', '".$fname."', '".$lname."', '".$pathToLocalPhoto."')";
			$rez = mysqli_query($con, $q);

			if ($rez) {
				$token = gen_token();

				$obj->code = 1;
				$obj->status = 'ok';
				$obj->data = array(
					"token" => $token,
					"login" => $login
				);

				$_SESSION[$login]['token']= $token;
				$_SESSION[$token]['login']= $login;

				return;
			} else {
				prepareErrorResponse(3, array(4355));
			}
		}
	} else {
		prepareErrorResponse(1, array(1001));
	}
}

function loginGoogle($accessToken) {
	global $obj;
	global $con;
	$q = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $accessToken;
	$json = file_get_contents($q);
	$userInfoArray = json_decode($json,true);
	$id=$userInfoArray['id'];
	$fname = $userInfoArray['given_name'];
	$lname = $userInfoArray['family_name'];
	$photo = $userInfoArray['picture'];
	$login = $userInfoArray['email'];

	if(isset($id) && !empty($id)) {

		$rez=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$login."'");

		if(mysqli_num_rows($rez)>0) {
			$obj->code=1;
			$obj->status='ok';
			$token=gen_token();
			$obj->data = array(
				"token" => $token,
				"login" => $login
			);
			$_SESSION[$login]['token']= $token;
			$_SESSION[$token]['login']= $login;
			return;
			
		} else {
			// Copy photo to server from google
			$content = file_get_contents($photo);
			$pathToCopy = $_SERVER["DOCUMENT_ROOT"] . '/app/img/profiles/' . $login . '.jpg';
			$pathToLocalPhoto = 'https://' . $_SERVER['HTTP_HOST'] . '/app/img/profiles/' . $login . '.jpg';

			if (!file_exists($pathToCopy)) {
				$fp = fopen($pathToCopy, "w");
				fwrite($fp, $content);
				fclose($fp);
			}
			//

			if(mysqli_query($con,"INSERT INTO users (user_login, user_pass, `user_fname`, `user_sname`, `user_photo`) VALUES ('".$login."', 'randomPass', '".$fname."', '".$lname."', '".$pathToLocalPhoto."')")){

				$obj->code=1;
				$obj->status='ok';
				$token=gen_token();
				$obj->data = array(
					"token" => $token,
					"login" => $login
				);
				$_SESSION[$login]['token']= $token;
				$_SESSION[$token]['login']= $login;
				return;
			}else{
				prepareErrorResponse(3, array(4355));
			}
		}
	}else{
		prepareErrorResponse(1, array(1001));
	}
}

function loginTwitter() {
	global $obj;
	$json=file_get_contents('https://api.twitter.com/oauth/authorize?oauth_token=Z6eEdO8MOmk394WozF5oKyuAv855l4Mlqo7hhlSLik');
	$userInfoArray = json_decode($json,true);
	$id=$userInfoArray['id'];
	return;
}

function prepareErrorResponse($code, $errors = array()) {
	global $obj;

	$obj->code = $code;
	$obj->status = 'error';
	$obj->errors = $errors;
}

?>