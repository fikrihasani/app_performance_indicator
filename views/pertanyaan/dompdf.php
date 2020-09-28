<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan SCA & Dokumentasi</title>
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
                STANDART AREA CLEANLINESS AREA (SCA) <br>
                AREA BANDARA
                </span>
            </td>
        </tr>
    </table>
    <br><hr class="line-title">
    Tanggal : <br>
    Area : <?php
                        $no = 1;
                        foreach ($area as $p) {
                    ?>
                      <?php if($no==1): ?>
                          <?= $p['nama']; break; ?>
                      <?php endif; ?>
                  <?php } ?>
    <br>Petugas : <br><br>
    <p style="font-size:12px;">
    <table class="table table-bordered">
        <tr style="background-color:#F5F5DC;">
            <th rowspan="2" class="text-center">AREA</th>
            <th rowspan="2" class="text-center">MATERIAL</th>
            <th rowspan="2" class="text-center">STANDART AREA</th>
            <th colspan="2" class="text-center">TINJAUAN</th>
            <th colspan="3" class="text-center">PERBAIKAN</th>
            <th rowspan="2" class="text-center">HASIL</th>
        </tr>
        <tr style="background-color:#F5F5DC;">
            <th class="text-center">KODE</th>
            <th class="text-center">PENJELASAN</th>
            <th class="text-center">TINDAK LANJUT</th>
            <th class="text-center">OLEH</th>
            <th class="text-center">WAKTU</th>
        </tr>
        <?php  foreach($pertanyaan as $row){ ?>
        <?php
            $rowmaterial = $this->db->query('select * from materials where id = '.$row['id_material'])->row_array();
            $rowarea = $this->db->query('select * from area where id = '.$row['id_area'])->row_array();    
        ?>
        <tr>
            <td><?= $rowarea['nama'];?></td>
            <td><?= $rowmaterial['standart']; ?></td>
            <td><?= $row['standart_pertanyaan']; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php } ?>
    </table>
    </p>
    <br><br>
    <table border=1 width=100 style="margin-left:590%;">
        <tr>
            <td>Disusun oleh</td>
            <td>Diperiksa oleh</td>
            <td>Disetujui oleh</td>
        </tr>
        <tr>
            <td height=70></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>TEAM LEADER</td>
            <td>SPV PROJECT</td>
            <td>KEPALA UNIT PELAKSANA</td>
        </tr>
    </table>

</body>
</html>