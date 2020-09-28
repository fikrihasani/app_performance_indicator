<div class="layout-content">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Pertanyaan / Edit</span>
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
            <a href="<?= base_url();?>pertanyaan" class="btn btn-danger"><span class="icon icon-arrow-left"></span> Back</a>
            <div class="row"><br>
              <div class="col-md-12">
                <div class="demo-form-wrapper">
                  <div class="form form-horizontal">
                  <?php if ($this->session->flashdata('danger')): ?>
                    <div class="form-group">
                       <label class="col-sm-3 control-label" for="form-control-3"></label>
                          <div class="col-sm-6">
                          <div class="alert alert-danger text-center" role="alert">
                            <?php echo $this->session->flashdata('danger'); ?>
                          </div>
                          </div>
                      </div>
                      <?php endif; ?>

                  <!-- FORM -->
                  <form class="form form-horizontal" method="post">
                      <div class="form-group">
                      <input type="text" hidden="" name="id_area" value="<?= $pertanyaan['id_area']; ?>">
                      <input type="text" hidden="" name="id_subarea" value="<?= $pertanyaan['id_subarea']; ?>">
                          <label class="col-sm-3 control-label" for="form-control-6">Area*</label>
                          <div class="col-sm-6">
                          <select class="form-control" name="a" id="area" disabled>
                          <?php foreach($area as $p)
                                    { 
                              ?>
                                <?php if($pertanyaan['id_area'] == $p['id']): ?>
                                        <option value="<?= $p['id']; ?>" selected><?= $p['nama']; ?></option>
                                <?php else: ?>
                                        <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
                                <?php endif; ?>
                                
                              <?php } ?>
                          </select>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-6">Sub Area*</label>
                        <div class="col-sm-6">
                          <select class="subarea form-control" name="b" id="sub_area" disabled>
                          <?php foreach($subarea as $s)
                                    { 
                              ?>
                                <?php if($pertanyaan['id_subarea'] == $s['id']): ?>
                                        <option value="<?= $s['id']; ?>" selected><?= $s['nama']; ?></option>
                                <?php else: ?>
                                        <option value="<?= $s['id']; ?>"><?= $s['nama']; ?></option>
                                <?php endif; ?>
                                
                              <?php } ?>
							          	</select>
                        </div>
                  </div><br>
                  <div class="form form-horizontal">   
                      <div class="form-group">
                        <!-- MULAI -->
                       <div class="row gutter-xs">
                      <div class="col-xs-12">
                        <div class="card">
                  <div class="card-header">
                  <div class="card-actions">
                  <button type="button" class="card-action card-toggler" title="Collapse"></button>
                  <button type="button" class="card-action card-reload" title="Reload"></button>
                  <button type="button" class="card-action card-remove" title="Remove"></button>
                  </div>
                  <strong>Daftar Material</strong>
                  </div>
                  <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                  <th>No</th>
                  <th width="120">Nama Material</th>
                  <th>Standart</th>
                  <th width="20">Ya</th>
                  <th>Tidak</th>
                  </tr>
                  </thead>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                  <th>Nama Material</th>
                  <th>Standart</th>
                  <th>Ya</th>
                  <th>Tidak</th>
                  </tr>
                  </tfoot>
                  <tbody>
                  <?php 
                  $n = 1;
                  foreach($tanya as $row) { ?>
                          <tr>
                          <td><?= $n++; ?></td>
                          <td><?= $row->standart ?></td>
                          <td><?= $row->standart_pertanyaan ?></td>
                          <input type="hidden" class="form-control" name="item[<?= $n; ?>][id]" value="<?= $row->id ?>">
                          <td><input type="radio" name="item[<?= $n; ?>][jawaban]" value="Ya" 
                          <?php
                            $k = $pertanyaan['id_subarea'];
                            $tanya2 = $this->db->query("select * from pertanyaan where id_subarea='$k'")->result_array();
                             $cek=0;

                            foreach($tanya2 as $m){
                              if($row->id == $m['id_material']){
                                echo 'checked';
                                $cek=2;
                              }
                            }

                          ?>
                          ></td>
                          <td><input type="radio" name="item[<?= $n; ?>][jawaban]" value="Tidak" 
                           <?php
                              if($cek!=2){
                                echo 'checked';
                              }
                          ?>
                          ></td>
                          </tr>
                  <?php } ?>
                  </tbody>
                  </table>
                        </div>
                  </div>
                  </div>
                  </div>

                        <!-- AKHIR -->
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
                url : "<?php echo base_url();?>Pertanyaan/get_subarea",
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

          });

         </script>