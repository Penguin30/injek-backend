<?php
require('../connect.php');
require('../function.php');
check_admin();
$name=$_POST['name_les'];
$date=$_POST['date_hid'];
$type=$_POST['type_les'];
$groups=$_POST['groups'];
$teacher=$_POST['teacher'];
$audience=$_POST['aud'];
$housing=$_POST['hous'];
$time_start=$_POST['time_start'];
$time_end=$_POST['time_end'];
$rez=mysqli_query($con,"INSERT INTO shedule(`date`,type_les,name_les,teacher_les,audience,housing,time_start,time_end) VALUES('".$date."','".$type."','".$name."','".$teacher."','".$audience."','".$housing."','".$time_start."','".$time_end."')");
if($rez){
	$rez=mysqli_query($con,"SELECT MAX(id) as id FROM shedule");
	$row=mysqli_fetch_assoc($rez);
	foreach($groups as $group){
		$rez=mysqli_query($con,"INSERT INTO shedule_groups(group_id,shedule_id) VALUES('".$group."','".$row['id']."')");
		if($rez){
			header('Location:/admin/shedule.php');
		}
	}
}
?>