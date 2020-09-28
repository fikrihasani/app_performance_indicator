<div class="layout-content">
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Profile / Edit Profile</span>
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
            <a href="<?= base_url(); ?>profile" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
            <div class="row"><br>
              <div class="col-md-8">
                <div class="demo-form-wrapper">
                  <div class="form form-horizontal"> 
                  <?php echo form_open_multipart('profile/edit'); ?>
                    <!--  -->
                  
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Username*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Username" name="username" value="<?= $user['username']; ?>" readonly>
                        <small class="form-text text-danger"><?= form_error('username');?></small>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Nama Lengkap*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Isi Nama Lengkap" name="nama" value="<?= $user['nama']; ?>">
                        <small class="form-text text-danger"><?= form_error('nama');?></small>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Nik*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Isi Nik" name="nik" value="<?= $user['nik']; ?>">
                        <small class="form-text text-danger"><?= form_error('nik');?></small>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-control-1">Email*</label>
                    <div class="col-sm-9">
                      <input id="form-control-1" class="form-control" type="text" placeholder="example@gmail.com" name="email" value="<?= $user['email']; ?>" readonly>
                      <small class="form-text text-danger"><?= form_error('email');?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-control-1">Jabatan*</label>
                    <div class="col-sm-9">
                      <input id="form-control-1" class="form-control" type="text" placeholder="Jabatan User" name="jabatan" value="<?= $user['jabatan']; ?>">
                      <small class="form-text text-danger"><?= form_error('jabatan');?></small>
                    </div>
                 </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-9">Photo</label>
                      <div class="col-sm-9">
                      <img src="<?= base_url('assets/upload/profile/') . $user['image']; ?>" alt="" width="100" height="100"><br><br><input type="file" name="image" id="image">
                        <p class="help-block">
                          <small>Image file size must not exceed 700 kb. Allowed types: png gif jpg jpeg.</small>
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 control-label">
                          <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                        <br><br><hr><div class="col-sm-4 control-label">* required fields</div>
                    </div>
                      <!-- aa -->
                  </div><?= form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>