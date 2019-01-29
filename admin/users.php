<?php 
require('connect.php');
require('function.php');
check_permissions();
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
?>
<title>Пользователи</title>
<div class="container">
	<div class="row">
		<div class="col-6">
			<a href="add_user.php"><i class="fas fa-plus"></i> Добавить пользователя</a>
		</div>
		<div class="col-6">
			<a id="gen_code" href="javascript:void(0)"><i class="fas fa-plus"></i> Создать код для учителя</a>
		</div>
	</div>
	<form id="gen_teacher_code_form" action="javascript:void(0)">
		<input id="teacher_email" class="form-control" type="email" placeholder="Введите E-mail преподователя">
		<div class="form-group">
			<button id="gen_code_teach" type="submit" class="btn primary-btn">Сгенерировать</button>
			<p id="techer_code"></p>
		</div>
	</form>
	<div class="row">
		<div class="col-12">
			<ul class="list-group">
					<?php $rez=mysqli_query($con,"SELECT * FROM users"); ?>
					<?php while($row=mysqli_fetch_assoc($rez)){ ?>
					<?php $rez2=mysqli_query($con,"SELECT faculty_name FROM faculties WHERE faculty_id='".$row['user_faculty']."'");
					$row2=mysqli_fetch_assoc($rez2);
					$rez3=mysqli_query($con,"SELECT group_name FROM groups WHERE group_id='".$row['user_group']."'");
					$row3=mysqli_fetch_assoc($rez3);
					?>
					<li class="list-group-item">
						<div class="row">
							<div class="col-1">
								<a id="<?php echo $row['user_id']; ?>" onclick="del_user(this)" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-12">							
								<a href="user.php?id=<?php echo $row['user_id']; ?>"><p><?php echo $row['user_fname'].' '.$row['user_lname']; ?></p></a>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-12">
								<p>
									<?php 
										switch ($row['user_type']) {
											case 'student':
												echo 'Студент';
												break;
											case 'f_student':
												echo 'Иностранный студент';
												break;
											case 'teacher':
												echo 'Преподователь';
												break;
											case 'enrollee':
												echo 'Абитуриент';
												break;
											default:										
												break;
										}
									?>
								</p>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-12">
								<p><?php echo $row2['faculty_name']; ?></p>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-12">
								<p><?php echo $row3['group_name']; ?></p>
							</div>
						</div>
					</li>		
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>