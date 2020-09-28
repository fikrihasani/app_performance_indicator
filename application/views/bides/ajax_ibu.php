<?php
    if(count($data) > 0) {
        if(count($data) > $limit) {
            unset($data[count($data)-1]);
        }

        for($i=0; $i<count($data); $i++){
            $h = $data[$i];
            echo"
            <tr align='left'>
                <td>".($start+1)."</td>
                <td>$h[nik]</td>
                <td>$h[nama_ibu]</td>
                <td>$h[alamat]</td>
                <td>$h[nomor_darurat]</td>
                <td align='center'>
                    <b>
                    <a href='".site_url('patient/ibu_edit')."/".simple_encrypt($h['nik'])."' class='btn btn-small btn-success' >Ubah</a> |
                    <a href='".site_url('patient/ibu_delete')."/".simple_encrypt($h['nik'])."' class='btn btn-danger btn-small'  onClick=\"return confirm('Anda yakin ingin menghapus data ini ?')\" >Hapus</a>
                    </b>
                </td>
            </tr>
            ";
			$start = $start+1;
        }
    }else {
        echo "
            <tr>
                <td colspan='7'>Data Tidak Ditemukan</td>
            </tr>
        ";
    }
?>
