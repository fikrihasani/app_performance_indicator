<div class="layout-content">
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Materials / Edit</span>
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
                  <input type="text" hidden="" name="id" value="<?= $materials['id'];?>">
                  <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Nama Material*</label>
                        <div class="col-sm-9">
                          <input id="form-control-1" class="form-control" type="text" placeholder="Nama Material" name="standart" value="<?= $materials['standart']; ?>" required>
                          <small class="form-text text-danger"><?= form_error('standart');?></small>
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Standart*</label>
                        <div class="col-sm-9">
                          <input id="form-control-1" class="form-control" type="text" placeholder="Isi Standart" name="standart_pertanyaan" value="<?= $materials['standart_pertanyaan']; ?>" required>
                          <small class="form-text text-danger"><?= form_error('standart_pertanyaan');?></small>
                        </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="form-control-9">Photo</label>
                      <div class="col-sm-9">
                      <img src="<?= base_url('assets/upload/materials/') . $materials['image']; ?>" alt="" width="100" height="100"><br><br><input type="file" name="image" id="image">
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