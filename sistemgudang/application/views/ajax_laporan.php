<?php
   // dumper($data);

    if(count($data) > 0) {
        for($i=0; $i<count($data); $i++){
            $h = $data[$i];
            echo"
            <tr>
                <td>".($i+1)."</td>
                <td>$h[nama_desa]</td>
                <td>$h[hb]</td>
                <td>$h[anemia]</td>
                <td>$h[hbkurang]</td>
                <td>$h[lila]</td>
                <td>$h[lilakurang]</td>
                <td>$h[proteinurine]</td>
                <td>$h[proteinurinepositif]</td>
                <td>$h[guladarah]</td>
                <td>$h[guladarahpositif]</td>
                <td>$h[hiv]</td>
                <td>$h[hivpositif]</td>
                <td>$h[kelambu]</td>
                <td>$h[mikroskopik]</td>
                <td>$h[malaria]</td>
                <td>$h[obat_malaria]</td>
                <td>$h[tb]</td>
                <td>$h[tbpositif]</td>
                <td>$h[obattb]</td>
                <td>$h[ims]</td>
                <td>$h[positifims]</td>
                <td>$h[hepatitis]</td>
                <td>$h[hepatitispositif]</td>
            </tr>
            ";
        }
    }else {
        echo "
            <tr>
                <td colspan='7'>Data Tidak Ditemukan</td>
            </tr>
        ";
    }
?>
