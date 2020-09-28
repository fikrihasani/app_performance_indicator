<!-- / box Kegiatan Rujukan-->
<section class="content">
	<?php echo show_alert('message'); ?>
	<form action="<?php echo $action;?>" method="post" class='form-horizontal'>>
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Kegiatan Rujukan</h3>
		</div>
		<div class="box-body with-border">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tanggal Rujukan</label>
				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="date" name="tanggal_rujukan" class="form-control datemask" inputmask="'alias': 'dd/mm/yyyy'" value="<?php echo (ISSET($last['tanggal_rujukan']))? $last['tanggal_rujukan'] : ''; ?>">
					</div>
				</div>
            </div>
			<div class="form-group" >
			<label for="inputEmail3" class="col-sm-2 control-label">Resiko Terdeteksi Oleh</label>
				<div class="col-sm-10">
					<select class="form-control" name="pendeteksi_resiko" style="max-width:150px;">
						<option value="">Tak Ada Resiko</option>
						<option value="1">Nakes</option>
						<option value="2">Non Nakes</option>
					</select>
				</div>
			</div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tempat Rujukan</label>
				<div class="col-sm-10">
					<textarea class="form-control" name='tempat_rujukan'  rows="3" placeholder="Sebutkan nama tempat spesifik"></textarea>
				</div>
			</div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Keadaan Tiba</label>
				<div class="col-sm-10">
					<textarea class="form-control" name='keadaan_tiba'  rows="3" placeholder="Sebutkan kondisi pasien"></textarea>
				</div>
			</div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Keadaan Pulang</label>
				<div class="col-sm-10">	
					<textarea class="form-control" name='keadaan_pulang'  rows="3" placeholder="Sebutkan hasil observasi"></textarea>
				</div>
			</div>
		</div>
		<div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Tambah</button>
        </div>
	</div>
	<!-- ./ box Kegiatan Rujukan-->	
	</form>	
</section>
<!-- ./ End Content-->