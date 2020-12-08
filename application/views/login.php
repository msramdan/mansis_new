<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman | Log in</title>
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/') ?>/img/favicon.png"/>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">

  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img style="width: 90%;height: auto;margin-top: 20px;" src="<?php echo base_url(); ?>assets/img/logo/logo.png">
<!--     <a href="<?=base_url()?>assets/index2.html"><b>Manajemen</b> Sistem</a> -->
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?=site_url('auth/process')?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
            <div class="form-group">
        <select class="form-control" name="bahasa" required="">
            <option value='1'>-- Pilih Bahasa --</option>
          <?php foreach ($bahasa as $bahasa) { ?>
            <option value="<?php echo $bahasa['bahasa_id']?>"><?php echo $bahasa['name'] ?></option>         
          <?php } ?>
        </select>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="<?php echo base_url() ?>auth/lupa_password">I forgot my password</a><br>
        </div>
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>
