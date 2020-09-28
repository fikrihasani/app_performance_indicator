<!-- Main content -->
<?php 
    $last = show_alert('last_posting');
?>


<section class="content">
	<!-- / box ibu -->	
	<div class="box box-default">
	<form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Ibu</h3>
		</div>
		<div class="box-body">
			<?php echo show_alert('message'); ?>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password Lama</label>
                  <div class="col-sm-10">
                        <input type="password" name="password_lama" class="form-control" placeholder="Masukkan Password Lama Anda" style="max-width:300px;">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password Baru</label>
                  <div class="col-sm-10">
                        <input type="password" pattern=".{0}|.{8,}"   required title="minimal 8 karakter" name="password_baru" class="form-control" placeholder="Min. 8 Karakter" style="max-width:300px;" value="<?php echo (ISSET($last['password_baru']))? $last['password_baru'] : ''; ?>">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Konfirmasi Password Baru</label>
                  <div class="col-sm-10">
                        <input type="password" pattern=".{0}|.{8,}"   required title="minimal 8 karakter" name="konfirmasi_password_baru" class="form-control" placeholder="Masukkan Ulang Password Baru Anda" style="max-width:300px;" value="<?php echo (ISSET($last['konfirmasi_password_baru']))? $last['konfirmasi_password_baru'] : ''; ?>">
                  </div>
            </div>
		</div>
		<div class="box-footer">
			<a href="<?php echo site_url('discover/dashboard');?>" class="btn btn-small btn-danger">Batalkan</a>
            <button type="submit" class="btn btn-success pull-right">Ubah Password</button>
        </div>
	</form>
	</div>
</section>