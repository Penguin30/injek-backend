<?php
$site_link='https://www.hneu.edu.ua';
session_start();
function check_admin(){
	if($_SESSION['admin']['login']==''){
    	?>
    	<script>
	    	location.href='/admin/login'
    	</script>
    	<?php
    	die();
  	}
}
function check_permissions(){
    if($_SESSION['admin']['prem']==2 || $_SESSION['admin']['prem']==3){ ?>
        <script>
            location.href='/admin/news';
        </script>
    <?php die;} 
}
function shorten_text($text, $max_length = 140, $cut_off = '...', $keep_word = false)
{
    if(strlen($text) <= $max_length) {
        return $text;
    }

    if(strlen($text) > $max_length) {
        if($keep_word) {
            $text = substr($text, 0, $max_length + 1);

            if($last_space = strrpos($text, ' ')) {
                $text = substr($text, 0, $last_space);
                $text = rtrim($text);
                $text .=  $cut_off;
            }
        } else {
            $text = substr($text, 0, $max_length);
            $text = rtrim($text);
            $text .=  $cut_off;
        }
    }

    return $text;
}