<!-- Main content -->
<?php 
    $last = show_alert('last_posting');
?>
<section class="content">
	<!-- / box ibu -->	
	<div class="box box-default">
	<form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Kelahiran</h3>
		</div>
		<div class="box-body">
			<?php echo show_alert('message'); ?>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu / NIK</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php	
						echo $get['nama_ibu'].' / '.$get['nik'];
					?>   
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir</label>
				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="date" name="tanggal_lahir" class="form-control datemask" inputmask="'alias': 'dd/mm/yyyy'" value="<?php echo (ISSET($last['tanggal_lahir']))? $last['tanggal_lahir'] : ''; ?> " style="max-width:150px;">
					</div>
				</div>
            </div>
			<div class="bootstrap-timepicker">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Waktu Lahir</label>
				  <div class="col-sm-10">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
							<input type="time" name="waktu_lahir" class="form-control timepicker" value="<?php echo (ISSET($last['waktu_lahir']))? $last['waktu_lahir'] : ''; ?>" style="max-width:150px;">
							</div>
					</div>
                </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tempat Lahir</label>
                  <div class="col-sm-10">
                        <textarea class="form-control" name="tempat_lahir" class="form-control" placeholder="Deskripsi penyebab"><?php echo (ISSET($last['tempat_lahir']))? $last['tempat_lahir'] : ''; ?></textarea>
                  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Penolong Persalinan</label>
				<div class="col-sm-10">
					<select class="form-control" name="lahir_by" style="max-width:150px;">
						<?php	
							if(ISSET($last['lahir_by']) && $last['lahir_by'] == '0'){
								echo"<option selected value='0'>Dokter<option>";
								echo"<option value='1'>Bidan</option>";
								echo"<option value='2'>Nakes Lainnya</option>";
								echo"<option value='3'>Non Nakes</option>";
							}else if(ISSET($last['lahir_by']) && $last['lahir_by'] == '1'){
								echo"<option selected value='1'>Bidandan<option>";
								echo"<option value='0'>Dokter</option>";
								echo"<option value='2'>Nakes Lainnya</option>";
								echo"<option value='3'>Non Nakes</option>";
							}else if(ISSET($last['lahir_by']) && $last['lahir_by'] == '2'){
								echo"<option selected value='2'>Nakes Lainnya<option>";
								echo"<option value='0'>Dokter</option>";
								echo"<option value='1'>Bidan</option>";
								echo"<option value='3'>Non Nakes</option>";
							}else if(ISSET($last['lahir_by']) && $last['lahir_by'] == '3'){
								echo"<option selected value='3'>Non Nakes<option>";
								echo"<option value='0'>Dokter</option>";
								echo"<option value='2'>Nakes Lainnya</option>";
								echo"<option value='1'>Bidan</option>";
							}else{
								echo"<option value=''>Pilih Salah Satu</option>";
								echo"<option value='0'>Dokter</option>";
								echo"<option value='1'>Bidan</option>";
								echo"<option value='2'>Nakes Lainnya</option>";
								echo"<option value='3'>Non Nakes</option>";
							}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<b >
			<a href='<?php echo site_url('checkup/kehamilan_berjalan_daftar/');?>' class='btn btn-small btn-danger' >Batalkan</a>
            <button type="submit" class="btn btn-success pull-right">Ubah Status</button>
			</b >
		</div>
	</form>
	</div>
</section>