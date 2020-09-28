<?php
    $user               = get_profile();

    $meta_title         = (ISSET($meta_title) && $meta_title != "")             ?$meta_title : "";
    $meta_description   = (ISSET($meta_description) && $meta_description != "") ?$meta_description : "";
    $breadcrumb         = (ISSET($breadcrumb) && $breadcrumb != "")             ?$breadcrumb : "";
    $content            = (ISSET($content) && $content != "")                   ?$content : "";
    if(!ISSET($css_assets) || $css_assets == ''){ $css_assets = []; }
    if(!ISSET($js_assets) || $js_assets == ''){ $js_assets = []; }

?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SI Antenatal Care | <?php echo $meta_title; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="<?php echo $meta_description; ?>" name="description">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/ionicons.min.css'); ?>">
	<!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/flat/blue.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/morris/morris.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/datepicker3.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/basic.css?v='.rand(0,1000)); ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">
  <style type="text/css">
		#container {
			height: 400px; 
			min-width: 310px; 
			max-width: 1200px;
			margin: 0 auto;
		}
	</style>
	<script src="<?php echo base_url('assets/js/highcharts.js')?>"></script>
	<script src="<?php echo base_url('assets/js/highcharts-3d.js')?>"></script>
	<script src="<?php echo base_url('assets/js/modules/exporting.js')?>"></script>
    <style>
        .dataTables_filter label {
            float:right;
        }

        .dataTables_filter {
            display:block;
        }

        .dataTables_paginate .pagination {
            margin-top:0px;
            margin-bottom:0px;
        }

        .dataTables_paginate {
            text-align: right !important;
        }

        @media (max-width:767px){
            .dataTables_length label{
                width:100%;
                text-align: center;
            }

            .dataTables_length select{
                max-width:100px;
                display: inline-block;
            }

            .dataTables_filter label {
                float:none !important;
                width:100%;
                text-align: center;
            }

            .dataTables_filter input{
                display: inline-block;
                max-width: 200px;
                margin-left:5px;
            }
        }
    </style>

    <?php 
        if(!empty($css_assets)) {
            foreach($css_assets as $list) { echo $list; }
        }
    ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">

    <a href="<?php echo site_url('discover');?>" class="logo">

      <span class="logo-mini"><b>SI</b>AC</span>

      <span class="logo-lg"><b>SI</b> Antenatal Care</span>
    </a>

    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">   
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<span class="hidden-xs">
					<?php 
						if( level() == 1){
							echo "Halo, ".full_name();
						}else if(level() == 2){
							echo "Halo, Bidan ".full_name();
						}else if(level() == 3){
							echo"Halo, Bidan koordinator ".full_name();
						}else if(level() == 4){
							echo"Halo, dr. ".full_name();
						}
					?>
				</span>
				<span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
			
              <!-- User image -->
              <li class="user-header">
                <img src="<?php 
					if (level() == 1){echo base_url('assets/dist/img/admin160x160.png');}
					else if (level() == 2){echo base_url('assets/dist/img/bidan160x160.png');}
					else if (level() == 3){echo base_url('assets/dist/img/bikor160x160.png');}
					else if (level() == 4){echo base_url('assets/dist/img/doctor160x160.png');}
					?>" class="img-circle" alt="User Image">
                <p><?php echo full_name();?>
                  <small>
						<?php 
							echo "Terdaftar Sejak ".date_convert(get_date($user['waktu_daftar'])); 
						?>
				  </small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
				<div class="btn-group">
					<a href="<?php echo site_url('doctor/user_edit/').simple_encrypt($user['id_user']);?>" class="btn btn-default btn-flat">Profile</a>
					<a href="<?php echo site_url('doctor/password_update/').simple_encrypt($user['id_user']);?>" class="btn btn-default btn-flat">Ubah Password</a>
					<a href="<?php echo site_url('discover/keluar');?>" class="btn btn-default btn-flat">Keluar</a>
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
                    <img src="<?php 
					if (level() == 1){echo base_url('assets/dist/img/logo160x160.png');}
					else if (level() == 2){echo base_url('assets/dist/img/logo160x160.png');}
					else if (level() == 3){echo base_url('assets/dist/img/bikor160x160.png');}
					else if (level() == 4){echo base_url('assets/dist/img/doctor160x160.png');}
					?>" class="img" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>
						<?php 
						if (level() == 1){
								echo"Administrator<br>Puskesmas Bonang I";
						}else if (level() == 3){
								echo"Bidan Koordinator<br>Puskesmas Bonang I";
						}else if (level() == 4){
								echo"Kepala Puskesmas <br> Bonang I";
						}else{
								echo "Bidan Desa <br>".desa_convert(id_desa())."<br>Puskemas Bonang I";
						}
						?>
					 </p>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">NAVIGASI MENU</li>
				<li class="treeview">
					<a href="<?php echo site_url('discover/index');?>">
						<i class="fa fa-dashboard"></i><span>Beranda</span>
					</a>
				</li>
				<?php if (level() == 1) 
					{
					echo"
						<li class='treeview'>
							<a href='".site_url('doctor/user_daftar')."'>
								<i class='fa fa-users'></i><span>Pengguna</span>
							</a>
						</li>
					";
					}
				?>
				<?php if (level() == 2) 
					{
						echo"
							<li class='treeview'>
								<a href='".site_url('patient/ibu_daftar')."'>
									<i class='fa fa-user'></i><span>Pasien</span>
								</a>
							</li>
						";
					}
				?>
				<?php if(is_auth(array(2,3,4)))
					{
						echo"
							<li class='treeview'>
								<a href='#'>
									<i class='fa fa-files-o'></i>
									<span>Kohort</span>
									<span class='pull-right-container'>
									  <i class='fa fa-angle-down pull-right'></i>
									</span>
								</a>
								<ul class='treeview-menu'>
									<li><a href='".site_url('checkup/kehamilan_unverified_daftar')."'>Kehamilan Belum Terverifikasi</a></li>
									<li><a href='".site_url('checkup/pemeriksaan_unverified_daftar')."'>Pemeriksaan Belum Terverifikasi</a></li>
								</ul>
							</li>
							<li class='treeview'>
								<a href='#'>
									<i class='fa fa-table'></i><span>Data Pasien</span>
									<span class='pull-right-container'><i class='fa fa-angle-down pull-right'></i></span>
								</a>
								<ul class='treeview-menu'>
									<li><a href='".site_url('checkup/kehamilan_berjalan_daftar')."'>Kehamilan Berjalan</a></li>
									<li><a href='".site_url('checkup/rujukan_berjalan_daftar')."'>Rujukan Berjalan</a></li>
									<li><a href='".site_url('review/kehamilan_per_tahun')."'>Kehamilan Per Tahun</a></li>
								</ul>
							</li>
						";
					}
				?>
				
				<?php if(is_auth(array(3,4))) 
					{
						echo"
							<li class='treeview'>
								<a href='".site_url('review/kehamilan_grafik')."'>
									<i class='fa fa-bar-chart'></i><span>Grafik</span>
								</a>
							</li>
						";
					}
				?>
				<?php if (level() == 3) 
					{
						echo"
							<li class='treeview'>
								<a href='".site_url('review/laporan_daftar')."'>
									<i class='fa fa-book'></i> <span>Laporan</span>
								</a>
							</li>
						";
					}
				?>
            </ul>
        </section>
    </aside>
	<!-- /.sidebar -->
	<!--/Konten-->
    <div class="content-wrapper">
        <section class="content-header">
            <h1><?php echo $title; ?></h1>
          <ol class="breadcrumb">
            <?php
                $list_bread = explode('~', $breadcrumb);
                $i = 1;
                foreach($list_bread as $brd) {
                    if($i == 1){
                        if(ISSET($breadcrumb_icon) && $breadcrumb_icon != ""){
                            $icons = $breadcrumb_icon;
                        }else {
                            $icons = 'fa fa-dashboard';
                        }
                        echo "<li><a href='#'><i class='fa $icons'></i> $brd</a></li>";
                    }else {
                        echo "<li><a href='#'> $brd</a></li>";
                    }
                    $i++;

                }
            ?>

          </ol>
        </section>
        <?php
    		echo $content;
    	?>
    </div>
    <!--/.Konten-->
    <footer class="main-footer">
        <div class="pull-right hidden-xs"><b>Version</b> 2.4.0</div>
        <strong>Copyright &copy; 2017 <a href="http://if.undip.ac.id">Ilmu Komputer Universitas Diponegoro</a>.</strong> All rights reserved.
    </footer>
    <div class="control-sidebar-bg"></div>
</div>

<script>base_url = "<?php echo site_url();?>";</script>
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
        <script src="<?php echo base_url('assets/plugins/morris/morris.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js')?>"></script>
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
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url('assets/dist/js/pages/dashboard.js')?>"></script>

        <!-- iCheck 1.0.1 -->
        <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url('assets/js/jquery.serializeObject.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/table-list.js?v=122')?>"></script>
        <script src="<?php echo base_url('assets/dist/js/demo.js')?>"></script>
        <!-- DataTables -->
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
		<!-- HighChart -->
		<script src="<?php echo base_url('assets/js/highcharts.js')?>"></script>
		<script src="<?php echo base_url('assets/js/highcharts-3d.js')?>"></script>
        <script src="<?php echo base_url('assets/js/modules/exporting.js')?>"></script>
        <script>
            $(document).ready(function(){
                $('.select2').select2();

                $("#datatable").DataTable({
                  "paging": true,
                  "lengthChange": true,
                  "searching": true,
                  "ordering": false,
                  "info": true,
                  "autoWidth": true
                });


                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                  checkboxClass: 'icheckbox_flat-green',
                  radioClass: 'iradio_flat-green'
                });
				
				// //Timepicker
				// $('input[type="time"]').timepicker({
				// 	showInputs: false
				// });

                $('#select-filter2').click(function() {
                    console.log(base_url + 'review/source_kehamilan_grafik');
					data_send = new Object();
					data_send = $('#formgrafik').serializeObject();
                    $.ajax({
                        url : "<?php echo site_url('review/source_kehamilan_grafik');?>",
                        data : data_send, 
                        type : 'GET',
                        dataType : "json",
                        success : function(result) {
                            Graph('chart-1', result.data_resiko, result.month, result.year);
                        }

                    });
                });

                $('#select-filter2').click();


                function Graph(id1, data1, bulane, tahune) {

                    console.log(data1);
					
					data1x = data1.replace("{","[");
					data1x = data1x.replace("}","]");
					
					data1total = JSON.parse(data1x);
					
					var total1 = data1total.reduce(function(a, b) { return a + b; }, 0);
                    
                    console.log(JSON.stringify(data1total))
				
					Highcharts.chart(id1, {
                        chart: {
                            type: 'column',
                        },

                        title: {
                            text: 'Jumlah Kehamilan Baru Puskesmas Bonang I Bulan '+bulane+' Tahun '+tahune
                        },

                        xAxis: {
                            categories: ['Tlogoboyo', 'Kembangan', 'Tridonorejo', 'Moro Demak', 'Purworejo', 'Margolinduk', 'Gebang Arum', 'Sumberejo', 'Karang rejo', 'Gebang', 'Sukodono']
                        },

                         yAxis: {
                             allowDecimals: false,
                             min: 0,
                             title: {
                                 text: ''
                             }
                         },

                         tooltip: {
                             headerFormat: '<b>{point.key}</b><br>',
                             pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / '+total1
                         },

                         plotOptions: {
                             column: {
                                 stacking: 'normal',
                                 depth: 40
                             }
                         },

                        series: [{
                            name: 'Jumlah Kehamilan Baru',
                            data: data1total
                           
                        }]
                    });                  
                }
            })
        </script>
        <?php 
             if(!empty($js_assets)) {
                foreach($js_assets as $list) { echo $list; }
            }
        ?>

         
    </body>
</html>
