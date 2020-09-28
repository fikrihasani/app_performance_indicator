<!-- Main content -->
<?php
    $last = show_alert('last_posting');
?>
<section class="content">
	<!-- / box ibu -->
	<div class="box box-default">
        <form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Pengguna</h3>
		</div>
		<div class="box-body">
            <?php echo show_alert('message'); ?>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-10">
                        <input type="number" name="nip" class="form-control" required placeholder="Angka" value="<?php echo (ISSET($last['nip']))? $last['nip'] : ''; ?>" style="max-width:250px;" maxlength="25">
                  </div>
            </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Pengguna</label>
                  <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" required placeholder="Maksimal 25 Karakter" value="<?php echo (ISSET($last['nama']))? $last['nama'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" required placeholder="Maksimal 25 Karakter" value="<?php echo (ISSET($last['username']))? $last['username'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                        <input type="password" pattern=".{0}|.{8,}"   required title="minimal 8 karakter" name="password" class="form-control" placeholder="Minimal 8 Karakter" value="<?php echo (ISSET($last['password']))? $last['password'] : ''; ?>" style="max-width:300px;">
                  </div>
            </div>
                <!-- phone mask -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nomor Telepon:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                            <input type="tel" name="no_telp" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask style="width:150px;" required value="<?php echo (ISSET($last['no_telp']))? $last['no_telp'] : ''; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Hak Akses</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="id_level" style="max-width:150px;">
							<?php
							if(ISSET($last['id_level']) && $last['id_level'] == '1'){
								echo"<option selected value='1'>Administrator</option>";
								echo"<option value='2'>Bidan Desa</option>";
								echo"<option value='3'>Bidan Koordinator</option>";
								echo"<option value='4'>Kepala Puskesmas</option>";
							}if(ISSET($last['id_level']) && $last['id_level'] == '2'){
								echo"<option selected value='2'>Bidan Desa</option>";
								echo"<option value='1'>Administrator</option>";
								echo"<option value='3'>Bidan Koordinator</option>";
								echo"<option value='4'>Kepala Puskesmas</option>";
							}if(ISSET($last['id_level']) && $last['id_level'] == '3'){
								echo"<option selected value='3'>Bidan Koordinator</option>";
								echo"<option value='1'>Administrator</option>";
								echo"<option value='2'>Bidan Desa</option>";
								echo"<option value='4'>Kepala Puskesmas<option>";
							}if(ISSET($last['id_level']) && $last['id_level'] == '4'){
								echo"<option selected value='4'>Kepala Puskesmas</option>";
								echo"<option value='1'>Administrator</option>";
								echo"<option value='2'>Bidan Desa</option>";
								echo"<option value='3'>Bidan Koordinator</option>";
							}else{
								echo"<option value=''>Pilih Salah Satu</option>";
								echo"<option value='1'>Administrator</option>";
								echo"<option value='2'>Bidan Desa</option>";
								echo"<option value='3'>Bidan Koordinator</option>";
								echo"<option value='4'>Kepala Puskesmas</option>";

							}
						?>
                        </select>
                    </div>
                </div>
			<!-- /.form group -->
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Desa</label>
                <div class="col-sm-10">
    				<select class="form-control select2 select2disable" name="id_desa" style="max-width:150px;" disabled>
    					<option value="">Pilih Desa</option>
        				<?php
							for($i=0; $i<count($hasil); $i++){
							$h = $hasil[$i];
                            if(ISSET($h['id_desa']) && $h['id_desa'] == $last['id_desa']){
                                echo"<option selected value='$h[id_desa]'>$h[nama_desa]</option>";
                            }else{
                                echo"<option value='$h[id_desa]'>$h[nama_desa]</option>";
                            }
						}
        				?>
    				</select>
                </div>
			</div>
		</div>
        <div class="box-footer">
			<a href="<?php echo site_url('doctor/user_daftar');?>" class="btn btn-small btn-danger">Batalkan</a>
            <button type="submit" class="btn btn-success pull-right">Tambah</button>
        </div>
        </form>
	</div>
</section>
