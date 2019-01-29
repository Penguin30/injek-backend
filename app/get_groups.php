<?php
require('connect.php');
require('function.php');
if($rez=mysqli_query($con,"SELECT * FROM groups")){
	$mas['code']=1;
	$mas['status']="OK";
	while($row=mysqli_fetch_assoc($rez)){
		$mas['data'][]=$row;
	}
	echo json_encode($mas,  JSON_UNESCAPED_UNICODE);
}else{
	$mas['code']=3;
	$mas['status']='Error';
}
?>