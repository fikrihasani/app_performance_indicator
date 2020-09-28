
<div class="login">
    <?= $this->session->flashdata('message');?>
      <div class="login-body">
        <a class="login-brand" href="index.html">
          <img class="img-responsive" src="<?= base_url();?>assets/img/angkasa.png" alt="Elephant">
        </a>
        <h3 class="login-heading">Sign in</h3>
        <div class="login-form">
          <form data-toggle="md-validator" method="post" action="<?= base_url();?>auth">
            <div class="md-form-group md-label-floating">
              <input class="md-form-control" type="text" name="username" spellcheck="false" autocomplete="off" data-msg-required="Please enter your username" value="<?= set_value('username'); ?>" required>
              <label class="md-control-label">Username</label>
            </div>
            <div class="md-form-group md-label-floating">
              <input class="md-form-control" type="password" value="<?= set_value('password'); ?>" name="password" minlength="5" data-msg-minlength="Password must be 5 characters or more." data-msg-required="Please enter your password." required>
              <label class="md-control-label">Password</label>
            </div>
            <div class="md-form-group md-custom-controls">
              <label class="custom-control custom-control-primary custom-checkbox">
                <input class="custom-control-input" type="checkbox" checked="checked">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-label">Keep me signed in</span>
              </label>
              <span aria-hidden="true"> · </span>
              <a href="<?= base_url(); ?>auth/forgotPassword">Forgot password?</a>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Sign in</button>
          </form>
        </div>
      </div>
    </div>