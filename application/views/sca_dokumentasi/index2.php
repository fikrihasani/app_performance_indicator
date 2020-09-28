<!-- MAIN CONTENT -->
<?
	 if(count($sca) > 0) {
        for($i=0; $i<25; $i++){
            $h = $sca[$i];
            echo"
            <tr align='center'>
                <td>".($i+1)."</td>
                <td>$h[shift]</td>
                <td>$h[area]</td>
                <td>$h[subarea]</td>
                <td>$h[nilai]</td>
                <td>$h[user]</td>
                <td>$h[time]</td>
				<td align='center'>
                    <b>
                    <a href='".site_url('sca_dokumentasi/cetakpdf')."/".$h['id']."' class='btn btn-small btn-success' >Cetak</a>
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
  