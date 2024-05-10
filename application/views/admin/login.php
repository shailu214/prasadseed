<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Login Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <!-- Dashboard Core -->
    <link href="<?=base_url()?>assets/css/dashboard.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/custom.css" rel="stylesheet" />
    <!-- c3.js Charts Plugin -->
    <script src="<?=base_url()?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<style>
  .form-error {
    color:#aa1212;
  }
</style>
  </head>
  <body class="">
    <?=$this->session->flashdata('notify')?>
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                  <h2>
                <img src="<?=base_url()?>media/config/<?=LOGO?>" alt="<?=COM_NAME?>" class="h-8" alt="">
                </h2>
              </div>
              <?php if($alert) : ?>
                <div class="alert alert-danger"><i class="fe fe-alert-triangle"></i> &nbsp;Sorry Invalid username or password.</div>
              <?php endif; ?>
              <form class="card" action="" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" data-validation="required" <?=($this->session->flashdata('dact'))? 'disabled="disabled"' : ''?> data-validation-error-msg="Please enter username.." name="username" placeholder="Enter Username..">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                      <!--<a href="./forgot-password.html" class="float-right small">I forgot password</a>-->
                    </label>
                    <input type="password" name="password" <?=($this->session->flashdata('dact'))? 'disabled="disabled"' : ''?> class="form-control" data-validation="required" data-validation-error-msg="Please enter password.." placeholder="Enter Password..">
                  </div>
                  <!-- <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Remember me</span>
                    </label>
                  </div> -->
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block" <?=($this->session->flashdata('dact'))? 'disabled="disabled"' : ''?>>Sign in</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    $(document).ready(function(){
      $.validate();
    });
    </script>
  </body>
</html>
