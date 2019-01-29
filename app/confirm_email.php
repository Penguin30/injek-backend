<?php
	session_id('7rj3m9ndo4vnj6aanob76u9507');
	session_start();
	session_id('7rj3m9ndo4vnj6aanob76u9507');
	require('connect.php');
	require('function.php');
	$id=$_GET['id'];
	if(mysqli_query($con,"UPDATE users SET user_status='1' WHERE user_id='".$id."'")){
		header('Location: /');
	}
?>