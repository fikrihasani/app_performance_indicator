<form action="<?php echo site_url('patient/source_ibu_list'); ?>" id='display-table'>
<!-- Main content -->
<section class="content">
    <div class="row">
		<a href="<?php echo site_url('patient/ibu_input');?>"class="btn btn-primary ml-15">
			<i class="fa fa-user"></i> Tambah Ibu Baru
		</a><br><br>
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
                          <input class="form-control" id="nama" max="25" placeholder="Maks.25 Karakter" type="text" name='full_name' style="width:305px;"/>
                        </div>
						<div class="form-group">
                          <label for="nama">NIK</label>
                          <input class="form-control" id="nama" placeholder="Nomor Induk Kependudukan" type="text" name='nik' style="width:200px;"/>
                        </div>
                    </div>
                    <div class='col-md-8'>
                        <div class="form-group">
                          <label for="nama">Alamat</label>
                          <input class="form-control" id="nama" max="25" placeholder="Maks.100 Karakter" type="text" name='address' />
                        </div>
                        <div class="form-group">
                          <label for="nama">Nomor Darurat</label>
                          <input class="form-control" id="nama" placeholder="Masukkan angka" type="text" name='nomor_darurat' style="width:140px;"/>
                        </div>


                    </div>

                    <button type="button" class="btn btn-primary" id='select-filter'>Filter</button>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box">
				<div class="box-header with-border">
                  <h3 class="box-title">Daftar Pasien</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php echo show_alert('message');?>
                <table id="listed-table" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">Nama Ibu</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Nomor Darurat</th>
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
                <input type='hidden' name='current_page' class='current-page' value='1' />

                <br class='clearfix'/>
                </div>
            </div>
        </div>
    </div>
</section>
</form>
