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
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu Hamil</label>
				<div class="col-sm-10">
					<select class="form-control select2" id="id_kehamilan" name="id_kehamilan" style="width:300px;">
					<?php	
						$h = $get;
						if(ISSET($h['id_kehamilan']) && $h['id_kehamilan'] == $last['id_kehamilan']){
							echo"<option selected value='$h[id_kehamilan]' disabled>$h[nama_ibu], ($h[nik])<option>";
						}else{
							echo"<option selected value='$h[id_kehamilan]' disabled>$h[nama_ibu], ($h[nik])<option>";
						}
					?>   
					</select>
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Catatan</label>
                  <div class="col-sm-10">
                        <textarea class="form-control" name="catatan" class="form-control" placeholder="Sebutkan deskripsi penyebab"><?php echo (ISSET($last['catatan']))? $last['catatan'] : ''; ?></textarea>
                  </div>
            </div>
		</div>
		<div class="box-footer">
            <b >
			<a href='<?php echo site_url('checkup/kehamilan_unverified_detail/'.simple_encrypt($get['nik']));?>' class='btn btn-small btn-danger' >Batalkan</a>
            <button type="submit" class="btn btn-success pull-right">Ubah Status</button>
			</b >
        </div>
	</form>
	</div>
</section>