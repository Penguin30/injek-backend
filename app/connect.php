<?php
	$db_name='c1ingek_mob';
	$db_user='c1_penguin';
	$db_pass='gXsmvKN3@P';
	$db_host='localhost';
	$con=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if(!$con){
		$mas['code']=3;
		$mas['msg']='Can not connect to data base';
	}
?>