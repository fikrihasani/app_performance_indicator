<div class="layout-content">
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Sub Area / Edit</span>
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
            <a href="<?= base_url(); ?>subarea" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
            <div class="row"><br>
              <div class="col-md-8">
                <div class="demo-form-wrapper">
                  <form class="form form-horizontal" method="post">
                  <input type="text" hidden="" name="id" value="<?= $subarea['id'];?>">
                  <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Area*</label>
                          <div class="col-sm-9">
                            <select id="form-control-6" class="form-control" name="area" required>
                              <?php
                                    foreach($area as $s){
                              ?>
                                    <?php if($subarea['id_area'] == $s['id']): ?>
                                        <option value="<?= $s['id']; ?>" selected><?= $s['nama']; ?></option>
                                    <?php else: ?>
                                        <option value="<?= $s['id']; ?>"><?= $s['nama']; ?></option>
                                    <?php endif; ?>
                                
                              <?php } ?>
                            </select>
                          </div>
                  </div>  
                  <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Sub Area*</label>
                        <div class="col-sm-9">
                          <input id="form-control-1" class="form-control" type="text" placeholder="Isi Sub Area" name="nama" value="<?= $subarea['nama']; ?>" required>
                          <small class="form-text text-danger"><?= form_error('subarea');?></small>
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Tag NFC*</label>
                        <div class="col-sm-9">
                          <input id="form-control-1" class="form-control" type="text" placeholder="Isi Sub Area" name="nfc" value="<?= $subarea['tag']; ?>" required>
                          <small class="form-text text-danger"><?= form_error('nfc');?></small>
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