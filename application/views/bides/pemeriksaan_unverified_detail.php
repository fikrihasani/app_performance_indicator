<section class="content">
	<form action="<?php echo $action;?>" method="post" class='form-horizontal'>
	<!-- / box kehamilan -->
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Data Kehamilan</h3>
		</div>
		<div class="box-body with-border">
		<!-- text input -->
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label pt-0i">NIK</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $get['nik'];
					?>
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label  pt-0i">Nama Ibu</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $get['nama_ibu'];
					?>
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label  pt-0i">Alamat</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $get['alamat'];
					?>
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label  pt-0i">Usia</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $get['tanggal_lahir']."  "."Tahun";;
					?>
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label pt-0i">Nomor Darurat</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $get['nomor_darurat'];
					?>
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label pt-0i">Usia Kandungan</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						$selisih 	= ((abs(strtotime ($get['waktu_konsepsi']) - strtotime (date('Y-m-d'))))/(60*60*24));
						$usia 		= (round(round($selisih) / 7));
						echo $usia."  "."Minggu";
					?>
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label pt-0i">HPL</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $get['HPL'];
					?>
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label pt-0i">Status BPJS</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo ($h['status_bpjs']);
					?>
				</div>
			</div>
			<div class='row'>
			<label for='inputEmail3' class='col-sm-2 control-label pt-0i'>Catatan Bikor</label>
				<div class='col-sm-10'>
					<a>:</a>

						<?php echo (ISSET($h['catatan']))? $h['catatan'] : '-'; ?>
				</div>
			</div>
		</div>
	</div>
	<!-- ./ box kehamilan -->
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Pemeriksaan Ibu</h3>
		</div>
		<div class="box-body with-border">
		<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label pt-0i">Tanggal Periksa</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['tanggal_periksa'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Trimester</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo ($h['trimester']);
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Anamnesis</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
							echo $h['anamnesis'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Tinggi Badan Ibu</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['tinggi_badan']."  "."Cm";
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Berat Badan Ibu</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['berat_badan']."  "."Kilogram";
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Tekanan Darah</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo ($h['tekanan_a'])."/".($h['tekanan_b']."  "."mmHg");
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Tinggi Fundung Uterus</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo ($h['fundung_uterus']);
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Lingkar Lengan</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo ($h['lingkar_lengan'])."  "."Cm";
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Status Gizi</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
								echo $h['status_gizi'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Refleksi Patella</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['refleksi_patella'];
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Pemeriksaan Bayi</h3>
		</div>
		<div class="box-body with-border">
		<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Denyut Jantung Janin</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo ($h['djj'])."  "."/ Menit";
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Kepala Terhadap PAP</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['kepala'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Taksiran Berat Janin </label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo ($h['berat_janin'])."  "."Gram";;
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Jumlah Janin</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['jumlah_janin'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Presentasi  Janin</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['presentasi'];
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Pelayanan Laboratorium</h3>
		</div>
		<div class="box-body with-border">
		<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Status Konseling</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['status_konseling'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Status Imunisasi</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['status_imunisasi'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Status Injeksi TT</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['status_injeksi'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Pencatatan Buku KIA</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['status_pencatatan'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Fe</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo ($h['ps']."  "."Gram");
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">HB</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo ($h['hb']);
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Protein Urine</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo ($h['protein_urine']);
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Gula Darah</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['gula_darah'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Status Thalasemia</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['status_thalasemia'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Status Sifilis</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['status_sifilis'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Hbsag</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['hbsag'];
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Integrasi Layanan</h3>
		</div>
		<div class="box-body with-border">
		<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">VCT</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['vct'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Serologi</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['serologi'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">ARV</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['arv'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Malaria</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['malaria'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Obat</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['obat'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Kelambu</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['kelambu'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">TB</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['tb'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Obat TB</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['obat2'];
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Komplikasi</h3>
		</div>
		<div class="box-body with-border">
		<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">HDK</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['hdk'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Abortus</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['abortus'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Pendarahan</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['pendarahan'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Infeksi</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['infeksi'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">KPD</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['kpd'];
					?>
				</div>
			</div>
			<div class="row">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Lain-Lain</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $h['lain_lain'];
					?>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label pt-0i">Status Resiko</label>
				<div class="col-sm-10">
					
					<?php
					if (is_auth([2,4])){
						echo"<a>:</a>";
						echo (status_convert($h['status_resiko']));
					}else if (is_auth(3)){
						echo"<select class='form-control' name='status_resiko' style='max-width:150px;'>
						";
						if($h['status_resiko'] == '0' && (level() == 2)){
							echo"<option selected value='0' disabled>Resiko Rendah</option>";
							echo"<option value='1' disabled>Resiko Tinggi</option>";
						}else if($h['status_resiko'] == '1' && (level() == 2)){
							echo"<option selected value='1' disabled>Resiko Tinggi</option>";
							echo"<option value='0' disabled>Resiko Rendah</option>";
						}else if($h['status_resiko'] == '0' && (level() == 3)){
							echo"<option selected value='0' >Resiko Rendah</option>";
							echo"<option value='1'>Resiko Tinggi</option>";
						}else if($h['status_resiko'] == '1' && (level() == 3)){
							echo"<option selected value='1'>Resiko Tinggi</option>";
							echo"<option value='0'>Resiko Rendah</option>";
						}
						echo"</select>";
					}
					?>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<b>
			<a href='<?php echo site_url('checkup/kehamilan_unverified_daftar/');?>' class='btn btn-small btn-info' >Kembali</a>
			<?php
				if (is_auth(2)){
					echo"<a href='".site_url('checkup/pemeriksaan_unverified_edit/')."/".simple_encrypt($h['id_pemeriksaan'])."' class='btn btn-small btn-success' >Ubah Data</a>";
				}else if (is_auth(3)){
						echo"<a href='".site_url('analysist/unverifikasi_pemeriksaan/')."/".simple_encrypt($get['nik'])."/".simple_encrypt($h['id_pemeriksaan'])."' class='btn btn-small btn-warning'>Periksa Kembali</a>";
						echo"<button type='submit' class='btn btn-success pull-right' onClick=\"return confirm('Anda yakin ingin memverifikasi data ini ?')\" >Verikasi</button>";
				}
			 ?>
			 </b>
        </div>
	</div>
	
	</form>
</section>
