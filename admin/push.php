<?php 
require('connect.php');
require('function.php');
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
?>
<title>Push уведомления</title>
<div class="container">
	<div class="row">		
		<div class="col-12">
			<a href="/admin/add_push.php" id="add_push"><i class="fas fa-plus"></i> Добавить push уведомление</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="list-group">
				<?php $rez=mysqli_query($con,"SELECT * FROM notifications"); ?>
				<?php while($row=mysqli_fetch_assoc($rez)){ ?>
  					<div class="list-group-item list-group-item flex-column align-items-start">
    					<div class="d-flex w-100 justify-content-between">
      						<h5 class="mb-1"><?php echo $row['title']; ?></h5>
      						<small><?php echo $row['date']; ?></small>
    					</div>
    					<p class="mb-1"><?php echo $row['text']; ?></p>
  					</div>
  				<?php } ?>
			</div>
		</div>
	</div>	
</div>
<?php require('footer.php'); ?>