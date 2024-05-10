
      <div class="my-3 my-md-5">
        <div class="container">
          <?php if( $alert == 1 ) : ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> fee added successfully.
          </div>
          <?php elseif( $alert == 2 ) : ?>
          <div class="alert alert-danger alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-alert-triangle"></i> &nbsp; <b>Error!</b> &nbsp; Something went wrong. Please try again.
          </div>
          <?php endif; ?>

          <div class="row">
            <div class="col-lg-12">
              <form class="card" method="post">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fa fa-money"></i> &nbsp;Fee Collect</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">

                      <div class="pro-box">
                        <table class="cart-tbl">
                          <tr>
                            <th style="text-align:left; width:160px;">Student Code : </th>
                            <td style="text-align:left">
                              <input type="text" id="ucode" value="<?=$code?>" />
                              <a href="javascript:;" class="btn btn-sm btn-primary" id="refresh"><i class="fe fe-refresh-ccw"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">Student Name : </th>
                            <td style="text-align:left"><?=$fname. ' ' . $lname?></td>
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">Course : </th>
                            <td style="text-align:left"><?=$course?></td>
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">Course Fee : </th>
                           
                            <?php if($fee_type == '1') { ?>
                            <td style="text-align:left">Rs. <?=$fee?> /month</td>
                            <?php } else { ?>
                            <td style="text-align:left">Rs. <?=$package_fee?></td>
                            <?php } ?>
                            
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">Course Duration : </th>
                            <td style="text-align:left">
                              <?php if($crs_end) : ?>
                              <?=date("M. Y", strtotime($created))?>
                               -
                               <?=date("M. Y", strtotime($crs_end. " -1 month"))?>
                            <?php endif; ?>
                             </td>
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">Mobile No. : </th>
                            <td style="text-align:left"><?=$mobile?></td>
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">Address : </th>
                            <td style="text-align:left"><?=$address?></td>
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">City : </th>
                            <td style="text-align:left"><?=$city?></td>
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">DOB : </th>
                            <td style="text-align:left"><?=($created)? date("d M Y", strtotime($created)) : '';?></td>
                          </tr>
                          <!-- <tr>
                            <th style="text-align:left; width:160px;">Total Fee : </th>
                            <td style="text-align:left">Rs. <?=$fee*$validity?></td>
                          </tr> -->
                          <tr>
                            <th style="text-align:left; width:160px;">Fee Paid : </th>
                            <td style="text-align:left">Rs. <?=$paid?></td>
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">Discount : </th>
                            <td style="text-align:left">Rs. <?=$discs?></td>
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">Prev. Due : </th>
                            <td style="text-align:left">Rs. <?=$due?></td>
                          </tr>
                          <tr>
                            <th style="text-align:left; width:160px;">Prev. Due Date : </th>
                            <td style="text-align:left"> <?=$due_date?></td>
                          </tr>
                          <?php foreach ($custom as $ckey => $cval) : ?>
                            <tr>
                              <th style="text-align:left; width:160px;"><?=$cval['title']?> : </th>
                              <td style="text-align:left"> <?=$cval['sval']?></td>
                            </tr>
                          <?php endforeach; ?>
                        </table>
                      </div>
                    </div>

                    <?php if( !empty($dates) ) : ?>

						
                    <div class="col-md-6">
                      <div class="shop-cart">
                        <table class="cart-tbl pay-cart">
                          <tbody>
                            <tr>
                              <td colspan="2">
                                <?php if($rfee == 1) : ?>
                                  <i class="fe fe-check" ></i>
                                <?php else : ?>
                                  <input type="checkbox" class="feechk" data-fee="<?=(REG_FEE)? REG_FEE : 0;?>" name="rfee" value="<?=(REG_FEE)? REG_FEE : 0;?>">
                                <?php endif; ?>
                                &nbsp; &nbsp; Registration Fee</td>
                            </tr>
							<tr>
							<td><input class="target" type="radio" value="1" name="type" data-fee="<?=$fee?>"  <?php if($fee_type == '2'){ echo 'disabled'; } ?>  <?php if($fee_type == '1'){ echo 'checked'; } ?> >  Monthly Package 
                            </td>
							<td><input class="target" type="radio" value="2" name="type" data-fee="<?=$package_fee?>"  <?php if($fee_type == '1'){ echo 'disabled'; } ?> <?php if($fee_type == '2'){ echo 'checked'; } ?> > Full Package </td>
							</tr>
                            <?php foreach($dates as $dk => $dval) { ?>
                              <tr>
                              <td colspan="2" class="<?php if(!$paid){ ?>d-none <?php } ?> monthcontent">
                                <?php if($dval['paid']) : ?>
                                  <i class="fe fe-check" ></i>
                                <?php else : ?>
                                  <input type="checkbox" class="feechk feechkmonth" data-fee="<?=$fee?>" name="fee[]" value="<?=$dval['my']?>" />
                                <?php endif; ?>
                                &nbsp; &nbsp; <?=date('M Y', strtotime('05-'.$dval['m'].'-'.$dval['y']))?></td>
                            </tr>
                            <?php } ?>

                            <?php if($due > 0) : ?>
                            <tr>
                              <td colspan="2">
                                  <input type="checkbox" class="feechk" data-fee="<?=$due?>" name="dfee" value="<?=$due?>" /> &nbsp; &nbsp; Due - <?=$due?>
                                </td>
                            </tr>
                          <?php endif; ?>

                            <?php foreach ($services as $sk => $svl) : ?>
                              <?php
                               if(in_array($svl['id'] , $srvs)) {
                               ?>
                                <tr>
                                  <td colspan="2">
                                    <i class="fe fe-check" ></i> &nbsp; &nbsp; <?=$svl['service_name']?>
                                  </td>
                                </tr>
                              <?php } else { ?>
                                <tr>
                                  <td colspan="2">
                                    <input type="checkbox" class="feechk" data-fee="<?=$svl['amount']?>" name="srv[]" value="<?=$svl['id']?>" /> &nbsp; &nbsp; <?=$svl['service_name']?>
                                  </td>
                                </tr>
                              <?php } ?>
                            <?php endforeach; ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th align="right" colspan="2">Sub-Total</th>
                              <th id="total" width="100">Rs. <span class="rs_val">00</span></th>
                              <input type="hidden" id="PackageAmount" name="package_amount" value="" />
                              <input 
                            </tr>
                            <tr>
                              <th align="right" colspan="2" >
                              <small>Other Charges.</small>
                              <input type="text" name="otc_rm" placeholder="Remark for Other Charges..." class="form-control" />
                            </th>
                              <th id="total" width="150"><input type="text" name="otc" id="otc" placeholder="Other Charges..." class="form-control" value="0" /></th>
                            </tr>
                            <tr>
                              <th align="right" colspan="2" >Discount</th>
                              <th id="total" width="150"><input type="text" name="disc" id="disc" placeholder="Discount..." class="form-control" /></th>
                            </tr>
                            <tr>
                              <th align="right" colspan="2">Sub-Total</th>
                              <th id="gtotal" width="100">Rs. <span class="rs_val">00</span></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <span class="pull-right" style="font-weight:600;padding:7px;">Fee Collected : &nbsp; </span>
                        </div>
                        <div class="col-md-6">
                          <input type="text" name="amt" data-validation="required number" data-validation-error-msg="Please enter amount..." class="form-control" placeholder="Amount..">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                          <span class="pull-right" style="font-weight:600;padding:7px;">Due Date: &nbsp; </span>
                        </div>
                        <div class="col-md-6">
                          <input type="date" name="due_date"  class="form-control" placeholder="Enter Due Date">
                        </div>
                    </div>
                    <!-- <div class="row">
                    <div class="col-md-6">
                      <span class="pull-right" style="font-weight:600;padding:7px;">Fee Collected : &nbsp; </span>
                    </div>
                    <div class="col-md-6">
                      <input type="text" name="amt" data-validation="required number" data-validation-error-msg="Please enter amount..." class="form-control" placeholder="Amount..">
                    </div>
                  </div> -->
                    <br>
                    <span class="pull-left"> <input type="checkbox" name="sms" value="1" > &nbsp; Allow SMS</span>
                      <button type="submit" class="btn btn-primary pull-right" id="makebill">Collect Fee</button> &nbsp;
                      <a href="<?=base_url()?>fee.html" class="btn btn-default pull-right" id="makebill"><i class="fa fa-angle-double-left"></i> &nbsp;Back</a>
                    </div>
                  <?php endif; ?>

                  </div>
                </div>
              </form>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-lg-12">
              <form class="card" method="post">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Fee Reciept</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="pro-box">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Code</th>
                              <th>Month</th>
                              <th>Amount</th>
                              <th>Discount</th>
                              <th>Paid</th>
                              <th>Due</th>
                              <th>Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tbody>
                              <?php foreach ($feelist as $key => $val) : ?>
                              <tr>
                                <td><?=$val['code']?></td>
                                <td><?php
                                if($val['month']) :
                                  $date = explode(",", $val['month']);
                                  foreach ($date as $key2 => $val2) {
                                    $dts[] = date("M", strtotime("5-".$val2."-2018"));
                                  }
                                  echo implode(", ", $dts);
                                  unset($dts);
                                  else :
                                    echo '--';
                                  endif;
                                 ?>
                                 <?=($val['rfee'] == 1)? '+ Reg. Fee' : ''; ?>
                                 <?=($val['other_fee'] > 0)? '+ '.$val['other_remark'] : ''; ?>

                               </td>
                                <td><?php echo $val['amount']+$val['other_fee']; $ams[] = $val['amount']+$val['other_fee']; ?> </td>
                                <td><?php echo $val['disc']; $dsc[] = $val['disc'];?></td>
                                <td><?php echo $val['paid']; $pay[] = $val['paid'];?></td>
                                <td><?php echo $val['due']; $damt[] = $val['due'];?></td>
                                <td><?=date("d M Y", strtotime($val['created']))?></td>
                                <td><a href="<?=base_url()?>fee/feeprint/<?=$val['id']?>" target="_blank">Print</a></td>
                              </tr>
                              <?php endforeach; ?>

                            </tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>
                </div>
              </form>
            </div>
          </div>


        </div>
      </div>
<script>
$(document).ready(function(){

 $("body").on('change', '.target',function(){
	 var val = $(this).val();
	 $('.monthcontent').removeClass('d-none');
	 
	 if(val == 1)
	 {
		  $('.monthcontent input[type=checkbox]')
    .attr('disabled', false).prop('checked', false);
	
		$('.feechkmonth').attr('data-fee', $(this).attr('data-fee'));
	
	 }else if(val == 2){
		var regfee = parseInt($('.feechk').attr('data-fee'));
		var amt = regfee + parseInt('<?php echo $package_fee; ?>');
		 $('.rs_val').html(amt);
		 $('#PackageAmount').val(amt);
		 
		 
		 $('.monthcontent input[type=checkbox]').prop('checked', true);
		 $('.feechk').prop('checked', true);
		// let fee = Math.round($(this).attr('data-fee')/$('.feechkmonth', $('.pay-cart')).length);
		 //$('.feechkmonth').attr('data-fee', fee);
	
	 }
 });

  $(".feechk").click(function(){
      //alert('hello');
    // 	if($("input[name='type']:checked").val() == 2) {
    // 		  //alert('hi');
    // 		  //return false;
    // 	  }
    var amt = 0;
	$('.rs_val').html('<?php echo $fee; ?>');
    $(".feechk:checked").each(function(){
      var fee = parseInt($(this).attr('data-fee'));
      //alert(fee);
      amt = (amt+fee);
    });
    $("#total span").text(amt);
    $("#gtotal span").text(amt);
    discval();

  });

  $("#refresh").click(function(){
    var code = $("#ucode").val();
    window.location.href="<?=base_url()?>fee/add/"+code;
  });

  $("#disc").keyup(function(){
      discval();
  });

  $("#otc").keyup(function(){
      discval();
  });

});



function discval() {

  var dis = $("#disc").val();
  var otc = parseInt($("#otc").val());
  var sb = parseInt($("#total span").text());

  sb = (sb+otc);

  if(sb > dis){
    if( dis.length ) {
      if(isNaN(dis)) {
        $("#disc").val(0);
      } else {
        sum = sb-dis;
        $("#gtotal span").text(sum);
      }
    } else {
      $("#disc").val(0);
      $("#gtotal span").text(sb);
    }
  } else {
    alert("Invalid value.");
    $("#disc").val(0);
    $("#gtotal span").text(sb);
  }

}
</script>
