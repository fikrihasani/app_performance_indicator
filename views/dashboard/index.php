<!-- Link -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<div class="layout-content">
          <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib"><span class="icon icon-bar-chart-o"></span> SCA STATS</span>
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
            <div class="row">
            <br><br>
            <div class="col-xs-12">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div><br><br><br><br>
            <script>
                      window.onload = function () {

                      var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light1", // "light1", "light2", "dark1", "dark2"
                        title: {
                          text: "SEMUA AREA - SEMUA SUBAREA (HARI INI)"
                        },
                        axisY: {
                          title: "Presentase (dalam %)",
                          suffix: "%",
                          includeZero: false
                        },
                        axisX: {
                          title: "Semua"
                        },
                        data: [{
                          type: "column",
                          yValueFormatString: "#,##0.0#\"%\"",
                          dataPoints: [
                            { label: "Terpenuhi", y: <?= $nilai_bersih; ?> },	
                            { label: "Tidak Terpenuhi", y: <?= $nilai_kotor; ?> },	
                            
                          ]
                        }]
                      });

                      chart.render();
                      }
                      </script>
                              <table class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Shift</th>
                                    <th>Area</th>
                                    <th>Sub Area</th>
                                    <th>Nilai</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Tanggal</th>
                                    <th>Photo</th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                    <th>No</th>
                                    <th>Shift</th>
                                    <th>Area</th>
                                    <th>Sub Area</th>
                                    <th>Nilai</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Tanggal</th>
                                    <th>Photo</th>
                                  </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                    $no = 1;
                                    foreach ($hasil_query as $pp) {
                                ?>
                                <?php
                                    $rowsubarea2 = $this->db->query('select * from subarea left join sca_dokumentasi on subarea.id  = '.$pp['sub_area'])->row_array();
                                    $rowarea2 = $this->db->query('select * from area left join sca_dokumentasi on area.id  = '.$pp['area'])->row_array();
                                ?>
                                  <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $pp['shift']; ?></td>
                                    <td><?= $rowarea2['nama']; ?></td>
                                    <td><?= $rowsubarea2['nama']; ?></td>
                                    <td><?= $pp['nilai'];?></td>
                                    <td><?= $pp['user'];?></td>
                                    <td><?= $pp['time'];?></td>
                                    <td class="text-center"><img class="card-img" alt="..." src="<?= base_url('assets/upload/sca/') . $pp['image']; ?>" width="80" height="80"></td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>   <br><hr>                     
            </div>
    
                                  <!-- AKhir -->
                        <br><br>
                <!-- AKHIR ROW-->



            <!-- BATES -->
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
                  <form action="<?php base_url('dashboard') ?>" method="post" enctype="multipart/form-data" >
                      <input type="text" hidden="" name="akun" value="<?= $user['nama']; ?>" length="50">
                      <div class="form-group">
                          <label class="col-sm-3 control-label" for="form-control-6">Shift*</label>
                          <div class="col-sm-6">
                            <select id="shift" class="form-control" name="shift" required rows="5">
                              <option value="">-- Silahkan Pilih --</option>
                              <option value="semua">Semua</option>
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
                            <option value="99">SEMUA AREA</option>
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
                        <label class="col-sm-3 control-label" for="form-control-1">Tanggal Awal</label>
                        <div class="col-sm-6">
                          <input id="form-control-1" class="form-control" type="date" name="tgl" value="">
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-control-1">Tanggal Akhir</label>
                        <div class="col-sm-6">
                          <input id="form-control-1" class="form-control" type="date" name="tgl_akhir" value="">
                        </div>
                  </div>
                  <div class="form-group">
                        <div class="col-sm-6 control-label">
                          <input class="btn btn-success" type="submit" name="btn" value="Tampilkan">   
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
                            if(id==99) {
                              html += '<option value="all" >SEMUA SUBAREA</option>';
                            } else {
                              html += '<option value="all" >SEMUA SUBAREA</option>';
                                for(i=0; i<data.length; i++){
                              html += '<option value="'+data[i].id+'" >'+data[i].nama+'</option>';
                            }
                            }
                        
                        $('.subarea').html(html);
                  
                }
              });
            });


          });
        </script>
