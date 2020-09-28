
<?php
        $jml=0;
        foreach($query2->result_array() as $rownyalagi) {
            foreach(json_decode($rownyalagi['result']) as $rownyasekalilagi) {
                $jml++;
             }
        }

         ?>

<table border="1" cellpadding="8">
        <tr style="background-color:#E5AA70	;">
            <th colspan="11"><h2>STANDARD  CLEANLINESS AREA BANDARA</h2></th>
        </tr><br><br>
        <tr>
        </tr>
        <tr></tr>
        <tr style="background-color:#E5AA70	;">
            <th rowspan="2" align=left valign="top">No</th>
            <th rowspan="2" align="left" valign="top">Area</th>
            <th rowspan="2" align="left" valign="top">Subarea</th>
            <th rowspan="2">Material</th>
            <th rowspan="2">Standart Area</th>
            <th colspan="2">Tinjauan</th>
            <th rowspan="2">Tindak Lanjut Kasus</th>
            <th rowspan="2">Oleh</th>
            <th rowspan="2" width="30">Waktu</th>
            <th rowspan="2" width="30">Hasil</th>
        </tr>
        <tr style="background-color: #E5AA70;">
            <th>Kode</th>
            <th>Penjelasan</th>
        </tr>
        <?php $jml; ?>
        <tr>
            <td rowspan="<?= $jml; ?>">1.</td>
            <td rowspan="<?= $jml; ?>">Ruang Kerja</td>
            <td rowspan="<?= $jml; ?>">Perkantoran</td>
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

    <br><br><br>
    <table border="1" cellpadding="8">
        <tr>
            <td width="110">Tanggal</td>
            <td width="2">:</td>
            <td><?= $sca_dokumentasi['time']; ?></td>
            <td rowspan="5" class="text-center" width="180"><img src="<?= base_url(); ?>assets/upload/sca/<?= $sca_dokumentasi['image']; ?>" width="200" height="210"></td>
            <td rowspan="5" class="text-center">Di Check Oleh Checker<br><br><br><br><br>(<?= $sca_dokumentasi['user']; ?>)</td>
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