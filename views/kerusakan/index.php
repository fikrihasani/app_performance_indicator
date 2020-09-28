<!-- MAIN CONTENT -->
<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>

        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Kerusakan</span>
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
          <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3) { ?>
            <a href="<?= base_url(); ?>kerusakan/in_add"  class="btn btn-info">(+) Add New</a>
          <?php } ?>
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
                  <strong>Daftar Kerusakan</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Area</th>
                        <th>Sub Area</th>
                        <th>Kerusakan</th>
                        <th>Follow Up</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th>Tanggal</th>
                        <?php if($this->session->userdata('level') == 1){ ?>
                        <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Area</th>
                        <th>Sub Area</th>
                        <th>Kerusakan</th>
                        <th>Follow Up</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th>Tanggal</th>
                        <?php if($this->session->userdata('level') == 1){ ?>
                        <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $no = 1;
                        foreach ($kerusakan as $p) {
                    ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p['area']; ?></td>
                        <td><?= $p['subarea']; ?></td>
                        <td><?= $p['kerusakan']; ?></td>
                        <td><?= $p['follow_up']; ?></td>
                        <td><?= statuslaporan_convert($p['status']); ?></td>
                        <td class="text-center"><img class="card-img" alt="..." src="<?= base_url('assets/upload/kerusakan/') . $p['image']; ?>" width="80" height="80"></td>
                        <td><?= $p['time']; ?></td>
                        <?php if($this->session->userdata('level') == 1){ ?>
                          <td class="text-center"><a class="icon icon-edit" href="<?= base_url();?>kerusakan/ubah/<?= $p['id'];?>"></a> | <a href="<?= base_url();?>kerusakan/hapus/<?= $p['id'];?>" class="icon icon-trash-o tombol-hapus"></a></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <br>
                  <!-- Print -->
                  <div class="text-center m-b">
                  <?php if($this->session->userdata('level') == 1 ) { ?>
                    <h3 class="m-b-0"><span class="icon icon-print"></span> Print File</h3>
                    <form action="<?=base_url('kerusakan/cetak')?>" method="post">
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