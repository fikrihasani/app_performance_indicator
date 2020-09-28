<div class="layout-content">
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Profile / Change Password</span>
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
            <a href="<?= base_url(); ?>profile" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a><br><br>
            <div class="row"><br>
              <div class="col-md-8">
              <?= $this->session->flashdata('message');?>
                <div class="demo-form-wrapper">
                  <div class="form form-horizontal"> 
                  <?php echo form_open_multipart('profile/change_password');?>
                    <!--  -->
                  
                    <div class="form-group">
                    <label class="col-sm-3 control-label" for="form-control-1">Current Password*</label>
                    <div class="col-sm-9">
                      <input id="form-control-1" class="form-control" type="password" placeholder="Current Password" name="current_password" value="<?= set_value('current_password'); ?>">
                      <small class="form-text text-danger"><?= form_error('current_password');?></small>
                    </div>
                  </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label" for="form-control-1">New Password*</label>
                  <div class="col-sm-9">
                    <input id="form-control-1" class="form-control" type="password" placeholder="New Password" name="new_password1" value="<?= set_value('new_password1'); ?>">
                    <small class="form-text text-danger"><?= form_error('new_password1');?></small>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="form-control-1">Repeat Password*</label>
                  <div class="col-sm-9">
                    <input id="form-control-1" class="form-control" type="password" placeholder="Repeat Password" name="new_password2" value="<?= set_value('new_password2'); ?>">
                    <small class="form-text text-danger"><?= form_error('new_password2');?></small>
                  </div>
                </div>
                    <div class="form-group">
                        <div class="col-sm-4 control-label">
                          <input class="btn btn-primary" type="submit" value="Save">
                        </div>
                        <br><br><hr><div class="col-sm-4 control-label">* required fields</div>
                    </div>
                      <!-- aa -->
                  </div></form>
                </div>
              </div>
            </div>
          </div>
        </div>