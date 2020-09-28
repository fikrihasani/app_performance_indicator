<form action="<?php echo site_url('review/source_kehamilan_per_tahun_list'); ?>" id='display-table'>
<!-- Main content -->
<section class="content">
	<?php echo show_alert('message'); ?>
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
                    <div class='col-md-4'>
                        <div class="form-group">
                          <label for="nama">Nama</label>
                          <input class="form-control" id="nama" placeholder="Max.25 Karakter" max="25" type="text" name='full_name' style="width:305px;" />
                        </div>
						<div class="form-group">
						  <label for="nama">Pilih Tahun</label>
							  <select class="form-control" id="nama" name='year' style="width:150px;">
								<option value=''>Pilih Salah Satu</option>
								<option value='2018'>2018</option>
								<option value='2017'>2017</option>
								<option value='2016'>2016</option>
							  </select>
						</div>
                    </div>
					<div class='col-md-8'>
						<div class="form-group">
                          <label for="nama">Status Kehamilan</label>
                          <select class="form-control" id="nama" name='status_kehamilan' style="width:130px;">
							<option value=''>Semua Status</option>
							<option value='1'>Berjalan</option>
							<option value='3'>Melahirkan</option>
							<option value='4'>Abortus</option>
							<option value='5'>Meninggal</option>
						  </select>
                        </div>
						<div class="form-group">
                          <label for="nama">Status Resiko</label>
                          <select class="form-control" id="nama" name='status_resiko' style="width:130px;">
							<option value=''>Semua Status</option>
							<option value='0'>Resiko Rendah</option>
							<option value='2'>Resiko Tinggi</option>
						  </select>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                    <button type="button" class="btn btn-primary ml-15" id='select-filter'>Filter</button>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box">
                <div class="box-body">
                    <table id="listed-table" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Ibu</th>
                                <?php if(is_auth([3,4])){echo"<th class='text-center'>Desa</th>";}?>
                                <th class="text-center">Status Resiko</th>
                                <th class="text-center">Status Kehamilan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody align="center"></tbody>
                    </table>

                    <br class='clearfix'/>
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary active btn-sm prev-page" type="button"><i class="fa fa-angle-double-left "></i></button>
                        <button class="btn btn-primary btn-sm next-page" type="button"><i class="fa fa-angle-double-right"></i></button>
                    </div>
                    <input type='hidden' name='current_page' class='current-page' value='<?php echo (ISSET($page))? $page : '1'; ?>' />

                    <br class='clearfix'/>
                </div>
            <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
