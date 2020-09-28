 <!-- MAIN CONTENT -->
 <div class="layout-content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    
    <?php if($this->session->flashdata('flash')): ?>
    
    <?php endif; ?>
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Lost & Found</span>
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
          <?php if($this->session->userdata('level') == 1 ) { ?>
            <h3 class="m-b-0"><span class="icon icon-print"></span> Print File</h3>
            <form action="<?=base_url('lost_found/cetak')?>" method="post">
              <input type="date" name="startdate" value="" required> - <input type="date"  name="enddate" value="" required> <br><br>
              <button type="submit" name="print" value="excel" class="btn-default">Print as Excel</button> <button class="btn-default" type="submit" name="print" value="pdf">Print as PDF</button>
            </form>
          <?php } ?><br>
          <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3) { ?>
            <a href="<?= base_url(); ?>lost_found/in_add"  class="btn btn-info">(+) Add New</a>
          <?php } ?>
          </div>
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                    <button type="button" class="card-action card-remove" title="Remove"></button>
                  </div>
                  <strong>Daftar Lost & Found</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Penemu / Pelapor</th>
                        <th>Deskripsi</th>
                        <th>Jenis Laporan</th>
                        <th>Status</th>
                        <th>Tanggal Selesai</th>
                        <th>Photo</th>
                        <?php if($this->session->userdata('level') == 1){ ?>
                        <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Penemu / Pelapor</th>
                        <th>Deskripsi</th>
                        <th>Jenis Laporan</th>
                        <th>Status</th>
                        <th>Tanggal Selesai</th>
                        <th>Photo</th>
                        <?php if($this->session->userdata('level') == 1){ ?>
                        <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $no = 1;
                        foreach ($lost_found as $p) {
                    ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p['tanggal1']; ?></td>
                        <td><?= $p['deskripsi']; ?></td>
                        <td><?= $p['penemu']; ?></td>
                        <td><?= jenislaporan_convert($p['jenis_laporan']); ?></td>
                        <td><?= statuslaporan_convert($p['status']); ?></td>
                        <td>
                        <?php 
                          if($p['tanggal2']==0){
                            echo '0';
                          }else{
                              echo $p['tanggal2']; 
                          }
                        ?>
                        </td>
                        <td class="text-center"><img class="card-img" alt="..." src="<?= base_url('assets/upload/lost_found/') . $p['image']; ?>" width="80" height="80"></td>
                        <?php if($this->session->userdata('level') == 1){ ?>
                        <td class="text-center"><a class="icon icon-edit" href="<?= base_url();?>lost_found/ubah/<?= $p['id'];?>"></a> | <a href="<?= base_url();?>lost_found/hapus/<?= $p['id'];?>" class="icon icon-trash-o tombol-hapus"></a></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>