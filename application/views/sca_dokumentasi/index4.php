<!-- MAIN CONTENT -->
<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">SCA & Dokumentasi</span>
              <span class="d-ib">
                <a class="title-bar-shortcut" href="#" title="Add to shortcut list" data-container="body" data-toggle-text="Remove from shortcut list" data-trigger="hover" data-placement="right" data-toggle="tooltip">
                  <span class="sr-only">Add to shortcut list</span>
                </a>
              </span>
            </h1>
            <p class="title-bar-description">
              <small></small>
            </p>
          </div>
          <hr>
          <div class="text-center m-b">
            <a href="<?= base_url(); ?>sca_dokumentasi/in_add"  class="btn btn-info">(+) Add New</a>
          </div><br>
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                    <button type="button" class="card-action card-remove" title="Remove"></button>
                  </div>
                  <strong>Daftar SCA & Dokumentasi</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Shift</th>
                        <th>Kategori</th>
                        <th>Area</th>
                        <th>Nilai</th>
                        <th>Penanggung Jawab</th>
                        <th>Tanggal</th>
                        <th>Photo</th>
                        <?php if($this->session->userdata('level') == 1){ ?>
                        <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Shift</th>
                        <th>Kategori</th>
                        <th>Area</th>
                        <th>Nilai</th>
                        <th>Penanggung Jawab</th>
                        <th>Tanggal</th>
                        <th>Photo</th>
                        <?php if($this->session->userdata('level') == 1){ ?>
                        <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
						if(count($sca) > 0) {
							for($i=0; $i<25; $i++){
								$h = $sca[$i];
								echo"
								<tr>
									<td>".($i+1)."</td>
									<td>$h[shift]</td>
									<td>$h[area]</td>
									<td>$h[subarea]</td>
									<td>$h[nilai]</td>
									<td>$h[user]</td>
									<td>$h[time]</td>
									<td class='text-center'><img class='card-img' alt='...' src='".base_url('assets/upload/sca/') . $h['image']."'; ' width='80' height='80'></td>
									<td align='center'>
										<b>
										<a href='".site_url('sca_dokumentasi2/cetakpdf')."/".$h['id']."' class='btn btn-small btn-success' >Cetak</a>
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
                    </tbody>
                  </table>
                  <br>
                  <!-- Print file -->
                  <div class="text-center m-b">
                    <?php if($this->session->userdata('level') == 1 ) { ?>
                      <h3 class="m-b-0"><span class="icon icon-print"></span> Print File</h3>
                      <form action="<?=base_url('sca_dokumentasi/cetak')?>" method="post">
                        <input type="date" name="startdate" value="" required> - <input type="date"  name="enddate" value="" required> <br><br>
                        <button type="submit" name="print" value="excel" class="btn-default">Print as Excel</button> <button class="btn-default" type="submit" name="print" value="pdf">Print as PDF</button>
                      </form>
                      <br><br>
                    <?php } ?>
                    </div>
                  <!-- Akhir Print -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>