<?php
    if(count($data) > 0) {
        if(count($data) > $limit) {
            unset($data[count($data)-1]);
        }

        for($i=0; $i<count($data); $i++){
            $h 			= $data[$i];
            if(is_auth([3,4])){
                echo"
                    <tr align='left'>
                        <td>".($i+1)."</td>
                        <td>$h[nama_ibu]</td>
						<td>$h[id_desa]</td>
					    <td bgcolor='$h[color];' align='center'>$h[status_resiko]</td>
                        <td align='center'>$h[status_kehamilan]</td>
                        <td align='center'>
                        <b>
                        <a href='".site_url('checkup/kehamilan_berjalan_detail')."/".simple_encrypt($h['id_kehamilan'])."' class='btn btn-small btn-success' >Lihat Detail</a>
                        </b>
                        </td>
                    </tr>
                ";
            }else{
                echo"
                    <tr>
                        <td>".($i+1)."</td>
                        <td>$h[nama_ibu]</td>
                        <td bgcolor='$h[color];' align='center'>$h[status_resiko]</td>
                        <td align='center'>$h[status_kehamilan]</td>
                        <td align='center'>
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
