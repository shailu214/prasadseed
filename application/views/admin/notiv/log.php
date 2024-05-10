

      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">
                <?php if($alert ==1) : ?>
                  <div class="alert alert-success"><i class="fe fe-check"></i> &nbsp;SMS Sent Successfully</div>
                <?php elseif ($alert == 2) : ?>
                  <div class="alert alert-success"><i class="fe fe-check"></i> &nbsp;Email Sent Successfully</div>
                <?php elseif ($alert == 3) : ?>
                  <div class="alert alert-success"><i class="fe fe-check"></i> &nbsp;Student are blocked successfully</div>
                <?php endif; ?>
                <form method="post"  >
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;"><i class="fe fe-list"></i>&nbsp; Block Student Log
                      <span class="pull-right">
                        <div class="form-input">
                          <input type="text" name="code" class="form-control pull-left" value="<?=$_SESSION['lg_code']?>" style="width:180px;" placeholder="Search by code..">
                          <button class="btn btn-primary pull-right">Search</button>
                        </div>
                      </span>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Student Code</th>
                          <th>Remark</th>
                          <th>Created</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($result as $key => $val ) { $sn++;?>
                        <tr>
                          <td> <?=$sn?> </td>
                          <td> <?=$val['codes']?>  </td>
                          <td> <?=$val['msg']?>  </td>
                          <td> <?=date("d-m-Y", strtotime($val['created']))?>  </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="4" align="right">
                            <nav aria-label="Page navigation example">
                              <?=$pages?>
                            </nav>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </form>

              </div>
            </div>
        </div>
      </div>

      <div class="notidiv">
        <i class="fe fe-check"></i> &nbsp; &nbsp;
        <span id="ntxt"></span>
      </div>
<script>
  $(document).ready(function(){
    $(".send_sms").click(function(){
      var mob = $(this).attr("data-mob");
      $.ajax({
        type:"post",
        url:"<?=base_url()?>action/singleFeeSMS.html",
        data: "mobileno="+mob,
        success:function() {
          $("#ntxt").text("SMS Sent Successfully.");
          $(".notidiv").fadeIn();
          setTimeout(function(){
            $(".notidiv").fadeOut();
          },1200);
        }
      })
    });


    $("#smsall").click(function(){
      $.ajax({
        type:"post",
        url:"<?=base_url()?>action/allFeeSMS.html",
        data: "",
        success:function() {
          $("#ntxt").text("SMS Sent Successfully.");
          $(".notidiv").fadeIn();
          setTimeout(function(){
            $(".notidiv").fadeOut();
          },1200);
        }
      })
    });





    $(".send_mail").click(function(){
      var mail = $(this).attr("data-mail");
      $.ajax({
        type:"post",
        url:"<?=base_url()?>action/singleFeeMail.html",
        data: "mail="+mail,
        success:function() {
          $("#ntxt").text("Mail Sent Successfully.");
          $(".notidiv").fadeIn();
          setTimeout(function(){
            $(".notidiv").fadeOut();
          },1200);
        }
      })
    });


  $("#mailall").click(function(){
      // var mail = $(this).attr("data-mail");
      $.ajax({
        type:"post",
        url:"<?=base_url()?>action/allFeeMail.html",
        data: '',
        success:function() {
          $("#ntxt").text("Mail Sent to all successfully.");
          $(".notidiv").fadeIn();
          setTimeout(function(){
            $(".notidiv").fadeOut();
          },1200);
        }
      })
    });


    $("#chkall").click(function(){
      if($(this).prop('checked') == true ) {
        $(".chk").prop("checked",true);
      } else {
        $(".chk").prop("checked",false);
      }
    });


    $(".nbtn").click(function( e ){
      if($('.chk:checked').length == 0) {
        e.preventDefault();
        alert("Please check an student to send sms or mail");
      }
    });

    $(".block").click(function( e ) {
      if($('.chk:checked').length == 0) {
        e.preventDefault();
        alert("Please check an student to block");
      }
    });

    $("#src").click(function( e ) {
      var dt = $("#date").val();

      if(dt.length > 0) {
        window.location.href="<?=base_url()?>due/"+dt;
      } else {
        e.preventDefault();
        alert("Please check an student to block");
      }

    });

    $(".dps").datepicker({ format:"dd-mm-yyyy"});
  });
</script>
