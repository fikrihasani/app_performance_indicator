<body onload="Window.print();">
	<div class="box-body">
		
		<table border="0">
			<thead>
				<tr>
					<th style="width:1450px; text-align:center;">
						RESI BARANG KELUAR
					</th>
					<th style=" text-align: right; width:150px;">
					 <img style="width:150px; align:right;" src="<?php echo base_url().'assets/image/unnamed.png'; ?>">
					</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td style="text-align:left; width:150px;">
					Tanggal : <?php echo $tanggal; ?><?php echo $no_resi; ?>
				</td>
				<td>
					
				</td>
			</tr>
			<tr>
				<td style="text-align:left; width:150px;">
					No Resi: <?php echo $no_resi; ?>
				</td>
				<td>
					
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	<br>
	<br>
	<style>
	html,body{
	 height:297mm;
	width:210mm;
	}

	th, td {
	  text-align: left;    
	}
	</style>
	<div>
		<table  border="1" style="border: 1px solid black; border-collapse: collapse;">
			<thead>
					<tr>
						<th style="width:100px;" class="text-left">No</th>
                        <th style="width:500px"class="text-left">ID Stock</th>
						<th style="width:500px"class="text-left">Nama Barang</th>
                        <th style="width:500px"class="text-left">Jumlah</th>
					</tr>
			</thead>
			<tbody>
				<tr>
					<?php 
                    			for($i=0; $i<count($barang); $i++){
									$h = $barang[$i];
										echo "<tr>";
											echo "<td>";
												echo $i+1;
											echo "</td>";
											echo "<td>";
												echo $h['id_stock'];
											echo "</td>";
											echo "<td>";
												echo $h['nama_barang'];
											echo "</td>";
											echo "<td>";
												echo $h['jumlah'];
											echo "</td>";
										echo "</tr>";
								}
                    		 ?>
				</tr>
			</tbody>
		</table>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<table border="0">
			<tbody>
			<tr>
				<td style="text-align:center; width:800px; height: 90px; vertical-align: top;">
					Logistik 
				</td>
				<td style="text-align:center; width:800px; height: 90px; vertical-align: top;">
				Requester
				</td>
			</tr>
			<tr>
				<td style="text-align:center">
					<?php echo full_name(); ?>
				</td>
				<td style="text-align:center">
					<?php echo $requester; ?>
				</td>
			</tr>
			
			</tbody>
		</table>
		
		
		
		
	</div>
