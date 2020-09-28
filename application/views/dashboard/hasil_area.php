<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
	<div class="layout-content-body">
		<div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Cleaning Service Perfomance</span>
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
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-actions">
							<button type="button" class="card-action card-toggler" title="Collapse"></button>
							<button type="button" class="card-action card-reload" title="Reload"></button>
							<button type="button" class="card-action card-remove" title="Remove"></button>
						</div>
						<strong><?		
								echo"Hasil Check Sheet Bulan ".$month." Tahun ".$year."";?></strong>
					</div>
						<style type="text/css">
							.highcharts-figure, .highcharts-data-table table {
								min-width: 310px; 
								max-width: 800px;
								margin: 1em auto;
							}

							#container {
								height: 400px;
							}

							.highcharts-data-table table {
								font-family: Verdana, sans-serif;
								border-collapse: collapse;
								border: 1px solid #EBEBEB;
								margin: 10px auto;
								text-align: center;
								width: 100%;
								max-width: 500px;
							}
							.highcharts-data-table caption {
								padding: 1em 0;
								font-size: 1.2em;
								color: #555;
							}
							.highcharts-data-table th {
								font-weight: 600;
								padding: 0.5em;
							}
							.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
								padding: 0.5em;
							}
							.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
								background: #f8f8f8;
							}
							.highcharts-data-table tr:hover {
								background: #f1f7ff;
							}
						</style>
					<div class="card-body">
						<script src="<?=base_url('/assets/highcharts/code/highcharts.js')?>"></script>
						<script src="<?=base_url('/assets/highcharts/code/modules/data.js')?>"></script>
						<script src="<?=base_url('/assets/highcharts/code/modules/drilldown.js')?>"></script>
						<script src="<?=base_url('/assets/highcharts/code/modules/exporting.js')?>"></script>
						<script src="<?=base_url('/assets/highcharts/code/modules/export-data.js')?>"></script>
						<script src="<?=base_url('/assets/highcharts/code/modules/accessibility.js')?>"></script>

						<figure class="highcharts-figure">
							<div id="container"></div>
							<p class="highcharts-description">
								Chart showing browser market shares. Clicking on individual columns
								brings up more detailed data. This chart makes use of the drilldown
								feature in Highcharts to easily switch between datasets.
							</p>
						</figure>
						<script type="text/javascript">
							// Create the chart
							Highcharts.chart('container', {
								chart: {
									type: 'column'
								},
								title: {
									text: 'Browser market shares. January, 2018'
								},
								subtitle: {
									text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
								},
								accessibility: {
									announceNewData: {
										enabled: true
									}
								},
								xAxis: {
									type: 'category'
								},
								yAxis: {
									title: {
										text: 'Total percent market share'
									}

								},
								legend: {
									enabled: false
								},
								plotOptions: {
									series: {
										borderWidth: 0,
										dataLabels: {
											enabled: true,
											format: '{point.y:.1f}%'
										}
									}
								},

								tooltip: {
									headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
									pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
								},

								series: [
									{
										name: "Browsers",
										colorByPoint: true,
										data: [
											{
												name: "Chrome",
												y: 62.74,
												drilldown: "Chrome"
											},
											{
												name: "Firefox",
												y: 10.57,
												drilldown: "Firefox"
											},
											{
												name: "Internet Explorer",
												y: 7.23,
												drilldown: "Internet Explorer"
											},
											{
												name: "Safari",
												y: 5.58,
												drilldown: "Safari"
											},
											{
												name: "Edge",
												y: 4.02,
												drilldown: "Edge"
											},
											{
												name: "Opera",
												y: 1.92,
												drilldown: "Opera"
											},
											{
												name: "Other",
												y: 7.62,
												drilldown: null
											}
										]
									}
								],
								drilldown: {
									series: [
										{
											name: "Chrome",
											id: "Chrome",
											data: [
												[
													"v65.0",
													0.1
												],
												[
													"v64.0",
													1.3
												],
												[
													"v63.0",
													53.02
												],
												[
													"v62.0",
													1.4
												],
												[
													"v61.0",
													0.88
												],
												[
													"v60.0",
													0.56
												],
												[
													"v59.0",
													0.45
												],
												[
													"v58.0",
													0.49
												],
												[
													"v57.0",
													0.32
												],
												[
													"v56.0",
													0.29
												],
												[
													"v55.0",
													0.79
												],
												[
													"v54.0",
													0.18
												],
												[
													"v51.0",
													0.13
												],
												[
													"v49.0",
													2.16
												],
												[
													"v48.0",
													0.13
												],
												[
													"v47.0",
													0.11
												],
												[
													"v43.0",
													0.17
												],
												[
													"v29.0",
													0.26
												]
											]
										},
										{
											name: "Firefox",
											id: "Firefox",
											data: [
												[
													"v58.0",
													1.02
												],
												[
													"v57.0",
													7.36
												],
												[
													"v56.0",
													0.35
												],
												[
													"v55.0",
													0.11
												],
												[
													"v54.0",
													0.1
												],
												[
													"v52.0",
													0.95
												],
												[
													"v51.0",
													0.15
												],
												[
													"v50.0",
													0.1
												],
												[
													"v48.0",
													0.31
												],
												[
													"v47.0",
													0.12
												]
											]
										},
										{
											name: "Internet Explorer",
											id: "Internet Explorer",
											data: [
												[
													"v11.0",
													6.2
												],
												[
													"v10.0",
													0.29
												],
												[
													"v9.0",
													0.27
												],
												[
													"v8.0",
													0.47
												]
											]
										},
										{
											name: "Safari",
											id: "Safari",
											data: [
												[
													"v11.0",
													3.39
												],
												[
													"v10.1",
													0.96
												],
												[
													"v10.0",
													0.36
												],
												[
													"v9.1",
													0.54
												],
												[
													"v9.0",
													0.13
												],
												[
													"v5.1",
													0.2
												]
											]
										},
										{
											name: "Edge",
											id: "Edge",
											data: [
												[
													"v16",
													2.6
												],
												[
													"v15",
													0.92
												],
												[
													"v14",
													0.4
												],
												[
													"v13",
													0.1
												]
											]
										},
										{
											name: "Opera",
											id: "Opera",
											data: [
												[
													"v50.0",
													0.96
												],
												[
													"v49.0",
													0.82
												],
												[
													"v12.1",
													0.14
												]
											]
										}
									]
								}
							});
						</script>
						
							<?
								echo"<table>";
								echo"
									<tr>
										<td>No</td>
										<td>Area</td>
										<td>Bersih</td>
										<td>Tidak Bersih</td>
										<td>Aksi</td>
									</tr>
									";
								
								 if(count($area) > 0) {
									for($i=0; $i<count($area); $i++){
										$h = $area[$i];
										echo"

										<tr align='center'>
											<td>".($i+1)."</td>
											<td>$h[nama]</td>
											<td>$h[databersih]</td>
											<td>$h[datakotor]</td>
											<td align='center'>
												<b>
												<a href='".site_url('dashboard/hasil_subarea')."/".$h['id']."' class='btn btn-small btn-success' >Lihat Detail</a>
												</b>
											</td>
										</tr>
										";
									}
								}else {
									echo "
										<tr>
											<td colspan='7'>Data Tidak Ditemukan</td>
										</tr>
									";
								}
								echo"</table>";


							?>
						<!-- Print file -->
						<div class="text-center m-b">
							<?php if($this->session->userdata('level') == 1 ) { ?>
							<h3 class="m-b-0"><span class="icon icon-print"></span> Print File</h3>
							<form action="<?=base_url('sca_dokumentasi/cetak')?>" method="post">
							<input type="date" name="startdate" value="" required> - <input type="date"  name="enddate" value="" required> <br><br>
							<button type="submit" name="print" value="excel" class="btn-default">Print as Excel</button> <button class="btn-default" type="submit" name="print" value="pdf">Print as PDF</button>
							</form>
							<br><br>
							<?php } ?>
						</div>
						<!-- Akhir Print -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>