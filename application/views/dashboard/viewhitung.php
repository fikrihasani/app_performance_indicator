<?
	
	echo"Hasil Check Sheet Cleaning Perfomance Bulan ".$month." Tahun ".$year."";
	echo"<table>";
	echo"
		<tr>
			<td>No</td>
			<td>Area</td>
			<td>Bersih</td>
			<td>Tidak Bersih</td>
			<td>Lihat Detil</td>
		</tr>
		";
	
	 if(count($area) > 0) {
        for($i=0; $i<count($area); $i++){
            $h = $area[$i];
            echo"

            <tr align='left'>
                <td>".($i+1)."</td>
                <td>$h[nama]</td>
                <td>$h[databersih]</td>
                <td>$h[datakotor]</td>
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