<?php
require('connect.php');
require('function.php');
check_permissions();
check_admin();
require('header.php');
require('menu.php');
require('sidebar.php');
?>
<title>Расписание</title>
<div class="container">
	<div class="row">
		<div class="col-12">
			<form method="POST" action="/admin/handlers/add_shedule.php">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label for="name_les">Название предмета</label>
							<input required type="text" placeholder="Економика" class="form-control" name="name_les" id="name_les">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="form-group">
							<label for="date">Дата</label>
							<input required type="text" placeholder="2018-07-27" name="date" id="date" class="form-control" data-toggle="datepicker"> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="form-group">
							<label for="type_les">Тип занятия</label>
							<input required type="text" placeholder="Лекция" class="form-control" name="type_les" id="type_les">
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="form-group">
							<label for="groups_select">Группы</label>
							<select required multiple class="form-control" id="groups_select" name="groups[]">
								<?php $rez=mysqli_query($con,"SELECT * FROM groups"); ?>
								<?php while($row=mysqli_fetch_assoc($rez)){ ?>
									<option value="<?php echo $row['group_id']; ?>"><?php echo $row['group_name']; ?></option>
								<?php } ?>
    						</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="form-group">
							<label for="teacher">Преподователь</label>
							<input required type="text" class="form-control" id="teacher" name="teacher" placeholder="Литвин Александр Александрович">
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="form-group">
							<label for="aud">Аудитория</label>
							<input required type="text" class="form-control" id="aud" name="aud" placeholder="215">
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="form-group">
							<label for="hous">Корпус</label>
							<input type="text" class="form-control" id="hous" name="hous" placeholder="2">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="time_start">Время начала пары</label>
							<input type="text" class="form-control" class="time_start" id="time_start" name="time_start">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="form-group">
							<label for="time_end">Время конца пары</label>
							<input type="text" class="form-control" class="time_end" id="time_end" name="time_end">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-dark btn-block">Добавить</button>
						</div>
					</div>
				</div>
				<input type="hidden" id="date_hid" name="date_hid">
			</form>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>
<script>
	$('input#date').on('input',function(){
		$('#date_hid').val($('input#date').val());
	});
	$(document).ready(function(){       
    $('[data-toggle="datepicker"]').on('pick.datepicker', function (e) {        
        $('#date_hid').val($('[data-toggle="datepicker"]').datepicker('getDate',true)); 
    });         
    $(function() {
        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-mm-dd',
        });
    });
    $('[data-toggle="datepicker"]').on('pick.datepicker', function (e) {        
        $('#date_hid').val($('[data-toggle="datepicker"]').datepicker('getDate', true)); 
    });
});
</script>