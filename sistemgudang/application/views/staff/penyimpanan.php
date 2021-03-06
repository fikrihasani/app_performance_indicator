<form action="<?php echo site_url('barang/source_kategori_daftar'); ?>" id='display-table'>
<!-- Main content -->
<section class="content">
    <div class="row">
			<a href="<?php echo site_url('barang/penyimpanan_input');?>"class="btn btn-primary ml-15">
			<i class="fa fa-box"></i> Tambah Penyimpanan Baru
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
                          <label for="nama">Nama Penyimpanan</label>
                          <input class="form-control" id="nama_penyimpanan" placeholder="Isi Penyimpanan" type="text" name='full_name' style="width:250px;"/>
                        </div>
                        
                    </div>
                    <div class='clearfix'></div>
                    <button type="button" class="btn btn-primary ml-15" id='select-filter'>Filter</button>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box">
				<div class="box-header with-border">
                  <h3 class="box-title">Daftar Penyimpanan</h3>

                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php echo show_alert('message');?>
					
                    <table class="table table-bordered table-striped mb-20" >
                        <thead>
                            <tr>
                                <th class="text-left">No</th>
                                <th class="text-left">Nama Penympanan</th>
                                <th class="text-left">Kapasitas</th>
                                <th class="text-left bg-danger">Gudang</th>
                                <th class="text-left">Sisa</th>
                                <th class="text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <?php 
                                $no = 0;
                                foreach ($penyimpanan as $store) {
                            ?>
                                <tr>
                                    <td><?= $no+1 ?></td>
                                    <td><?= $store['nama_penyimpanan'] ?></td>
                                    <td><?= $store['kapasitas'] ?></td>
                                    <td><?= $store['id_gudang'] ?></td>
                                    <td><?= $store['sisa'] ?></td>
                                    <td><a class="btn btn-danger">Hapus</a></td>
                                </tr>
                            <?php
                                $no++;
                                } 
                            ?>
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
