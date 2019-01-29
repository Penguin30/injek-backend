<?php require('function.php'); ?>
<?php if(isset($_SESSION['admin']['login']) && !empty($_SESSION['admin']['login'])){
  header("Location: index.php");
} ?>
<?php require('header.php'); ?>
<title>Login</title>
    <form class="form-signin" action="javascript:void(0)">
      <img class="mb-4" src="img/logo.png" alt="" width="50%" height="50%">
      <h1 class="h3 mb-3 font-weight-normal">Пожалуйста войдите</h1>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
      <label for="inputPassword" class="sr-only">Пароль</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
      <button class="btn btn-lg btn-primary btn-block" id="login_btn">Войти</button>
      <p class="error_login"></p>
    </form>
<?php require('footer.php'); ?>