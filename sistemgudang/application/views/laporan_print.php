<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Laporan</title>
  <style>
    body, table, tr, td, th {
        font-size : 12px;
        font-family: arial;
    }

    h2 {
        display: block;
        font-family: arial;
        text-align: center;
    }


    table, tr, td, th {
        border :1px solid #000;
        border-collapse: collapse;
    }

    th, td {
        padding:3px;
    }


    .footers, .footers td, .footers tr {
        border:0px solid #FFF;
    }

    .footers {
        width : 100%;
        margin-top:20px;
    }

  </style>


</head>
<body onload="window.print();">


<section class="">
      <!-- title row -->
      <div class="">
        <div class="">
          <h2 class="">
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
            <strong>Bulan <?php echo $tanggal; ?></strong><br>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12">
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
                <?php 
                   echo $data['content'];
                    //echo $this->load->view('ajax_laporan', ['data' => $data['content']] ,true);
                ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

        <table class='footers'>
            <tr>
                <td>
                    Mengetahui<br />
                    Kepala Puskesmas Bonang I<br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <strong style="align:center";>dr. Rudy</strong><br>
                    <strong>NIP.197007032007011018</strong><br>
                </td>
                <td style='text-align:right; position:relative;'>
                        <table style='position:absolute;right:0;top:0;border:0px solid #000;width:200px;'>
                                        <tr>
                                            <td style='border:0px solid #000;'>
                                        Bonang, <?php echo date_convert(date('Y-m-d'));?><br />
                                  
                                    Bidan Koordinator<br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <strong style="align:center";><?php echo full_name();?></strong><br>
                                    <strong>NIP.196411161994032002</strong><br>
                                  
                                </td>
                            </tr>
                        </table>
                </td>
            </tr>
        </table>

      <div class="row">
        <!-- info row -->
        <div class="col-sm-6 invoice-col">
          
        </div>
        <!-- /.col -->
		<div class="col-sm-6 invoice-col">
           
        </div>
      </div>
      <!-- /.row -->
    </section>
</body>
</html>