<div class="layout-content">
  <div class="layout-content-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    
    <?php if($this->session->flashdata('flash')): ?>
    
    <?php endif; ?>
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Materials / Add</span>
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
            <a href="<?= base_url(); ?>materials" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
            <div class="row"><br>
              <div class="col-md-8">
                <div class="demo-form-wrapper">
                  <form class="form form-horizontal" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Nama Material*</label>
                        <div class="col-sm-9">
                          <input id="form-control-1" class="form-control" type="text" placeholder="Nama Material" name="standart" required>
                          <small class="form-text text-danger"><?= form_error('standart');?></small>
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Standart*</label>
                        <div class="col-sm-9">
                          <input id="form-control-1" class="form-control" type="text" placeholder="Isi Standart" name="standart_pertanyaan" required>
                          <small class="form-text text-danger"><?= form_error('standart_pertanyaan');?></small>
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