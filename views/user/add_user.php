<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    
    <?php if($this->session->flashdata('flash')): ?>
    
    <?php endif; ?>
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">User / Add</span>
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
            <a href="<?= base_url(); ?>user" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
            <div class="row"><br>
              <div class="col-md-8">
                <div class="demo-form-wrapper">
                  <form class="form form-horizontal" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Username*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Username" name="username" value="<?= set_value('username'); ?>" required>
                        <small class="form-text text-danger"><?= form_error('username');?></small>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-control-1">Password*</label>
                    <div class="col-sm-9">
                      <input id="form-control-1" class="form-control" type="password" placeholder="Password" name="password1" value="<?= set_value('password1'); ?>" required>
                      <small class="form-text text-danger"><?= form_error('password1');?></small>
                    </div>
                  </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label" for="form-control-1">Retype Password*</label>
                  <div class="col-sm-9">
                    <input id="form-control-1" class="form-control" type="password" placeholder="Retype Password" name="password2" value="<?= set_value('password2'); ?>" required>
                  </div>
                </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Nama Lengkap*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Isi Nama Lengkap" name="nama"value="<?= set_value('nama'); ?>" required>
                        <small class="form-text text-danger"><?= form_error('nama');?></small>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Nik*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Isi Nik" name="nik" value="<?= set_value('nik'); ?>" required>
                        <small class="form-text text-danger"><?= form_error('nik');?></small>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-control-1">Email*</label>
                    <div class="col-sm-9">
                      <input id="form-control-1" class="form-control" type="text" placeholder="example@gmail.com" name="email" value="<?= set_value('email'); ?>" required>
                      <small class="form-text text-danger"><?= form_error('email');?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-control-1">Jabatan*</label>
                    <div class="col-sm-9">
                      <input id="form-control-1" class="form-control" type="text" placeholder="Jabatan User" name="jabatan" value="<?= set_value('jabatan'); ?>" required>
                      <small class="form-text text-danger"><?= form_error('jabatan');?></small>
                    </div>
                 </div>
                  <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Pilihan*</label>
                          <div class="col-sm-9">
                            <select id="form-control-6" class="form-control" name="level" required>
                              <option value="">-- Silahkan Pilih --</option>
                              <option value="1">Admin</option>
                              <option value="2">SPV</option>
                              <option value="3">Checker</option>
                              <option value="4">Gudang</option>
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