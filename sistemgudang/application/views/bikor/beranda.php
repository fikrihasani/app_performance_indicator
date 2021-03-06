<!DOCTYPE html>
<html>
	<script src="<?php echo base_url('assets/js/highcharts.js')?>"></script>
	<script src="<?php echo base_url('assets/js/highcharts-3d.js')?>"></script>
	<script src="<?php echo base_url('assets/js/modules/exporting.js')?>"></script>
	<!-- Main content -->
    <section class="content">
   <!-- Small boxes (Stat box) -->
      <!-- Main row -->
		<div class="row" id="container">
	  
	  
	  
			<script type="text/javascript">
			Highcharts.chart('container', {
				chart: {
					type: 'column',
					options3d: {
						enabled: true,
						alpha: 15,
						beta: 15,
						viewDistance: 25,
						depth: 40
					}
				},

				title: {
					text: 'Kehamilan Berjalan Desa <?php echo desa_convert(id_desa());?>'
				},

				xAxis: {
					categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
				},

				yAxis: {
					allowDecimals: false,
					min: 0,
					title: {
						text: 'Number of fruits'
					}
				},

				tooltip: {
					headerFormat: '<b>{point.key}</b><br>',
					pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
				},

				plotOptions: {
					column: {
						stacking: 'normal',
						depth: 40
					}
				},

				series: [{
					name: 'John',
					data: [5, 3, 4, 7, 2],
					stack: 'male'
				}, {
					name: 'Joe',
					data: [3, 4, 4, 2, 5],
					stack: 'male'
				}, {
					name: 'Jane',
					data: [2, 5, 6, 2, 1],
					stack: 'female'
				}, {
					name: 'Janet',
					data: [3, 0, 4, 4, 3],
					stack: 'female'
				}]
			});
		</script>
    </div> 
    <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</html>
