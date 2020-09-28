<div class="layout-content">
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Absensi / Add</span>
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
            <a href="<?= base_url(); ?>absensi" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
            <div class="row"><br>
              <div class="col-md-8">
                <div class="demo-form-wrapper">
                  <form class="form form-horizontal" method="post">
                      <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Pegawai*</label>
                          <div class="col-sm-9">
                            <select id="form-control-6" class="form-control" name="pegawai" required>
                              <option value="">--- Pilih Pegawai ---</option>
                              <?php foreach($user2 as $p)
                                    { 
                              ?>
                                <option value="<?= $p['nama'] ?>"><?= $p['nama']; ?></option>
                              <?php } ?>
                              
                            </select>
                          </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-6">Jenis Pelanggaran*</label>
                      <div class="col-sm-9">
                        <select id="form-control-6" class="form-control" name="jns_pelanggaran" required>
                          <option value="">-- Pilih Jenis Pelanggaran --</option>
                          <option value="Terlambat">Terlambat</option>
                          <option value="Mangkir">Mangkir</option>
                        </select>
                      </div>
                </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Keterangan*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Isi Keterangan" name="keterangan" value="<?= set_value('keterangan'); ?>" required>
                        <small class="form-text text-danger"><?= form_error('keterangan');?></small>
                      </div>
                  </div>
                    <div class="form-group">
                        <div class="col-sm-4 control-label">
                          <input class="btn btn-primary" type="submit" value="Save">
                        </div>
                        <br><br><hr><div class="col-sm-4 control-label">* required fields</div>
                    </div>
                      <!-- aa -->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>