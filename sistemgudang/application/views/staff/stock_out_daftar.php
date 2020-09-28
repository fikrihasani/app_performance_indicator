<form action="<?php echo site_url('barang/source_stock_in_daftar'); ?>" id='display-table'>
<!-- Main content -->
<section class="content">
    <div class="row">
			<a href="<?php echo site_url('barang/stock_out_input');?>"class="btn btn-primary ml-15">
			<i class="fa fa-box"></i> Tambah Stock Out
			</a><br><br>
        <div class="col-xs-12">			
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Filter</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <div class='col-md-6'>
                        <div class="form-group">
                          <label for="nama">Nama Item</label>
                          <input class="form-control" id="nama_barang" placeholder="Isi nama" type="text" name='full_name' style="width:250px;"/>
                        </div>
                        <div class="form-group">
                          <label for="nama">Shipper</label>
                          <select name='nama_shipper'  class="form-control" style="width:150px;">
                              <option value=''>Semua Jenis</option>
                              <?php
                                foreach($kategori as $key => $kat) {
                                    echo "<option value='$key'>$kat</option>";
                                }
                              ?>
                          </select>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class="form-group">
                          <label for="nama">Forwarder</label>
                          <input class="form-control" id="kode" placeholder="Kode" type="text" name='telepon' style="width:120px;"/>
                        </div>
                        <div class="form-group">
                          <label for="nama">Penerima</label>
                          <select name='id_satuan'  class="form-control" style="width:150px;">
                              <option value=''>Semua Jenis</option>
                              <?php
                                foreach($lokasi as $ke => $sat) {
                                    echo "<option value='$ke'>$sat</option>";
                                }
                              ?>
                          </select>
                        </div>

                    </div>
                    <div class='clearfix'></div>
                    <button type="button" class="btn btn-primary ml-15" id='select-filter'>Filter</button>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box">
				<div class="box-header with-border">
                  <h3 class="box-title">Riwayat Barang Keluar</h3>

                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php echo show_alert('message');?>
					
                    <table id="listed-table" class="table table-bordered table-striped mb-20" >
                        <thead>
                            <tr>
                                <th class="text-left">No</th>
                                <th class="text-left">Nama Item</th>
                                <th class="text-left">Jumlah</th>
                                <th class="text-left">Penerima Barang</th>
                                <th class="text-left">Waktu Keluar</th>
                                <th class="text-left">Aksi</th>		
                            </tr>
                        </thead>
                        <tbody align="center">
                            
                        </tbody>
                    </table>
                    <br class='clearfix'/>
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary active btn-sm prev-page" type="button"><i class="fa fa-angle-double-left "></i></button>
                        <button class="btn btn-primary btn-sm next-page" type="button"><i class="fa fa-angle-double-right"></i></button>
                    </div>
                    <input type='hidden' name='current_page' class='current-page' value='<?php echo (ISSET($page))? $page : '1'; ?>' />
                    <br class='clearfix'/>
                </div>
            </div>
		</div>
    </div>
</section>

</form>
