<?php
    if(count($data) > 0) {
        if(count($data) > $limit) {
            unset($data[count($data)-1]);
        }

        for($i=0; $i<count($data); $i++){
            $h = $data[$i];
            echo"
            <tr  align='left'>
                <td >".($i+1)."</td>
                <td >$h[nama_barang]</td>
                <td>$h[nama_satuan]</td>
                <td>$h[kode]</td>
                <td>$h[nama_kategori]</td>
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
