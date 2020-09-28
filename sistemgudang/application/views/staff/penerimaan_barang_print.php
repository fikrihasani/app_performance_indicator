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
            PT. Angkasa Pura Suport Cabang Semarang
            <small class="pull-right"><?php echo date_convert(date('Y-m-d')); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Form Penerimaan Barang
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
				  <th rowspan="4" align="center">Nama Barang</th>
				  <th colspan="3" align="center">Jumlah</th>
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
                    Petugas Forwarder<br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <strong style="align:center";>Ap Logistik</strong><br>
                    <strong>NIP</strong><br>
                </td>
                <td style='text-align:right; position:relative;'>
                        <table style='position:absolute;right:0;top:0;border:0px solid #000;width:200px;'>
                                        <tr>
                                            <td style='border:0px solid #000;'>
                                        Semarang, <?php echo date_convert(date('Y-m-d'));?><br />
                                  
                                    Penerima<br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <strong style="align:center";><?php echo full_name();?></strong><br>
                                    <strong>NIP</strong><br>
                                  
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