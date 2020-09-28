<?
	
	echo"Hasil Check Sheet Cleaning Perfomance Area".$area." Bulan ".$month." Tahun ".$year."";
	echo"<table>";
	echo"
		<tr>
			<td>No</td>
			<td>Sub Area</td>
			<td>Bersih</td>
			<td>Tidak Bersih</td>
			<td>Aksi</td>
		</tr>
		";
	
	 if(count($subarea) > 0) {
        for($i=0; $i<count($subarea); $i++){
            $h = $subarea[$i];
            echo"

            <tr align='center'>
                <td>".($i+1)."</td>
                <td>$h[nama]</td>
                <td>$h[databersih]</td>
                <td>$h[datakotor]</td>
				<td align='center'>
                    <b>
                    <a href='".site_url('dashboard/hasil_subarea')."/".$h['id']."' class='btn btn-small btn-success' >Cetak</a>
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
	echo"</table>";


?>