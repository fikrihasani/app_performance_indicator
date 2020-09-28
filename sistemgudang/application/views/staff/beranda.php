    <!-- Main content -->
    <section class="content">
	<div class="box">
                <div class="box-body">
			<!-- Small boxes (Stat box) -->
				<div class="row">
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-aqua">
					<div class="inner">
					  <h3><?php echo $jml_gudang;?></h3>
					  <p>Jumlah Gudang</p>
					</div>
					<div class="icon">
					  <i class="fa fa-building-o"></i>
					</div>
					<a href="<?php echo site_url('review/kehamilan_per_tahun');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-green">
					<div class="inner">
					  <h3><?php echo $jml_stock;?> Item</h3>
					  <p>Stock Tersimpan</p>
					</div>
					<div class="icon">
					  <i class="fa fa-archive"></i>
					</div>
					<a href="<?php echo site_url('checkup/kehamilan_berjalan_daftar');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-yellow">
					<div class="inner">
					  <h3><?php echo $jml_permintaan; ?></h3>

					  <p>Permintaan Barang</p>
					</div>
					<div class="icon">
					  <i class="fa fa-shopping-cart"></i>
					</div>
					<a href="<?php echo site_url('patient/ibu_daftar');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-red">
					<div class="inner">
					  <h3><?php echo $jml_penerimaan; ?></h3>

					  <p>Penerimaan Barang</p>
					</div>
					<div class="icon">
					  <i class="fa fa-truck"></i>
					</div>
					<a href="<?php echo site_url('review/kehamilan_per_tahun');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				</div>
				<!-- ./col -->
			  </div>
			  <!-- Main row -->
			</div>
		</div>
		<!-- Latest Order -->
		
		<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Request</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Penerima</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Call of Duty IV</td>
                    <td><span class="label label-success">Shipped</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">Yusuf</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-warning">Pending</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">Fadlil</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="label label-danger">Delivered</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">Iqbal</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-info">Processing</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00c0ef" data-height="20">Kevin</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-warning">Pending</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">Abrar</div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
      <div class="row">
        
      </div>
      <!-- /.row (main row) -->
	  </section>
    <!-- /.content -->
