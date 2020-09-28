<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absensi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .line-title{
            border: 0 ;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
</head>
<body>
    <img src="assets/img/img1.png" style="position: absolute; width: 170px; height:auto;">
    <table style= "width: 100%;">
        <tr>
            <td align ="center">
                <span style="line-height: 1.6; font-weight: bold;">
                    PT. ANGKASA PURA SUPPORTS
                    <br>SEMARANG INDONESIA
                </span>
            </td>
        </tr>
    </table>
    <p style="float:right;"><?php $tgl=time();  date_default_timezone_set('Asia/Jakarta');  echo date('Y-m-d H:i:s' , $tgl); ?></p>
    <br><hr class="line-title">
    <p align ="center">
        LAPORAN DATA ABSENSI <br>
        Tanggal : <?= $tgl1; ?> sampai <?= $tgl2; ?>
    </p>

    <p style="font-size:12px;">
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
        </tr>
        <?php $no=1; foreach($absensi as $row){ ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['pegawai']; ?></td>
            <td><?= $row['jenis']; ?></td>
            <td><?= $row['keterangan']; ?></td>
            <td><?= $row['tanggal']; ?></td>
        </tr>
        <?php } ?>
    </table>
    </p>

</body>
</html>