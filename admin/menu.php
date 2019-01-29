<nav id="main_menu" class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/admin/">KHNEU</a>
    <div class="navbar-header">
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
   <i class="fas fa-bars"></i>
  </button>
</div>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="navbar-nav px-3">
        <?php if($_SESSION['admin']['prem']!=2 && $_SESSION['admin']['prem']!=3){ ?>
	    	  <li class="nav-item">
                <a class="nav-link" href="/admin/">
                  <span data-feather="home"></span>
                  Консоль
                </a>
              </li>
        <?php } ?>
              <?php if($_SESSION['admin']['prem']!=2 && $_SESSION['admin']['prem']!=3){ ?>
                <li class="nav-item">
                  <a class="nav-link" href="/admin/users">
                    <span data-feather="file"></span>
                    Пользователи
                  </a>
                </li>     
              <?php } ?>         
              <li class="nav-item">
                <a class="nav-link" href="/admin/news">
                  <span data-feather="layers"></span>
                  Новости
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/admin/shedule">
                  <span data-feather="layers"></span>
                  Расписание
                </a>
              </li>
              <?php if($_SESSION['admin']['prem']!=2 && $_SESSION['admin']['prem']!=3){ ?>
                <li class="nav-item">
                  <a class="nav-link" href="/admin/faculties">
                    <span data-feather="layers"></span>
                    Факультеты
                  </a>
                </li>
              <?php } ?>
              <?php if($_SESSION['admin']['prem']!=2 && $_SESSION['admin']['prem']!=3){ ?>
                <li class="nav-item">
                  <a class="nav-link" href="/admin/groups">
                    <span data-feather="layers"></span>
                    Группы
                  </a>
                </li>
              <?php } ?>
              <?php if($_SESSION['admin']['prem']!=3){ ?>
              <li class="nav-item">
                <a class="nav-link" href="advertising.php">
                  <span data-feather="layers"></span>
                  Реклама
                </a>
              </li>
            <?php } ?>
              <li class="nav-item">
                <a class="nav-link" href="push.php">
                  <span data-feather="layers"></span>
                  Push уведомления
                </a>
              </li>
              <li class="nav-item logout_sidebar">
                <a class="nav-link" href="/admin/logout">
                  <span data-feather="layers"></span>
                  Выйти
                </a>
              </li>           	   
	    </ul>
	</div>
</nav>