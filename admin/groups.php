<?php 
require('connect.php');
require('function.php');
check_permissions();
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
$rez=mysqli_query($con,"SELECT * FROM groups");
$rez2=mysqli_query($con,"SELECT * FROM faculties");
?>
<title>Группы</title>
<div class="container">
	<div class="row">
		<div class="col-12">
			<a href="javascript:void(0)" onclick="show_add_faculty_form()" id="add_group"><i class="fas fa-plus"></i> Добавить группу</a>
		</div>
		<div id="add_group_row" class="row">
			<div class="col-md-9">
				<form class="add_faculty_form">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12">
							<input required type="text" placeholder="Group name" id="name_group" class="form-control">	
							<div for="name_group" class="invalid-feedback">
	        					Введите название группы.
	      					</div>
	      				</div>
      					<div class="col-lg-4 col-md-4 col-sm-12">
							<input required type="text" placeholder="Group short name" id="short_name_group" class="form-control">
							<div for="short_name_group" class="invalid-feedback">
	        					Введите короткое название группы.
	      					</div>
	      				</div>
      					<div class="col-lg-4 col-md-4 col-sm-12">	
							<input required type="text" placeholder="Group number" id="number_group" class="form-control">	
							<div for="number_group" class="invalid-feedback">
	        					Введите номер группы.
	      					</div>
	      				</div>
      					<div class="col-12">
							<select id="select_faculty" class="form-control" name="faculties">		
								<?php while($row2=mysqli_fetch_assoc($rez2)){ ?>
									<option value="<?php echo $row2['faculty_id'] ?>"><?php echo $row2['faculty_name']; ?></option>
								<?php } ?>
							</select>		
							<div for="select_faculty" class="invalid-feedback">
	        					Выбирете факультет.
	      					</div>
	      				</div>
						<button class="btn btn-dark add_group_btn">Добавить</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<ul class="list-group">
			<?php while($row=mysqli_fetch_assoc($rez)){ ?>
				<?php $rez3=mysqli_query($con,"SELECT faculty_id,faculty_name FROM faculties WHERE faculty_id='".$row['faculty_id']."'");
					$row3=mysqli_fetch_assoc($rez3);
				?>
				<li id="group-li group-<?php echo $row['group_id']; ?>" data-id="<?php echo $row['group_id']; ?>" class="list-group-item d-flex justify-content-between align-items-center">					
					<a href="javascript:void(0)"><i class="far fa-trash-alt"></i></a>
					<p class="group_name" id="<?php echo $row['group_id']; ?>"><?php echo $row['group_name']; ?></p>
		    		<p class="group_short_name"><?php echo $row['group_short_name']; ?></p>
		    		<p class="group_number"><?php echo $row['group_number']; ?></p>
					<p class="faculty" id="<?php echo $row3['faculty_id']; ?>"><?php echo $row3['faculty_name']; ?></p>
				</li>	  
			<?php } ?>
			</ul>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>