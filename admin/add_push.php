<?php 
require('connect.php');
require('function.php');
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
?>
<title>Добавить push уведомления</title>
<div class="container">
	<h2>Добавить push уведомление</h2>
	<form action="/admin/handlers/add_push.php" method="POST">
		<input placeholder="Название push уведомления" type="text" class="form-control mb-5 mt-5" name="name_push">
		<textarea placeholder="Текст push уведомления" name="push_text" class="form-control mb-5" width="100%"></textarea>
		<div class="row">
			<div class="col-sm-4 mb-5">
				<select name="faculty" id="" class="form-control select-faculty-push">
					<option value="">---</option>
					<?php $rez=mysqli_query($con,"SELECT * FROM faculties"); ?>
					<?php while($row=mysqli_fetch_assoc($rez)){ ?>
						<option value="<?php echo $row['faculty_id']; ?>">
							<?php echo $row['faculty_name']; ?>
						</option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-4 mb-5">
				<select name="group" id="" class="form-control select-group-push">
					<option value="">---</option>					
				</select>
			</div>
			<div class="col-sm-4 mb-5">
				<select name="user" id="" class="form-control select-group-user">
					<option value="">---</option>					
				</select>
			</div>
		</div>
		<button class="btn btn-primary btn-dark">Добавить</button>
		<div class="row">
			<label for="" class="not_warn">Если не выбран факультет, группа или пользователи, то уведомление будет отправлено всем</label>
		</div>		
	</form>
</div>
<?php require('footer.php'); ?>