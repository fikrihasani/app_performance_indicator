<form action="<?php echo site_url('doctor/source_user_list'); ?>" id='display-table'>
<!-- Main content -->
<section class="content">
    <div class="row">
			<a href="<?php echo site_url('doctor/user_input');?>"class="btn btn-primary ml-15">
			<i class="fa fa-user"></i> Tambah Pengguna
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
                          <label for="nama">Nama</label>
                          <input class="form-control" id="nama" placeholder="Nama" type="text" name='full_name' style="width:250px;"/>
                        </div>
                        <div class="form-group">
                          <label for="nama">Username</label>
                          <input class="form-control" id="nama" placeholder="Username" type="text" name='username' style="width:250px;"/>
                        </div>

                    </div>
                    <div class='col-md-6'>
                        <div class="form-group">
                          <label for="nama">Telepon</label>
                          <input class="form-control" id="nama" placeholder="Telepon" type="text" name='telepon' style="width:120px;"/>
                        </div>
                        <div class="form-group">
                          <label for="nama">Level</label>
                          <select name='level'  class="form-control" style="width:120px;">
                              <option value=''>Semua Level</option>
                              <?php

                                foreach($level as $key => $lvl) {
                                    echo "<option value='$key'>$lvl</option>";
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
                  <h3 class="box-title">Daftar Pengguna</h3>

                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php echo show_alert('message');?>
					
                    <table id="listed-table" class="table table-bordered table-striped mb-20" >
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Telepon</th>
                                <th class="text-center">Hak Akses</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
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
