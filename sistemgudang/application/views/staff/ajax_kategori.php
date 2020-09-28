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
                <td >$h[nama_kategori]</td>
				<td align='left'>
                    <b>
                    <a href='".site_url('barang/kategori_edit')."/".simple_encrypt($h['id_kategori'])."' class='btn btn-small btn-success' >Ubah</a> |
					<a href='".site_url('barang/kategori_delete')."/".simple_encrypt($h['id_kategori'])."' class='btn btn-danger btn-small'  onClick=\"return confirm('Anda yakin ingin menonaktifkan kategori ini ?')\" >Non-aktifkan</a>
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
