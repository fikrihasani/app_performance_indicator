<section class="content">

	<!-- / coba -->
		<div id='dialog-replace'></div>
		<form id='display-table' action='<?php echo site_url('checkup/_ajax');?>'>
		<div class="panel">
			<div class="panel-header">
				<h3><i class="fa fa-filter"></i> <strong>Filter</h3>
				<div class="control-btn"><a class="panel-toggle" href="#"><i class="fa fa-angle-down"></i></a></div>
			</div>
			<div class="panel-content" style='display:none;'>
				<div class="row">
				  <div class="col-sm-6">
					<div class="form-group">
					  <label>Status</label>
					  <select class="form-control" data-style="" data-placeholder="Select Status..." name='status'>
						<option></option>
						<option value="1">Active</option>
						<option value="2">Disable</option>
					  </select>
					</div>
				  </div>
				  <div class="col-sm-6">
					<div class="form-group">
					  <label class="control-label">Name</label>
					  <div class="">
						<input type="text" required="" placeholder="Minimum 4 characters..." minlength="4" class="form-control" name="name" aria-required="true" />
					  </div>
					</div>
				  </div>
				  <div class="col-sm-6">
					<div class="form-group">
					  <label class="control-label">Category</label>
					  <div class="">

						<select class="form-control" data-style="" data-placeholder="Select Category" name='product_category'>
						<option></option>
						<?php
						/*    foreach($categories as $val) {
								echo "<option value='".$val['cat_id']."'>".$val['cat_name']."</option>";
							}*/
						?>
					  </select>

					   </div>
					</div>
				  </div>

				</div>
				<div class="">
					<button class="btn btn-embossed btn-primary" type="submit" id='select-filter'>Filter</button>
				</div>
			</div>
		</div>
	<!-- ./ coba -->	
	<!-- / box kehamilan -->	
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Data Kehamilan</h3>
		</div>
		<div class="box-body with-border">
		<!-- text input -->
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label">NIK</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php	
						echo $get['nik'];
					?>   
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php	
						echo $get['nama_ibu'];
					?>   
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php	
						echo $get['alamat'];
					?>   
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label">Nomor Darurat</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php	
						echo $get['nomor_darurat'];
					?>   
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label">Usia Kandungan</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php	
						$selisih 	= ((abs(strtotime ($get['waktu_daftar']) - strtotime (date('Y-m-d'))))/(60*60*24));
						$usia 		= ($get['usia_kandungan_daftar'] + (round(round($selisih) / 7)));
						echo $usia;
					?>   
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label">HPL</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php	
						$hpl 		= date_convert($get['HPL']);
						echo $hpl;
					?>   
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label">Status Resiko</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php	
						
						echo ($get['status_resiko']);
					?>   
				</div>
			</div>
		</div>
	</div>
	<!-- ./ box kehamilan -->
	<!-- / box riwayat pemeriksaan -->	
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Riwayat Layanan Antenatal Terpadu</h3>
		</div>
		<div class="box-body with-border">
			<table id="datatable" class="table table-bordered table-striped" >
				<thead>
					<tr>
					  <th class="text-center">Pemeriksaan Ke- </th>
					  <th class="text-center">Tanggal Periksa</th>
					  <th class="text-center">Trimester</th>
					  <th class="text-center">Anamnesis</th>
					  <th class="text-center">Berat Badan Ibu</th>
					  <th class="text-center">Tinggi Badan Ibu</th>
					  <th class="text-center">Tekanan Darah</th>
					  <th class="text-center">Fundung Uterus</th>
					  <th class="text-center">Lingkar Lengan Atas</th>
					  <th class="text-center">Status Gizi</th>
					  <th class="text-center">Refleksi Patella</th>
					  <th class="text-center">Denyut Jantung Janin</th>
					  <th class="text-center">Kepala Janin</th>
					  <th class="text-center">Berat Janin</th>
					  <th class="text-center">Presentasi</th>
					  <th class="text-center">Konseling</th>
					  <th class="text-center">Imunisasi</th>
					  <th class="text-center">Injeksi TT</th>
					  <th class="text-center">Pencatatan Buku KIA</th>
					  <th class="text-center">PS</th>
					  <th class="text-center">HB</th>
					  <th class="text-center">Protein Urine</th>
					  <th class="text-center">Gula Darah</th>
					  <th class="text-center">Thalasemia</th>
					  <th class="text-center">Sifilis</th>
					  <th class="text-center">Hbsag</th>
					  <th class="text-center">HDK</th>
					  <th class="text-center">Abortus</th>
					  <th class="text-center">Pendarahan</th>
					  <th class="text-center">Infeksi</th>
					  <th class="text-center">KPD</th>
					  <th class="text-center">Lain Lain</th>
					  <th class="text-center">Status Resiko</th>
					</tr>
				</thead>
				<tbody align="center">
				<?php	
					for($i=0; $i<count($hasil); $i++){
					$h 			= $hasil[$i];
						echo"
							<tr>
								<td>".($i+1)."</td>
								<td>$h[tanggal_periksa]</td>
								<td>$h[berat_badan]</td>
								<td>$h[tinggi_badan]</td>
								<td>$h[tekanan_a]."/".$h[tekanan_b]</td>
								<td>$h[fundung_uterus]</td>
								<td>$h[lingkar_lengan]</td>
								<td>$h[status_gizi]</td>
								<td>$h[refleksi_patella]</td>
								<td>$h[djj]</td>
								<td>$h[kepala]</td>
								<td>$h[berat_janin]</td>
								<td>$h[jumlah_janin]</td>
								<td>$h[presentasi]</td>
								<td>$h[status_konseling]</td>
								<td>$h[status_imunisasi]</td>
								<td>$h[status_injeksi]</td>
								<td>$h[status_pencatatan]</td>
								<td>$h[ps]</td>
								<td>$h[hb]</td>
								<td>$h[protein_urine]</td>
								<td>$h[gula_darah]</td>
								<td>$h[status_thalasemia]</td>
								<td>$h[status_sifilis]</td>
								<td>$h[hbsag]</td>
								<td>$h[hdk]</td>
								<td>$h[abortus]</td>
								<td>$h[pendarahan]</td>
								<td>$h[infeksi]</td>
								<td>$h[kpd]</td>
								<td>$h[lain_lain]</td>
								<td>$h[status_resiko]</td>
							</tr>
						";
					}	
				?>   
				</tbody>
			</table>
		</div>
	</div>
	<!-- / box riwayat pemeriksaan -->	
	<!-- / box riwayat rujukan -->	
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Riwayat Rujukan</h3>
		</div>
		<div class="box-body with-border">
			<table id="datatable" class="table table-bordered table-striped" >
				<thead>
					<tr>
					  <th class="text-center">Rujukan Ke- </th>
					  <th class="text-center">Pendeteksi Resiko</th>
					  <th class="text-center">Tempat Rujukan</th>
					  <th class="text-center">Keadaan Tiba</th>
					  <th class="text-center">Keadaan Pulang</th>
					</tr>
				</thead>
				<tbody align="center">
				<?php	
					for($i=0; $i<count($hasil2); $i++){
						$j 			= $hasil2[$i];
						echo"
							<tr>
								<td>".($i+1)."</td>
								<td>$j[pendeteksi_resiko]</td>
								<td>$j[tempat_rujukan]</td>
								<td>$j[keadaan_tiba]</td>
								<td>$j[keadaan_pulang]."/".$h[tekanan_b]</td>
							</tr>
						";
					}	
				?>   
				</tbody>
			</table>
		</div>
		<div class="box-footer">
	            <a href='<?php echo site_url('checkup/pemeriksaan_unverified_daftar');?>' class='btn btn-small btn-info' >Kembali</a>
	    </div>
	</div>
	<!-- / box riwayat rujukan -->
</section>	