<form action="<?php echo site_url('barang/qr_print'); ?>" id='display-table'>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">QR Code</h3>

                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php echo show_alert('message');?>
                    <table style=" align:center; width:1400px;">
						<tr style=" align:center; width:1400px;">
							<td style=" align:center; width:1400px;"><center><img style="max_width:400px" src="<?php echo base_url().'assets/qr/'.$gambar.'.png'; ?>"></center></td>
						</tr>
						<tr>
							<td><center style="font-size:20px">Logistik APS - <?php echo $cabang['nama_cabang']?></center></td>
						</tr>
						<tr>
							<td><center style="font-size:20px"><?php echo $barang['nama_barang']?></center></td>
						</tr>
						<tr align='center'>
							<td>
								<a href="<?php echo site_url('barang/qr_print')."/".$gambar; ?>" class='btn btn-default' >Print</a>
							</td>	
						</tr>
					</table>				
                    <br class='clearfix'/>
						 <div class="btn-group pull-right">
							
						</div>
                    <br class='clearfix'/>
                </div>
				
			</div>
		</div>
	</div>
</section>