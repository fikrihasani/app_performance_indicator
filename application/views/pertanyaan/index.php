<!-- MAIN CONTENT -->
<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Pertanyaan</span>
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
            <form action="<?=base_url('pertanyaan/cetak')?>" method="post">
            <div class="form-group">
                          <label class="col-sm-4 control-label" for="form-control-6"></label>
                          <div class="col-sm-4">
                            <select id="shift" class="form-control" name="sca" required rows="5">
                            <option value="">-- Pilih Area --</option>
                              <?php
                                    foreach($area as $s){
                              ?>
                                <option value="<?= $s['id']; ?>"><?= $s['nama']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                      </div> <br><br>
              <button class="btn-default" type="submit">Print SCA</button>
            </form>
            <br><br>
          <?php } ?>
            
            <a href="<?= base_url(); ?>pertanyaan/in_add"  class="btn btn-info">(+) Add New</a>
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
                  <strong>Daftar Pertanyaan</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Area</th>
                        <th>Sub Area</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Area</th>
                        <th>Sub Area</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        $no = 1;
                        foreach ($pertanyaan as $p) {
                    ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p['area']; ?></td>
                        <td><?= $p['subarea']; ?></td>
                        <td class="text-center"><a class="icon icon-edit" href="<?= base_url();?>pertanyaan/ubah/<?= $p['id'];?>"></a> | <a href="<?= base_url();?>pertanyaan/hapus/<?= $p['id_subarea'];?>" class="icon icon-trash-o tombol-hapus"></a></td>
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