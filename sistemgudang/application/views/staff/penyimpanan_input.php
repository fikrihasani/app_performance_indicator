<!-- Main content -->
<?php
    $last = show_alert('last_posting');
?>
<section class="content">
	<!-- / box ibu -->
	<div class="box box-default">
        <form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Penyimpanan Baru</h3>
		</div>
		<div class="box-body">
            <?php echo show_alert('message'); ?>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Penyimpanan</label>
                  <div class="col-sm-10">
                        <input type="text" name="nama_penyimpanan" class="form-control" required placeholder="Penyimpanan" value="<?php echo (ISSET($last['nama']))? $last['nama'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Gudang</label>
                  <div class="col-sm-10">
                        <!-- <input type="text" name="nama_penyimpanan" class="form-control" required placeholder="Penyimpanan" value="<?php echo (ISSET($last['nama']))? $last['nama'] : ''; ?>" style="max-width:300px;" maxlength="25"> -->
                        <select name="gudang" class="form-control" style="max-width:300px;">
                            <option value="0">Pilih Gudang</option>
                            <?php
                              foreach ($gudang as $gd) {
                                ?>
                                <option value="<?= $gd['id_gudang'] ?>"><?= $gd['nama_gudang'] ?></option>
                                <?php
                              }
                            ?>
                        </select>
                  </div>  
            </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kapasitas</label>
                  <div class="col-sm-10">
                        <input type="text" name="kapasitas" class="form-control" required placeholder="Kapasitas" value="<?php echo (ISSET($last['nama']))? $last['nama'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Sisa</label>
                  <div class="col-sm-10">
                        <input type="text" name="sisa" class="form-control" required placeholder="Sisa" value="<?php echo (ISSET($last['nama']))? $last['nama'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
        <div class="box-footer">
			<a href="<?php echo site_url('barang/barang_daftar');?>" class="btn btn-small btn-danger">Batalkan</a>
            <button type="submit" class="btn btn-success pull-right">Tambah</button>
        </div>
        </form>
	</div>
</section>
