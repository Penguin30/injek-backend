<?php 
require('connect.php');
require('function.php');
require('header.php');
require('menu.php');
require('sidebar.php');
$id=$_GET['id'];
?>
<?php $rez=mysqli_query($con,"SELECT * FROM news WHERE news_id='".$id."'"); ?>
<?php $row=mysqli_fetch_assoc($rez); ?>
<?php $rez2=mysqli_query($con,"SELECT * FROM `news-photo` WHERE news_id='".$id."'"); ?>
<title>Редактировать</title>
<div class="container" style="margin-left: 25%;">
	<div class="row mt-5">
		<?php while($row2=mysqli_fetch_assoc($rez2)){ ?>
			<div class="col-3">
				<div class="caption">								
					<!-- <a href="#">Edit</a> -->
					<a href="/admin/handlers/delete_photo?id=<?php echo $row2['id']; ?>">Удалить</a>
				</div>
				<img width="100%" src="<?php echo $row2['photo']; ?>">
			</div>
		<?php } ?>
	</div>
	<div class="row">
		<div class="col-12">
			<form action="/admin/handlers/edit_news.php?id=<?php echo $row['news_id']; ?>" enctype="multipart/form-data" method="POST">
			<a href="javascript:void(0)"><input multiple type="file" accept="image/*" name="news_photos[]" id="news_photo_edit">Загрузить фото</a>				
				<div class="col-12 mb-5">
					<label for="news_title">Заголовок</label>
					<input type="text" value="<?php echo $row['news_title']; ?>" required id="news_title" name="news_title" class="form-control">
				</div>
				<div class="col-12 mb-5">
					<label for="news_content">Новость</label>
					<textarea class="form-control" name="news_content" id="news_content"><?php echo $row['news_content']; ?></textarea>
				</div>
				<?php if($_SESSION['admin']['prem']!=3){ ?>
		<div class="row mb-5">
			<div class="col-6" id="select_section_news_div">
				<label for="news_section">Секция новости</label>
				<select class="form-control" name="news_section" id="news_section">
					<option value="news_university">Новости университета</option>
					<option value="news_faculty">Новости факультета</option>
				</select>
			</div>
			<div class="col-6" id="select_faculty_news_div">
				<label for="select_faculty_news">Выбирете факультет</label>
					<select class="form-control" name="faculty_news" id="select_faculty_news">
						<?php $rez=mysqli_query($con,"SELECT * FROM faculties"); 
							while($row=mysqli_fetch_assoc($rez)){
						?>
							<option value="<?php echo $row['faculty_id'] ?>"><?php echo $row['faculty_name']; ?></option>
						<?php } ?>
					</select>				
			</div>
		</div>
	<?php }else{ 
			$rez2=mysqli_query($con,"SELECT * FROM users WHERE user_login='".$_SESSION['admin']['login']."'");
			$row2=mysqli_fetch_assoc($rez2);
		?>
		<input type="hidden" name="news_section" value="news_faculty">
		<input type="hidden" name="faculty_news" value="<?php echo $row2['user_faculty']; ?>">
	<?php } ?>
			<div class="col-12 mb-5">
				<button id="news_add_btn" class="btn btn-primary btn-lg btn-block" type="submit">Сохранить</button>
			</div>
		</form>
	</div>
	</div>
</div>
<?php require('footer.php'); ?>