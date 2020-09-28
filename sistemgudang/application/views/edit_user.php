<!-- Main content -->
<section class="content">
<?php
	echo show_alert('message');
?>
	<!-- / box ibu -->	
	<div class="box box-default">
        <form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Pengguna</h3>
		</div>
		<div class="box-body">
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Pengguna</label>
                  <div class="col-sm-10">
                        <input type="text" name="nama" value='<?php echo (isset($get['nama']))?$get['nama']:'';?>'  class="form-control" placeholder="Maksimal 25 Karakter">
                  </div>
            </div>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                        <input type="text" name="username" value='<?php echo (isset($get['username']))?$get['username']:'';?>' class="form-control" placeholder="Maksimal 20 Karakter">
                  </div>
            </div>
   			<div class="form-group">
    			<label for="inputEmail3" class="col-sm-2 control-label">Nomor Telepon:</label>
                <div class="col-sm-10">
    			<div class="input-group">
        			  <div class="input-group-addon">
        				<i class="fa fa-phone"></i>
        			  </div>
        			  <input type="tel" name="no_telp"  value='<?php echo (isset($get['no_telp']))?$get['no_telp']:'';?>'  class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask style="width:200px;">
                    </div>
    			</div>
    			<!-- /.input group -->
			</div>
		</div>
         <div class="box-footer">
			<a href="<?php echo site_url('discover/dashboard');?>" class="btn btn-small btn-danger">Batalkan</a>
            <button type="submit" class="btn btn-success pull-right">Ubah Data Pengguna</button>
        </div>
	</div>
    </form>
</div>
</section>