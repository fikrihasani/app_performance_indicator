<!-- MAIN CONTENT -->
<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Stok Gudang</span>
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
            <form action="<?=base_url('gudang/cetak')?>" method="post">
              <input type="date" name="startdate" value="" required> - <input type="date"  name="enddate" value="" required> <br><br>
              <button type="submit" name="print" value="excel" class="btn-default">Print as Excel</button> <button class="btn-default" type="submit" name="print" value="pdf">Print as PDF</button>
            </form>
            <br><br>
          <?php } ?>
          <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 4) { ?>
            <a href="<?= base_url(); ?>gudang/in_add"  class="btn btn-info" style="float: left;">(+) Add New</a>
            <a href="<?= base_url(); ?>gudang/in_history"  class="btn btn-success" style="float: right;">History Pengambilan Barang</a><br>
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
                  <strong>Daftar Stok Gudang</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Pengambil</th>
                        <th>Photo</th>
                        <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 4){ ?>
                        <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Pengambil</th>
                        <th>Photo</th>
                        <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 4){ ?>
                        <th>Aksi</th>
                        <?php } ?>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php $no=1; foreach($gudang as $c){ ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $c['nama_barang']; ?></td>
                        <td><?= $c['stok']; ?></td>
                        <td><?= $c['pengambil']; ?></td>
                        <td class="text-center"><img class="card-img" alt="..." src="<?= base_url('assets/upload/gudang/') . $c['image']; ?>" width="80" height="80"></td>
                        <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 4){ ?>
                        <td class="text-center">
                          <?php if($c['stok']>0){ ?>
                            <a class="icon icon-minus-square" href="<?= base_url();?>gudang/kurangStok/<?= $c['id'];?>"></a> |  
                          <?php } ?>
                        <a class="icon icon-edit" href="<?= base_url();?>gudang/ubah/<?= $c['id'];?>"></a>            | <a href="<?= base_url();?>gudang/hapus/<?= $c['id'];?>" class="icon icon-trash-o tombol-hapus"></a>
                        <?php } ?></td>
                      
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