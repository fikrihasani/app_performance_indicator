<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Complains / Add</span>
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
            <a href="<?= base_url();?>Complains" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
            <div class="row"><br>
              <div class="col-md-8">
                <div class="demo-form-wrapper">
                  <div class="form form-horizontal">
                  <!-- FORM -->
                  <?php echo form_open_multipart('complains/in_add'); ?>
                      <input type="text" hidden="" name="akun" value="<?= $user['nama']; ?>">
                      <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Area*</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="area" id='area'>
                              <option value="">--- Pilih Area ---</option>
                              <?php foreach($area as $p)
                                    { 
                              ?>
                                <option value="<?= $p['id'] ?>"><?= $p['nama']; ?></option>
                              <?php } ?>
                              

                            </select>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-6">Sub Area*</label>
                        <div class="col-sm-9">
                          <select class="form-control" id='subarea' name="subarea">
                            <option value="">--- Select ---</option>
                          </select>
                        </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-1">Complain*</label>
                      <div class="col-sm-9">
                        <input id="form-control-1" class="form-control" type="text" name="complain" placeholder="Isi Complain" value="<?= set_value('complain'); ?>" required>
                        <small class="form-text text-danger"><?= form_error('complain');?></small>
                      </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Stakeholder*</label>
                        <div class="col-sm-9">
                          <input id="form-control-1" class="form-control" type="text" name="stakeholder" placeholder="Isi Stakeholder" value="<?= set_value('stakeholder'); ?>" required>
                          <small class="form-text text-danger"><?= form_error('stakeholder');?></small>
                        </div>
                  </div>
                  <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Status*</label>
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
                  </div><?= form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>



         <!-- AJAX SELECT DINAMIS -->
         <script type="text/javascript">
           $(function(){

            $.ajaxSetup({
            type:"POST",
            url: "<?php echo base_url('complains/ambil_data') ?>",
            cache: false,
            });

            $("#area").change(function(){

            var value=$(this).val();
            if(value>0){
            $.ajax({
            data:{modul:'subarea',id:value},
            success: function(respond){
            $("#subarea").html(respond);
            }
            })
            }

            });


            })


         </script>