<!-- Main content -->
<?php
    $last = show_alert('last_posting');
?>
<section class="content">
    <div class="box box-default">
        <form action="<?php echo $action;?>" method="POST" class='form-horizontal'>
        <div class="box-header with-border">
            <h3 class="box-title">Data Requester</h3>
        </div>
        <div class="box-body">
            <?php echo show_alert('message'); ?>
            <div class='col-md-6'>
                        <div class="form-group">
                          <label for="nama">Nama Pengambil</label>
                          <input class="form-control" id="nama_barang" placeholder="Pengambil" type="text" name='full_name' style="width:250px;"/>
                        </div>
                        <div class="form-group">
                          <label for="nama">Id Stok</label>
                          <input class="form-control" id="nama_barang" placeholder="ID Stock" type="text" name='full_name' style="width:250px;"/>
                        </div>
                    </div>
            <div class='col-md-6'>
                        <div class="form-group">
                          <label for="nama">Tanggal</label>
                          <input class="form-control" id="nama_barang" placeholder="Tanggal" type="text" name='full_name' style="width:250px;"/>
                        </div>
                        <div class="form-group">
                          <label for="nama">Penerima</label>
                          <input class="form-control" id="nama_barang" placeholder="Penerima" type="text" name='full_name' style="width:250px;"/>
       </div>
		</form>
   </div>



                </div>
    </div>
        

    <!-- / box ibu -->
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Barang Keluar</h3>
      <!-- <?php var_dump($this->session->userdata('transaksi')) ?> -->
		</div>
		<div class="box-body">
            <form action="<?php echo site_url('barang/cek_stock_out');?>" method="POST" class='form-horizontal'>
            <?php echo show_alert('message'); ?>
            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">ID Stock</label>
                  <div class="col-sm-3">
                        <input type="text" name="id_stock" class="form-control" required placeholder="" value="<?php echo (ISSET($barang['id_stock']))? $barang['id_stock'] : ''; ?>" style="max-width:300px;" maxlength="25" >
                  </div>
				  <div class="col-sm-7">
						<button type="submit" class="btn btn-primary">Cari</button>
                  </div>
            </div>
			</form>
			<form class='form-horizontal' method="POST" action="<?php echo site_url('barang/add_stock_out');?>">
			<div class="form-group">
        <input type="hidden" name="id_stocks" value="<?= (ISSET($barang['id_stock']) ? $barang['id_stock'] : '') ?>">
        <input type="hidden" name="stock" value="<?= (ISSET($barang['stock']) ? $barang['stock'] : '') ?>">
				<label for="inputEmail3" class="col-sm-2 control-label">Nama Barang</label>
				<div class="col-sm-10">
                <input class="form-control" value='<?php echo (ISSET($barang['nama_barang']))? $barang['nama_barang'] : ''; ?>' type="text" name='nama_barang' style="max-width:300px;" maxlength="25"/>
				</div>
			</div>
			<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jumlah</label>
                  <div class="col-sm-10">
                        <input type="number" name="jumlah" class="form-control" required placeholder="Angka" value="<?php echo (ISSET($last['jumlah']))? $last['jumlah'] : ''; ?>" style="max-width:300px;" maxlength="25">
                  </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Lokasi Penyimpanan</label>
				<div class="col-sm-10">
                <input class="form-control" value='<?php echo (ISSET($barang['nama_penyimpanan']))? $barang['nama_penyimpanan'] : ''; ?>' type="text" name='nama_penyimpanan' style="max-width:300px;" maxlength="25"/>
				</div>
			</div>
		</div>
        <div class="box-footer">
			<!-- <a href="<?php echo site_url('barang/barang_daftar');?>" class="btn btn-small btn-danger">Batalkan</a> -->
            <button type="submit" class="btn btn-primary pull-right">Tambah</button>
        </div>
        </form>
	</div>
    <!-- daftar barang keluar -->
     <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Daftar Baraang Keluar</h3>
                  <?= var_dump($this->session->userdata('updater')) ?>

                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    
                    <table  class="table table-bordered table-striped mb-20" >
                        <thead>
                            <tr>
                                <th class="text-left">No</th>
                                <th class="text-left">ID Stock</th>
                                <th class="text-left">Nama Barang</th>
                                <th class="text-left">Jumlah</th>
                                <!-- <th class="text-left">Nama Penyimpanan</th> -->
                                <th style="width: 150px;" class="text-left">Option</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                          <?php
                            $no = 0;
                            foreach ($this->session->userdata('transaksi') as $transaksi) {

                            
                          ?>
                            <tr>
                              <td><?= $no+1 ?></td>
                              <td><?= $transaksi['id_stock'] ?></td>
                              <td><?= $transaksi['nama_barang'] ?></td>
                              <td><?= $transaksi['jumlah'] ?></td>
                              <td><a class="btn btn-danger" href="<?= site_url() ?>/barang/delete_item_transaksi?id=<?= $no ?>">Hapus</a></td>
                            </tr>

                            <?php
                              $no += 1;
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
                <form method="POST" action="<?php  echo site_url('barang/transaksi') ?>">
                <a href="<?php echo site_url('barang/barang_daftar');?>" class="btn btn-small btn-danger">Batalkan</a>
                <!-- <form method="POST" action="<?php  echo site_url('barang/transaksi') ?>"> -->
                  <button type="submit" class="btn btn-success pull-right">TRANSAKSI</button>
                </form>
</section>
