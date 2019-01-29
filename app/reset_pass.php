<?php session_id('7rj3m9ndo4vnj6aanob76u9507'); ?>
<?php session_start(); ?>
<?php session_id('7rj3m9ndo4vnj6aanob76u9507'); ?>
<?php require('connect.php'); ?>
<?php require('function.php'); ?>
<?php
$email=$_GET['email'];
$link=$site_url.'/app/gen_new_pass.php?email='.$email;
mail($email,'Link reset pass',$link);
	$mas['code']=1;
	$mas['status']='ok';
	echo json_encode($mas);
?>