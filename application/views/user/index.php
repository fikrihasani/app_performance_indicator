<div class="layout-content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Users</span>
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
                  <strong>Daftar Users</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    /*<?php date_default_timezone_set('Asia/Jakarta');  echo date('Y-m-d H:i:s' , $p['date_created']); ?> */
                        $no = 1;
                        foreach ($user2 as $p) {
                    ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p['nik']; ?></td>
                        <td><?= $p['nama']; ?></td>
                        <td><?= $p['jabatan']; ?></td>
                        <td><?= $p['email']; ?></td>
                        <td><img class="card-img" alt="..." src="<?= base_url('assets/upload/profile/') . $p['image']; ?>" width="80" height="80">
                          
                      </td>
                        <td><?php if($p['level']==1){
                                    echo "Admin";
                                  }else if($p['level']==2){
                                    echo "SPV";
                                  }else if($p['level']==3){
                                    echo "Checker";
                                  }
                        ?></td>
                        <td><?php if($p['is_active']==1){
                                    echo "Active";
                                  }else{
                                    echo "Not Active";}
                        ?></td>
                        <td><?=  date('d F Y' , $p['date_created']); ?></td>
                        <td class="text-center"><a href="<?= base_url();?>user/hapus/<?= $p['id'];?>" class="icon icon-trash-o tombol-hapus"></a></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <br>
                  <!-- BARU -->
                  <div class="text-center m-b">
                    <a href="<?= base_url(); ?>user/in_add"  class="btn btn-info">(+) Add New</a><br><br>
                  </div>
                  <!-- AKHIR -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>