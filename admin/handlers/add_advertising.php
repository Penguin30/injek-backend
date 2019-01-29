<?php 
require('../connect.php');
require('../function.php');
$name=$_POST['name_banner'];
$text=$_POST['text_banner'];
$link_part=$_POST['link_banner'];
if(isset($_FILES['upload_banner']['name']) && !empty($_FILES['upload_banner']['name'])){
	$tmp=$_FILES['upload_banner']['tmp_name'];	
	$link='/app/img/advertising/'.$_FILES['upload_banner']['name'];
	$full_link=$site_link.$link;
	if(!empty($tmp)){
		if(move_uploaded_file($tmp,$_SERVER['DOCUMENT_ROOT'].$link)){
			if(mysqli_query($con,"INSERT INTO advertising(name,banner,`text`,link) VALUES('".$name."','".$full_link."','".$text."','".$link_part."')")){
					header('Location:/admin/advertising.php');
			}
		}
	}
}else{
	if(mysqli_query($con,"INSERT INTO advertising(name,`text`,link) VALUES('".$name."','".$text."','".$link."')")){
					header('Location:/admin/advertising.php');
			}
}
?>