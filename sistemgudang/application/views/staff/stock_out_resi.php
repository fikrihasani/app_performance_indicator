<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:20px; display: block; margin-left: auto; margin-right: auto; width: 17%;">Resi Barang Keluar</h3>

                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                     <table style=" align:center; width:100%;">
						<tr style=" align:center; width:100%;">
							<td style="width:1000px;"><img style="width:200px; float: right;" src="../assets/image/unnamed.png"></td>
						</tr>
						<tr><td></td></tr>
						<tr>
							<td style="float: right;">Tanggal : <?php echo $tanggal; ?></td>
						</tr>
						<tr>
								<td style="float: right;">No. Resi : <?php echo $no_resi; ?></td>	
						</tr>
					</table>	
                    <table  class="table table-bordered table-striped mb-20" >
                        <thead>
                            <tr>
                                <th class="text-left">No</th>
                                <th class="text-left">ID Stock</th>
                                <th class="text-left">Nama Barang</th>
                                <th class="text-left">Jumlah</th>
                            </tr>
                        </thead>
                    	<tbody>
                    		
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
                    	</tbody>
                    </table>
                    <br class='clearfix'/>
								<a href="<?php echo site_url('barang/resi_print')."/"; ?>" class='btn btn-default' >Print</a>
                    <br class='clearfix'/>
                </div>
            </div>
		</div>
	</div>
</section>
