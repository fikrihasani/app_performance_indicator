<!-- Main content -->
<?php 
    $last = show_alert('last_posting');
?>
<section class="content">
	<!-- / box ibu -->	
	<div class="box box-default">
	<form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Catatan Untuk BIdan Desa</h3>
		</div>
		<div class="box-body">
			<?php echo show_alert('message'); ?>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu  Hamil / NIK</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php	
						echo $get['nama_ibu'].'/'.$get['nik'];
					?>   
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Catatan</label>
                  <div class="col-sm-10">
                        <textarea class="form-control" name="catatan" class="form-control" placeholder="Sebutkan deskripsi hal-hal yang perlu diperhatikan bidan desa"><?php echo (ISSET($last['catatan']))? $last['catatan'] : ''; ?></textarea>
                  </div>
            </div>
		</div>
		<div class="box-footer">
            <b >
			<a href='<?php echo site_url('checkup/pemeriksaan_unverified_daftar/');?>' class='btn btn-small btn-danger' onClick=\"return confirm('Anda yakin ingin membatalkan pengubahan data?')\">Batal</a>
            <button type="submit" class="btn btn-success pull-right" onClick=\"return confirm('Anda yakin ingin mengubah status data pemeriksaan ini ?')\">Ubah Status</button>
			</b >
        </div>
	</form>
	</div>
</section>