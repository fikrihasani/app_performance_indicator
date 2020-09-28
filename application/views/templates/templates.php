<?php
    $content            = (ISSET($content) && $content != "")                   ?$content : "";
    if(!ISSET($css_assets) || $css_assets == ''){ $css_assets = []; }
    if(!ISSET($js_assets) || $js_assets == ''){ $js_assets = []; }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url();?>assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url();?>assets/img/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="<?= base_url();?>assets/manifest.json">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#d9230f">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/vendor.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/elephant.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/application.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/demo.min.css">

    <!-- Sweetalert -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  <!-- Jquery -->
   <script src="<?= base_url(); ?>assets/jquery/jquery.min.js"></script>
   <script src="<?= base_url(); ?>assets/js2/sweetalert2.all.min.js"></script>
    <?php 
        if(!empty($css_assets)) {
            foreach($css_assets as $list) { echo $list; }
        }
    ?>
 </head>
 <body class="layout layout-header-fixed">
 <!-- TOP BAR -->
	<div class="layout-header">
		<div class="navbar navbar-default">
		  <div class="navbar-header">
			<a class="navbar-brand navbar-brand-center" href="#">
			  <p style="font-size:10px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: wheat; font-weight: bold;">PT. Angkasa Pura Supports Semarang</p>
			</a>
			<button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="bars">
				<span class="bar-line bar-line-1 out"></span>
				<span class="bar-line bar-line-2 out"></span>
				<span class="bar-line bar-line-3 out"></span>
			  </span>
			  <span class="bars bars-x">
				<span class="bar-line bar-line-4"></span>
				<span class="bar-line bar-line-5"></span>
			  </span>
			</button>
			<button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="arrow-up"></span>
			  <span class="ellipsis ellipsis-vertical">
				<img class="ellipsis-object" width="32" height="32" src="img/0180441436.jpg" alt="Teddy Wilson">
			  </span>
			</button>
		  </div>
		  <div class="navbar-toggleable">
			<nav id="navbar" class="navbar-collapse collapse">
			  <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="bars">
				  <span class="bar-line bar-line-1 out"></span>
				  <span class="bar-line bar-line-2 out"></span>
				  <span class="bar-line bar-line-3 out"></span>
				  <span class="bar-line bar-line-4 in"></span>
				  <span class="bar-line bar-line-5 in"></span>
				  <span class="bar-line bar-line-6 in"></span>
				</span>
			  </button>
  
			  <!-- NAVBAR -->
			  <ul class="nav navbar-nav navbar-right">
				<li class="hidden-xs hidden-sm">
				  <form class="navbar-search navbar-search-collapsed">
					<div class="navbar-search-group">
					  <input class="navbar-search-input" type="text" placeholder="Search for people, companies, and more&hellip;">
					  <button class="navbar-search-toggler" title="Expand search form ( S )" aria-expanded="false" type="submit">
						<span class="icon icon-search icon-lg"></span>
					  </button>
					  <button class="navbar-search-adv-btn" type="button">Advanced</button>
					</div>
				  </form>
				</li>
				<li class="dropdown hidden-xs">
				  <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
				  <img class="rounded" width="36" height="36" src="<?= base_url('assets/upload/profile/') . $user['image']; ?>"><?= $user['nama']; ?>
					<span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu dropdown-menu-right">
					<li class="divider"></li>
					<li class="divider"></li> 
					<li><a href="<?= base_url(); ?>profile">Profile</a></li>
					<li><a href="<?= base_url(); ?>auth/logout">Sign out</a></li>
				  </ul>
				</li>
				<li class="visible-xs-block">
				  <a href="contacts.html">
					<span class="icon icon-users icon-lg icon-fw"></span>
					Contacts
				  </a>
				</li>
				<li class="visible-xs-block">
				  <a href="profile.html">
					<span class="icon icon-user icon-lg icon-fw"></span>
					Profile
				  </a>
				</li>
				<li class="visible-xs-block">
				  <a href="login-1.html">
					<span class="icon icon-power-off icon-lg icon-fw"></span>
					Sign out
				  </a>
				</li>
			  </ul>
			</nav>
		  </div>
		</div>
	</div>
	<!-- AKHIR TOOGLE -->
	<!-- SIDEBAR -->
	<div class="layout-main">
		<div class="layout-sidebar">
		  <div class="layout-sidebar-backdrop"></div>
		  <div class="layout-sidebar-body">
			<div class="custom-scrollbar">
			  <nav id="sidenav" class="sidenav-collapse collapse">

				<!-- NAVIGATION -->
				<ul class="sidenav">
				  <li class="sidenav-search hidden-md hidden-lg">
					<form class="sidenav-form" action="#">
					  <div class="form-group form-group-sm">
						<div class="input-with-icon">
						  <input class="form-control" type="text" placeholder="Search…">
						  <span class="icon icon-search input-icon"></span>
						</div>
					  </div>
					</form>
				  </li>
				<?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2){ ?>
				  <li class="sidenav-item">
					<a href="<?= base_url(); ?>dashboard" aria-haspopup="true">
					  <span class="sidenav-icon icon icon-home"></span>
					  <span class="sidenav-label">Dashboard</span>
					</a>
				  </li>
				<?php } ?>
				<?php if($this->session->userdata('level') != 4){ ?>
				  <li class="sidenav-item">
					<a href="<?= base_url(); ?>complains">
					  <span class="sidenav-icon icon icon-comment"></span>
					  <span class="sidenav-label">Complains</span>
					</a>
				  </li>
				<?php } ?>
				<?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3){ ?>
				  <li class="sidenav-item">
					  <a href="<?= base_url(); ?>sca_dokumentasi" aria-haspopup="true">
						<span class="sidenav-icon icon icon-keyboard-o"></span>
						<span class="sidenav-label">SCA & Dokumentasi</span>
					  </a>
					</li>
				  <?php } ?>   
				  <?php if($this->session->userdata('level') != 4){ ?>
				  <li class="sidenav-item">
						<a href="<?= base_url(); ?>kerusakan" aria-haspopup="true">
						  <span class="sidenav-icon icon icon-unlink"></span>
						  <span class="sidenav-label">Kerusakan</span>
						</a>
				  </li>
				  <?php } ?>
				  <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3){ ?>
				  <li class="sidenav-item">
					  <a href="<?= base_url(); ?>lost_found" aria-haspopup="true">
						<span class="sidenav-icon icon icon-search"></span>
						<span class="sidenav-label">Lost & Found</span>
					  </a>
				  </li>
				  <?php } ?>
				  <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3){ ?>
				  <li class="sidenav-item">
					<a href="<?= base_url(); ?>absensi" aria-haspopup="true">
					  <span class="sidenav-icon icon icon-list-alt"></span>
					  <span class="sidenav-label">Absensi</span>
					</a>
				  </li>
				  <?php } ?>
				<?php if($this->session->userdata('level') == 1){ ?>
				<li class="sidenav-item">
					<a href="<?= base_url(); ?>user" aria-haspopup="true">
					  <span class="sidenav-icon icon icon-users"></span>
					  <span class="sidenav-label">User</span>
					</a>
				</li>
				<?php } ?>
				<?php if($this->session->userdata('level') == 1){ ?>
				<li class="sidenav-item">
					<a href="<?= base_url(); ?>materials" aria-haspopup="true">
					  <span class="sidenav-icon icon icon-gear"></span>
					  <span class="sidenav-label">Materials</span>
					</a>
			   </li>
			   <?php } ?>
			   <?php if($this->session->userdata('level') == 1){ ?>
				<li class="sidenav-item">
					<a href="<?= base_url(); ?>pertanyaan" aria-haspopup="true">
					  <span class="sidenav-icon icon icon-question-circle-o"></span>
					  <span class="sidenav-label">Pertanyaan</span>
					</a>
				</li>
				<?php } ?>
			   <?php if($this->session->userdata('level') == 1){ ?>
			   <li class="sidenav-item has-subnav">
				  <a href="#" aria-haspopup="true">
					<span class="sidenav-icon icon icon-map-signs"></span>
					<span class="sidenav-label">Areas</span>
				  </a>
				  <ul class="sidenav-subnav collapse">
					<li><a href="<?= base_url(); ?>area">Area</a></li>
					<li><a href="<?= base_url(); ?>subarea">Sub Area</a></li>
				  </ul>
				</li>
				<?php } ?>
				<?php $t=$this->session->userdata('level');
				if($t == 1 || $t == 4){ ?>
				<li class="sidenav-item">
					<a href="<?= base_url(); ?>gudang" aria-haspopup="true">
					  <span class="sidenav-icon icon icon-briefcase"></span>
					  <span class="sidenav-label">Stok Gudang</span>
					</a>
				</li>
				<?php } ?>
				<?php if($this->session->userdata('level') == 1){ ?>
				<li class="sidenav-item">
					<a href="<?= base_url(); ?>history_system" aria-haspopup="true">
					  <span class="sidenav-icon icon icon-history"></span>
					  <span class="sidenav-label">History System</span>
					</a>
				</li>
				<?php } ?>
				</ul>
			  </nav>
			</div>
		  </div>
		</div>
		<!-- AKHIR NAVIGATION -->
		<!-- CONTENT -->
		<div class="layout-content">
			<?php
			  $content;
			?>
		</div>
		<!-- AKHIR CONTENT -->
		<div class="layout-footer">
			<div class="layout-footer-body">
			  <small class="version">Version 1.4.0</small>
			  <small class="copyright">2019 &copy; <a href="#">PT. Angkasa Pura Supports Semarang</a></small>
			</div>
		</div>
    </div>
		<script>base_url = "<?php echo site_url();?>";</script>
		<script src="<?= base_url();?>assets/js2/myscript.min.js"></script>
		<script src="<?= base_url();?>assets/js/vendor.min.js"></script>
		<script src="<?= base_url();?>assets/js/elephant.min.js"></script>
		<script src="<?= base_url();?>assets/js/application.min.js"></script>
		<script src="<?= base_url();?>assets/js/demo.min.js"></script>
	<!-- HighChart -->
		<script src="<?=base_url();?>assets/js/jquery.serializeObject.min.js"></script>
		<script src="<?= base_url();?>assets/js/highcharts.js"></script>
		<script src="<?= base_url();?>assets/js/highcharts-3d.js"></script>
        <script src="<?= base_url();?>assets/js/modules/exporting.js"></script>
    <script>
	$(document).ready(function(){
		$('#select-filter2').click(function() {
			console.log(base_url + 'dashboard/source_grafik');
			data_send = new Object();
			data_send = $('#formgrafik').serializeObject();
			$.ajax({
				url : "<?php echo site_url('dashboard/source_grafik');?>",
				data : data_send, 
				type : 'GET',
				dataType : "json",
				success : function(result) {
					Graph('chart-1', result.data_readiness, result.month, result.year);
				}

			});
		});

			$('#select-filter2').click();
		
		function Graph(id1, data1, bulane, tahune) {

			console.log(data1);
			
			data1x = data1.replace("{","[");
			data1x = data1x.replace("}","]");
			
			//data1total = JSON.parse(data1x);
			data1total = JSON.parse([2,4,3,4,8,6,1,2,9,7,6]);
			var total1 = data1total.reduce(function(a, b) { return a + b; }, 0);
			
			console.log(JSON.stringify(data1total))
		
			Highcharts.chart(id1, {
				chart: {
					type: 'column',
				},

				title: {
					text: 'Readiness '+bulane+' Tahun '+tahune
				},

				xAxis: {
					categories: ['Departures', 'Arrival', 'Hall', 'Mezanine', 'Concordia Lounge', 'Margolinduk', 'Gebang Arum', 'Sumberejo', 'Karang rejo', 'Gebang', 'Sukodono']
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
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-83990101-1', 'auto');
      ga('send', 'pageview');
    </script>
	<?php 
		 if(!empty($js_assets)) {
			foreach($js_assets as $list) { echo $list; }
		}
	?>
</body>
</html>
