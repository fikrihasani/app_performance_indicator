<!-- Main content -->
<?php 
    $last = show_alert('last_posting');
?>
<section class="content">
	<!-- / box ibu -->	
	<div class="box box-default">
	<form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
		<div class="box-header with-border">
			<h3 class="box-title">Data Abortus</h3>
		</div>
		<div class="box-body">
			<?php echo show_alert('message'); ?>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu / NIK</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php	
						echo $get['nama_ibu'].' / '.$get['nik'];
					?>   
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tanggal Abortus</label>
				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="date" name="tanggal_abortus" class="form-control datemask" inputmask="'alias': 'dd/mm/yyyy'" value="<?php echo (ISSET($last['tanggal_abortus']))? $last['tanggal_abortus'] : ''; ?> " style="max-width:150px;">
					</div>
				</div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Penyebab</label>
                  <div class="col-sm-10">
                        <textarea class="form-control" name="penyebab" class="form-control" placeholder="Deskripsi penyebab abortus"><?php echo (ISSET($last['penyebab']))? $last['penyebab'] : ''; ?></textarea>
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kondisi Ibu</label>
                  <div class="col-sm-10">
                        <textarea class="form-control" name="kondisi_ibu" class="form-control" placeholder="Deskripsi kondisi ibu"><?php echo (ISSET($last['kondisi_ibu']))? $last['kondisi_ibu'] : ''; ?></textarea>
                  </div>
            </div>
		</div>
		<div class="box-footer">
            <b >
			<a href='<?php echo site_url('checkup/kehamilan_berjalan_daftar/');?>' class='btn btn-small btn-danger' >Batalkan</a>
            <button type="submit" class="btn btn-success pull-right">Ubah Status</button>
			</b >
        </div>
	</form>
	</div>
</section>