$('.form-signin').submit(function(e){
	e.preventDefault(); 
	var email=$('#inputEmail').val();
	var pass=$('#inputPassword').val();
	$.ajax({
        type:'POST',
        url:'handlers/login.php',
        data:'email='+email+'&pass='+pass,
        success:function(msg){
        	if(msg=='OK' || msg=='Loggined')
        		location.href='/admin';
        	else{
        		$('.error_login').text(msg);
        		setTimeout(function(){$('.error_login').text('');},2000);
        	}
        }
    });
});
function getName (str){
    if (str.lastIndexOf('\\')){
        var i = str.lastIndexOf('\\')+1;
    }
    else{
        var i = str.lastIndexOf('/')+1;
    }                       
    var filename = str.slice(i);            
    var uploaded = document.getElementById("fileformlabel");
    uploaded.innerHTML = filename;
}
$(document).ready(function(){
    $('.animated-icon1,.animated-icon3,.animated-icon4,#burg_menu').click(function(){
        $(this).toggleClass('open');
    });
});
function show_add_faculty_form(){
    if($('.add_faculty_form').css('display')=='none'){
        $('.add_faculty_form').slideDown(1500);
    }else{
        $('.add_faculty_form').slideUp(1500);
    }
}
$('.add_group_btn').on('click',function(e){
    e.preventDefault();
    var name=$('#name_group').val();
    var short=$('#short_name_group').val();
    var num=$('#number_group').val();
    var faculty=$('#select_faculty').val();
    if(name==''){
        $('#name_group').addClass('is-invalid');
    }
    if(short==''){
        $('#short_name_group').addClass('is-invalid');
    }
    if(num==''){
        $('#number_group').addClass('is-invalid');
    }
    if(faculty==''){
        $('#select_faculty').addClass('is-invalid');
    }
    if(name!='' && faculty!='' && num!='' && short!=''){
        $.ajax({
        type:'POST',
        url:'handlers/add_group.php',
        data:'name='+name+'&faculty='+faculty+'&short='+short+'&num='+num,
        success:function(){        
            location.reload();            
        }
    });
    }
});
$('#name_group').on('input',function(){
    $('#name_group').removeClass('is-invalid');
});
$('#short_name_group').on('input',function(){
    $('#short_name_group').removeClass('is-invalid');
});
$('#number_group').on('input',function(){
    $('#number_group').removeClass('is-invalid');
});
$('#select_faculty').change(function(){
    $('#select_faculty').removeClass('is-invalid');
});


$('#name_faculty').on('input',function(){
    $('#name_faculty').removeClass('is-invalid');
});
$('#short_name_faculty').on('input',function(){
    $('#short_name_faculty').removeClass('is-invalid');
});
$('.add_faculty_btn').on('click',function(e){
    e.preventDefault();
    var name=$('#name_faculty').val();
    var s_name=$('#short_name_faculty').val();
    if(name==''){
        $('#name_faculty').addClass('is-invalid');
    }
    if(s_name==''){
        $('#short_name_faculty').addClass('is-invalid');
    }
    if(name!='' && s_name!=''){
        $.ajax({
        type:'POST',
        url:'handlers/add_faculty.php',
        data:'name='+name+'&short='+s_name,
        success:function(){        
            location.reload();            
        }
    });
    }
});
function edit_faculty(el){
    if($(el).children().find('#edit_faculty_input').length > 0) {
        return false;
    }else{
        var p=$(el).children('.faculty_name');
        var s=$(el).children('.faculty_short_name');        
        var id=$(p).attr('id');
        $(p).after(`<form method="POST" class="edit_faculty_form" action="handlers/edit_faculty.php">
                        <input name="faculty_id" type="hidden" value="'+id+'">
                        <input name="faculty_name" class="form-control edit_faculty_input" type="text" id="edit_faculty_input" class="form-control" value="`+$(p).text()+`" required>
                        <input name="faculty_short_name" class="form-control edit_faculty_input" type="text" id="edit_faculty_input" class="form-control" value="`+$(s).text()+`" required>
                        <button type="submit">
                            <i class="far fa-save"></i>
                        </button>
                    </form>`);
        $(p).css('display','none');
        $(s).css('display','none');
    }
}
$(document).ready(function(){
    $('#date_born').mask('0000-00-00');
});
$(document).ready(function(){
    var email=$('input#email').val();
    var id=$('.user_id_hid').attr('id');
    $.ajax({
        type:'POST',
        url:'handlers/check_email.php',
        data:'email='+email+'&id='+id,
        success:function(msg){       
            if(msg=="Ok"){
               $('#user_add_btn').removeAttr('disabled');
               $('input#email').removeClass('is-invalid');
               $('#user_update_btn').removeAttr('disabled');
            }else{
                $('input#email').addClass('is-invalid');
                $('#user_add_btn').attr('disabled',true);
                $('#user_update_btn').attr('disabled',true);
            }            
        }
    });
});
$('input#email').on('input',function(e){
    var email=$('input#email').val();
    var id=$('.user_id_hid').attr('id');
    $.ajax({
        type:'POST',
        url:'handlers/check_email.php',
        data:'email='+email+'&id='+id,
        success:function(msg){       
            if(msg=="Ok"){
               $('button#user_update_btn').removeAttr('disabled');
               $('#user_add_btn').removeAttr('disabled');
               $('input#email').removeClass('is-invalid');
            }else{
                $('#user_add_btn').attr('disabled',true);
                $('#user_update_btn').attr('disabled',true);
                $('input#email').addClass('is-invalid');
            }            
        }
    });
});
function del_user(el){
    var id=$(el).attr('id');
    $.ajax({
        type:'POST',
        url:'handlers/delete_user.php',
        data:'id='+id,
        success:function(msg){       
            if(msg!=''){
               var li=$(el).parents('li');
               if(!$('#error_del_admin').length)
                    $(li).before('<p id="error_del_admin" style="color:red;">Вы не можете удалить последнего администратора!</p>')
               setTimeout(function(){$('#error_del_admin').detach()},3000);
            }else{
               location.reload();
            }            
        }
    });    
}
$(document).ready(function(){
    tinymce.init({ 
        selector:'textarea#news_content',
        height:400,
        plugins: "powerpaste"
        });
});
$(document).ready(function(){
    $('#select_faculty_news_div').css('display','none');
    if($('#news_section').val()=='news_faculty'){
        $('#select_faculty_news_div').css('display','block');
    }
});
$('#news_section').on('change',function(){
    $('#select_faculty_news_div').css('display','none');
    if($('#news_section').val()=='news_faculty'){
        $('#select_faculty_news_div').css('display','block');
    }
});
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:'/admin/handlers/load_news.php',
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.event-list').append(html);
            }
        });
    });
});
$('a#gen_code').on('click',function(){
    if($('#gen_teacher_code_form').css('display')=='block'){
        $('#gen_teacher_code_form').fadeOut(2000);
    }else{
        $('#gen_teacher_code_form').fadeIn(2000);
    }
});
$('#gen_teacher_code_form').submit(function(){
    var email=$('#teacher_email').val();
    $.ajax({
        type:'POST',
        url:'/admin/handlers/gen_code.php',
        data:'email='+email,
        success:function(code){
            $('#techer_code').text(code);
        }
    });
})
$('.group_name').click(function(){
    li=$(this).parents('li');
    var id=$(li).data('id');
    var id_fac=$(li).children('.faculty').attr('id');
    var name=$(li).children('.group_name').text();
    var s_name=$(li).children('.group_short_name').text();
    var num=$(li).children('.group_number').text();
    var fac=$(li).children('.faculty').text();
    var form=`
        <form method="POST" action="/admin/handlers/edit_group.php?id=`+id+`">
            <div class="row">
                <input type="text" value="`+name+`" name="g_name" class="form-control mb-3">
                <input type="text" value="`+s_name+`" name="s_g_name" class="form-control mb-3">
                <input type="text" value="`+num+`" name="num_g" class="form-control mb-3">
                <select value="`+id_fac+`" id="group_faculty_edit" name="group_faculty" class="form-control mb-3">
                    <option value="`+id_fac+`">`+fac+`</option>
                </select>                
                <button class="btn btn-primary btn-dark" type="submit">
                    Сохранить
                </button>
            </div>
        </form>`;
    $(li).html(form);
    $.ajax({
        type:'POST',
        url:'/admin/handlers/get_faculties.php',
        data:'id_fac='+id_fac,
        success:function(html){
            $('#group_faculty_edit').append(html);
        }
    });
});

$(document).ready(function(){    
    var id=$('#user_id').data('id');
    if($('select#user_type').val()=='f_student'){
        $('.add_fields').empty();
        $('.add_fields').html(`
            <div class="col-md-6 col-sm-12">
                <label for="country">Страна</label>
                <input type="text" id="country" name="country" class="form-control">
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="group">Группа</label>
                <select class="custom-select d-block w-100" name="group" id="group" required>
                   
               </select>
            </div>
        `);
        $.ajax({
        type:'POST',
        url:'/admin/handlers/get_groups.php',
        success:function(html){
            $('#group').append(html);
        }
    });        
    $.ajax({
        type:'POST',
        url:'/admin/handlers/get_user.php',
        data: 'id='+id,
        success:function(json){
            var user=jQuery.parseJSON(json);
            $('#country').val(user.country);
            $('#group').val(user['user_group']);
        }
    });
}
    if($('select#user_type').val()=='teacher'){
       $('.add_fields').empty();
        $('.add_fields').html(`
            <div class="col-12">
                <label for="patronymic">Отчество</label>
                <input type="text" id="patronymic" name="patronymic" class="form-control">
            </div>
            `);

        $.ajax({
        type:'POST',
        url:'/admin/handlers/get_user.php',
        data: 'id='+id,
        success:function(json){
            var user=jQuery.parseJSON(json);
            $('#patronymic').val(user['patronymic']);
        }
    });
    }
        if($('select#user_type').val()=='student'){
        $('.add_fields').empty();
        $('.add_fields').html(`
            <div class="col-md-6 col-sm-12">
                <label for="facultie">Факультет</label>
                <select class="custom-select d-block w-100" name="faculty" id="faculty" required>
                   
               </select>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="group">Группа</label>
                <select class="custom-select d-block w-100" name="group" id="group" required>
                   
               </select>
            </div>
        `);
        $.ajax({
        type:'POST',
        url:'/admin/handlers/get_groups.php',
        success:function(html){
            $('#group').append(html);
        }
    });
        $.ajax({
        type:'POST',
        url:'/admin/handlers/get_faculties.php',
        success:function(html){
            $('#faculty').append(html);
        }
    });
    $.ajax({
        type:'POST',
        url:'/admin/handlers/get_user.php',
        data: 'id='+id,
        success:function(json){
            var user=$.parseJSON(json);
            $('#faculty').val(user.user_faculty);
            $('#group').val(user.user_group);
        }
    });
}
if($('select#user_type').val()=='enrollee'){
    $('.add_fields').empty();
}
});

$('select#user_type').change(function(){
    var id=$('#user_id').data('id');
    if($('select#user_type').val()=='f_student'){
        $('.add_fields').empty();
        $('.add_fields').html(`
            <div class="col-md-6 col-sm-12">
                <label for="country">Страна</label>
                <input type="text" id="country" name="country" class="form-control">
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="group">Группа</label>
                <select class="custom-select d-block w-100" name="group" id="group" required>
                   
               </select>
            </div>
        `);
        $.ajax({
        type:'POST',
        url:'/admin/handlers/get_groups.php',
        success:function(html){
            $('#group').append(html);
        }
    });
        $.ajax({
        type:'POST',
        url:'/admin/handlers/get_user.php',
        data: 'id='+id,
        success:function(json){
            var user=jQuery.parseJSON(json);
            $('#country').val(user['country']);
            $('#group').val(user['user_group']);
        }
    });
}
    if($('select#user_type').val()=='teacher'){
       $('.add_fields').empty();
        $('.add_fields').html(`
            <div class="col-12">
                <label for="patronymic">Отчество</label>
                <input type="text" id="patronymic" name="patronymic" class="form-control">
            </div>
            `);
        $.ajax({
        type:'POST',
        url:'/admin/handlers/get_user.php',
        data: 'id='+id,
        success:function(json){
            var user=jQuery.parseJSON(json);
            $('#patronymic').val(user['patronymic']);
        }
    });
    }
        if($('select#user_type').val()=='student'){
        $('.add_fields').empty();
        $('.add_fields').html(`
            <div class="col-md-6 col-sm-12">
                <label for="faculty">Факультет</label>
                <select class="custom-select d-block w-100" name="faculty" id="faculty" required>
                   
               </select>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="group">Группа</label>
                <select class="custom-select d-block w-100" name="group" id="group" required>
                   
               </select>
            </div>
        `);
        $.ajax({
        type:'POST',
        url:'/admin/handlers/get_groups.php',
        success:function(html){
            $('#group').append(html);
        }
    });
        $.ajax({
        type:'POST',
        url:'/admin/handlers/get_faculties.php',
        success:function(html){
            $('#faculty').append(html);
        }
    });
    $.ajax({
        type:'POST',
        url:'/admin/handlers/get_user.php',
        data: 'id='+id,
        success:function(json){
            var user=jQuery.parseJSON(json);
            $('#faculty').val(user['user_faculty']);
            $('#group').val(user['user_group']);
        }
    });
}
if($('select#user_type').val()=='enrollee'){
    $('.add_fields').empty();
}
});
$(document).ready(function(){
    $('#date').mask('0000-00-00');
    $('#time_start').mask('00:00');
    $('#time_end').mask('00:00');
});
$('.select-faculty-push').on('change',function(){
    var faculty=$(this).val();
    $.ajax({
        type:'POST',
        url:'/admin/handlers/get_groups.php',
        data: 'faculty='+faculty,
        success:function(html){
            $('.select-group-push').empty();
            $('.select-group-push').append('<option>---</option>');
            $('.select-group-push').append(html);
        }
    });   
});
$('.select-group-push').on('change',function(){
    var group=$(this).val();
    $.ajax({
        type:'POST',
        url:'/admin/handlers/get_users.php',
        data: 'group='+group,
        success:function(html){
            $('.select-group-user').empty();
            $('.select-group-user').append('<option>---</option>');
            $('.select-group-user').append(html);
        }
    });   
});