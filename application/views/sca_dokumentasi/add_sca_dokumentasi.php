<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">SCA & Dokumentasi / Add</span>
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
            <a href="<?= base_url();?>sca_dokumentasi" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
            <div class="row"><br>
              <div class="col-md-12">
                <div class="demo-form-wrapper">
                  <div class="form form-horizontal">
                  <!-- FORM -->
                  <form action="<?php base_url('sca_dokumentasi/in_add') ?>" method="post" enctype="multipart/form-data" >
                      <input type="text" hidden="" name="akun" value="<?= $user['nama']; ?>" length="50">
                      <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Shift*</label>
                          <div class="col-sm-6">
                            <select id="shift" class="form-control" name="shift" required rows="5">
                              <option value="">-- Silahkan Pilih --</option>
                              <option value="Pagi">Pagi</option>
                              <option value="Siang">Siang</option>
                              <option value="Malam">Malam</option>
                            </select>
                          </div>
                  </div>
                      <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Area*</label>
                          <div class="col-sm-6">
                          <select class="form-control" name="id_area" id="area"  required>
                            <option value="" style="display:none;">Silakan pilih area</option>
                            <?php
                              $quer = $this->db->query('select * from area order by id asc');
                              foreach($quer->result_array() as $r) {
                                echo '<option value="'.$r['id'].'">'.strtoupper($r['nama']).'</option>';
                              }
                              ?>
                          </select>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-6">Sub Area*</label>
                        <div class="col-sm-6">
                          <select class="subarea form-control" name="id_subarea" id="sub_area" required>
									          <option value="" style="display:none;">Silakan pilih area terlebih dahulu</option>
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
                  <div class="form form-horizontal">   
                      <div class="form-group">
                        <div id="question"></div>
                      </div>
                  </div>
                  <div class="form-group">
                        <div class="col-sm-4 control-label">
                          <input class="btn btn-primary" type="submit" name="btn" value="Save">   
                          </form>   
                        </div>
                        <br><br><hr><div class="col-sm-4 control-label">* required fields</div>
                 </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

         <!-- AJAX SELECT DINAMIS -->
         <script type="text/javascript">
           $(document).ready(function(){
		
            $('#area').change(function(){
              var id=$(this).val();
              $.ajax({
                url : "<?php echo base_url();?>sca_dokumentasi/get_subarea",
                method : "POST",
                data : {id: id},
                async : false,
                    dataType : 'json',
                success: function(data){
                  var html = '';
                  var i;
                  html += '<option style="display:none;" value="">Silahkan Pilih Sub Area</option>';
                        for(i=0; i<data.length; i++){
                            html += '<option value="'+data[i].id+'" >'+data[i].nama+'</option>';
                        }
                        $('.subarea').html(html);
                  
                }
              });
            });

            $("#sub_area").change(function(){
              var idsub = $("#sub_area").val();
              var dataSub = 'id='+idsub;
              
              $.ajax({
                url	: '<?php echo base_url();?>sca_dokumentasi/get_question',
                data	: dataSub,
                type	: 'POST',
                dataType: 'html',
                success	: function(data){
                    $("#question").html(data);
                  }
              });
            });


          });

         </script>