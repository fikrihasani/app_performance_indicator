<!-- Main content -->
<section class="content">
	<!-- / box ibu -->
	<div class="box box-default">
        <form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Pengguna</h3>
		</div>
		<div class="box-body">
            <?php
                echo show_alert('message');
            ?>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                  <div class="col-sm-10">
                        <input type="number" name="nip" value='<?php echo (isset($get['nip']))?$get['nip']:'';?>'  class="form-control" placeholder="Maksimal 25 Karakter" style="max-width:300px;" required maxlength="25">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Pengguna</label>
                  <div class="col-sm-10">
                        <input type="text" name="nama" required value='<?php echo (isset($get['nama']))?$get['nama']:'';?>'  class="form-control" placeholder="Maksimal 25 Karakter" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                        <input type="text" name="username" required value='<?php echo (isset($get['username']))?$get['username']:'';?>' class="form-control" placeholder="Maksimal 25 Karakter" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                        <input type="password" pattern=".{0}|.{8,}"    title="isi jika hanya ingin mengubah" name="password" class="form-control" placeholder="Minimal 8 Karakter" style="max-width:300px;">
                  </div>
            </div>


			<div class="form-group">
    			<label for="inputEmail3" class="col-sm-2 control-label">Nomor Telepon:</label>
                <div class="col-sm-10">
    			<div class="input-group">
        			  <div class="input-group-addon">
        				<i class="fa fa-phone"></i>
        			  </div>
        			  <input type="tel" name="no_telp"  value='<?php echo (isset($get['no_telp']))?$get['no_telp']:'';?>'  class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask style="max-width:150px;">
                    </div>
    			</div>
    			<!-- /.input group -->
			</div>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Hak Akses</label>
                <div class="col-sm-10">
			    <select class="form-control select2" name="id_level" style="max-width:150px;">
				    <option value="">Pilih Salah Satu</option>
				    <option value="1" <?php echo (isset($get['id_level']) && $get['id_level'] == 1)?'selected':''?> >Administrator</option>
					<option value="2" <?php echo (isset($get['id_level']) && $get['id_level'] == 2)?'selected':''?> >Bidan Desa</option>
					<option value="3" <?php echo (isset($get['id_level']) && $get['id_level'] == 3)?'selected':''?> >Bidan Koordinator</option>
					<option value="4" <?php echo (isset($get['id_level']) && $get['id_level'] == 4)?'selected':''?> >Kepala Puskesmas</option>
				</select>
                </div>
			</div>
			<!-- /.form group -->
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Desa</label>
                <div class="col-sm-10">
				<select class="form-control select2" name="id_desa" style="max-width:150px;">
					<option value="">Pilih Desa</option>
				<?php


					$desa_user = array_column($desa_user, 'id_desa');


					for($i=0; $i<count($desa); $i++){
						$h = $desa[$i];
					    if(ISSET($get['id_desa']) && $get['id_desa'] == $h['id_desa']){
					        echo"<option value='$h[id_desa]' selected>$h[nama_desa]</option>";
					    }elseif(!in_array($h['id_desa'], $desa_user)) {
							 echo"<option value='$h[id_desa]'>$h[nama_desa]</option>";
						}
					}


					// for($i=0; $i<count($desa); $i++){
					// 	$h = $desa[$i];
                    //     if(ISSET($get['id_desa']) && $get['id_desa'] == $h['id_desa']){
                    //         echo"<option value='$h[id_desa]' selected>$h[nama_desa]</option>";
                    //     }
					// }
					// for($i=0; $i<count($desa2); $i++){
					// 		$j = $desa2[$i];
					// 		echo"<option value='$j[id_desa]'>$j[nama_desa]</option>";
					// 	}
				?>
				</select>
                </div>
			</div>
		</div>
         <div class="box-footer">
			<a href="<?php echo site_url('doctor/user_daftar');?>" class="btn btn-small btn-danger">Kembali</a>
            <button type="submit" class="btn btn-info pull-right">Ubah Data Pengguna</button>
        </div>
	</div>
    </form>
</div>
</section>
