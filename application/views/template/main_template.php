<!DOCTYPE html>
<html>

<head>

  <!-- Meta Tag -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $page ?> | NFBS Bogor</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?= base_url('public/custom/logo_nf_atas.ico') ?>" rel="shortcut icon" type="image/vnd.microsoft.icon" />
  <!-- Required CSS -->
  <link rel="stylesheet" href="<?= base_url('public') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('public') ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('public') ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url('public') ?>/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= base_url('public') ?>/bower_components/pace/pace-theme-mac-osx.css">
  <link rel="stylesheet" href="<?= base_url('public/bower_components/Ionicons/css/ionicons.min.css') ?>">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= base_url('public') ?>/dist/css/mystyle.css">
  <?php include('load_css.php') ?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <script src="<?= base_url('public') ?>/bower_components/jquery/jquery.min.js"></script>
  <script src="<?= base_url('public') ?>/bower_components/sweetalert2/sweetalert2.all.min.js"></script>
  <script type="text/javascript">
    let base_url = '<?= base_url() ?>';
  </script>
  <style>
    .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('public/custom/loader_nfbs.gif') 50% 50% no-repeat rgb(249, 249, 249);
      opacity: .5;
    }
  </style>
</head>
<!-- Must Load First -->


<body class="hold-transition skin-blue layout-top-nav fixed">
  <div class="wrapper">
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?php echo site_url() ?>" class="navbar-brand" style="padding: 0px !important;">
              <img class="brandlogo-image" src="<?php echo site_url('public/custom/Test.png') ?>"></a>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown <?php echo $menu == "Dashboard" ? "active" : ""; ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">DASBOARD<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">

                  <li><a href="<?php echo site_url('report/absensi_tahfidz') ?>">REPORT ABSENSI AL QUR`AN</a></li>
                  <li><a href="<?php echo site_url('report/tahfidz') ?>">REPORT AL QUR`AN</a></li>
                </ul>
              </li>
              <li><a href="#"><?php echo sesi_tahfidz() . " | " . date('H') ?></a></li>
              <!-- Administrator -->
              <?php if (have_access('nfbs-5ef31438ccf8b')) { ?>
                <li class="dropdown <?php echo $menu == "Master" ? "active" : ""; ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">MASTER<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">                    
                    <?php if (have_access('nfbs-5ef31438ccf8b')) { ?>
                      <li><a href="<?php echo site_url('users') ?>">PENGGUNA</a></li>
                    <?php } ?>                    
                    <?php if (have_access('nfbs-5ef31438ccf8b')) { ?>
                      <li><a href="<?php echo site_url('groups') ?>">GROUP</a></li>
                    <?php } ?>                    
                    <?php if (have_access('nfbs-5ef31438ccf8b')) { ?>
                      <li><a href="<?php echo site_url('mushrif_alquran') ?>">MUSHRIF AL QUR`AN</a></li>
                    <?php } ?>                    
                    <?php if (have_access('nfbs-5ef31438ccf8b')) { ?>
                      <li><a href="<?php echo site_url('asrama') ?>">ASRAMA</a></li>
                    <?php } ?>                    
                    <?php if (have_access('nfbs-5ef31438ccf8b')) { ?>
                      <li><a href="<?php echo site_url('santri') ?>">SANTRI</a></li>
                    <?php } ?>

                    
                  </ul>
                </li>
              <?php } ?>

              <li class="dropdown <?php echo $menu == "Pesantren" ? "active" : ""; ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">KEPESANTRENAN<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <!-- Guru Al Qur`an -->
                  <?php if (have_access('nfbs-5ef31438d5f69')) { ?>
                    <li><a href="<?php echo site_url('alquran') ?>">AL QUR`AN</a></li>
                  <?php } ?>
                </ul>
              </li>
              <li class="dropdown <?php echo $menu == "Sekolah" ? "active" : ""; ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">SEKOLAH<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  
                </ul>
              </li>
              <li class="dropdown <?php echo $menu == "Report" ? "active" : ""; ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">REPORT<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <!-- Guru Al Qur`an -->
                  <?php if (have_access('nfbs-5ef31438d5f69')) { ?>
                    <li><a href="<?php echo site_url('report/absensi_tahfidz') ?>">REPORT ABSENSI AL QUR`AN</a></li>
                  <?php } ?>
                  <!-- Guru Al Qur`an -->
                  <?php if (have_access('nfbs-5ef31438d5f69')) { ?>
                    <li><a href="<?php echo site_url('report/tahfidz') ?>">REPORT AL QUR`AN</a></li>
                  <?php } ?>
                </ul>
              </li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Notifications Menu -->
              <li class="dropdown tasks-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- Inner menu: contains the tasks -->
                    <ul class="menu">
                      <li>
                        <!-- Task item -->
                        <a href="#">
                          <!-- Task title and progress text -->
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <!-- The progress bar -->
                          <div class="progress xs">
                            <!-- Change the css width attribute to simulate progress -->
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo site_url('public') ?>/dist/img/user1.png" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $this->session->userdata('users_nama_lengkap'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo site_url('public') ?>/dist/img/user1.png" class="img-circle" alt="User Image">

                    <p>
                      <?php echo $this->session->userdata('users_nama_lengkap'); ?>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url('auth/logout') ?>" class="btn btn-default">Keluar</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $page ?>
          </h1>
        </section>

        <!-- Main content -->
        <?php echo $contents ?>

        <!-- /.content -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="container">
        <div class="pull-right hidden-xs">
          Page rendered in <strong>{elapsed_time}</strong> seconds. <strong>Developed By LRC NFBS Bogor</strong>
        </div>
        <strong>&copy; <?php echo date('Y') ?></strong> Nurul Fikri Boarding School Bogor

      </div>
      <!-- /.container -->
    </footer>
  </div>
  <!-- ./wrapper -->
  <!-- Required JS -->
  <script src="<?= base_url('public') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url('public') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?= base_url('public') ?>/bower_components/pace/pace.min.js"></script>
  <script src="<?= base_url('public') ?>/dist/js/adminlte.min.js"></script>
  <script src="<?= base_url('public') ?>/bower_components/sweetalert2/bootstrap-notify.min.js"></script>
  <?php include('load_js.php') ?>
  <!-- Custom JS -->
  <script type="text/javascript">
    function reload_ajax() {
      table.ajax.reload(null, false);
    }
  </script>


</body>

</html>