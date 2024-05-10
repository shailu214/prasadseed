

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
              <form method="post">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;"><i class="fe fe-users"></i>&nbsp; Student Absent List
                      <span style="float:right; font-size:14px; " >
					   <form name="frm_filter" id="frm_filter" action="<?=base_url()?>absent.html" method="post">
					  <select class="form-control pull-left" name="batch" id="btc" style="width:180px; padding:0px 15px; height:30px; margin-right:20px;">
                          <option value="">--Select--</option>
                          <?php foreach ($batch as $key => $val) : ?>
                          <option value="<?=$val['id']?>" <?=($batch_id== $val['id'])? 'selected="selected"' : '';?>><?=$val['batch_name']?></option>
                          <?php endforeach; ?>
                        </select>
                        <input type="text" name="date" disabled class="form-control pull-left dps" value="<?=date('d-m-Y')?>" style="width:160px; padding:0px 15px;" placeholder="dd-mm-yyyy" id="date" /> &nbsp;
                        <button type="submit" class="btn btn-primary btn-sm text-white" id="src"><i class="fe fe-search"></i> &nbsp;Search</button>
                        &nbsp; &nbsp; | &nbsp; &nbsp;
						</form>

                        <button type="submit" name="btn" value="mail" class="btn btn-info btn-sm nbtn"><i class="fe fe-mail"></i> &nbsp;Mail Send</button>
                        &nbsp; &nbsp; | &nbsp; &nbsp;
                        <button type="submit" name="btn" value="sms" class="btn btn-success btn-sm nbtn"><i class="fe fe-send"></i> &nbsp;SMS Send</button>
                      </span>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1"><input type="checkbox"  id="chkall"/></th>
                          <th>Code</th>
                          <th>Student Name</th>
                          <th>Contact No.</th>
                          <th>Course</th>
                          <th>Batch</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($result as $key => $val ) { $sn++;?>
                        <tr>
                          <td>
                            <?php if($val['status'] == 1) { ?>
                              <input type="checkbox" class="chk" name="chk[]" value="<?=$val['id']?>" />
                            <?php } else { ?>
                              <span class="status-icon bg-danger"></span>
                            <?php  } ?>

                          </td>
                          <td> <?=$val['code']?>  </td>
                          <td> <?=$val['fname'].' '.$val['lname']?>  </td>
                          <td> <?=$val['mobile2']?>  </td>
                          <td> <?=$val['course']?>  </td>
                          <td> <?=$val['batch_name']?>  </td>
                          <td width="200">
                            <?php if( $val['status'] == 1) { ?>
                            <a href="javascript:;" class="send_mail" data-mail="<?=$val['email']?>">
                              <i class="fe fe-mail"></i>
                              Send Mail
                            </a>
                            &nbsp; &nbsp; | &nbsp; &nbsp;
                            <a href="javascript:;" class="send_sms" data-mob="<?=$val['mobile2']?>" >
                              <i class="fe fe-send"></i> Send SMS
                            </a>
                          <?php } else { ?>
                            <span class="text-danger">Blocked</span>
                          <?php } ?>
                           </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="6" align="right">
                            <nav aria-label="Page navigation example">
                              <?=$pages?>
                            </nav>
                          </td>
                        <tr>
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
        url:"<?=base_url()?>action/singleAbsSMS.html",
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
        url:"<?=base_url()?>action/allAbsSMS.html",
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
        url:"<?=base_url()?>action/singleAbsMail.html",
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
        url:"<?=base_url()?>action/allAbsMail.html",
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




  });
</script>
