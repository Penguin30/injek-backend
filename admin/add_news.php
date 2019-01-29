<?php
require('connect.php');
require('function.php');
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
?>
<title>Добавить новость</title>
<div class="container">
	<h2>Добавить новость</h2>
	<div class="mb-5"></div>
	<form action="/admin/handlers/add_news.php" enctype="multipart/form-data" method="POST">
		<div class="col-12 mb-5">
			<div class="fileform center-block">
				<div id="fileformlabel"></div>
				<div class="selectbutton">Загрузить</div>
				<input type="file" accept="image/*" id="upload" onchange="getName(this.value);" name="news_photos[]" multiple>			
			</div>			
		</div>
		<div class="col-12 mb-5">
			<label for="news_title">Заголовок новости</label>
			<input type="text" required id="news_title" name="news_title" class="form-control">
		</div>
		<div class="col-12 mb-5">
			<label for="news_content">Текст новости</label>
			<textarea class="form-control" name="news_content" id="news_content"></textarea>
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
			<button id="news_add_btn" class="btn btn-primary btn-lg btn-block" type="submit">Добавить</button>
		</div>
	</form>
</div>
<?php require('footer.php'); ?>