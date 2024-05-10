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
    <title>Check Student Status</title>
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
                <img src="media/config/logo.png" class="h-8" alt="">
              </div>
              <div class="card" style="padding:15px;">
                <center>
                  <h4 class="text-blue" style="margin-bottom:0px">STUDENT STATUS</h4>
                  <hr style="margin-top:10px">
                  <?php if($status == 1) { ?>
                  <i class="fe fe-check-circle text-green" style="font-size:60px;"></i>
                  <h2 class="text-green">ACTIVE</h2>
                <?php } else { ?>
                  <i class="fe fe-alert-triangle text-red" style="font-size:60px;"></i>
                  <h2 class="text-red">SUSPEND</h2>
                <?php  } ?>
                  <hr>
                  <img src="<?=base_url()?>media/student/<?=$image?>" width="50" style="border-radius:100%"/> &nbsp; &nbsp; &nbsp; <b> Name : <?=$fname.' '.$lname?></b>
                </center>
              </div>
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
