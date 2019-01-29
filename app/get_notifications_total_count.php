<?php

session_start();
session_id('7rj3m9ndo4vnj6aanob76u9507');

require('connect.php');
require('function.php');

$token = trim($_GET['token']);

// TODO: 
// Add get function for a current user provided by token

$mas = new stdClass();

if (isset($token) && !empty($token)) {
  $q = 'SELECT * FROM `notifications`';
  $res = mysqli_query($con, $q);
  $count = mysqli_num_rows($res);

  $mas->code = 1;
  $mas->status = 'ok';
  $mas->data = array(
    'count' => $count
  );
} else {
  $mas->code = 6;
  $mas->status = 'error';
}

echo json_encode($mas, JSON_UNESCAPED_UNICODE);