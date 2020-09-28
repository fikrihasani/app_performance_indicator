<?php
    if(count($data) > 0) {
        if(count($data) > $limit) {
            unset($data[count($data)-1]);
        }

        for($i=0; $i<count($data); $i++){
            $h 			= $data[$i];
            if(is_auth([3,4])){
                echo"
                    <tr>
                        <td>".($i+1)."</td>
                        <td>$h[nama_ibu]</td>
                        <td>$h[usia_kandungan_daftar] minggu</td>
                        <td>$h[tanggal_rujukan]</td>
                        <td>$h[tempat_rujukan]</td>
                        <td>$h[keadaan_tiba]</td>
                        <td>$h[keadaan_pulang]</td>
                        <td>$h[id_desa]</td>
                        <td>$h[pendeteksi_resiko]</td>
                        <td >
                        <b>
                        <a href='".site_url('checkup/kehamilan_berjalan_detail')."/".simple_encrypt($h['id_kehamilan'])."' class='btn btn-small btn-success' >Lihat Detail</a>|
                        </b>
                        </td>
                    </tr>
                ";
            }else{
                echo"
                    <tr>
                        <td>".($i+1)."</td>
                        <td>$h[nama_ibu]</td>
                        <td>$h[usia_kandungan_daftar] minggu</td>
                        <td>$h[tanggal_rujukan]</td>
                        <td>$h[tempat_rujukan]</td>
                        <td>$h[keadaan_tiba]</td>
                        <td>$h[keadaan_pulang]</td>
                        <td>$h[pendeteksi_resiko]</td>
						<td>
						<b>
                        <a href='".site_url('checkup/kehamilan_berjalan_detail')."/".simple_encrypt($h['id_kehamilan'])."' class='btn btn-small btn-success' >Lihat Detail</a>
                        </b>
                        </td>
                    </tr>
                ";
            }
        }
    }else {
        echo "
            <tr>
                <td colspan='7'>Data Tidak Ditemukan</td>
            </tr>
        ";
    }
?>
