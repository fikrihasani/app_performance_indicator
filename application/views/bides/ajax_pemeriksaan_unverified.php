<?php
    if(count($data) > 0) {
        if(count($data) > $limit) {
            unset($data[count($data)-1]);
        }
        for($i=0; $i<count($data); $i++){
            $h 	= $data[$i];
            if(is_auth([3,4])){
                echo"
                    <tr align='left'>
                        <td>".($start+1)."</td>
                        <td>$h[nama_ibu]</td>
                        <td>$h[HPL]</td>
                        <td>$h[id_desa]</td>
                        <td bgcolor='$h[color];'>$h[status_resiko]</td>
						<td bgcolor='$h[color2];'>$h[status_verifikasi]</td>
                        <td align='center'>
                        <b>
                        <a href='".site_url('checkup/pemeriksaan_unverified_detail')."/".simple_encrypt($h['id_pemeriksaan'])."' class='btn btn-small btn-success' >Lihat Detail</a>
                        </b>
                        </td>
                    </tr>
                ";
				$start = $start+1;
            }else{
                echo"
                    <tr align='left'>
                        <td>".($start+1)."</td>
                        <td>$h[nama_ibu]</td>
                        <td>$h[usia_kandungan_daftar] minggu</td>
                        <td>$h[HPL]</td>
                        <td bgcolor='$h[color];'>$h[status_resiko]</td>
						<td bgcolor='$h[color2];'>$h[status_verifikasi]</td>
                        <td align='center'>
                        <b>
                        <a href='".site_url('checkup/pemeriksaan_unverified_detail')."/".simple_encrypt($h['id_pemeriksaan'])."' class='btn btn-small btn-success' >Lihat Detail</a>|
                        <a href='".site_url('checkup/pemeriksaan_delete')."/".simple_encrypt($h['id_pemeriksaan'])."' class='btn btn-small btn-danger' onClick=\"return confirm('Anda yakin ingin menghapus data ini ?')\">Hapus</a>
                        </b>
                        </td>
                    </tr>
                ";
				$start = $start+1;
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
