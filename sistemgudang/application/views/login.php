<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>APS Inventory System | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/ionicons.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css'); ?>">
</head>
<body class="hold-transition login-page" align="center">
<div class="login-box">
  <div class="login-logo">
	<img src="<?php echo base_url('assets/image/apslogo.png'); ?>" class="user-image" alt="User Image"></br>
    </br><a>Inventory System</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Masuk Sesuai akun anda</p>
    <form action="<?php echo site_url('discover/masuk');?>" method="post">
		<?php 
        //$this->session->set_flashdata('message', 'value');
        echo show_alert('message');

         ?>
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.2.3.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });
</script>
</body>
</html>