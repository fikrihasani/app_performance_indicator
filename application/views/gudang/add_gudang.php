<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    
    <?php if($this->session->flashdata('flash')): ?>
    
    <?php endif; ?>
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Stok Gudang / Add</span>
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
            <a href="<?= base_url(); ?>gudang" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
            <div class="row"><br>
              <div class="col-md-8">
                <div class="demo-form-wrapper">
                  <form class="form form-horizontal" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Nama Barang*</label>
                        <div class="col-sm-9">
                          <input id="form-control-1" class="form-control" type="text" placeholder="Isi Nama Barang" name="nama_barang" value="<?= set_value('nama_barang'); ?>" required>
                          <small class="form-text text-danger"><?= form_error('nama_barang');?></small>
                        </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Stok Barang*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" placeholder="Isi Stok Barang" name="stok_barang" value="<?= set_value('stok_barang'); ?>" required>
                        <small class="form-text text-danger"><?= form_error('stok_barang');?></small>
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