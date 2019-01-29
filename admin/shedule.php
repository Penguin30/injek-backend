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

			<a href="add_shedule.php"><i class="fas fa-plus"></i> Добавить расписание</a>

		</div>

	</div>

	<div class="row mt-5">

		<div class="col-12">

			<form method="POST" action="">
			<h3 class="mb-5">Поиск</h3>
			<div class="row">
				<div class="col-12">
					<input type="text" name="name" class="form-control" placeholder="Название предмета">
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-6">
					<input required type="text" placeholder="2018-07-27" id="date_end" class="form-control" data-toggle="datepicker"> 
				</div>
				<div class="col-6">
					<input required type="text" placeholder="2018-07-30" id="date_start" class="form-control" data-toggle="datepicker"> 
				</div>
			</div>
				
			<input type="hidden" id="date_hid" name="date_s">
			<input type="hidden" id="date_hid" name="date_e">
			</form>

		</div>

	</div>

</div>

<?php require('footer.php'); ?>
<script>

	$('input#date_start').on('input',function(){

		$('#date_s').val($(this).val());

	});

	$(document).ready(function(){       

    $('#date_start').on('pick.datepicker', function (e) {        

        $('#date_s').val($(this).datepicker('getDate',true)); 

    }); 

    $('#date_end').on('pick.datepicker', function (e) {        

        $('#date_e').val($(this).datepicker('getDate',true)); 

    });
    $(function() {

        $('[data-toggle="datepicker"]').datepicker({

            format: 'yyyy-mm-dd',

        });

    });

});

</script>