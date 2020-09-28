<form action="<?php echo site_url('review/source_laporan_daftar'); ?>" id='display-table'>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Filter</h3>
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
                          <label for="nama">Bulan</label>
                          <select class="form-control" id="month-choose" name='month' style="width:120px;">
							<option value=''>Pilih Bulan</option>
							<option value='01'>Januari</option>
							<option value='02'>Februari</option>
							<option value='03'>Maret</option>
							<option value='04'>April</option>
							<option value='05'>Mei</option>
							<option value='06'>Juni</option>
							<option value='07'>Juli</option>
							<option value='08'>Agustus</option>
							<option value='09'>September</option>
							<option value='10'>Oktober</option>
							<option value='11'>November</option>
							<option value='12'>Desember</option>
						  </select>
                        </div>
                    </div>
                    <div class='col-md-10'>
                        <div class="form-group">
                          <label for="nama">Tahun</label>
                          <select class="form-control" id="year-choose" name='year' style="width:120px;">
							<option value=''>Pilih Tahun</option>
							<?php
								for($i=0; $i<count($tahun); $i++){
									$h = $tahun[$i];
										echo"<option value='$h[year]'>$h[year]</option>";
								}
							?>
						  </select>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                    <button type="button" class="btn btn-primary ml-15" id='select-filter'>Proses</button>
                    <a href="<?php echo site_url('review/laporan_print/');?>" target="_blank" class="btn btn-default" id="laporan-print"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            Dinas Kesehatan Kabupaten Demak
            <small class="pull-right"><?php echo date_convert(date('Y-m-d')); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From ANC Terpadu Puskesmas Bonang I
          <address>
            <strong id="tanggal"></strong><br>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped" id="listed-table" border="3px">
            <thead>
				<tr align="center">
				  <th rowspan="4" align="center">No</th>
				  <th rowspan="4" align="center">Desa</th>
				  <th colspan="3" align="center">HB</th>
				  <th colspan="2" align="center">KEK</th>
				  <th colspan="2" align="center">Protein Urine</th>
				  <th colspan="2" align="center">Gula Darah</th>
				  <th colspan="13" align="center">Integrasi Program</th>
				</tr>
				<tr>
				  <th rowspan="3">Diperiksa HB</th>
				  <th rowspan="3">Anemia</th>
				  <th rowspan="3">kurang dari 8mg/dl </th>
				  <th rowspan="3">Diperiksa LILA</th>
				  <th rowspan="3">LILA kurang dari 23,5 cm</th>
				  <th rowspan="3">Diperiksa</th>
				  <th rowspan="3">Positif</th>
				  <th rowspan="3">Diperiksa</th>
				  <th rowspan="3">Gula Darah lebih dari 140 g/dl </th>
				</tr>
				<tr>
					<th colspan="2">Pencegahan Penularan HIV Ibu kepada Anak (PPIA)</th>
					<th colspan="4">Pencegahan Malaria dalam Kehamilan</th>
					<th colspan="3">TB dalam Kehamilan</th>
					<th colspan="2">Pencegahan IMS dalam Kehamilan</th>
					<th colspan="2">Pencegahan hepatitis dalam Kehamilan</th>
				</tr>
				<tr>
				  <th>Dites HIV </th>
				  <th>Positif HIV</th>
				  <th>Ibu mendapatkan kelambu</th>
				  <th>Diperiksa mikroskopis</th>
				  <th>Ibu hamil malaria +</th>
				  <th>Ibu hamil mendapatkan Kina/ACT </th>
				  <th>Ibu hamil diperiksa dahak </th>
				  <th>Ibu hamil hasil dahak TB +</th>
				  <th>Obat</th>
				  <th>Ibu hamil diperiksa IMS </th>
				  <th>Ibu hamil hasil tes IMS +</th>
				  <th>Ibu hamil diperiksa Hepatitis B </th>
				  <th>Ibu hamil hasil tes Hepatitis B +</th>
				</tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- info row -->
        <div class="col-sm-10 invoice-col">
          Mengetahui
          <address>
            Kepala Puskesmas Bonang I<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<strong style="align:center";>dr. Rudy</strong><br>
			<strong>NIP.197007032007011018</strong><br>
          </address>
        </div>
        <!-- /.col -->
		<div class="col-sm-2 invoice-col">
           Bonang, <?php echo date_convert(date('Y-m-d'));?>
          <address>
            Bidan Koordinator<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<strong style="align:center";><?php echo full_name();?></strong><br>
			<strong>NIP.196411161994032002</strong><br>
          </address>
        </div>
      </div>
      <!-- /.row -->
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          
        </div>
      </div>
    </section>
<!-- /.content -->
