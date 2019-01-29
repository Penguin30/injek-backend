<?php
if($_SESSION['admin']['prem']!=2){
require('connect.php');
require('function.php');
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
?>
<title>Добавить пользователя</title>
 <div class="container">
 	<form id="user_form" enctype="multipart/form-data" class="needs-validation" method="POST" action="/admin/handlers/add_user.php">
      <div class="py-5 text-center">        
        <div class="fileform center-block">
			<div id="fileformlabel"></div>
			<div class="selectbutton">Загрузить</div>
			<input type="file" accept="image/*" name="upload" id="upload" onchange="getName(this.value);" />
		</div>
      </div>
      <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Данные пользователя</h4>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Имя</label>
                <input type="text" name="fname" class="form-control" id="firstName" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Фамилия</label>
                <input type="text" name="lname" class="form-control" id="lastName" value="" required>
              </div>
            </div>
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="email">Email</label>
              <input type="email" name="email" required class="form-control" id="email" value="">
              <div class="invalid-feedback">
                Этот e-mail уже занят.
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="email">Пароль</label>
              <input type="password" name="pass" required class="form-control" id="pass" value="">
            </div>
          </div>
        <div class="row">	
            <div class="col-md-6 mb-3">
              <label for="address">Тип пользователя</label>
              <select class="custom-select d-block w-100" id="user_type" name="user_type" required>
              	<option value="student">Студент</option>
              	<option value="teacher">Преподователь</option>
              	<option value="f_student">Иностранный студент</option>
              	<option value="enrollee">Абитуриент</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label for="address">Пол</label>
              <select class="custom-select d-block w-100" name="user_sex" required>
              	<option value="male">Мужской</option>
              	<option value="female">Женский</option>
              </select>
            </div>
		</div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="country">Активация e-mail</label>
                <select class="custom-select d-block w-100" name="activate" id="activate" required>
                  <option value="0">Не активирован</option>
                  <option value="1">Активирован</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="state">Дата рождения</label>
				<input type="text" id="date_born" name="date_born_s" class="form-control" value="" data-toggle="datepicker">          
				<input type="hidden" value="" id="date_born_hid" name="date_born">
              </div>
            </div>
            <div class="row">              
              <div class="col-md-12">
                <label for="state">Уровень доступа</label>
				<select class="custom-select d-block w-100" name="lvl" required>
					<option value="0">Пользователь</option>
					<option value="1">Глобальный администратор</option>
          <option value="2">Редактор</option>
          <option value="3">Редактор факультета</option>
				</select>
              </div>
            </div>
            <div class="row add_fields">
              <div class="col-md-6 mb-3">
                <label for="country">Факультет</label>
                <select class="custom-select d-block w-100" name="faculty" id="faculty" required>
                  <?php $rez2=mysqli_query($con,"SELECT * FROM faculties");  ?>
                  <?php while($row2=mysqli_fetch_assoc($rez2)){ ?>
                    <option value="<?php echo $row2['faculty_id']; ?>"><?php echo $row2['faculty_name']; ?></option>  
                  <?php } ?>                
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="group">Группа</label>
                <select class="custom-select d-block w-100" name="group" id="group" required>
                   <?php $rez2=mysqli_query($con,"SELECT * FROM groups");  ?>
                  <?php while($row2=mysqli_fetch_assoc($rez2)){ ?>
                    <option value="<?php echo $row2['group_id']; ?>"><?php echo $row2['group_name']; ?></option>  
                  <?php } ?>     
               </select>
              </div>
            </div>
            <hr class="mb-4">
            <button id="user_add_btn" class="btn btn-primary btn-lg btn-block" type="submit">Добавить</button>
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
  $('input#date_born').on('input',function(){
    $('#date_born_hid').val($('[data-toggle="datepicker"]').datepicker('getDate', true)); 
  });
    $('[data-toggle="datepicker"]').on('pick.datepicker', function (e) {    	
  		$('#date_born_hid').val($('[data-toggle="datepicker"]').datepicker('getDate', true)); 
  	});
</script>
<?php } ?>