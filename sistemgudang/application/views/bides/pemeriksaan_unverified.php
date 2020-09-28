<form action="<?php echo site_url('checkup/source_pemeriksaan_unverified_list'); ?>" id='display-table'>
<!-- Main content -->
<section class="content">
	<?php echo show_alert('message'); ?>
    <div class="row">
		<?php
			if(!is_auth([1,3,4])) {
				echo"
					<a href='".site_url('checkup/pemeriksaan_input')."' class='btn btn-primary ml-15'>
					<i class='fa fa-file-o'></i> Tambah Pemeriksaan Baru
					</a><br><br>
				";
			}
		?>
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
                    <div class='col-md-4'>
                        <div class="form-group">
                          <label for="nama">Nama</label>
                          <input class="form-control" id="nama" placeholder="Max.25 Karakter" max="100" type="text" name='full_name' style="width:305px;"/>
                        </div>
                    </div>
                    <div class='col-md-2'>
						<div class="form-group">
                          <label for="nama">Status Verifikasi</label>
                          <select class="form-control" id="nama" name='status_verifikasi' style="width:140px;">
							<option value=''>Semua Status</option>
							<option value='0'>Menunggu Verifikasi</option>
							<option value='2'>Periksa Kembali</option>
						  </select>
                        </div>
                    </div>
					<div class='col-md-6'>
						<div class="form-group">
                          <label for="nama">Status Resiko</label>
                          <select class="form-control" id="nama" name='status_resiko' style="width:140px;">
							<option value=''>Semua Status</option>
							<option value='0'>Resiko Rendah</option>
							<option value='2'>Resiko Tinggi</option>
						  </select>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                    <button type="button" class="btn btn-primary ml-15" id='select-filter'>Filter</button>
                </div>
            </div>
            <!-- /.box-body -->
	   <div class="box">

		<!-- /.box-header -->
		<div class="box-body">
		  <table id="listed-table" class="table table-bordered table-striped" >
			<thead>
			<tr>
			  <th class="text-center">No</th>
			  <th class="text-center">Nama Ibu</th>
			  <th class="text-center">HPL</th>
			  <?php if(is_auth([3,4])){echo"<th class='text-center'>desa</th>";}?>
			  <th class="text-center">Status Resiko</th>
			  <th class="text-center">Status Verifikasi</th>
			  <th class="text-center">Aksi</th>
			</tr>
			</thead>
			<tbody align="center"></tbody>
		  </table>
          <br class='clearfix'/>
          <div class="btn-group pull-right">
              <button class="btn btn-primary active btn-sm prev-page" type="button"><i class="fa fa-angle-double-left "></i></button>
              <button class="btn btn-primary btn-sm next-page" type="button"><i class="fa fa-angle-double-right"></i></button>
          </div>
          <input type='hidden' name='current_page' class='current-page' value='1' />

          <br class='clearfix'/>
		</div>
		<!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<!-- page script -->
<script>
    $("#example2").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true
    });
</script>
</body>
</html>
