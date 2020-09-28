<link rel="stylesheet" href="<?= base_url(); ?>assets/css/signup-2.min.css">

<div class="signup">
      <div class="signup-body">
          <a class="signup-brand" href="index.html">
            <center><img class="img-responsive" src="<?= base_url(); ?>assets/img/angkasa.png" alt="Elephant"></center>
            </a>
        <a href="index.html">
          <center><h4><?= $this->session->userdata('reset_email'); ?></h4></center>
        </a><br>
        <div class="signup-form">
          <form data-toggle="validator" method="post">
            <div class="row gutter-xs">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input id="password" class="form-control" placeholder="Enter New Password" type="password" name="password1">
                  <small class="form-text text-danger"><?= form_error('password1');?></small>
                </div>
              </div>
            </div>
            <div class="signup-form">
              <div data-toggle="validator" data-groups='{"birthdate": "birth_month birth_day birth_year"}'>
                <div class="row gutter-xs">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="password">Repeat Password</label>
                      <input id="password" class="form-control" placeholder="Repeat Password" type="password" name="password2">
                      <small class="form-text text-danger"><?= form_error('password2');?></small>
                    </div>
                  </div>
                </div>
            <button class="btn btn-primary btn-block" type="submit">Change Password</button>
          </form>
        </div>
      </div>
    </div>