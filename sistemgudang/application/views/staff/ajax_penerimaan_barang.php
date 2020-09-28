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
                <td >$h[nama_shipper]</td>
                <td>$h[nama_forwarder]</td>
                <td>$h[jumlah]</td>
                <td>$h[nomor_po]</td>
				 <td>$h[create_date]</td>
                <td>$h[create_by]</td>
				<td align='left'>
                    <b>
                    <a href='".site_url('barang/penerimaan_edit')."/".simple_encrypt($h['id_penerimaan'])."' class='btn btn-small btn-success' >Ubah</a> |
                    <a href='".site_url('barang/penerimaan_print')."/".simple_encrypt($h['id_penerimaan'])."' class='btn btn-small btn-info' >Print</a> |
					<a href='".site_url('barang/penerimaan_delete')."/".simple_encrypt($h['id_penerimaan'])."' class='btn btn-danger btn-small'  onClick=\"return confirm('Anda yakin ingin menonaktifkan Gudang ini ?')\" >Non-aktifkan</a> 
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
