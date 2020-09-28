<!-- Main content -->
<?php 
    $last = show_alert('last_posting');
?>
<section class="content">
	<!-- / box ibu -->	
	<div class="box box-default">
	<form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Rujukan</h3>
		</div>
		<div class="box-body">
			<?php echo show_alert('message'); ?>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu Hamil</label>
				<div class="col-sm-10">
					<select class="form-control select2" id="id_kehamilan" name="id_kehamilan" style="max-width:300px;">
					<?php	
						for($i=0; $i<count($hasil); $i++){
							$h = $hasil[$i];
							if(ISSET($h['id_kehamilan']) && $h['id_kehamilan'] == $last['id_kehamilan']){
								echo"<option selected value='$h[id_kehamilan]'>$h[nama_ibu], ($h[nik])</option>";
							}else{
								echo"<option value='$h[id_kehamilan]'>$h[nama_ibu], ($h[nik])</option>";
							}
						}
					?>   
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tanggal Rujukan</label>
				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="date" name="tanggal_rujukan" class="form-control datemask" inputmask="'alias': 'dd/mm/yyyy'" value="<?php echo (ISSET($last['tanggal_rujukan']))? $last['tanggal_rujukan'] : ''; ?>" style="max-width:150px;">
					</div>
				</div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Pendeteksi Resiko</label>
				<div class="col-sm-10">
					<select class="form-control" name='pendeteksi_resiko' style="max-width:150px;">
						<?php	
							if(ISSET($last['pendeteksi_resiko']) && $last['pendeteksi_resiko'] == '0'){
								echo"<option selected value='0'> Nakes <option>";
								echo"<option value='1'>Non Nakes</option>";
							}if(ISSET($last['pendeteksi_resiko']) && $last['pendeteksi_resiko'] == '1'){
								echo"<option selected value='1'>Non Nakes <option>";
								echo"<option value='0'>Nakes</option>";
							}else{
								echo"<option value=''>Pilih Salah Satu</option>";
								echo"<option value='0'>Nakes</option>";
								echo"<option value='1'>Non Nakes</option>";
							}
						?>
					</select>
				</div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tempat Rujukan</label>
                  <div class="col-sm-10">
                        <textarea class="form-control" name="tempat_rujukan" class="form-control" placeholder="Sebutkan nama tempat spesifik" style="max-width:300px;"><?php echo (ISSET($last['tempat_rujukan']))? $last['tempat_rujukan'] : ''; ?></textarea>
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keadaan Tiba</label>
                  <div class="col-sm-10">
                        <textarea class="form-control" name="keadaan_tiba" class="form-control" placeholder="Deskripsikan keadaan pasien" style="max-width:300px;"><?php echo (ISSET($last['keadaan_tiba']))? $last['keadaan_tiba'] : ''; ?></textarea>
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keadaan Pulang</label>
                  <div class="col-sm-10">
                        <textarea class="form-control" name="keadaan_pulang" class="form-control" placeholder="Deskripsikan keadaan pasien" style="max-width:300px;"><?php echo (ISSET($last['keadaan_pulang']))? $last['keadaan_pulang'] : ''; ?></textarea>
                  </div>
            </div>
		</div>
		<div class="box-footer">
			<a href="<?php echo site_url('checkup/kehamilan_berjalan_daftar');?>" class="btn btn-small btn-danger">Batalkan</a>
            <button type="submit" class="btn btn-success pull-right">Tambah</button>
        </div>
	</form>
	</div>
</section>