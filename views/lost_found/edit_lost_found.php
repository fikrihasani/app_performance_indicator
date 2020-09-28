<div class="layout-content">
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Lost & Found / Edit</span>
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
                  <input type="text" hidden="" name="id" value="<?= $lost_found['id'];?>">
                      <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Jenis Laporan*</label>
                          <div class="col-sm-9">
                            <select id="form-control-6" class="form-control" name="laporan" required>
                            <?php foreach($jns_laporan as $a): ?>
                                <?php if($a == $lost_found['status']): ?>
                                    <option value="<?= $a; ?>" selected><?= $a; ?></option>
                                <?php else : ?>
                                    <option value="<?= $a; ?>"><?= $a; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                          </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Deskripsi*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Deskripsi Kehilangan / Penemuan" name="deskripsi" value="<?= $lost_found['deskripsi']; ?>" required>
                        <small class="form-text text-danger"><?= form_error('deskripsi');?></small>
                        </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Penemu / Pelapor*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Isi Penemu / Pelapor" name="penemu_pelapor" value="<?= $lost_found['penemu']; ?>" required>
                        <small class="form-text text-danger"><?= form_error('penemu_pelapor');?></small>
                      </div>
                  </div>
                  <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Pilih Status*</label>
                          <div class="col-sm-9">
                            <select id="form-control-6" class="form-control" name="status" required>
                            <?php foreach($status as $j): ?>
                                <?php if($j == $lost_found['status']): ?>
                                    <option value="<?= $j; ?>" selected><?= $j; ?></option>
                                <?php else : ?>
                                    <option value="<?= $j; ?>"><?= $j; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </select>
                          </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-9">Photo</label>
                      <div class="col-sm-9">
                      <img src="<?= base_url('assets/upload/lost_found/') . $lost_found['image']; ?>" alt="" width="100" height="100"><br><br><input type="file" name="image" id="image">
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