<form action="<?php echo site_url('checkup/source_kehamilan_berjalan_list'); ?>" id='display-table'>
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
                  <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <div class='col-md-4'>
                        <div class="form-group">
                          <label for="nama">Nama</label>
                          <input class="form-control" id="nama" placeholder="Max.25 Karakter" max="25" type="text" name='full_name' style="width:305px;"/>
                        </div>
                    </div>
                    <div class='col-md-2'>
                        <div class="form-group">
                          <label for="nama">Bulan Perkiraan Lahir</label>       
						  <div class="form-group">
							    <select class="form-control" id="nama" name='hpl' style="width:140px;">
								<option value=''>Semua Bulan</option>
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
                    </div>
					<div class='col-md-6'>
						<div class="form-group">
                          <label for="nama">Status Resiko</label>
                          <select class="form-control" id="nama" name='status_resiko' style="width:140px;">
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

            <!-- /.box-body -->

            <div class="box">
                <div class="box-body">
                    <table id="listed-table" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Ibu</th>
                                <th class="text-center">HPL</th>
                                <?php if(is_auth([3,4])){echo"<th class='text-center'>desa</th>";}?>
                                <th class="text-center">Status Resiko</th>
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
