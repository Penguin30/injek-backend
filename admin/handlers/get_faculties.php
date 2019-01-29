<?php
require('../connect.php');
require('../function.php');
check_admin();
$id_fac=$_POST['id_fac'];
if(!isset($id_fac)){
	$query="SELECT * FROM faculties";
}else{
	$query="SELECT * FROM faculties WHERE faculty_id<>'".$id_fac."'";
}
$rez=mysqli_query($con,$query);
while($row=mysqli_fetch_assoc($rez)){ ?>
<option value="<?php echo $row['faculty_id']; ?>"><?php echo $row['faculty_name']; ?></option>
<?php } ?>