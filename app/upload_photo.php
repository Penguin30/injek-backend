<?php

session_start();

session_id('7rj3m9ndo4vnj6aanob76u9507');

require('function.php');

if(!empty($_FILES['user_pict']['name']) && isset($_FILES['user_pict']['name'])){

	$hash=md5($_FILES['user_pict']['tmp_name']);

	if(cropImage($_FILES['user_pict']['tmp_name'],$_SERVER["DOCUMENT_ROOT"].'/app/temp/'.$_FILES['user_pict']['name'], 960, 960)){

		$_FILES['user_pict']['tmp_name']='temp/'.$_FILES['user_pict']['name'];

		$_SESSION[$hash]=$_FILES['user_pict'];

		$_SESSION[$hash]['tmp_name']='temp/'.$_FILES['user_pict']['name'];

		$mas['code']=1;

		$mas['status']='ok';

		$mas['data']['photo_hash']=$hash;

		echo json_encode($mas);

	}

}else{

	$mas['code']=2;

	$mas['status']='error';

	$mas['errors']=1011;

	echo json_encode($mas);

}

	// $data=$_POST['data'];

	// if(!isset($data) || empty($data)){

	// 	$mas['code']=2;

	// 	$mas['status']='error';

	// 	$mas['errors']=1011;

	// 	echo json_encode($mas);

	// }

	// $hash=md5(shorten_text($data,10,'',true));

 //    $file ='temp/'.$hash.'.jpg'; 

	// $rez=file_put_contents($file, $data);

	// if($rez){

	// 	$mas['code']=1;

	// 	$mas['status']='ok';

	// 	$mas['hash']=$hash;

	// 	echo json_encode($mas);	

	// }else{

	// 	$mas['code']=2;

	// 	$mas['errors']=1011;

	// 	$mas['status']='error';

	// 	echo json_encode($mas);	

	// }

?>

