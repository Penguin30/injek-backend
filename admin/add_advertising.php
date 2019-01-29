<?php 
require('connect.php');
require('function.php');
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
?>
<title>Добавить рекламный банер</title>
<div class="container">
	<h2 class="mb-5">Добавить рекламный баннер</h2>
	<form action="/admin/handlers/add_advertising.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="name_banner">Название баннера</label>
			<input type="text" class="form-control" id="name_banner" name="name_banner">
		</div>
		<div class="form-group">
			<label for="text_banner">Текст баннера</label>
			<input type="text" id="text_banner" name="text_banner" class="form-control">
		</div>
		<div class="form-group">
			<label for="link_banner">Ссылка на партнера</label>
			<input type="text" id="link_banner" name="link_banner" class="form-control">
		</div>
		<div class="form-group">
			<label for="img_banner">Картинка</label>
			<div class="fileform img_banner_upload">
				<div id="fileformlabel"></div>
				<div class="selectbutton">Загрузить</div>
				<input type="file" accept="image/*" name="upload_banner" id="upload" onchange="getName(this.value);" />
			</div>
		</div>
		<button id="add_advertising_btn" class="btn btn-primary btn-dark" type="submit">Добавить</button>
	</form>
</div>
<?php require('footer.php'); ?>