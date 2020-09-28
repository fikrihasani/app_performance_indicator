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
                <td >$h[nama_gudang]</td>
                <td >$h[alamat]</td>
				<td align='left'>
                    <b>
                    <a href='".site_url('barang/gudang_edit')."/".simple_encrypt($h['id_gudang'])."' class='btn btn-small btn-success' >Ubah</a> |
					<a href='".site_url('barang/gudang_delete')."/".simple_encrypt($h['id_gudang'])."' class='btn btn-danger btn-small'  onClick=\"return confirm('Anda yakin ingin menonaktifkan Gudang ini ?')\" >Non-aktifkan</a>
                    </b>
                </td>
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
