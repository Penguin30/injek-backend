<?php
require('../connect.php');
require('../function.php');
check_admin();
if(!empty($_POST['faculty'])){
	$rez=mysqli_query($con,"SELECT * FROM groups WHERE faculty_id='".$_POST['faculty']."'");
	while($row=mysqli_fetch_assoc($rez)){ ?>
		<option value="<?php echo $row['group_id']; ?>">
			<?php echo $row['group_name']; ?>			
		</option>
	<?php }
}else{
	$rez=mysqli_query($con,"SELECT * FROM groups");
	while($row=mysqli_fetch_assoc($rez)){ ?>
		<option value="<?php echo $row['group_id']; ?>">
			<?php echo $row['group_name']; ?>	
		</option>
	<?php }
}
?>