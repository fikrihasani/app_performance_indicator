<!-- Main content -->
<?php 
    $last = show_alert('last_posting');
?>


<section class="content">
	<?php echo show_alert('message'); ?>
	<form action="<?php echo $action;?>" method="post" class='form-horizontal'>
	<!-- / box ibu -->	
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Data Ibu</h3>
		</div>
		<div class="box-body with-border">
			<!-- text input -->
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label pt-0i">Nama Ibu</label>
				<div class="col-sm-10">
					<select class="form-control select2" id="id_ibu" name="id_ibu" style="width:300px;">
					<?php	
						for($i=0; $i<count($hasil); $i++){
							$h = $hasil[$i];
                            if(ISSET($h['id_ibu']) && $h['id_ibu'] == $last['id_ibu']){
                                echo"<option selected value='$h[nik]'>$h[nama_ibu], ($h[nik])</option>";
                            }else{
                                echo"<option value='$h[nik]'>$h[nama_ibu], ($h[nik])</option>";
                            }
						}
					?>   
				    </select>
				</div>
			</div>
			<div class="row">
                  <label for="inputEmail3" class="col-sm-2 control-label pt-0i">Tanggal Lahir Ibu :</label>
                  <div class="col-sm-10" id="tanggal-lahir-ibu">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label pt-0i">Alamat :</label>
                  <div class="col-sm-10" id="alamat-ibu">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label pt-0i">Nomor Darurat :</label>
                  <div class="col-sm-10" id="nomor-darurat-ibu">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label pt-0i">Usia Kandungan :</label>
                  <div class="col-sm-10" id="usia-kandungan">
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label pt-0i">HPL :</label>
                  <div class="col-sm-10" id="HPL">
                  </div>
            </div>
		</div>
	</div>
	<!-- ./ box ibu -->
	<!-- / box pemeriksaan ibu-->
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Pemeriksaan Ibu</h3>
		</div>
		<div class="box-body with-border">				
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tanggal Periksa</label>
				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="date" name="tanggal_periksa" class="form-control datemask" inputmask="'alias': 'dd/mm/yyyy'" value="<?php echo (ISSET($last['tanggal_periksa']))? $last['tanggal_periksa'] : ''; ?> " style="max-width:130px;">
					</div>
				</div>
            </div>
			<div class="bootstrap-timepicker">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Waktu Periksa</label>
				  <div class="col-sm-10">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
							<input type="time" name="waktu_periksa" class="form-control timepicker" value="<?php echo (ISSET($last['waktu_periksa']))? $last['waktu_periksa'] : ''; ?>" style="max-width:100px;">
							</div>
					</div>
                </div>
            </div>
			<div class="form-group">

                  <label for="inputEmail3" class="col-sm-2 control-label">Status BPJS</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="status_bpjs" value ='0' class="flat-red"   <?php echo (ISSET($last['status_bpjs']) && $last['status_bpjs'] == '0' )? 'checked' : ''; ?>  >Ya
                        </label>
                  </div>
				  <div class="col-sm-5">
                        <input type="radio"  name="status_bpjs" value ='1' class="flat-red"   <?php echo (ISSET($last['status_bpjs']) && $last['status_bpjs'] == '1' )? 'checked' : ''; ?> >Tidak
                  </div>
            </div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Trimester</label>
				<div class="col-sm-10">
					<select class="form-control" name="trimester" style="max-width:150px;">
						<?php	
							if(ISSET($last['trimester']) && $last['trimester'] == '1'){
								echo"<option selected value='1'>1</option>";
								echo"<option value='2'>2</option>";
								echo"<option value='3'>3</option>";
							}else if(ISSET($last['trimester']) && $last['trimester'] == '2'){
								echo"<option selected value='2'>2</option>";
								echo"<option value='1'>1</option>";
								echo"<option value='3'>3</option>";
							}else if(ISSET($last['trimester']) && $last['trimester'] == '3'){
								echo"<option selected value='3'>3</option>";
								echo"<option value='1'>1</option>";
								echo"<option value='2'>2</option>";
							}else{
								echo"<option value=''>Pilih Salah Satu</option>";
								echo"<option value='1'>1</option>";
								echo"<option value='2'>2</option>";
								echo"<option value='3'>3</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Anamnesis</label>
				<div class="col-sm-10">
					<textarea class="form-control" name='anamnesis'  rows="3" placeholder="Deskripsi Amnesis"><?php echo (isset($last['anamnesis']))?$last['anamnesis']:'';?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Berat Badan(Kg)</label>
				<div class="col-sm-5">
					<input type="number" placeholder="Angka" name='berat_badan' onchange="setTwoNumberDecimal" step="0.1" min="1" max="300" class="form-control" style="width:100px;" value="<?php echo (ISSET($last['berat_badan']))? $last['berat_badan'] : '0.0'; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tinggi Badan(Cm)</label>
				<div class="col-sm-10">
					<input type="number"placeholder="Cm" name='tinggi_badan' onchange="setTwoNumberDecimal" step="0.1" min="1" max="300" class="form-control" style="width:100px;" value="<?php echo (ISSET($last['tinggi_badan']))? $last['tinggi_badan'] : '0.0'; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tekanan Darah</label>
				<div class="col-sm-10">
					<input type="number"placeholder="mm" name='tekanan_a' min="1" max="300" class="form-control" style="width:100px;" value="<?php echo (ISSET($last['tekanan_a']))? $last['tekanan_a'] : ''; ?>">
					<input type="number"placeholder="Hg" name='tekanan_b' min="1" max="300" class="form-control" style="width:100px;" value="<?php echo (ISSET($last['tekanan_b']))? $last['tekanan_b'] : ''; ?>">
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tinggi Fundung Uterus</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="fundung_uterus" value ='0' class="flat-red"   <?php echo (ISSET($last['fundung_uterus']) && $last['fundung_uterus'] == '0' )? 'checked' : ''; ?>  >Simetri
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
                        <input type="radio"  name="fundung_uterus" value ='1' class="flat-red"   <?php echo (ISSET($last['fundung_uterus']) && $last['fundung_uterus'] == '1' )? 'checked' : ''; ?> >Tidak Simetri
				  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Lingkar Lengan Atas(Cm)</label>
				<div class="col-sm-10">
					<input type="number" onchange="setTwoNumberDecimal" placeholder="Cm" name='lingkar_lengan' min="0" max="100" step="0.1" class="form-control" style="width:100px;" value="<?php echo (ISSET($last['lingkar_lengan']))? $last['lingkar_lengan'] : '0.0'; ?>">
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Status Gizi</label>
                  <div class="col-sm-2">
                    <label>
                        <input type="radio"  name="status_gizi" value ='0' class="flat-red"   <?php echo (ISSET($last['status_gizi']) && $last['status_gizi'] == '0' )? 'checked' : ''; ?>  >Cukup Gizi
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
                        <input type="radio"  name="status_gizi" value ='1' class="flat-red"   <?php echo (ISSET($last['status_gizi']) && $last['status_gizi'] == '1' )? 'checked' : ''; ?> >Kurang Gizi
					</label>
				  </div>
            </div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Refleksi Patella</label>
				<div class="col-sm-1">
                    <label>
                        <input type="radio"  name="refleksi_patella" value ='0' class="flat-red"   <?php echo (ISSET($last['refleksi_patella']) && $last['refleksi_patella'] == '0' )? 'checked' : ''; ?>  >Positif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
                        <input type="radio"  name="refleksi_patella" value ='1' class="flat-red"   <?php echo (ISSET($last['refleksi_patella']) && $last['refleksi_patella'] == '1' )? 'checked' : ''; ?> >Negatif
					</label>
				  </div>
			</div>
		</div>
	</div>
	<!-- ./ box pemeriksaan ibu-->	
	<!-- / box pemeriksaan janin-->
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Pemeriksaan Janin</h3>
		</div>
		<div class="box-body with-border">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Denyut Jantung Janin</label>
				<div class="col-sm-10">
					<input type="number" placeholder="X/menit" name='djj' min="0" max="999" class="form-control" style="width:100px;" value="<?php echo (ISSET($last['djj']))? $last['djj'] : ''; ?>">
				</div>
			</div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Kepala Terhadap PAP</label>
				<div class="col-sm-10">
					<select class="form-control" name="kepala" style="max-width:150px;">
						<?php
							if(ISSET($last['kepala']) && $last['kepala'] == '0'){
								echo"<option selected value='0'>Normal</<option>";
								echo"<option value='1'>Sungsang</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($last['kepala']) && $last['kepala'] == '1'){
								echo"<option selected value='1'>Sungsang </option>";
								echo"<option value='0'>Normal</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($last['kepala']) && $last['kepala'] == '2'){
								echo"<option selected value='2'>Belum Terlihat</option>";
								echo"<option value='0'>Normal</option>";
								echo"<option value='1'>Sungsang</option>";
							}else{
								echo"<option value=''>Pilih Salah Satu</option>";
								echo"<option value='0'>Normal</option>";
								echo"<option value='1'>Sungsang</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Taksiran Berat Janin</label>
				<div class="col-sm-10">
					<input type="number" placeholder="gr" name='berat_janin' min="0" max="9999" class="form-control" style="width:100px;" value="<?php echo (ISSET($last['berat_janin']))? $last['berat_janin'] : ''; ?>">
				</div>
			</div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Jumlah Janin</label>
				<div class="col-sm-10">
					<select class="form-control" name="jumlah_janin" style="max-width:150px;">
						<?php
							if(ISSET($last['jumlah_janin']) && $last['jumlah_janin'] == '0'){
								echo"<option selected value='0'>Tunggal</<option>";
								echo"<option value='1'>Gameli</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($last['jumlah_janin']) && $last['jumlah_janin'] == '1'){
								echo"<option selected value='1'>Gameli </option>";
								echo"<option value='0'>Tunggal</</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($last['jumlah_janin']) && $last['jumlah_janin'] == '2'){
								echo"<option selected value='2'>Belum Terlihat</option>";
								echo"<option value='0'>Tunggal</option>";
								echo"<option value='1'>Gameli</option>";
							}else{
								echo"<option value=''>Pilih Salah Satu</option>";
								echo"<option value='0'>Tunggal</option>";
								echo"<option value='1'>Gameli</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Presentasi</label>
				<div class="col-sm-10">
					<select class="form-control" name="presentasi" style="max-width:150px;">
						<?php
							if(ISSET($last['presentasi']) && $last['presentasi'] == '0'){
								echo"<option selected value='0'>Normal</option>";
								echo"<option value='1'>Suspect Tidak Normal</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($last['presentasi']) && $last['presentasi'] == '1'){
								echo"<option selected value='1'>Suspect Tidak Normal </option>";
								echo"<option value='0'>Normal</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($last['presentasi']) && $last['presentasi'] == '2'){
								echo"<option selected value='2'>Belum Terlihat</option>";
								echo"<option value='0'>Normal</option>";
								echo"<option value='1'>Suspect Tidak Normal</option>";
							}else{
								echo"<option value=''>Pilih Salah Satu</option>";
								echo"<option value='0'>Normal</option>";
								echo"<option value='1'>Suspect Tidak Normal</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<!-- ./ box pemeriksaan janin-->	
	<!-- / box Pelayanan-->
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Pelayanan Laboratorium</h3>
		</div>
		<div class="box-body with-border">
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Konseling</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="status_konseling" value ='0' class="flat-red"   <?php echo (ISSET($last['status_konseling']) && $last['status_konseling'] == '0' )? 'checked' : ''; ?>  >Ya
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
                        <input type="radio"  name="status_konseling" value ='1' class="flat-red"   <?php echo (ISSET($last['status_konseling']) && $last['status_konseling'] == '1' )? 'checked' : ''; ?> >Tidak
                  </label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Imunisasi</label>
                  <div class="col-sm-2">
                    <label>
                        <input type="radio"  name="status_imunisasi" value ='0' class="flat-red"   <?php echo (ISSET($last['status_imunisasi']) && $last['status_imunisasi'] == '0' )? 'checked' : ''; ?>  >Komplit
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					<input type="radio"  name="status_imunisasi" value ='1' class="flat-red"   <?php echo (ISSET($last['status_imunisasi']) && $last['status_imunisasi'] == '1' )? 'checked' : ''; ?> >Tidak Komplit
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Injeksi Tetanus</label>
                  <div class="col-sm-2">
                    <label>
                        <input type="radio"  name="status_injeksi" value ='0' class="flat-red"   <?php echo (ISSET($last['status_injeksi']) && $last['status_injeksi'] == '0' )? 'checked' : ''; ?>  >Komplit (TT5)
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="status_injeksi" value ='1' class="flat-red"   <?php echo (ISSET($last['status_injeksi']) && $last['status_injeksi'] == '1' )? 'checked' : ''; ?> >Tidak Komplit
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pencatatan Buku KIA</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="status_pencatatan" value ='0' class="flat-red"   <?php echo (ISSET($last['status_pencatatan']) && $last['status_pencatatan'] == '0' )? 'checked' : ''; ?>  >Ya
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="status_pencatatan" value ='1' class="flat-red"   <?php echo (ISSET($last['status_pencatatan']) && $last['status_pencatatan'] == '1' )? 'checked' : ''; ?> >Tidak
					</label>
				  </div>
            </div>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Fe</label>
			    <div class="col-sm-10">
					<input type="text" name='ps'  class="form-control" min="0" max="9999" placeholder="Gram" style="max-width:150px;" value="<?php echo (ISSET($last['ps']))? $last['ps'] : ''; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Hb</label>
				<div class="col-sm-10">
					<input type="number" onchange="setTwoNumberDecimal" placeholder="gr/DL" name='hb' min="1" max="99" step="0.1" class="form-control" style="width:100px;" value="<?php echo (ISSET($last['hb']))? $last['hb'] : '0.0'; ?>">
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Protein Urine</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="protein_urine" value ='0' class="flat-red"   <?php echo (ISSET($last['protein_urine']) && $last['protein_urine'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="protein_urine" value ='1' class="flat-red"   <?php echo (ISSET($last['protein_urine']) && $last['protein_urine'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Gula Darah</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="gula_darah" value ='0' class="flat-red"   <?php echo (ISSET($last['gula_darah']) && $last['gula_darah'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="gula_darah" value ='1' class="flat-red"   <?php echo (ISSET($last['gula_darah']) && $last['gula_darah'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Thalasemia</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="status_thalasemia" value ='0' class="flat-red"   <?php echo (ISSET($last['status_thalasemia']) && $last['status_thalasemia'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="status_thalasemia" value ='1' class="flat-red"   <?php echo (ISSET($last['status_thalasemia']) && $last['status_thalasemia'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Sifilis</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="status_sifilis" value ='0' class="flat-red"   <?php echo (ISSET($last['status_sifilis']) && $last['status_sifilis'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="status_sifilis" value ='1' class="flat-red"   <?php echo (ISSET($last['status_sifilis']) && $last['status_sifilis'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">HbsAg</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="hbsag" value ='0' class="flat-red"   <?php echo (ISSET($last['hbsag']) && $last['hbsag'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="hbsag" value ='1' class="flat-red"   <?php echo (ISSET($last['hbsag']) && $last['hbsag'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
		</div>
	</div>
	<!-- ./ box Pelayanan-->
	<!-- / box Integrasi-->
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Integrasi Layanan</h3>
		</div>
		<div class="box-body with-border">
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">VCT</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="vct" value ='0' class="flat-red"   <?php echo (ISSET($last['vct']) && $last['vct'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
                    <label>
						<input type="radio"  name="vct" value ='1' class="flat-red"   <?php echo (ISSET($last['vct']) && $last['vct'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Serologi</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="serologi" value ='0' class="flat-red"   <?php echo (ISSET($last['serologi']) && $last['serologi'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="serologi" value ='1' class="flat-red"   <?php echo (ISSET($last['serologi']) && $last['serologi'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">ARV Provilaksis</label>
				<div class="col-sm-5">
					<input type="text" name='arv' min="1" max="35" style="max-width:500px;" placeholder="sebutkan nama tindakan" class="form-control" style="width:10%;" value="<?php echo (ISSET($last['arv']))? $last['arv'] : ''; ?>">
				</div>
				<div class="col-sm-2">
					&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Isi Jika Positif
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Malaria</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="malaria" value ='0' class="flat-red"   <?php echo (ISSET($last['malaria']) && $last['malaria'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="malaria" value ='1' class="flat-red"   <?php echo (ISSET($last['malaria']) && $last['malaria'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Obat Malaria</label>
				<div class="col-sm-5">
					<input type="text" name='obat' min="1" max="35" style="max-width:500px;" placeholder="sebutkan nama obat" class="form-control" style="width:10%;" value="<?php echo (ISSET($last['obat']))? $last['obat'] : ''; ?>">
				</div>
				<div class="col-sm-2">
					&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Isi Jika Positif
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelambu Barinsektisida</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="kelambu" value ='0' class="flat-red"   <?php echo (ISSET($last['kelambu']) && $last['kelambu'] == '0' )? 'checked' : ''; ?>  >Dapat
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="kelambu" value ='1' class="flat-red"   <?php echo (ISSET($last['kelambu']) && $last['kelambu'] == '1' )? 'checked' : ''; ?> >Tidak Dapat
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">TB</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="tb" value ='0' class="flat-red"   <?php echo (ISSET($last['tb']) && $last['tb'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="tb" value ='1' class="flat-red"   <?php echo (ISSET($last['tb']) && $last['tb'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Obat TB</label>
				<div class="col-sm-5">
					<input type="text" name='obat2' min="1" max="35" placeholder="sebutkan nama obat" style="max-width:500px;" class="form-control" style="width:10%;" value="<?php echo (ISSET($last['obat2']))? $last['obat2'] : ''; ?>">
				</div>
				<div class="col-sm-2">
					&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Isi Jika Positif
				</div>
			</div>
		</div>
	</div>	
	<!-- ./ box Integrasi-->
	<!-- / box Komplikasi-->
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Komplikasi</h3>
		</div>
		<div class="box-body with-border">
			<div class="box-body with-border">
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">HDK</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="hdk" value ='0' class="flat-red"   <?php echo (ISSET($last['hdk']) && $last['hdk'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="hdk" value ='1' class="flat-red"   <?php echo (ISSET($last['hdk']) && $last['hdk'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Abortus</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="abortus" value ='0' class="flat-red"   <?php echo (ISSET($last['abortus']) && $last['abortus'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="abortus" value ='1' class="flat-red"   <?php echo (ISSET($last['abortus']) && $last['abortus'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pendarahan</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="pendarahan" value ='0' class="flat-red"   <?php echo (ISSET($last['pendarahan']) && $last['pendarahan'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="pendarahan" value ='1' class="flat-red"   <?php echo (ISSET($last['pendarahan']) && $last['pendarahan'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Infeksi</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="infeksi" value ='0' class="flat-red"   <?php echo (ISSET($last['infeksi']) && $last['infeksi'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="infeksi" value ='1' class="flat-red"   <?php echo (ISSET($last['infeksi']) && $last['infeksi'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">KPD</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="kpd" value ='0' class="flat-red"   <?php echo (ISSET($last['kpd']) && $last['kpd'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="kpd" value ='1' class="flat-red"   <?php echo (ISSET($last['kpd']) && $last['kpd'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Lain-Lain</label>
				<div class="col-sm-10">
					<textarea class="form-control" name='lain_lain'  rows="3" placeholder="Sebutkan jika ada"><?php echo (isset($last['lain_lain']))?$last['lain_lain']:'';?></textarea>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<a href="<?php echo site_url('checkup/pemeriksaan_unverified_daftar');?>" class="btn btn-small btn-danger">Batalkan</a>
             <button type="submit" class="btn btn-success pull-right">Tambah</button>
        </div>
	</div>
	<!-- ./ box Komplikasi-->		
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#id_ibu").change(function(){
				var id_ibu = $('#id_ibu').val();

				$.ajax({
					method      : 'GET',
                    dataType    : 'json',
					url         : '<?php echo site_url('checkup/ajax_pemeriksaan/');?>/' + id_ibu,
					data        : "",
                    success     : function(result){
                       $('#tanggal-lahir-ibu').html(result.tanggal_lahir);
                       $('#nomor-darurat-ibu').html(result.nomor_darurat);
                       $('#alamat-ibu').html(result.alamat);
                       $('#usia-kandungan').html(result.usia_kandungan);
                       $('#HPL').html(result.HPL);
                    }
				});
			});
		});
	</script>
	<script>
	function setTwoNumberDecimal(event){
		this.value = parseFloat(this.value).toFixed(1);
	}
	</script>
</section>
<!-- ./ End Content-->