<!-- Main content -->
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
			    <label for="inputEmail3" class="col-sm-2 control-label">Nama Ibu</label>
				<div class="col-sm-10">
					<select class="form-control select2" name="id_ibu" style="width:300px;">
					<?php	
						if(ISSET($get['id_kehamilan']) && $get['nik'] == $h['id_kehamilan']){
							echo"<option selected value='$get[nik]' disabled>$get[nama_ibu], ($get[nik])<option>";
						}else{
							echo"<option selected value='$get[nik]' disabled>$get[nama_ibu], ($get[nik])<option>";
						}
					?>
				    </select>
				</div>
			</div>
			<div class="row">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir Ibu</label>
                  <div class="col-sm-10" >
					<a>:</a><?php echo date_convert($ibu['tanggal_lahir']);?>
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
					<a>:</a><?php echo $ibu['alamat'];?>
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nomor Darurat</label>
                  <div class="col-sm-10">
					<a>:</a><?php echo $ibu['nomor_darurat'];?>
                  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Catatan Bidan Koordinator</label>
                  <div class="col-sm-10">
					<a>:</a><?php echo (ISSET($h['catatan']))? $h['catatan'] : '-'; ?>
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
		<input type="hidden" name="id_pemeriksaan" class="form-control" value="<?php echo (ISSET($h['id_pemeriksaan']))? $h['id_pemeriksaan'] : ''; ?> " style="max-width:150px;">
		<div class="box-body with-border">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tanggal Periksa</label>
				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="date" name="tanggal_periksa" class="form-control datemask" inputmask="'alias': 'dd/mm/yyyy'" value="<?php echo (ISSET($h['tanggal_periksa']))? $h['tanggal_periksa'] : ''; ?> " style="max-width:130px;">
					</div>
				</div>
            </div>
			<div class="bootstrap-timepicker">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Waktu Periksa</label>
				  <div class="col-sm-10">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
							<input type="time" name="waktu_periksa" class="form-control timepicker" value="<?php echo (ISSET($h['waktu_periksa']))? $h['waktu_periksa'] : ''; ?>" style="max-width:100px;">
							</div>
					</div>
                </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Status BPJS</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="status_bpjs" value ='0' class="flat-red"   <?php echo (ISSET($h['status_bpjs']) && $h['status_bpjs'] == '0' )? 'checked' : ''; ?>  >Ya
                        </label>
                  </div>
				  <div class="col-sm-5">
                        <input type="radio"  name="status_bpjs" value ='1' class="flat-red"   <?php echo (ISSET($h['status_bpjs']) && $h['status_bpjs'] == '1' )? 'checked' : ''; ?> >Tidak
                  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Waktu Konsepsi</label>
				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="date" name="waktu_konsepsi" class="form-control datemask datepicker" inputmask="'alias': 'dd/mm/yyyy'" style="max-width:130px;" value="<?php echo (ISSET($get['waktu_konsepsi']))? $get['waktu_konsepsi'] : ''; ?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="input-group" class="col-sm-2 control-label">Hari Perkiraan Lahir</label>
				<div class="col-sm-10">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<input type="date" name="HPL" class="form-control datemask" inputmask="'alias': 'dd/mm/yyyy'" style="max-width:130px;" value="<?php echo (isset($get['HPL']))?$get['HPL']:'';?>">
					</div>
				</div>
			</div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Trimester</label>
				<div class="col-sm-10">
					<select class="form-control" name="trimester" style="max-width:100px;">
						<?php			
							if(ISSET($h['trimester']) && $h['trimester'] == '1'){
								echo"<option selected value='1'>1</option>";
								echo"<option value='2'>2</option>";
								echo"<option value='3'>3</option>";
							}else if(ISSET($h['trimester']) && $h['trimester'] == '2'){
								echo"<option selected value='2'>2</option>";
								echo"<option value='1'>1</option>";
								echo"<option value='3'>3</option>";
							}else if(ISSET($h['trimester']) && $h['trimester'] == '3'){
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
					<textarea class="form-control" name='anamnesis'  rows="3" placeholder="Deskripsi Amnesis"><?php echo (isset($h['anamnesis']))?$h['anamnesis']:'';?></textarea>
																											  
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Berat Badan</label>
				<div class="col-sm-5">
					<input type="number" placeholder="Angka" onchange="setTwoNumberDecimal" name='berat_badan' min="1" max="300" step="0.1" class="form-control" style="width:100px;" value="<?php echo (ISSET($h['berat_badan']))? $h['berat_badan'] : '0.0'; ?>">
				</div>
				<div class="col-sm-2">
					Kilogram
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tinggi Badan</label>
				<div class="col-sm-10">
					<input type="number"placeholder="Cm" onchange="setTwoNumberDecimal" name='tinggi_badan' min="1" max="300" step="0.1" class="form-control" style="width:100px;" value="<?php echo (ISSET($h['tinggi_badan']))? $h['tinggi_badan'] : '0.0'; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tekanan Darah</label>
				<div class="col-sm-10">
					<input type="number"placeholder="mm" name='tekanan_a' min="1" max="300" class="form-control" style="width:100px;" value="<?php echo (ISSET($h['tekanan_a']))? $h['tekanan_a'] : ''; ?>">
					<input type="number"placeholder="Hg" name='tekanan_b' min="1" max="300" class="form-control" style="width:100px;" value="<?php echo (ISSET($h['tekanan_b']))? $h['tekanan_b'] : ''; ?>">
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tinggi Fundung Uterus</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="fundung_uterus" value ='0' class="flat-red"   <?php echo (ISSET($h['fundung_uterus']) && $h['fundung_uterus'] == '0' )? 'checked' : ''; ?>  >Simetri
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
                        <input type="radio"  name="fundung_uterus" value ='1' class="flat-red"   <?php echo (ISSET($h['fundung_uterus']) && $h['fundung_uterus'] == '1' )? 'checked' : ''; ?> >Tidak Simetri
				  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Lingkar Lengan Atas</label>
				<div class="col-sm-10">
					<input type="number" placeholder="Cm" onchange="setTwoNumberDecimal" name='lingkar_lengan' min="1" max="100" step="0.1" class="form-control" style="width:100px;" value="<?php echo (ISSET($h['lingkar_lengan']))? $h['lingkar_lengan'] : '0.0'; ?>">
				</div>
			</div>
			<div class="form-group">
					  <label for="inputEmail3" class="col-sm-2 control-label">Status Gizi</label>
					  <div class="col-sm-2">
						<label>
							<input type="radio"  name="status_gizi" value ='0' class="flat-red"   <?php echo (ISSET($lh['status_gizi']) && $h['status_gizi'] == '0' )? 'checked' : ''; ?>  >Cukup Gizi
							</label>
					  </div>
					  <div class="col-sm-2">
						<label>
							<input type="radio"  name="status_gizi" value ='1' class="flat-red"   <?php echo (ISSET($h['status_gizi']) && $h['status_gizi'] == '1' )? 'checked' : ''; ?> >Kurang Gizi
						</label>
					  </div>
				</div>
				<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Refleksi Patella</label>
					<div class="col-sm-1">
						<label>
							<input type="radio"  name="refleksi_patella" value ='0' class="flat-red"   <?php echo (ISSET($h['refleksi_patella']) && $h['refleksi_patella'] == '0' )? 'checked' : ''; ?>  >Positif
							</label>
					  </div>
					  <div class="col-sm-2">
						<label>
							<input type="radio"  name="refleksi_patella" value ='1' class="flat-red"   <?php echo (ISSET($h['refleksi_patella']) && $h['refleksi_patella'] == '1' )? 'checked' : ''; ?> >Negatif
						</label>
					  </div>
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
					<input type="number" placeholder="X/menit" name='djj' min="0" max="35" class="form-control" style="width:100px;" value="<?php echo (ISSET($h['djj']))? $h['djj'] : ''; ?>">
				</div>
			</div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Kepala Terhadap PAP</label>
				<div class="col-sm-10">
					<select class="form-control" name="kepala" style="max-width:150px;">
						<?php	
							if(ISSET($h['kepala']) && $h['kepala'] == '0'){
								echo"<option selected value='0'>Normal</<option>";
								echo"<option value='1'>Sungsang</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($h['kepala']) && $h['kepala'] == '1'){
								echo"<option selected value='1'>Sungsang </option>";
								echo"<option value='0'>Normal</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($h['kepala']) && $h['kepala'] == '2'){
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
					<input type="number" placeholder="gr" name='berat_janin' min="1" max="300" class="form-control" style="width:100px;" value="<?php echo (ISSET($h['berat_janin']))? $h['berat_janin'] : ''; ?>">
				</div>
			</div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Jumlah Janin</label>
				<div class="col-sm-10">
					<select class="form-control" name="jumlah_janin" style="max-width:150px;">
						<?php	
							if(ISSET($h['jumlah_janin']) && $h['jumlah_janin'] == '0'){
								echo"<option selected value='0'>Tunggal</<option>";
								echo"<option value='1'>Gameli</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($h['jumlah_janin']) && $h['jumlah_janin'] == '1'){
								echo"<option selected value='1'>Gameli </option>";
								echo"<option value='0'>Tunggal</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($h['jumlah_janin']) && $h['jumlah_janin'] == '2'){
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
							if(ISSET($h['presentasi']) && $h['presentasi'] == '0'){
								echo"<option selected value='0'>Normal</<option>";
								echo"<option value='1'>Suspect Tidak Normal</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($h['presentasi']) && $h['presentasi'] == '1'){
								echo"<option selected value='1'>Suspect Tidak Normal <option>";
								echo"<option value='0'>Normal</option>";
								echo"<option value='2'>Belum Terlihat</option>";
							}else if(ISSET($h['presentasi']) && $h['presentasi'] == '2'){
								echo"<option selected value='2'>Belum Terlihat<option>";
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
                        <input type="radio"  name="status_konseling" value ='0' class="flat-red"   <?php echo (ISSET($h['status_konseling']) && $h['status_konseling'] == '0' )? 'checked' : ''; ?>  >Ya
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
                        <input type="radio"  name="status_konseling" value ='1' class="flat-red"   <?php echo (ISSET($h['status_konseling']) && $h['status_konseling'] == '1' )? 'checked' : ''; ?> >Tidak
                  </label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Imunisasi</label>
                  <div class="col-sm-2">
                    <label>
                        <input type="radio"  name="status_imunisasi" value ='0' class="flat-red"   <?php echo (ISSET($h['status_imunisasi']) && $h['status_imunisasi'] == '0' )? 'checked' : ''; ?>  >Komplit
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					<input type="radio"  name="status_imunisasi" value ='1' class="flat-red"   <?php echo (ISSET($h['status_imunisasi']) && $h['status_imunisasi'] == '1' )? 'checked' : ''; ?> >Tidak Komplit
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Injeksi Tetanus</label>
                  <div class="col-sm-2">
                    <label>
                        <input type="radio"  name="status_injeksi" value ='0' class="flat-red"   <?php echo (ISSET($h['status_injeksi']) && $h['status_injeksi'] == '0' )? 'checked' : ''; ?>  >Komplit (TT5)
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="status_injeksi" value ='1' class="flat-red"   <?php echo (ISSET($h['status_injeksi']) && $h['status_injeksi'] == '1' )? 'checked' : ''; ?> >Tidak Komplit
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pencatatan Buku KIA</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="status_pencatatan" value ='0' class="flat-red"   <?php echo (ISSET($h['status_pencatatan']) && $h['status_pencatatan'] == '0' )? 'checked' : ''; ?>  >Ya
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="status_pencatatan" value ='1' class="flat-red"   <?php echo (ISSET($h['status_pencatatan']) && $h['status_pencatatan'] == '1' )? 'checked' : ''; ?> >Tidak
					</label>
				  </div>
            </div>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Fe</label>
			    <div class="col-sm-10">
					<input type="text" name='ps'  class="form-control" min="0" max="9999" placeholder="Gram" style="max-width:150px;" value="<?php echo (ISSET($h['ps']))? $h['ps'] : ''; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Hb</label>
				<div class="col-sm-10">
					<input type="number" onchange="setTwoNumberDecimal" placeholder="gr/DL" name='hb' min="1" max="99" step="0.1" class="form-control" style="width:100px;" value="<?php echo (ISSET($h['hb']))? $h['hb'] : '0.0'; ?>">
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Protein Urine</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="protein_urine" value ='0' class="flat-red"   <?php echo (ISSET($h['protein_urine']) && $h['protein_urine'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="protein_urine" value ='1' class="flat-red"   <?php echo (ISSET($h['protein_urine']) && $h['protein_urine'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Gula Darah</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="gula_darah" value ='0' class="flat-red"   <?php echo (ISSET($h['gula_darah']) && $h['gula_darah'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="gula_darah" value ='1' class="flat-red"   <?php echo (ISSET($h['gula_darah']) && $h['gula_darah'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Thalasemia</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="status_thalasemia" value ='0' class="flat-red"   <?php echo (ISSET($h['status_thalasemia']) && $h['status_thalasemia'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="status_thalasemia" value ='1' class="flat-red"   <?php echo (ISSET($h['status_thalasemia']) && $h['status_thalasemia'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Sifilis</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="status_sifilis" value ='0' class="flat-red"   <?php echo (ISSET($h['status_sifilis']) && $h['status_sifilis'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="status_sifilis" value ='1' class="flat-red"   <?php echo (ISSET($h['status_sifilis']) && $h['status_sifilis'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">HbsAg</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="hbsag" value ='0' class="flat-red"   <?php echo (ISSET($h['hbsag']) && $h['hbsag'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="hbsag" value ='1' class="flat-red"   <?php echo (ISSET($h['hbsag']) && $h['hbsag'] == '1' )? 'checked' : ''; ?> >Positif
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
                        <input type="radio"  name="vct" value ='0' class="flat-red"   <?php echo (ISSET($h['vct']) && $h['vct'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
                    <label>
						<input type="radio"  name="vct" value ='1' class="flat-red"   <?php echo (ISSET($h['vct']) && $h['vct'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Serologi</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="serologi" value ='0' class="flat-red"   <?php echo (ISSET($h['serologi']) && $h['serologi'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="serologi" value ='1' class="flat-red"   <?php echo (ISSET($h['serologi']) && $h['serologi'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">ARV Provilaksis</label>
				<div class="col-sm-5">
					<input type="text" name='arv' min="1" max="35" style="max-width:500px;" placeholder="sebutkan nama tindakan" class="form-control" style="width:10%;" value="<?php echo (ISSET($h['arv']))? $h['arv'] : ''; ?>">
				</div>
				<div class="col-sm-2">
					&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Isi Jika Positif
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Malaria</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="malaria" value ='0' class="flat-red"   <?php echo (ISSET($h['malaria']) && $h['malaria'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="malaria" value ='1' class="flat-red"   <?php echo (ISSET($h['malaria']) && $h['malaria'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Obat Malaria</label>
				<div class="col-sm-5">
					<input type="text" name='obat' min="1" max="35" style="max-width:500px;" placeholder="sebutkan nama obat" class="form-control" style="width:10%;" value="<?php echo (ISSET($h['obat']))? $h['obat'] : ''; ?>">
				</div>
				<div class="col-sm-2">
					&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Isi Jika Positif
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelambu Barinsektisida</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="kelambu" value ='0' class="flat-red"   <?php echo (ISSET($h['kelambu']) && $h['kelambu'] == '0' )? 'checked' : ''; ?>  >Dapat
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="kelambu" value ='1' class="flat-red"   <?php echo (ISSET($h['kelambu']) && $h['kelambu'] == '1' )? 'checked' : ''; ?> >Tidak Dapat
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">TB</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="tb" value ='0' class="flat-red"   <?php echo (ISSET($h['tb']) && $h['tb'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="tb" value ='1' class="flat-red"   <?php echo (ISSET($h['tb']) && $h['tb'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Obat TB</label>
				<div class="col-sm-5">
					<input type="text" name='obat2' min="1" max="35" placeholder="sebutkan nama obat" style="max-width:500px;" class="form-control" style="width:10%;" value="<?php echo (ISSET($h['obat2']))? $h['obat2'] : ''; ?>">
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
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">HDK</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="hdk" value ='0' class="flat-red"   <?php echo (ISSET($h['hdk']) && $h['hdk'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="hdk" value ='1' class="flat-red"   <?php echo (ISSET($h['hdk']) && $h['hdk'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Abortus</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="abortus" value ='0' class="flat-red"   <?php echo (ISSET($h['abortus']) && $h['abortus'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="abortus" value ='1' class="flat-red"   <?php echo (ISSET($h['abortus']) && $h['abortus'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pendarahan</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="pendarahan" value ='0' class="flat-red"   <?php echo (ISSET($h['pendarahan']) && $h['pendarahan'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="pendarahan" value ='1' class="flat-red"   <?php echo (ISSET($h['pendarahan']) && $h['pendarahan'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Infeksi</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="infeksi" value ='0' class="flat-red"   <?php echo (ISSET($h['infeksi']) && $h['infeksi'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="infeksi" value ='1' class="flat-red"   <?php echo (ISSET($h['infeksi']) && $h['infeksi'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">KPD</label>
                  <div class="col-sm-1">
                    <label>
                        <input type="radio"  name="kpd" value ='0' class="flat-red"   <?php echo (ISSET($h['kpd']) && $h['kpd'] == '0' )? 'checked' : ''; ?>  >Negatif
                        </label>
                  </div>
				  <div class="col-sm-2">
					<label>
					  <input type="radio"  name="kpd" value ='1' class="flat-red"   <?php echo (ISSET($h['kpd']) && $h['kpd'] == '1' )? 'checked' : ''; ?> >Positif
					</label>
				  </div>
            </div>
			<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Lain-Lain</label>
				<div class="col-sm-10">
					<textarea class="form-control" name='lain_lain'  rows="3" placeholder="Sebutkan jika ada"><?php echo (isset($h['lain_lain']))?$h['lain_lain']:'';?></textarea>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<b>
			<a href='<?php echo site_url('checkup/kehamilan_unverified_daftar/');?>' class='btn btn-small btn-danger' >Batalkan</a>
             <button type="submit" class="btn btn-success pull-right">Simpan</button>
			</b>
        </div>
	</div>
	<!-- ./ box Komplikasi-->		
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
	function setTwoNumberDecimal(event){
		this.value = parseFloat(this.value).toFixed(1);
	}
	</script>
</section>
<!-- ./ End Content-->