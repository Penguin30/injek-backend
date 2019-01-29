<?php
require('connect.php');
require('function.php');
check_permissions();
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
?>
<title>Профиль пользователя</title>
<?php 
$id=$_GET['id'];
$rez=mysqli_query($con,'SELECT * FROM users WHERE user_id="'.$id.'"');
$row=mysqli_fetch_assoc($rez);
if(!empty($row['user_fname']) && !empty($row['user_sname'])){
	$name=$row['user_fname'].' '.$row['user_sname'];
}else{
	$name=$row['user_login'];
}
?>
 <div class="container">
 	<form enctype="multipart/form-data" class="needs-validation" method="POST" action="/admin/handlers/edit_user?id=<?php echo $id; ?>">
    <input type="hidden" data-id="<?php echo $id; ?>" id="user_id">
      <div class="py-5 text-center">
        <input type="hidden" id="<?php echo $id; ?>" class="user_id_hid">
        <img class="d-block mx-auto mb-4" src="<?php echo $row['user_photo']; ?>" alt="" width="150px" height="150px">
        <div class="fileform center-block">
			<div id="fileformlabel"></div>
			<div class="selectbutton">Загрузить</div>
			<input type="file" accept="image/*" name="upload" id="upload" onchange="getName(this.value);" />
		</div>
        <h2><?php echo $name; ?></h2>
      </div>
      <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Данные пользователя</h4>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Имя</label>
                <input type="text" name="fname" class="form-control" id="firstName" value="<?php echo $row['user_fname']; ?>" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Фамилия</label>
                <input type="text" name="lname" class="form-control" id="lastName" value="<?php echo $row['user_sname']; ?>" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" name="email" required class="form-control" id="email" value="<?php echo $row['user_login']; ?>">
              <div class="invalid-feedback">
                Этот e-mail уже занят!
              </div>
            </div>
        <div class="row">	
            <div class="col-md-6 mb-3">
              <label for="address">Тип пользователя</label>
              <select class="custom-select d-block w-100" id="user_type" name="user_type" required>
              	<option value="student" <?php if($row['user_type']=='student'){echo 'selected';}?>>Студент</option>
              	<option value="teacher" <?php if($row['user_type']=='teacher'){echo 'selected';}?>>Преподователь</option>
              	<option value="f_student" <?php if($row['user_type']=='f_student'){echo 'selected';}?>>Иностранные студент</option>
              	<option value="enrollee" <?php if($row['user_type']=='enrollee'){echo 'selected';}?>>Абитуриент</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label for="address">Пол</label>
              <select class="custom-select d-block w-100" name="user_sex" required>
              	<option value="male" <?php if($row['user_sex']=='male'){echo 'selected';}?>>Мужской</option>
              	<option value="female" <?php if($row['user_sex']=='female'){echo 'selected';}?>>Женский</option>
              </select>
            </div>
		</div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="country">Активация E-mail</label>
                <select class="custom-select d-block w-100" name="activate" id="activate" required>
                  <option value="0" <?php if($row['user_status']=='0'){echo 'selected';}?>>Не активирован</option>
                  <option value="1" <?php if($row['user_status']=='1'){echo 'selected';}?>>Активирован</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="state">Дата рождения</label>
				<input type="text" name="date_born" id="date_born_c" class="form-control" value="<?php echo $row['date_born']; ?>" data-toggle="datepicker">          
				<input type="hidden" value="<?php echo $row['date_born']; ?>" id="date_born">
              </div>
            </div>
            <div class="row">      
              <div class="col-12">
                <label for="state">Уровень доступа</label>
				<select class="custom-select d-block w-100" name="lvl" required>
					<option value="0" <?php if($row['user_admin']==0){echo 'selected';} ?>>Пользователь</option>
					<option value="1" <?php if($row['user_admin']==1){echo 'selected';} ?>>Глобальный Администратор</option>
          <option value="2" <?php if($row['user_admin']==2){echo 'selected';} ?>>Редактор</option>
          <option value="3" <?php if($row['user_admin']==3){echo 'selected';} ?>>Редактор факультета</option>
				</select>
              </div>
            </div>
            <div class="row add_fields">
              
            </div>
            <hr class="mb-4">
            <button id="user_update_btn" class="btn btn-primary btn-lg btn-block" type="submit">Сохранить</button>
          </form>
          <div class="mb-5"></div>
        </div>
  </div>
</div>
<?php require('footer.php'); ?>
<script>
	$(function() {
      $('[data-toggle="datepicker"]').datepicker({
        format: 'yyyy-mm-dd'
      });
    });
    $('[data-toggle="datepicker"]').on('pick.datepicker', function (e) {    	
  		$('#date_born').val($('[data-toggle="datepicker"]').datepicker('getDate', true)); 
  	});
</script>