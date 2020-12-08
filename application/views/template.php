<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Manajemen Sistem</title>
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/') ?>/img/favicon.png" />

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <a href="<?= site_url('dashboard') ?>" class="logo">
        <span class="logo-mini"><b>M</b>S</span>
        <span class="logo-lg"><b>Manajemen</b>Sistem</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                  <p>
                    <?= ucfirst($this->fungsi->user_login()->name) ?>
                    <small><?= ucfirst($this->fungsi->user_login()->address) ?></small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= site_url('profil') ?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= site_url('auth/logout') ?>" class="btn btn-danger btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?= ucfirst($this->fungsi->user_login()->username) ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>


        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <?php if ($this->fungsi->user_login()->level == 1 || $this->fungsi->user_login()->level == 2) { ?>
            <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <?php } else { ?>
            <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <?php } ?>


                    <?php
          $session_role_id = $this->fungsi->user_login()->level;
          $queryMenu = "SELECT `user_access_menu`.`id`,`role_id`,`user_menu`.`menu`,`user_menu`.`icon`,`user_menu`.`id` as id_menu
    FROM `user_access_menu` JOIN `user_sub_menu` 
      ON `user_access_menu`.`user_sub_menu` = `user_sub_menu`.`id`
      JOIN `user_menu` 
      ON `user_menu`.`id` = `user_sub_menu`.`menu_id`
   WHERE `user_access_menu`.`role_id` = $session_role_id
   GROUP BY `user_menu`.`id`
      ORDER BY `user_menu`.`urutan` ASC
   ";
          $menu = $this->db->query($queryMenu)->result_array();
          ?>

          <!-- looping menu -->
          <?php foreach ($menu as $m) : ?>
            <!-- Heading -->
            <li class="treeview">
              <a href="#">
                <i class="<?= $m['icon'] ?>"></i> <span><?= $m['menu'] ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

                <?php
                $menuId = $m['id_menu'];
                $querySubMenu = "SELECT `user_access_menu`.`role_id`,`user_access_menu`.`user_sub_menu`,`user_sub_menu`.*
                FROM `user_access_menu` JOIN `user_sub_menu` 
                  ON `user_access_menu`.`user_sub_menu` = `user_sub_menu`.`id`
               WHERE `user_sub_menu`.`menu_id` = $menuId
               AND `user_sub_menu`.`is_active` = 1
               AND `user_access_menu`.`role_id` = $session_role_id
               
               ";
                $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>

                <?php foreach ($subMenu as $sm) : ?>
                  <!--  <?php if ($title == $sm['title']) : ?>
            <li class="active">
          <?php else : ?>
            <li>
          <?php endif; ?> -->
                  <li><a href="<?= base_url($sm['url']) ?>"><i class="<?= $sm['icon'] ?>"></i><?= $sm['title'] ?></a></li>
                <?php endforeach; ?>





              </ul>
            </li>
          <?php endforeach ?>
        </ul>

      </section>
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php echo $contents ?>
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; <?php echo date("Y") ?> <a href="https://kangramdan.com" target="_blank">MsRamdan</a>.</strong> All rights
      reserved.
    </footer>


    <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>

    <script src="<?= base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/number_format.js"></script>
    <script>
      $(document).ready(function() {
        $('#table1').DataTable()
        $('#table2').DataTable()
        $('#table3').DataTable()
      })
    </script>



</body>

</html>