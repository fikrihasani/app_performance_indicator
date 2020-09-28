<?
	 if(count($area) > 0) {
        if(count($area) > $limit) {
            unset($area[count($area)-1]);
        }

        for($i=0; $i<count($area); $i++){
            $h = $area[$i];
            echo"
            <tr align='left'>
                <td>".($start+1)."</td>
                <td>$h[id]</td>
                <td>$h[nama]</td>
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