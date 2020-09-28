<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    
    <?php if($this->session->flashdata('flash')): ?>
    
    <?php endif; ?>
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Lost & Found / Add</span>
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
            <a href="<?= base_url(); ?>lost_found" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
            <div class="row"><br>
              <div class="col-md-8">
                <div class="demo-form-wrapper">
                  <form class="form form-horizontal" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Jenis Laporan*</label>
                          <div class="col-sm-9">
                            <select id="form-control-6" class="form-control" name="laporan" required>
                              <option value="">-- Pilih Jenis Laporan --</option>
                              <option value="Kehilangan">Kehilangan</option>
                              <option value="Penemuan">Penemuan</option>
                            </select>
                          </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Deskripsi*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Deskripsi Kehilangan / Penemuan" name="deskripsi" value="<?= set_value('deskripsi'); ?>" required>
                        <small class="form-text text-danger"><?= form_error('deskripsi');?></small>
                        </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Penemu / Pelapor*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Isi Penemu / Pelapor" name="penemu_pelapor" value="<?= set_value('penemu_pelapor'); ?>" required>
                        <small class="form-text text-danger"><?= form_error('penemu_pelapor');?></small>
                      </div>
                  </div>
                  <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Pilih Status*</label>
                          <div class="col-sm-9">
                            <select id="form-control-6" class="form-control" name="status" required>
                              <option value="">-- Silahkan Pilih --</option>
                              <option value="Belum Selesai">Belum Selesai</option>
                              <option value="Selesai">Selesai</option>
                            </select>
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-9">Photo</label>
                      <div class="col-sm-9">
                      <input id="form-control-9" type="file" accept="image/*" multiple="multiple" name="image">
                        <p class="help-block">
                        <small>Image file size must not exceed 700 kb. Allowed types: png gif jpg jpeg.</small>
                        </p>
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