

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
                    <h3 class="card-title" style="width:100%;"><i class="fa fa-money"></i>&nbsp; Due Fee List
                      &nbsp;&nbsp;<a href="<?=base_url()?>due.html">Refresh</a>
					  <span style="float:right; font-size:14px; " >
					     
                        <select class="form-control pull-left" name="batch" id="btc" style="width:180px; padding:0px 15px; height:30px; margin-right:20px;">
                          <option value="0">All Batch</option>
                          <?php foreach ($batch as $key => $val) : ?>
                          <option value="<?=$val['id']?>" <?=($_SESSION['src_btc']== $val['id'])? 'selected="selected"' : '';?>><?=$val['batch_name']?></option>
                          <?php endforeach; ?>
                        </select>
                        <input type="text" name="date" class="form-control pull-left dps" value="<?=$fdate?>" style="width:160px; padding:0px 15px;" placeholder="dd-mm-yyyy" id="date" /> &nbsp;
                        <a href="javascript:;" class="btn btn-primary btn-sm text-white" id="src"><i class="fe fe-search"></i> &nbsp;Search</a>
                        &nbsp; &nbsp; | &nbsp; &nbsp;
                        <!-- <a href="javascript:;" style="color:#467FCF;" id="mailall"><i class="fe fe-mail"></i> &nbsp;Mail Send to All</a> -->
                        <button type="submit" name="btn" value="mail" class="btn btn-info btn-sm nbtn"><i class="fe fe-mail"></i> &nbsp;Mail Send</button>
                        &nbsp; &nbsp; | &nbsp; &nbsp;
                        <!-- <a href="javascript:;" style="color:#467FCF;" id="smsall"><i class="fe fe-send"></i> &nbsp;SMS Send to All</a> -->
                        <button type="submit" name="btn" value="sms" class="btn btn-success btn-sm nbtn"><i class="fe fe-send"></i> &nbsp;SMS Send</button>
                        &nbsp; &nbsp; | &nbsp; &nbsp;
                        <a href="<?=base_url()?>dues/print.html" class="btn btn-danger btn-sm" style="color:#fff;"><i class="fe fe-file"></i> &nbsp;Print</a>
                      </span>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1"><input type="checkbox"  id="chkall"/></th>
                          <th width="100">Code</th>
                          <th>Student Name</th>
                          <th>Contact No.</th>
                          <th>Due Amount</th>
                          <th>Due Date</th>
                          <th>Join Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($result as $key => $val ) { $sn++;
						  
						  //print_r($val);
						  //exit;
						  
						  if($val['due_date']!='')
						  {
							$due_date =  date("Y-m-d", strtotime($val['due_date']));  
						  }else{
							 $due_date ='--'; 
						  }	  
						?>
                        <tr>
                          <td>
                            <?php if($val['status'] == 1) { ?>
                              <input type="checkbox" class="chk" name="chk[]" value="<?=$val['code']?>" />
                            <?php } else { ?>
                              <span class="status-icon bg-danger"></span>
                            <?php  } ?>
                           </td>
                          <td> <?=$val['code']?>  </td>
                          <td> <a href="<?=base_url()?>student/info/<?=$val['code']?>"><?=$val['fname'].' '.$val['lname']?></a>  </td>
                          <td> <?=$val['mobile']?>  </td>
                          <!---<td> <a href="<?=base_url()?>fee/add/<?=$val['code']?>"><?=$val['due']+$val['fee']?> </a> </td>----->
                           <td> <a href="<?=base_url()?>fee/add/<?=$val['code']?>"><?=$val['due']?> </a> </td>
                          <td> <?=$due_date?> </td>
                          <td> <?=date("d-m-Y", strtotime($val['created']))?>  </td>
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
                          <td colspan="6"></td>
                        </tr>
                        <tr>
                          <td colspan="2" width="100">
                            <textarea name="bmsg" rows="2" placeholder="Remark..."></textarea>
                            <br>
                            <button type="submit" name="btn" value="block" class="btn btn-block btn-danger btn-md block"><i class="fe fe-slash"></i> &nbsp;Block</button></td>
                            <td colspan="2"></td>
                          <td colspan="3" align="right">
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
	  var batch_id = $("#btc").val();
	  
      
      if(batch_id!='') {
        window.location.href="<?=base_url()?>due/"+dt+"/"+batch_id;
      
	  } else {
        e.preventDefault();
        alert("Please check an student to block");
      }

    });

    $(".dps").datepicker({ format:"yyyy-mm-dd"});

    $("#btc").change(function(){
      var val = $(this).val();
	  
      $.ajax({
        type:"POST",
        url:"<?=base_url()?>ajax/setBatch.html",
        data:"id="+val,
        success: function(){
          window.location.href="<?=base_url()?>due.html"
        }
      })
    });


  });
</script>
