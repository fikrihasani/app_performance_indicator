<!-- Main content -->
<section class="content">
	<!-- / box ibu -->
	<div class="box box-default">
	<form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Ibu</h3>
		</div>
		<div class="box-body">
			<?php echo show_alert('message'); ?>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIK</label>
                  <div class="col-sm-10">
                        <input type="number" name="nik" min="16" value='<?php echo (isset($get['nik']))?$get['nik']:'';?>' class="form-control" placeholder="Nomor Induk Kependudukan" style="max-width:300px;">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu</label>
                  <div class="col-sm-10">
                        <input type="text" name="nama_ibu" class="form-control" value='<?php echo (isset($get['nama_ibu']))?$get['nama_ibu']:'';?>' placeholder="Maksimal 25 Karakter" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir</label>
				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="date" name="tanggal_lahir" value='<?php echo (isset($get['tanggal_lahir']))?$get['tanggal_lahir']:'';?>' class="form-control datemask" inputmask="'alias': 'dd/mm/yyyy'" style="max-width:150px;">
					</div>
				</div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                        <textarea class="form-control" name="alamat" class="form-control" placeholder="Deskripsikan Alamat Pasien" style="max-width:300px;"><?php echo (isset($get['alamat']))?$get['alamat']:'';?></textarea>
                  </div>
            </div>
			<div class="form-group">
    			<label for="inputEmail3" class="col-sm-2 control-label">Nomor Darurat:</label>
                <div class="col-sm-10">
    			<div class="input-group">
        			  <div class="input-group-addon">
        				<i class="fa fa-phone"></i>
        			  </div>
        			  <input type="number" name="nomor_darurat"  value='<?php echo (isset($get['nomor_darurat']))?$get['nomor_darurat']:'';?>'  class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask style="max-width:150px;">
                    </div>
    			</div>
    			<!-- /.input group -->
			</div>
		</div>
		<div class="box-footer">
			<a href="<?php echo site_url('patient/ibu_daftar');?>" class="btn btn-small btn-danger">Kembali</a>
            <button type="submit" class="btn btn-success pull-right">Simpan</button>
        </div>
	</form>
	</div>
</section>
