<!-- Main content -->
<?php
    $last = show_alert('last_posting');
?>
<section class="content">
	<!-- / box ibu -->
	<div class="box box-default">
        <form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Barang Baru</h3>
		</div>
		<div class="box-body">
            <?php echo show_alert('message'); ?>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Barang</label>
                  <div class="col-sm-10">
                        <input type="text" name="nama_barang" class="form-control" required placeholder="Maksimal 25 Karakter" value="<?php echo (ISSET($last['nama']))? $last['nama'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
            <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
                <div class="col-sm-10">
    				<select class="form-control " name="id_kategori" style="max-width:150px;" >
    					<option value="">Pilih Kategori</option>
        				<?php
							for($i=0; $i<count($kategori); $i++){
							$h = $kategori[$i];
                            if(ISSET($h['id_kategori']) && $h['id_kategori'] == $last['id_kategori']){
                                echo"<option selected value='$h[id_kategori]'>$h[nama_kategori]</option>";
                            }else{
                                echo"<option value='$h[id_kategori]'>$h[nama_kategori]</option>";
                            }
						}
        				?>
    				</select>
                </div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Satuan</label>
                <div class="col-sm-10">
    				<select class="form-control " name="id_satuan" style="max-width:150px;" >
    					<option value="">Pilih Satuan</option>
        				<?php
							for($i=0; $i<count($lokasi); $i++){
							$h = $lokasi[$i];
                            if(ISSET($h['id_satuan']) && $h['id_satuan'] == $last['id_satuan']){
                                echo"<option selected value='$h[id_satuan]'>$h[nama_satuan]</option>";
                            }else{
                                echo"<option value='$h[id_satuan]'>$h[nama_satuan]</option>";
                            }
						}
        				?>
    				</select>
                </div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kode Barang</label>
                  <div class="col-sm-10">
                        <input type="text" name="kode_barang" class="form-control" required placeholder="Kode Unik Barang" value="<?php echo (ISSET($last['kode_barang']))? $last['kode_barang'] : ''; ?>" style="max-width:250px;" maxlength="25">
                  </div>
            </div>
		</div>
        <div class="box-footer">
			<a href="<?php echo site_url('barang/barang_daftar');?>" class="btn btn-small btn-danger">Batalkan</a>
            <button type="submit" class="btn btn-success pull-right">Tambah</button>
        </div>
        </form>
	</div>
</section>
