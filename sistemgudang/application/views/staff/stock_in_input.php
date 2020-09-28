<!-- Main content -->
<?php
    $last = show_alert('last_posting');
?>
<section class="content">
	<!-- / box ibu -->
	<div class="box box-default">
        <form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Input Item</h3>
		</div>
		<div class="box-body">
            <?php echo show_alert('message'); ?>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">No. PO</label>
                <div class="col-sm-10">
    				<select class="form-control select2 " name="id_penerimaan" style="max-width:300px;">
    					<option value="">Pilih Salah Satu</option>
        				<?php
							for($i=0; $i<count($po); $i++){
							$h = $po[$i];
                            if(ISSET($h['id_penerimaan']) && $h['id_penerimaan'] == $last['id_penerimaan']){
                                echo"<option selected value='$h[id_penerimaan]'>$h[nomor_po]</option>";
                            }else{
                                echo"<option value='$h[id_penerimaan]'>$h[nomor_po]</option>";
                            }
						}
        				?>
    				</select>
                </div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nama Barang</label>
                <div class="col-sm-10">
    				<select class="form-control select2 " name="id_barang" style="max-width:300px;">
    					<option value="">Pilih Salah Satu</option>
        				<?php
							for($i=0; $i<count($barang); $i++){
							$h = $barang[$i];
                            if(ISSET($h['id_barang']) && $h['id_barang'] == $last['id_barang']){
                                echo"<option selected value='$h[id_barang]'>$h[nama_barang] - $h[kode]</option>";
                            }else{
                                echo"<option value='$h[id_barang]'>$h[nama_barang] - $h[kode]</option>";
                            }
						}
        				?>
    				</select>
                </div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jumlah</label>
                  <div class="col-sm-10">
                        <input type="number" name="jumlah" class="form-control" required placeholder="Angka" value="<?php echo (ISSET($last['jumlah']))? $last['jumlah'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Lokasi Penyimpanan</label>
                <div class="col-sm-10">
    				<select class="form-control select2 " name="id_penyimpanan" style="max-width:300px;">
    					<option value="">Pilih Salah Satu</option>
        				<?php
							for($i=0; $i<count($penyimpanan); $i++){
							$h = $penyimpanan[$i];
                            if(ISSET($h['id_penyimpanan']) && $h['id_penyimpanan'] == $last['id_penyimpanan']){
                                echo"<option selected value='$h[id_penyimpanan]'>$h[nama_gudang] - $h[nama_penyimpanan]</option>";
                            }else{
                                echo"<option value='$h[id_penyimpanan]'>$h[nama_gudang] - $h[nama_penyimpanan]</option>";
                            }
						}
        				?>
    				</select>
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
