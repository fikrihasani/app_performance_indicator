<!-- Main content -->
<?php
    $last = show_alert('last_posting');
?>
<section class="content">
	<!-- / box ibu -->
	<div class="box box-default">
        <form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Input Penerimaan Barang Baru</h3>
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Shipper</label>
                  <div class="col-sm-10">
                        <input type="text" name="nama_shipper" class="form-control" required placeholder="Maksimal 25 Karakter" value="<?php echo (ISSET($last['nama_shipper']))? $last['nama_shipper'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Forwarder</label>
                  <div class="col-sm-10">
                        <input type="text" name="nama_forwarder" class="form-control" required placeholder="Maksimal 25 Karakter" value="<?php echo (ISSET($last['nama_forwarder']))? $last['nama_forwarder'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jumlah</label>
                  <div class="col-sm-10">
                        <input type="number" name="jumlah" class="form-control" required placeholder="Angka" value="<?php echo (ISSET($last['jumlah']))? $last['jumlah'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nomor PO / DO</label>
                  <div class="col-sm-10">
                        <input type="text" name="nomor_po" class="form-control" required placeholder="Maksimal 25 Karakter" value="<?php echo (ISSET($last['nomor_po']))? $last['nomor_po'] : ''; ?>" style="max-width:300px;" maxlength="25">
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
