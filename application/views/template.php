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
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui/themes/base/minified/jquery-ui.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/skins/_all-skins.min.css">
  
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/datatables/responsive.dataTables.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

  <!-- Google Font -->
  <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"-->
</head>

<!--body class="hold-transition skin-blue sidebar-mini"-->
  <!-- AUTO HIDE -->
  <body class="skin-blue sidebar-mini sidebar-collapse" style="height: auto; min-height: 100%;">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url() ?>index.php/welcome" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <!--span class="logo-mini"><b>A</b>RC</span-->
        <span class="logo-mini"><img src="<?php echo base_url() ?>assets/images/Mustika_Ratu_Horizontal_icon.png" /></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="<?php echo base_url() ?>assets/images/Mustika_Ratu_Horizontal.png" /></span> </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #8E744B), color-stop(1, #FFD662));">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="icon-bar"></span> 
      <span class="icon-bar"></span> 
      <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- notif -->
			<?php
				//get data promotion
				$id_users = $this->session->userdata('id_users');
				$query = "SELECT COUNT(form_promotion.promotion_number) AS count_notif FROM form_promotion LEFT JOIN wf_program ON form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme WHERE wf_program.id_users = '".$id_users."' AND form_promotion.status IN ('0','1')";
				$count_notif = $this->db->query($query)->row();
		
				$query_promotion = "SELECT form_promotion.promotion_id, form_promotion.promotion_number FROM form_promotion LEFT JOIN wf_program ON form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme WHERE wf_program.id_users = '".$id_users."' AND form_promotion.status IN ('0','1')";
				$data = $this->db->query($query_promotion)->result();
		
				if ($count_notif->count_notif > 0){
					echo "<li class='dropdown notifications-menu'>
            				<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
              					<i class='fa fa-bell-o'></i>
              						<span class='label label-danger' style='font-size: 13px'>".$count_notif->count_notif."</span>
            				</a>
            				<ul class='dropdown-menu'>
              					<li class='header'>You have ".$count_notif->count_notif." waiting approval</li>
							<li>
                				<ul class='menu'>";
								foreach ($data as $data_promotion){
                  					echo "<li>
                    					<a href='".site_url('wf_program/read/'),$data_promotion->promotion_id."'>
                      						<i class='fa fa-file-text-o text-aqua'></i> ".$data_promotion->promotion_number."
                    					</a>
                  					</li>";
								}
                				echo "</ul>
              				</li>
              				<li class='footer'><a href='".site_url('wf_program')."'>View all</a></li>
            				</ul>
          				</li>";
				} else {
					echo "<li class='dropdown notifications-menu'>
            				<a href='#' class='dropdown-toggle' data-toggle='dropdown'>
              					<i class='fa fa-bell-o'></i>
              						<span class='label label-danger' style='font-size: 13px'>".$count_notif->count_notif."</span>
            				</a>
            				<ul class='dropdown-menu'>
              					<li class='header'>You have ".$count_notif->count_notif." waiting approval</li>
              					<li class='footer'><a href='".site_url('wf_program')."'>View all</a></li>
            				</ul>
          				</li>";
				}
		  ?>
			<!-- end notif -->
            <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="">
                <!--img src="?php echo base_url() ?>assets/foto_profil/?php echo $this->session->userdata('images'); ?>" class="user-image" alt="User Image"-->
                <!--img src="?php echo base_url() ?>assets/foto_profil/user.png" class="user-image" alt="User Image"-->
                <div class="circle_account"> <b><?php echo strtoupper(substr($this->session->userdata('full_name'), 0, 1)); ?></b> </div>
                <span class="hidden-xs"><?php echo $this->session->userdata('full_name'); ?> </span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <!--img src="?php echo base_url() ?>assets/foto_profil/?php echo $this->session->userdata('images'); ?> " class="img-circle" alt="User Image"-->
                  <p> <?php echo $this->session->userdata('full_name'); ?> </p>
                </li>
                <!--li class="user-footer">
                <div class="pull-left"> ?php echo anchor('user/profile', 'Profile', array('class' => 'btn btn-default btn-flat')); ?> </div>
                <div class="pull-right"> ?php echo anchor('auth/logout', 'Logout', array('class' => 'btn btn-default btn-flat')); ?> </div>
              </li-->
              </ul>
            </li>
            <!--li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li-->
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <?php $this->load->view('template/sidebar'); ?>
    </aside>
    <?php echo $contents; ?>

    <!-- /.content-wrapper -->
    <!--footer class="main-footer"> <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io" target="_blank">Almsaeed Studio</a>.</strong> All rights
    reserved. </footer-->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/jquery-ui/ui/minified/jquery-ui.min.js"></script>
  <!-- jQuery 3
        <script src="<?php echo base_url() ?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
         -->
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url() ?>assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url() ?>assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() ?>assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/adminlte/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() ?>assets/adminlte/dist/js/demo.js"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url() ?>assets/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo base_url() ?>assets/datatables/dataTables.responsive.js"></script>
  <!-- page script -->
  <script>
    $(function() {
      $('.select2').select2()
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': true,
		'responsive': true,
      })
    })
  </script>


</body>

</html>