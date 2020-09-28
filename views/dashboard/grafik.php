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
				<div id="chartContainer3" style="height: 300px; width: 100%;"></div>
				<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
				<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            <div class="row">
            <br>
              <div class="col-md-12">
                <div class="demo-form-wrapper">
                  <div class="form form-horizontal">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                  </div>
                  <script>
                      window.onload = function () {

                      var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light1", // "light1", "light2", "dark1", "dark2"
                        title: {
                          text: "<?= $nilai_area; ?> - <?= $nilai_subarea; ?> (HARI INI)"
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
                            { label: "Terpenuhi", y: <?= $nilai_bersih2; ?> },	
                            { label: "Tidak Terpenuhi", y: <?= $nilai_kotor2; ?> },	
                            
                          ]
                        }]
                      });

                      var chart2 = new CanvasJS.Chart("chartContainer2", {
                        animationEnabled: true,
                        theme: "light1", // "light1", "light2", "dark1", "dark2"
                        title: {
                          text: "<?= $nilai_area; ?> - <?= $nilai_subarea; ?>"
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
                      chart2.render();

                      }
                      </script>
                    <br>
                    <center><h4><a href="<?=base_url('dashboard')?>">Kembali</a></h4></center>  
                </div>
              </div>
                      <!-- Coba -->
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">

                <div class="card-body">
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
                        foreach ($hasil_query2 as $pp) {
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
                  </table>
                </div>
              </div>
            </div>
          </div>

                      <!-- AKhir -->
            </div>
            <br><br>
            <!-- CONTENT 2 -->
            <div class="row">
            <br>
              <div class="col-md-12">
                <div class="demo-form-wrapper">
                  <div class="form form-horizontal">
                    <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
                  </div>
                    <br>
                    <center><h4><a href="<?=base_url('dashboard')?>">Kembali</a></h4></center>  
                </div>
              </div>
                      <!-- Coba -->
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                    <button type="button" class="card-action card-remove" title="Remove"></button>
                  </div>
                  <strong>Daftar SCA & Dokumentasi</strong>
                </div>
                <div class="card-body">
                  <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered table-nowrap dataTable" cellspacing="0" width="100%">
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
                        foreach ($hasil_query as $p) {
                    ?>
                    <?php
                        $rowsubarea = $this->db->query('select * from subarea left join sca_dokumentasi on subarea.id  = '.$p['sub_area'])->row_array();
                        $rowarea = $this->db->query('select * from area left join sca_dokumentasi on area.id  = '.$p['area'])->row_array();
                    ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p['shift']; ?></td>
                        <td><?= $rowarea['nama']; ?></td>
                        <td><?= $rowsubarea['nama']; ?></td>
                        <td><?= $p['nilai'];?></td>
                        <td><?= $p['user'];?></td>
                        <td><?= $p['time'];?></td>
                        <td class="text-center"><img class="card-img" alt="..." src="<?= base_url('assets/upload/sca/') . $p['image']; ?>" width="80" height="80"></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- CONTENT 2-->
            </div>
                          <!-- AKHIR -->

          </div>
        </div>