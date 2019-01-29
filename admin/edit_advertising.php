<?php 
require('connect.php');
require('function.php');
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
$id=$_GET['id'];
$rez=mysqli_query($con,"SELECT * FROM advertising WHERE id='".$id."'");
$row=mysqli_fetch_assoc($rez);
?>
<title>Реклама</title>
<div class="container">
	<h2 class="mb-5">Редактировать рекламный баннер</h2>
	<form action="/admin/handlers/edit_advertising.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="name_banner">Название баннера</label>
			<input type="text" value="<?php echo $row['name']; ?>" class="form-control" id="name_banner" name="name_banner">
		</div>
		<div class="form-group">
			<label for="text_banner">Текст баннера</label>
			<input type="text" value="<?php echo $row['text']; ?>" id="text_banner" name="text_banner" class="form-control">
		</div>
		<div class="form-group">
			<label for="link_banner">Ссылка на партнера</label>
			<input type="text" id="link_banner" value="<?php echo $row['link']; ?>" name="link_banner" class="form-control">
		</div>
		<img src="<?php echo $row['banner']; ?>" alt="" width="300px" height="300px;">
		<div class="form-group">		
			<label for="img_banner">Картинка</label>
			<div class="fileform img_banner_upload">
				<div id="fileformlabel"></div>
				<div class="selectbutton">Загрузить</div>
				<input type="file" accept="image/*" name="upload_banner" id="upload" onchange="getName(this.value);" />
			</div>
		</div>
		<button id="edit_advertising_btn" class="btn btn-primary btn-dark" type="submit">Сохранить</button>
	</form>
</div>
<?php require('footer.php'); ?>