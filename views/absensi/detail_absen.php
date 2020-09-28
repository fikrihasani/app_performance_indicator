<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Detail Absensi</span>
              <span class="d-ib">
                <a class="title-bar-shortcut" href="#" title="Add to shortcut list" data-container="body" data-toggle-text="Remove from shortcut list" data-trigger="hover" data-placement="right" data-toggle="tooltip">
                  <span class="sr-only">Add to shortcut list</span>
                </a>
              </span>
            </h1>
            <p class="title-bar-description">
            </p>
          </div>
          <hr>
            <a href="<?= base_url(); ?>absensi" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
          <div class="row"><br><br>
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                    <button type="button" class="card-action card-remove" title="Remove"></button>
                  </div>
                  <strong>
                  <?php
                        $no = 1;
                        foreach ($absensi as $p) {
                    ?>
                      <?php if($no==1): ?>
                          <?= $p['pegawai']; break; ?>
                      <?php endif; ?>
                  <?php } ?>

                </strong>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Jenis</th>
                          <th>Keterangan</th>
                          <th>Tanggal</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $no = 1;
                        foreach ($absensi as $p) {
                    ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $p['jenis']; ?></td>
                          <td><?= $p['keterangan']; ?></td>
                          <td><?= $p['tanggal']; ?></td>
                        </tr>
                        <?php } ?>
                        <tr style="background-color:#FFFACD; font-weight:bold;">
                          <td colspan="3" >Jumlah Pelanggaran</td>
                          <td><?= $jumlah_absensi; ?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>