<!-- MAIN CONTENT -->
<div class="layout-content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
  
  <?php if($this->session->flashdata('flash')): ?>
   
  <?php endif; ?>
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">My Profile</span>
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
          <div class="row gutter-xs">
            <div class="col-xs-12">
            <div class="container-fluid">
              <!-- Page Heading -->
              <div class="container-fluid">
              <div class="card mb-3 col-lg-8">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img class="card-img" alt="..." src="<?= base_url('assets/upload/profile/') . $user['image']; ?>" width="200" height="250">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h4 class="card-title"><?= $user['nama']; ?></h4>
                    <h6 class="card-text"><?= $user['username']; ?></h6>
                    <h6 class="card-text"><?= $user['jabatan']; ?></h6>
                    <h6 class="card-text"><?= $user['email']; ?></h6><br>
                    <p class="card-text"><small class="text-muted">Member since </small> <?=  (date_convert(get_date($user['create_date']))); ?></p><br><br>
                    <a href="<?= base_url(); ?>profile/edit" class="btn btn-danger"><span class="icon icon-pencil-square-o"></span>Edit Profile</a> | 
                    <a href="<?= base_url(); ?>profile/change_password" class="btn btn-danger"><span class="icon icon-pencil-square-o"></span>Change Password</a>
                  </div>
                </div>
              </div>
              </div>
        
              </div>
              <!--  -->
            </div>
          </div>
        </div>
      </div>