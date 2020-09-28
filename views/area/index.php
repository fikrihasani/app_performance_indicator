<!-- MAIN CONTENT -->
<div class="layout-content">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
    <?php if($this->session->flashdata('flash')): ?>
     
    <?php endif; ?>

        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Area</span>
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
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                    <button type="button" class="card-action card-remove" title="Remove"></button>
                  </div>
                  <strong>Daftar Area</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th width="18">No</th>
                        <th>Area</th>
                        <th width="80">Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Area</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $no = 1;
                        foreach ($area as $p) {
                    ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p['nama']; ?></td>
                        <td class="text-center"><a class="icon icon-edit" href="<?= base_url();?>area/ubah/<?= $p['id'];?>"></a> | <a href="<?= base_url();?>area/hapus/<?= $p['id'];?>" class="icon icon-trash-o tombol-hapus"></a></td>
                      </tr>
                   <?php } ?>
                    </tbody>
                  </table>
                  <br>
                  <!-- BARU -->
                  <div class="text-center m-b">
                    <a href="<?= base_url();?>Area/in_add"  class="btn btn-info">(+) Add New</a>
                  </div>
                  <!-- AKHIR -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  