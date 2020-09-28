<!-- MAIN CONTENT -->
<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Stok Gudang | History Pengambilan Barang</span>
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
          <a href="<?= base_url(); ?>gudang" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
          <div class="text-center m-b">
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
                  <strong>History Pengambilan Barang</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th width="20">No</th>
                        <th>Nama Barang</th>
                        <th width="30">Jumlah Barang diambil</th>
                        <th>Stok</th>
                        <th>Pengambil</th>
                        <th>Tanggal Pengambilan</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th width="20">No</th>
                        <th>Nama Barang</th>
                        <th width="30">Jumlah Barang diambil</t>
                        <th>Stok</th>
                        <th>Pengambil</th>
                        <th>Tanggal Pengambilan</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php $no=1; foreach($gudang as $c){ ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $c['id_barang']; ?></td>
                        <td>1</td>
                        <td><?= $c['stok']; ?></td>
                        <td><?= $c['pengambil']; ?></td>
                        <td><?= $c['time']; ?></tD>
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