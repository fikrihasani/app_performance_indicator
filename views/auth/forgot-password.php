<div class="login">
    <?= $this->session->flashdata('message');?>
      <div class="login-body">
        <a class="login-brand" href="index.html">
          <img class="img-responsive" src="<?= base_url(); ?>assets/img/angkasa.png" alt="Angkasa Pura">
        </a>
        <div class="login-form">
          <form data-toggle="validator" method="post" action="<?= base_url(); ?>auth/forgotPassword">
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" class="form-control" type="email" name="email" spellcheck="false" autocomplete="off" data-msg-required="Please enter your email address." required>
              <p class="help-block">
                <small>If you've forgotten your password, we'll send you an email to reset your password.</small>
              </p>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Send password reset email</button><br>
            <center><a href="<?= base_url(); ?>auth">Back to login</a></center>
          </form>
        </div>
      </div>
    </div>