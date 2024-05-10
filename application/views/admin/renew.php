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
    <title>App Installation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <!-- Dashboard Core -->
    <link href="assets/css/dashboard.css" rel="stylesheet" />
    <!-- c3.js Charts Plugin -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<style>
  .form-error {
    color:#aa1212;
  }
</style>
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col-md-4 mx-auto">
              <div class="text-center mb-4">
                <!-- <img src="./demo/brand/tabler.svg" class="h-6" alt=""> -->
              </div>
              <?php if($alert) : ?>
                <div class="alert alert-danger"><i class="fe fe-alert-triangle"></i> &nbsp;Product key was inavalid or expired.</div>
              <?php endif; ?>
              <form class="card" action="" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Activate Application</div>
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Activation Key</label>
                        <input type="text" class="form-control" data-validation="required" data-validation-error-msg="Please enter activation key.." name="data[key]" placeholder="Enter Activation Key..">
                      </div>
                    </div>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">NEXT</button>
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
