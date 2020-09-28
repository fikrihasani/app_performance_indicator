<!DOCTYPE html>
<?php $user = $this->session->userdata('pengguna');?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SI Antenatal Care | Beranda</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/flat/blue.css'); ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css'); ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/morris/morris.css'); ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css'); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css'); ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/colorpicker/bootstrap-colorpicker.min.css'); ?>">
	<!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.min.css'); ?>">  
	
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SI</b>AC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SI</b> Antenatal Care</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
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
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src=""<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user['username']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user['username']; ?>
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url('home/user_edit/').$user['id_user'];?>" class="btn btn-default btn-flat">Ubah Profil</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('home/keluar');?>" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['username']; ?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGASI MENU</li>
        <li class="treeview">
          <a href="<?php echo site_url('home/dashboard');?>">
            <i class="fa fa-home"></i> <span>Beranda</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Kohort</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  <ul class="treeview-menu">
            <li><a href="<?php echo site_url('home/ibu_input');?>"><i class="fa fa-circle-o"></i>Tambah Data Ibu</a></li>
            <li><a href="<?php echo site_url('home/kohort_input');?>"><i class="fa fa-circle-o"></i>Tambah Data Kehamilan Baru</a></li>
            <li><a href="<?php echo site_url('home/pemeriksaan_input');?>"><i class="fa fa-circle-o"></i>Tambah Data Pemeriksaan Baru</a></li>
            <li><a href="<?php echo site_url('home/kohort_input');?>"><i class="fa fa-circle-o"></i>Ubah Data Kehamilan Berjalan</a></li>
            <li><a href="<?php echo site_url('home/kohort_input');?>"><i class="fa fa-circle-o"></i>Data Menunggu Verifikasi</a></li>
            <li><a href="<?php echo site_url('home/kohort_input');?>"><i class="fa fa-circle-o"></i>Data Gagal Verifikasi</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i>
            <span>Grafik</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('home/kehamilan_berjalan_daftar');?>"><i class="fa fa-circle-o"></i>Kehamilan Tahun Berjalan</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i>Kehamilan 5 Tahun Terakhir</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Data Pasien</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('home/kehamilan_berjalan_daftar');?>"><i class="fa fa-circle-o"></i>Kehamilan Berjalan</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i>Resiko Tinggi</a></li>
          </ul>
        </li>
        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Laporan</span></a></li>
      </ul>
    </section>
   </aside>
	<!-- /.sidebar -->
	<!--/Konten-->
      <?php
				echo $content;
		?>
    <!--/.Konten-->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.2.0
    </div>
    <strong>Copyright &copy; 2017 <a href="http://if.undip.ac.id.com">Ilmu Komputer Universitas Diponegoro</a>.</strong>
  </footer>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.2.3.min.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/plugins/sparkline/jquery.sparkline.min.js')?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/plugins/knob/jquery.knob.js')?>"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/app.min.js')?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js')?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/dist/js/pages/dashboard.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js')?>"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js')?>"></script>

<script>
$(document).ready(function() {
	//Initialize Select2 Elements
    $(".select2").select2();
	//Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
 //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
});
</script>
</body>
</html>
