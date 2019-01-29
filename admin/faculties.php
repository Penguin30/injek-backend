<?php 
require('connect.php');
require('function.php');
check_permissions();
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
?>
<title>Факультеты</title>
<div class="container">
	<div class="row">		
		<div class="col-md-3">
			<a href="javascript:void(0)" onclick="show_add_faculty_form()" id="add_faculty"><i class="fas fa-plus"></i> Добавить факультет</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			<form class="add_faculty_form">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12">
						<input required placeholder="Faculty name" type="text" id="name_faculty" class="form-control">		
						<div class="invalid-feedback">
        					Введите название факультета.
      					</div>	
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<input required placeholder="Faculty short name" type="text" id="short_name_faculty" class="form-control">
						<div class="invalid-feedback">
        					Введите короткое название факультета.
      					</div>			
					</div>
					<button class="btn btn-dark add_faculty_btn">Добавить</button>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<ul class="list-group">
				<?php $rez=mysqli_query($con,"SELECT * FROM faculties");
					while($row=mysqli_fetch_assoc($rez)){
						$rez2=mysqli_query($con,"SELECT faculty_id FROM groups WHERE faculty_id='".$row['faculty_id']."'");
						$row2=mysqli_num_rows($rez2);
				?>
		  		<li onclick="edit_faculty(this)" class="list-group-item d-flex justify-content-between align-items-center">
		  			<a href="/admin/handlers/delete_faculty.php?id=<?php echo $row['faculty_id']; ?>"><i class="far fa-trash-alt"></i></a>
		    		<p class="faculty_name" id="<?php echo $row['faculty_id']; ?>"><?php echo $row['faculty_name']; ?></p>
		    		<p class="faculty_short_name"><?php echo $row['faculty_short_name']; ?></p>
		    		<span class="badge badge-primary badge-pill"><?php echo $row2; ?></span>
		  		</li>		  		
		  	<?php } ?>
			</ul>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>