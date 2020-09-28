<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Table With Full Features</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php echo show_alert('message');?>
                <table id="datatable" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
							<th class="text-center">Nama Ibu</th>
							<th class="text-center">Desa</th>
							<th class="text-center">Usia Kandungan</th>
							<th class="text-center">HPL</th>
							<th class="text-center">Status Resiko</th>
							<th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                    <?php	
				for($i=0; $i<count($hasil); $i++){
					$h 			= $hasil[$i];
					$hpl 		= date_convert($h['HPL']);
					$selisih 	= ((abs(strtotime ($h['waktu_daftar']) - strtotime (date('Y-m-d'))))/(60*60*24));
					$usia 		= ($h['usia_kandungan_daftar'] + (round(round($selisih) / 7)));
					$status 	= status_convert($h['status_resiko']);
					$desa		= desa_convert($h['id_desa']); 
					echo"
						
							<td>".($i+1)."</td>
							<td>$h[nama_ibu]</td>
							<td>$desa </td>
							<td>$usia  minggu</td>
							<td>$hpl</td>
							<td>$status</td>
							<td >
							<b>
							<a href='".site_url('analysist/kehamilan_detail')."/".simple_encrypt($h['id_kehamilan'])."' class='btn btn-small btn-success' >Lihat Detail</a>|  
							<div class='btn-group'>
							  <button type='button' class='btn btn-info'>Ubah Status</button>
							  <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
								<span class='caret'></span>
								<span class='sr-only'>Toggle Dropdown</span>
							  </button>
							  <ul class='dropdown-menu' role='menu'>
								<li><a href='".site_url('checkup/status_kehamilan/')."/".simple_encrypt($h['id_kehamilan'])."'>Melahirkan</a></li>
								<li><a href='".site_url('checkup/status_kehamilan/')."/".simple_encrypt($h['id_kehamilan'])."'>Abortus</a></li>
								<li><a href='".site_url('checkup/status_kehamilan/')."/".simple_encrypt($h['id_kehamilan'])."'>Meninggal</a></li>
								<li class='divider'></li>
								<li><a href=''>Separated link</a></li>
							  </ul>
							</div>
							</b>
							</td>
						</tr>
					";
				}	
			?>   
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</section>
