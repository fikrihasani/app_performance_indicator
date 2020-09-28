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
                        <td>".date_convert($h['tanggal_rujukan'])."</td>
                        <td>$h[tempat_rujukan]</td>
                        <td>".pendeteksi_convert($h['pendeteksi_resiko'])."</td>
                        <td>$h[keadaan_tiba]</td>
                        <td>$h[keadaan_pulang]</td>

                    </tr>
                ";
            }else{
                echo"
                    <tr>
                        <td>".($i+1)."</td>
                         <td>".date_convert($h['tanggal_rujukan'])."</td>
                        <td>$h[tempat_rujukan]</td>
                         <td>".pendeteksi_convert($h['pendeteksi_resiko'])."</td>
                        <td>$h[keadaan_tiba]</td>
                        <td>$h[keadaan_pulang]</td>
                    </tr>
                ";
            }
        }
    }else {
        echo "
            <tr>
                <td colspan='7'>Belum Pernah Melakukan Rujukan</td>
            </tr>
        ";
    }
?>
