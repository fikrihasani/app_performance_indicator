<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Sca & Dokumentasi</title>
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
    <p align ="center" style="line-height: 1.6; font-weight: bold;">
    STANDARD  CLEANLINESS AREA BANDARA <br>
    </p>
    <p style="float:left;">Tanggal : <?= $sca_dokumentasi['time']; ?> </p> <p style="float:right;">Checker : Fadhil </p><br><br>
    <p style="float:left; margin-top:-15px;">Subarea : <?= $sca_dokumentasi['nama_subarea']; ?> </p> <p style="float:right; margin-top:-15px;">Shift : <?= $sca_dokumentasi['shift']; ?> </p>     
        <br><br>

        <?php
        $jml=0;
        foreach($query2->result_array() as $rownyalagi) {
            foreach(json_decode($rownyalagi['result']) as $rownyasekalilagi) {
                $jml++;
             }
        }

         ?>

    <p style="font-size:12px;">
    <table class="table table-bordered">
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Area</th>
            <th rowspan="2">Subarea</th>
            <th rowspan="2">Material</th>
            <th rowspan="2">Standart Area</th>
            <th colspan="2">Tinjauan</th>to
            <th rowspan="2">Tindak Lanjut Kasus</th>
            <th rowspan="2">Oleh</th>
            <th rowspan="2">Waktu</th>
            <th rowspan="2">Hasil</th>
        </tr>
        <tr>
            <th>Kode</th>
            <th>Penjelasan</th>
        </tr>
        <?php $jml; ?>
        <tr>
            <td>1.</td>
            <td><?= $sca_dokumentasi['nama_area']; ?></td>
            <td><?= $sca_dokumentasi['nama_subarea']; ?></td>
            <?php 
            foreach($query2->result_array() as $rownyalagi) {
                foreach(json_decode($rownyalagi['result']) as $rownyasekalilagi) { 

                    $materials = $this->db->query("select a.id, a.id_material, b.standart, b.standart_pertanyaan from pertanyaan a
                                                    left join materials b on a.id_material=b.id where a.id='$rownyasekalilagi->id'")->row_array(); 

                ?>
            <td><?= $materials['standart'];  ?></td>
            <td><?= $materials['standart_pertanyaan'];  ?></td>
            <td><?= $rownyasekalilagi->jawaban; break; ?></td>
            <?php } } ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php 
            $p = 0;

            foreach($query2->result_array() as $rownyalagi) {
                foreach(json_decode($rownyalagi['result']) as $rownyasekalilagi) { 
                
                $materials = $this->db->query("select a.id, a.id_material, b.standart, b.standart_pertanyaan from pertanyaan a
                                                    left join materials b on a.id_material=b.id where a.id='$rownyasekalilagi->id'")->row_array(); 

                ?>
                <?php if($p != 0 ){ ?>
        <tr>
        <td></td>
        <td></td>
        <td></td>
            <td><?= $materials['standart'];  ?></td>
            <td><?= $materials['standart_pertanyaan'];  ?></td>
            <td><?= $rownyasekalilagi->jawaban; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
                <?php } ?>
         <?php $p++; } } ?>     
    </table>
    </p>

    <br><br>
    <table class="table table-bordered">
        <tr>
            <td width="110">Tanggal</td>
            <td width="2">:</td>
            <td><?= $sca_dokumentasi['time']; ?></td>
            <td rowspan="5" class="text-center" width="180"><img src="assets/upload/sca/<?= $sca_dokumentasi['image']; ?>" width="200" height="210"></td>
            <td rowspan="5" class="text-center">Di Check Oleh <br> Checker<br><br><br><br><br><br>(<?= $sca_dokumentasi['user']; ?>)</td>
            <td rowspan="5" class="text-center">Supervisor<br><br><br><br><br><br><br>(______________)</td>
        </tr>
        <tr>
            <td>Sub Area</td>
            <td>:</td>
            <td><?= $sca_dokumentasi['nama_subarea']; ?></td>
        </tr>
        <tr>
            <td>Nilai Kebersihan %</td>
            <td>:</td>
            <td><?= $sca_dokumentasi['nilai']; ?></td>
        </tr>
        <tr>
            <td>Terpenuhi</td>
            <td>:</td>
            <td><?= $terpenuhi; ?></td>
        </tr>
        <tr>
            <td>Tidak Terpenuhi</td>
            <td>:</td>
            <td><?= $tdk_terpenuhi; ?></td>
        </tr>
    </table>
    

</body>
</html>