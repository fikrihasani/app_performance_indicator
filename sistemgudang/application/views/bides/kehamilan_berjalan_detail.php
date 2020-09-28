
<!-- Main content -->
<section class="content">
    <form action="<?php echo site_url('checkup/source_kehamilan_berjalan_detail_list/'.simple_encrypt($get['nik'])); ?>" id='display-table'>
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
						echo $get['waktu_konsepsi']."  "."Minggu";
					?>
				</div>
			</div>
			<div class="row">
			    <label for="inputEmail3" class="col-sm-2 control-label">HPL</label>
				<div class="col-sm-10">
					<a>:</a>
					<?php
						echo $get['HPL'];
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Filter Pemeriksaan</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <div class='col-md-2'>
						<div class="form-group">
                          <label for="nama">Trimester</label>
                          <select class="form-control" id="nama" name='trimester' style="width:90px;">
							<option value=''>Semua</option>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
						  </select>
                        </div>
					</div>
					<div class='col-md-6'>
						<div class="form-group">
                          <label for="nama">Resiko</label>
                          <select class="form-control" id="nama" name='status_resiko' style="width:130px;">
							<option value=''>Semua Resiko</option>
							<option value='0'>Rendah</option>
							<option value='1'>Tinggi</option>
						  </select>
                        </div>
					</div>
                    <div class='clearfix'></div>
                    <button type="button" class="btn btn-primary ml-15" id='select-filter'>Filter</button>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box">
				<div class="box-header with-border">
                  <h3 class="box-title">Riwayat Pemeriksaan</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                    <table id="listed-table" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal Periksa</th>
                                <th class="text-center">Trimester</th>
                                <th class="text-center">Anamnesis</th>
                                <th class="text-center">Berat Badan (Kg)</th>
                                <th class="text-center">Tinggi Badan (Cm)</th>
                                <th class="text-center">Tekanan Darah (mm/Hg)</th>
                                <th class="text-center">TInggi Fundung Uterus</th>
                                <th class="text-center">Lingkar Lengan (Cm)</th>
                                <th class="text-center">Status Gizi</th>
                                <th class="text-center">Refleksi Pattela</th>
                                <th class="text-center">djj (X/menit)</th>
                                <th class="text-center">Letak Kepala </th>
                                <th class="text-center">Taksiran Berat Janin (gr)</th>
                                <th class="text-center">Jumlah Janin</th>
                                <th class="text-center">Presentasi</th>
                                <th class="text-center">Konseling</th>
                                <th class="text-center">Imunisasi</th>
                                <th class="text-center">Injeksi TT</th>
                                <th class="text-center">Pencatatan Buku KIA</th>
                                <th class="text-center">Fe (Tablet/Botol)</th>
                                <th class="text-center">Hb (gr/DL)</th>
                                <th class="text-center">Gula Darah</th>
                                <th class="text-center">Thalasemia</th>
                                <th class="text-center">Sifilis</th>
                                <th class="text-center">Hbsag</th>
                                <th class="text-center">CVT</th>
                                <th class="text-center">Serologi</th>
                                <th class="text-center">ARV</th>
                                <th class="text-center">Riwayat Malaria</th>
                                <th class="text-center">Obat Malaria</th>
                                <th class="text-center">Kelambu Berinsektisida</th>
                                <th class="text-center">TB</th>
                                <th class="text-center">Obat TB</th>
                                <th class="text-center">HDK</th>
                                <th class="text-center">Riwayat Abortus</th>
								<th class="text-center">Pendarahan</th>
                                <th class="text-center">Infeksi</th>
                                <th class="text-center">KPD</th>
                                <th class="text-center">Lain-lain</th>
                                <th class="text-center">BPJS</th>
                                <th class="text-center">Status Resiko</th>
                            </tr>
                        </thead>
                        <tbody align="center"></tbody>
                    </table>
                    </div>
                    <br class='clearfix'/>
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary active btn-sm prev-page" type="button"><i class="fa fa-angle-double-left "></i></button>
                        <button class="btn btn-primary btn-sm next-page" type="button"><i class="fa fa-angle-double-right"></i></button>
                    </div>
					<input type='hidden' name='current_page' class='current-page' value='<?php echo (ISSET($page))? $page : '1'; ?>' />
                    <br class='clearfix'/>
                </div>
            <!-- /.box-body -->
            </div>
        </div>
    </div>
</form>
<form action="<?php echo site_url('checkup/source_riwayat_rujukan_list/'.simple_encrypt($get['nik'])); ?>" id='display-table2'>
    <!-- /.box -->
	<div class="box">
		<div class="box-header with-border">
          <h3 class="box-title">Riwayat Rujukan</h3>
        </div>
        <div class="box-body">
            <table id="listed-table2" class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal Rujukan</th>
                        <th class="text-center">Tempat Rujukan</th>
                        <th class="text-center">Pendeteksi Resiko</th>
                        <th class="text-center">Keadaan TIba</th>
                        <th class="text-center">Keadaan Pulang</th>
                    </tr>
                </thead>
                <tbody align="center"></tbody>
            </table>

            <br class='clearfix'/>
            <div class="btn-group pull-right">
                <button class="btn btn-primary active btn-sm prev-page" type="button"><i class="fa fa-angle-double-left "></i></button>
                <button class="btn btn-primary btn-sm next-page" type="button"><i class="fa fa-angle-double-right"></i></button>
            </div>
			<input type='hidden' name='current_page2' class='current-page2' value='<?php echo (ISSET($page))? $page : '1'; ?>' />
            <br class='clearfix'/>
        </div>
    <!-- /.box-body -->
    </div>
</form>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
