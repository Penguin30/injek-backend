<?php 
require('connect.php');
require('function.php');
$i=0;
while($i<100){
mysqli_query($con,"UPDATE news SET news_section='news_university',news_faculty=NULL");
// mysqli_query($con,"INSERT INTO notifications(title,`text`,`date`) VALUES('test','content',NOW())");
$i++;
}