<!DOCTYPE HTML>
<div class="layout-content">
	<div class="layout-content-body">
		<div class="title-bar">
			<h1 class="title-bar-title">
				<span class="d-ib"><span class="icon icon-bar-chart-o"></span> SCA STATS</span>
				<span class="d-ib">
				  <a class="title-bar-shortcut" href="#" title="Add to shortcut list" data-container="body" data-toggle-text="Remove from shortcut list" data-trigger="hover" data-placement="right" data-toggle="tooltip">
					<span class="sr-only">Add to shortcut list</span>
				  </a>
				</span>
			  </h1>
			  <p class="title-bar-description">
				<small></small>
			  </p>
		</div>
		<div class="row gutter-xs">
            <div class="col-xs-6 col-md-3">
              <div class="card">
                <div class="card-values">
                  <div class="p-x">
                    <small>Laporan Kehilangan Belum Terselesaikan</a></small>
                    <h3 class="card-title fw-l"><a href="<?= base_url(); ?>lost_found"><?php echo $jml_kehilangan;?></a></h3>
                  </div>
                </div>
                <div class="card-chart">
                  <canvas data-chart="line" data-animation="false" data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]' data-values='[{"colorStop1": "#fcdfe0", "colorStop2": "#ffffff", "y0": 0, "y1": 36, "borderColor": "#f1595d", "data": [25250, 23370, 25568, 28961, 26762, 30072, 25135]}]' data-scales='{"yAxes": [{ "ticks": {"max": 31072}}]}' data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]' height="50"></canvas>
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-md-3">
              <div class="card">
                <div class="card-values">
                  <div class="p-x">
                    <small>Jumlah Inspeksi Terlaksana Hari Ini</small>
                    <h3 class="card-title fw-l"><a href="<?= base_url(); ?>sca_dokumentasi"><?php echo $jml_inspeksi;?> / 20</a></h3>
                  </div>
                </div>
                <div class="card-chart">
                  <canvas data-chart="line" data-animation="false" data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]' data-values='[{"colorStop1": "#fcdfe0", "colorStop2": "#ffffff", "y0": 0, "y1": 36,"borderColor": "#f1595d", "data": [8796, 11317, 8678, 9452, 8453, 11853, 9945]}]' data-scales='{"yAxes": [{ "ticks": {"max": 12853}}]}' data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]' height="50"></canvas>
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-md-3">
              <div class="card">
                <div class="card-values">
                  <div class="p-x">
                    <small>Jumlah Barang Rusak Belum Tertangani</small>
                    <h3 class="card-title fw-l"><a href="<?= base_url(); ?>kerusakan"><?php echo $jml_kerusakan;?> Laporan</a></h3>
                  </div>
                </div>
                <div class="card-chart">
                  <canvas data-chart="line" data-animation="false" data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]' data-values='[{"colorStop1": "#fcdfe0", "colorStop2": "#ffffff", "y0": 0, "y1": 36,"borderColor": "#f1595d", "data": [116196, 145160, 124419, 147004, 134740, 120846, 137225]}]' data-scales='{"yAxes": [{ "ticks": {"max": 157004}}]}' data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]' height="50"></canvas>
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-md-3">
              <div class="card">
                <div class="card-values">
                  <div class="p-x">
                    <small>Rata-rata durasi Inspeksi</small>
                    <h3 class="card-title fw-l"><a href="<?= base_url(); ?>kerusakan">00:07:56</a></h3>
                  </div>
                </div>
                <div class="card-chart">
                  <canvas data-chart="line" data-animation="false" data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]' data-values='[{"colorStop1": "#fcdfe0", "colorStop2": "#ffffff", "y0": 0, "y1": 36,"borderColor": "#f1595d", "data": [13590442, 12362934, 13639564, 13055677, 12915203, 11009940, 11542408]}]' data-scales='{"yAxes": [{ "ticks": {"max": 14662531}}]}' data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]' height="50"></canvas>
                </div>
              </div>
            </div>
          </div>
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
					  <h3 class="box-title">Filter</h3>
					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					  </div>
					  <!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body" style="display: block;">
						<div class='col-md-2'>
							<div class="input-group date">
								<label for="nama">Pilih Tanggal</label>
								<input type="text" class="form-control" data-provide="datepicker" id="date-choose" name="date" min="2018-01-01" max='<?php date('Y-m-d')?>'>
							</div>
						</div>
						<div class='clearfix'></div>
						<div class='col-md-4'>
							<button type="button" class="btn btn-primary ml-10" id='select-filter2'>Filter</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="aaa">
		
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="demo-form-wrapper">
					<div class="form form-horizontal">
						<div id="chartContainer" style="height: 300px; width: 100%;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
//Filter Grafik
	//$('#select-filter2').click(function() {
      //              console.log(base_url + 'review/source_kehamilan_grafik');
		//			data_send = new Object();
			//		data_send = $('#formgrafik').serializeObject();
              //      $.ajax({
                //        url : "<?php echo site_url('review/source_kehamilan_grafik');?>",
                  //      data : data_send, 
                    //    type : 'GET',
                      //  dataType : "json",
                        //success : function(result) {
                          //  Graph('chartContainer', result.data_resiko, result.month, result.year);
                        //}
                    //});
                //});

                //$('#select-filter2').click();


window.onload = function () {
var dataPoints = [];
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title: {
		text: 'Readiness Factor Area Bandar Udara Jenderal Ahmad Yani Semarang'
	},
	axisY: {
		title: "Readiness Factor",
		suffix: "%",
		includeZero: false
	},
	axisX: {
		title: "Area"
	},
	data: [{
		type: "column",
		yValueFormatString: "#0.0#\"%\"",
		dataPoints: dataPoints,
	}]
});

$.ajax({
	type: "GET",
	url: base_url+"Info/getData",
	// data: ,
	dataType: "json",
	success: function (response) {
		console.log(response);
		$.each(response, function(key, value){
			console.log(value);
        	dataPoints.push({label: value['x'], y: parseInt(value['y'])});
   		});
		console.log(dataPoints);
    	chart.render();
	},
	error: function(response){
		console.log(response);
	}
});

// $.getJSON(<?php echo base_url()?>+"Info/getData", function(data) {  
// 	alert(data);
//     $.each(data, function(key, value){
//         dataPoints.push({x: value['label'], y: parseInt(value['nilai'])});
//     });
//     chart.render();
// });
// chart.render();

}
</script>
<script>
	//  $('#select-filter2').click(function() {
	// 	console.log(base_url + 'dashboard/source_grafik');
	// 	data_send = new Object();
	// 	data_send = $('#formgrafik').serializeObject();
	// 	$.ajax({
	// 		url : "<?php echo site_url('dashboard/source_grafik');?>",
	// 		data : data_send, 
	// 		type : 'GET',
	// 		dataType : "json",
	// 		success : function(result) {
	// 			Graph('chart-1', result.data_resiko, result.month, result.year);
	// 		}

	// 	});
	// });

	// $('#select-filter2').click();

</script>
	<script src="<?php echo base_url('assets/js/highcharts.js')?>"></script>
	<script src="<?php echo base_url('assets/js/highcharts-3d.js')?>"></script>
    <script src="<?php echo base_url('assets/js/exporting.js')?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.serializeObject.min.js')?>"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>