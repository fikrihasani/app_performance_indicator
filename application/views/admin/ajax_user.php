<?php
    if(count($data) > 0) {
        if(count($data) > $limit) {
            unset($data[count($data)-1]);
        }

        for($i=0; $i<count($data); $i++){
            $h = $data[$i];
            
			if ($h['user_status'] == 0){
				$h['user_statusi'] = 'Aktif';
			}else{
				$h['user_statusi'] = 'Non Aktif';
			}
            $str_level = ISSET($level[$h['id_level']]) ? $level[$h['id_level']] : "undefined";
            echo"
            <tr  align='left'>
                <td >".($i+1)."</td>
                <td >$h[nama]</td>
                <td>$h[nip]</td>
                <td>$h[username]</td>
                <td>$h[no_telp]</td>
                <td>$str_level</td>
                <td align='center'>$h[user_statusi]</td>
                ";
			if($h['user_status'] == 0){
				echo"
				<td align='center'>
                    <b>
                    <a href='".site_url('doctor/user_edit')."/".simple_encrypt($h['id_user'])."' class='btn btn-small btn-success' >Ubah</a> |
					<a href='".site_url('doctor/user_change')."/".simple_encrypt($h['id_user'])."' class='btn btn-danger btn-small'  onClick=\"return confirm('Anda yakin ingin menonaktifkan pengguna ini ?')\" >Non-aktifkan</a>
                    </b>
                </td>
            </tr>
				";
			}else{
				echo"
				<td align='center'>
                    <b>
					<a href='".site_url('doctor/user_change')."/".simple_encrypt($h['id_user'])."' class='btn btn-info btn-small'  onClick=\"return confirm('Anda yakin ingin mengaktifkan pengguna ini ?')\" >Aktifkan</a>|<a href='".site_url('doctor/user_delete')."/".simple_encrypt($h['id_user'])."' class='btn btn-danger btn-small'  onClick=\"return confirm('Anda yakin ingin menghapus data pengguna ini ?')\" >Hapus</a>
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
