<!-- MAIN CONTENT -->
<div class="layout-content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Absensi</span>
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
            <a href="<?= base_url(); ?>absensi/in_add"  class="btn btn-info">(+) Add New</a>
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
                  <strong>Daftar Absensi</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $no = 1;
                        foreach ($absensi as $p) {
                    ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p['pegawai']; ?></td>
                        <td><?= $p['jenis']; ?></td>
                        <td><?= $p['keterangan']; ?></td>
                        <td><?= $p['tanggal'];?></td>
                        <td class="text-center">
                        <?php if($this->session->userdata('level') == 1){ ?>
                         <a class="icon icon-edit" href="<?= base_url();?>absensi/ubah/<?= $p['id'];?>"></a> 
                        <?php } ?>
                         <a class="icon icon-search-plus" href="<?= base_url();?>absensi/detail/?nama=<?= $p['pegawai'];?>"></a>  
                        <?php if($this->session->userdata('level') == 1){ ?>
                         | <a href="<?= base_url();?>absensi/hapus/<?= $p['id'];?>" class="icon icon-trash-o tombol-hapus"></a>
                       <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <br>
                  <!-- print File -->
                  <div class="text-center m-b">
                  <?php if($this->session->userdata('level') == 1){ ?>
                    <h3 class="m-b-0"><span class="icon icon-print"></span> Print File</h3>
                    <form action="<?=base_url('absensi/cetak')?>" method="post">
                      <input type="date" name="startdate" value="" required> - <input type="date"  name="enddate" value="" required> <br><br>
                      <button type="submit" name="print" value="excel" class="btn-default">Print as Excel</button> <button class="btn-default" type="submit" name="print" value="pdf">Print as PDF</button>
                    </form>
                    <br><br>
                  <?php } ?>
                  </div>

                  <!-- Akhir -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>