<?php
require('../connect.php');
require('../function.php');
check_admin();
if(!empty($_POST['group'])){
	$rez=mysqli_query($con,"SELECT * FROM users WHERE user_group='".$_POST['group']."'");
	while($row=mysqli_fetch_assoc($rez)){ ?>
		<option value="<?php echo $row['user_id']; ?>">
			<?php echo $row['user_fname']; ?>			
		</option>
	<?php }
}