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
                        <td>".($start+1)."</td>
                        <td>$h[nama_ibu]</td>
                        <td>$h[HPL]</td>
                        <td>$h[id_desa]</td>
                        <td bgcolor='$h[color];' align='center'>$h[status_resiko]</td>
                        <td align='center' >
                        <b>
                        <a href='".site_url('checkup/kehamilan_berjalan_detail')."/".simple_encrypt($h['id_kehamilan'])."' class='btn btn-small btn-success' >Lihat Detail</a>
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
                        <td>$h[HPL]</td>
                        <td bgcolor='$h[color];' align='center'>$h[status_resiko]</td>
                        <td align='center'>
                        <b>
                        <a href='".site_url('checkup/kehamilan_berjalan_detail')."/".simple_encrypt($h['id_kehamilan'])."' class='btn btn-small btn-success' >Lihat Detail</a>|
                        <div class='btn-group'>
                          <button type='button' class='btn btn-info'>Ubah Status</button>
                          <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
                            <span class='caret'></span>
                            <span class='sr-only'>Toggle Dropdown</span>
                          </button>
                          <ul class='dropdown-menu' role='menu'>
                            <li><a href='".site_url('checkup/data_lahir_input/')."/".simple_encrypt($h['id_kehamilan'])."'>Melahirkan</a></li>
                            <li><a href='".site_url('checkup/data_abortus_input/')."/".simple_encrypt($h['id_kehamilan'])."'>Abortus</a></li>
                            <li><a href='".site_url('checkup/data_kematian_input/')."/".simple_encrypt($h['id_kehamilan'])."'>Meninggal</a></li>
                          </ul>
                        </div>
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
