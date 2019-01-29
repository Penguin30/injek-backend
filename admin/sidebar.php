<nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
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
              <li class="nav-item logout">
                <a class="nav-link" href="/admin/logout">
                  <span data-feather="layers"></span>
                  Выйти
                </a>
              </li>           
            </ul>            
          </div>
        </nav>