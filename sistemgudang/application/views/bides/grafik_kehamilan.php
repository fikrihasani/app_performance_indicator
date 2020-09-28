<!-- Main content -->
<section class="content">
<form id="formgrafik">
  <!-- Main row -->
	<div class="row">
        <div class="col-xs-12">
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
					<div class='col-md-6'>
						<div class="form-group">
                          <label for="nama">Tahun</label>
                          <select class="form-control" id="year" name='status_resiko'>
							<option value=''>Pilih Tahun</option>
							<option value='2017'>2017</option>
							<option value='2016'>2016</option>
						  </select>
                        </div>
					</div>
                    <div class='clearfix'></div>
                    <button type="button" class="btn btn-primary ml-15" id='select-filter2'>Filter</button>
                </div>
            </div>
		</div>
	</div>
	<div class="row" id="container">
        <div class='col-md-6'>
            <div id='chart-1'></div>
        </div>
        <div class='col-md-6'>
             <div id='chart-2'></div>
        </div>
    </div>
<!-- /.row (main row) -->
	</form>
</section>
<!-- /.content -->

