<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>MAPS</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>assets\images\favicon.ico\apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>assets\images\favicon.ico\apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets\images\favicon.ico\apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets\images\favicon.ico\apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets\images\favicon.ico\apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets\images\favicon.ico\apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>assets\images\favicon.ico\apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets\images\favicon.ico\apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets\images\favicon.ico\apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>assets\images\favicon.ico\android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets\images\favicon.ico\favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets\images\favicon.ico\favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets\images\favicon.ico\favicon-16x16.png">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/AdminLTE.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/iCheck/square/blue.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo"> <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets\images\Mustika_Ratu_Vertical.png" width=""></a> </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php
      $status_login = $this->session->userdata('status_login');
      if (empty($status_login)) {
        $message = "";
      } else {
        $message = $status_login;
      }
      ?>
    <p class="login-box-msg"><?php echo $message; ?></p>
    <form action="<?php echo base_url(); ?>auth/cheklogin" method="post" class="form-signin">
      <!--?php echo form_open('auth/cheklogin'); ?-->
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="email" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span> </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span> </div>
      <div class="form-group has-feedback">
        <label> <?php echo form_checkbox('remember', TRUE, $remember) ?> Remember Me </label>
      </div>
      <div class="row">
        <div class="col-xs-15">
          <button type="submit" class="btn btn-lg btn-login btn-flat"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button>
        </div>
        <!--div class="col-xs-6">  echo anchor('#', '<i class="fa fa-eye-slash" aria-hidden="true"></i> Lupa Password', array('class' => 'btn btn-primary btn-block btn-flat')); ?> </div--> 
      </div>
      <!-- /.col --> 
      
      <!-- /.col -->
      
    </form>
  </div>
  <!-- /.login-box-body --> 
</div>
<!-- /.login-box --> 

<!-- jQuery 3 --> 
<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script> 
<!-- Bootstrap 3.3.7 --> 
<script src="<?php echo base_url(); ?>/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> 
<!-- iCheck --> 
<script src="<?php echo base_url(); ?>/assets/adminlte/plugins/iCheck/icheck.min.js"></script> 
<script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
</body>
</html>