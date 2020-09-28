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
		</div>
		<div class="row gutter-xs">
			<div class="col-xs-6 col-md-3">
				<div class="card">
					<div class="card-header bg-primary">
					  <strong>Pilih Tanggal</strong>
					</div>
					<!-- /.box-header -->
					<div class="card-body">
						<div class='col-md-7'>
							<div class="input-group date">
								<input type="text" class="form-control" data-provide="datepicker" id="date-choose" name="date" min="2018-01-01" max='<?php date('Y-m-d')?>'>
							</div>
						</div>
						<div class='col-md-1'>
							<button type="button" class="btn btn-primary ml-12" id='select-filter2'>Filter</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row row gutter-xs">
			<div class="col-md-12">
						<div id="chart-1" style="height: 300px; width: 100%;"></div>
			</div>
		</div>
	</div>
</div>
<!-- HighChart -->
<script src="<?php echo base_url('assets/js/highcharts.js')?>"></script>
<script src="<?php echo base_url('assets/js/highcharts-3d.js')?>"></script>
<script src="<?php echo base_url('assets/js/exporting.js')?>"></script>
<script>base_url = "<?php echo site_url();?>";</script>
<script>
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
				text: 'Readiness Factor Bandar Udara Jenderal Ahmad Yani Semarang I Bulan '+bulane+' Tahun '+tahune
			},

			xAxis: {
				categories: ['Terminal', 'Toilet', 'Check In', 'Hall', 'Office', 'Parking', 'Gebang Arum', 'Sumberejo', 'Karang rejo', 'Gebang', 'Sukodono']
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
</script>