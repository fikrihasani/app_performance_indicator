<!-- Main content -->
<?php
    $last = show_alert('last_posting');
?>
<section class="content">
	<!-- / box ibu -->
	<div class="box box-default">
        <form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Gudang Baru</h3>
		</div>
		<div class="box-body">
            <?php echo show_alert('message'); ?>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Gudang</label>
                  <div class="col-sm-10">
                        <input type="text" name="nama_gudang" class="form-control" required placeholder="Maksimal 25 Karakter" value="<?php echo (ISSET($last['nama']))? $last['nama'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Alamat</label>
                  <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" required placeholder="Alamat" value="<?php echo (ISSET($last['alamat']))? $last['alamat'] : ''; ?>" style="max-width:250px;" maxlength="25">
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
