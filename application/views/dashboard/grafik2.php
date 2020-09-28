<div class="layout-content">
	<div class="layout-content-body">
		 <div class="title-bar">
			<h1 class="title-bar-title">
				<span class="d-ib"><span class="icon icon-bar-chart-o"></span> SCA READINESS STATS</span>
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
		<div class="row">
			<div class="col-xs-16">
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
							<div class="form-group">
							  <label for="nama">Bulan</label>
							  <select class="form-control" id="year-choose" name='month' style="width:120px;">
								<option value=''>Pilih Bulan</option>
								<option value='01'>Januari</option>
								<option value='02'>Februari</option>
								<option value='03'>Maret</option>
								<option value='04'>April</option>
								<option value='05'>Mei</option>
								<option value='06'>Juni</option>
								<option value='07'>Juli</option>
								<option value='08'>Agustus</option>
								<option value='09'>September</option>
								<option value='10'>Oktober</option>
								<option value='11'>November</option>
								<option value='12'>Desember</option>
							  </select>
							</div>
						</div>
						<div class='col-md-2'>
							<div class="form-group">
							  <label for="nama">Tahun</label>
							  <select class="form-control" id="year-choose" name='year' style="width:120px;">
								<option value=''>Pilih Tahun</option>
								<?php
									for($i=0; $i<count($tahun); $i++){
										$h = $tahun[$i];
											echo"<option value='$h[year]'>$h[year]</option>";
									}
								?>
							  </select>
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
		<div class="row" id="container">
        <div class='col-md-12'>
            <div id='chart-1'></div>
        </div>
    </div>
	</div>
</div>