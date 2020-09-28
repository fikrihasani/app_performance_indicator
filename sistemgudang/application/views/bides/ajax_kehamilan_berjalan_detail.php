<?php
    if(count($data) > 0) {
        if(count($data) > $limit) {
            unset($data[count($data)-1]);
        }

        for($i=0; $i<count($data); $i++){
            $h 			= $data[$i];

            if($h['tekanan_a'] == 0 || $h['tekanan_b'] == 0){
                $tekanan = 0;
            }else {
                $tekanan = $h['tekanan_a'].'/'.$h['tekanan_b'];
            }

            if(is_auth([3,4])){
                echo"
                    <tr>
                        <td>".($i+1)."</td>
                        <td>$h[tanggal_periksa]</td>
                        <td>$h[trimester]</td>
                        <td>$h[anamnesis]</td>
                        <td>$h[berat_badan]</td>
                        <td>$h[tinggi_badan]</td>
                        <td>$tekanan</td>
                        <td>$h[fundung_uterus]</td>
                        <td>$h[lingkar_lengan]</td>
                        <td>$h[status_gizi]</td>
                        <td>$h[refleksi_patella]</td>
                        <td>$h[djj]</td>
                        <td>$h[kepala]</td>
                        <td>$h[berat_janin]</td>
                        <td>$h[jumlah_janin]</td>
                        <td>$h[presentasi]</td>
                        <td>$h[status_konseling]</td>
                        <td>$h[status_imunisasi]</td>
                        <td>$h[status_injeksi]</td>
                        <td>$h[status_pencatatan]</td>
                        <td>$h[ps]</td>
                        <td>$h[hb]</td>
                        <td>$h[gula_darah]</td>
                        <td>$h[status_thalasemia]</td>
                        <td>$h[status_sifilis]</td>
                        <td>$h[hbsag]</td>
                        <td>$h[vct]</td>
                        <td>$h[serologi]</td>
                        <td>$h[arv]</td>
                        <td>$h[malaria]</td>
                        <td>$h[obat]</td>
                        <td>$h[kelambu]</td>
                        <td>$h[tb]</td>
                        <td>$h[obat2]</td>
                        <td>$h[hdk]</td>
                        <td>$h[abortus]</td>
                        <td>$h[pendarahan]</td>
                        <td>$h[infeksi]</td>
                        <td>$h[kpd]</td>
                        <td>$h[lain_lain]</td>
                        <td>$h[status_bpjs]</td>
                        <td  bgcolor='$h[color];'>$h[status_resiko]</td>
                    </tr>
                ";
            }else{
                echo"
                    <tr>
                        <td>".($i+1)."</td>
                        <td>$h[tanggal_periksa]</td>
                        <td>$h[trimester]</td>
                        <td>$h[anamnesis]</td>
                        <td>$h[berat_badan]</td>
                        <td>$h[tinggi_badan]</td>
                        <td>$tekanan</td>
                        <td>$h[fundung_uterus]</td>
                        <td>$h[lingkar_lengan]</td>
                        <td>$h[status_gizi]</td>
                        <td>$h[refleksi_patella]</td>
                        <td>$h[djj]</td>
                        <td>$h[kepala]</td>
                        <td>$h[berat_janin]</td>
                        <td>$h[jumlah_janin]</td>
                        <td>$h[presentasi]</td>
                        <td>$h[status_konseling]</td>
                        <td>$h[status_imunisasi]</td>
                        <td>$h[status_injeksi]</td>
                        <td>$h[status_pencatatan]</td>
                        <td>$h[ps]</td>
                        <td>$h[hb]</td>
                        <td>$h[gula_darah]</td>
                        <td>$h[status_thalasemia]</td>
                        <td>$h[status_sifilis]</td>
                        <td>$h[hbsag]</td>
                        <td>$h[vct]</td>
                        <td>$h[serologi]</td>
                        <td>$h[arv]</td>
                        <td>$h[malaria]</td>
                        <td>$h[obat]</td>
                        <td>$h[kelambu]</td>
                        <td>$h[tb]</td>
                        <td>$h[obat2]</td>
                        <td>$h[hdk]</td>
                        <td>$h[abortus]</td>
                        <td>$h[pendarahan]</td>
                        <td>$h[infeksi]</td>
                        <td>$h[kpd]</td>
                        <td>$h[lain_lain]</td>
                        <td>$h[status_bpjs]</td>
                        <td  bgcolor='$h[color];'>$h[status_resiko]</td>
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
