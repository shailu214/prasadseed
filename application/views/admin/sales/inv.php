
      <div class="my-3 my-md-5">
        <div class="container">
          <?php if( $alert == 1 ) : ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> Payment saved successfully.
          </div>
        <?php elseif( $alert == 2 ) : ?>
          <div class="alert alert-danger alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-alert-triangle"></i> &nbsp; <b>Error!</b> Payment should not be greater than due amount.
          </div>
          <?php endif; ?>
          <div class="row">
            <div class="col-lg-1" ></div>
            <div class="col-lg-10" >
              <a href="javascript:;" class="pull-right print-btn"><i class="fa fa-print"></i> Print</a>
                <div class="card" style="padding:25px;">
                <table style="width:100%;">
                  <thead>
                  <tr>
                    <td colspan="2">
                      <h4><?=COM_NAME?></h4>
                      <p>
                        Mobile : +91 <?=MOBILE?><br>
                        Email : <?=EMAIL?>
                      </p><br>
                    </td>
                    <td style="text-align:right; vertical-align:text-top">
                      <b>
                        <small>Invoice No.</small><br>
                        <?=$code?>
                      </b><br><br>
                      Date : <?=date("d-m-Y", strtotime($created))?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Customer Name :</b> &nbsp; <?=$customer_name?><br></td>
                    <td><b>Contact No. : </b>&nbsp; <?=$mobile?></td>
                    <td><b>Address : </b>&nbsp; <?=$address?></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="3"><br>
                      <table class="item-tbl">
                        <tr>
                          <th>S.No.</th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Amount</th>
                          <th>GST</th>
                          <th style="text-align:right">Sub Total &nbsp; </th>
                        </tr>
                        <?php $i=0; foreach ($items as $key => $val) : $i++;?>
                          <tr>
                            <td><?=$i?></td>
                            <td><?=$val['product_name']?></td>
                            <td><?=$val['qty']?></td>
                            <td><?=$val['price']?></td>
                            <td><?=$val['gst_amt']?></td>
                            <td style="text-align:right"><?=$val['total']?> &nbsp; </td>
                          </tr>
                        <?php endforeach; ?>
                        <tr>
                          <th colspan="5" class="tfoot">Total</th>
                          <th class="tfoot"><?=$amount?> &nbsp; </th>
                        </tr>
                        <tr>
                          <th colspan="5" class="tfoot">Discount</th>
                          <th class="tfoot">- <?=$discount?> &nbsp; </th>
                        </tr>
                        <tr>
                          <th colspan="5" class="tfoot">Grand Total</th>
                          <th class="tfoot"><?=$total?> &nbsp; </th>
                        </tr>
                        <tr>
                          <td><b>Paid :</b></td>
                          <td style="text-align:left">Rs. <?=$paid?></td>
                          <td ><b>Due :</b></td>
                          <td colspan="3" style="text-align:left">Rs. <?=$due?></td>
                          <!-- <td></td> -->
                        </tr>
                      </table>
                    </td>
                  </tr>

                </tbody>
                </table>

              </div>
            </div>
          </div>

          <?php if( !empty( $payments ) ) { ?>
          <div class="row">
            <div class="col-lg-1" ></div>
            <div class="col-lg-10" >
                <div class="card" style="padding:25px;">
                  <h4>Payment Detail &nbsp; <i class="fa fa-angle-double-right"></i> </h4>

                <table class="pay-tbl" >
                  <thead>
                    <tr>
                      <th>Mode</th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>remark</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                <tbody>
                  <?php foreach ($payments as $pk => $pv) : ?>
                  <tr>
                    <td>
                      <?php if($pv['mode'] == 1) : ?>
                        Cash
                      <?php elseif($pv['mode'] == 2) : ?>
                        Cheque
                      <?php elseif($pv['mode'] == 3) : ?>
                        Credit/Debit Card
                      <?php elseif($pv['mode'] == 4) : ?>
                        WalletApp or Online
                      <?php endif; ?>
                    </td>
                    <td><?=$pv['pay_desc']?></td>
                    <td>Rs. <?=$pv['amount']?></td>
                    <td><?=$pv['remark']?></td>
                    <td><?=date("d-m-Y", strtotime($pv['created']))?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
                </table>

              </div>
            </div>
          </div>
        <?php } ?>

        <?php if( $due > 0) { ?>
          <form method="post" >
          <div class="row">
            <div class="col-lg-1" ></div>
            <div class="col-lg-10" >
                <div class="card" style="padding:25px;">
                  <h4>Add Payment &nbsp; <i class="fa fa-angle-double-right"></i> </h4>
                  <table class="pay-tbl" >
                    <tbody>
                      <tr>
                        <td width="50%">
                          <div class="form-group">
                          <select class="form-control" name="data[mode]">
                            <option value="1">Cash</option>
                            <option value="2">Cheque</option>
                            <option value="3">Credit/Debit Card</option>
                            <option value="4">Wallet App</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Payment Description</label>
                          <input type="text" class="form-control" name="data[pay_desc]" value="" placeholder="Payment Description..">
                        </div>
                        <div class="form-group">
                          <label>Amount</label>
                          <input type="text" class="form-control" name="data[amount]" value="" placeholder="Amount.." data-validation="required number" data-validation-error-msg="Please enter amount.">
                        </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label>Remark</label>
                            <textarea rows="6" placeholder="Remark.." name="data[remark]" class="form-control"></textarea>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <button class="btn btn-primary btn-lg">Add Payment</button>
                </div>
              </div>
            </div>
          </form>
        <?php } ?>
        </div>
      </div>
<script>
$(document).ready(function(){
  $(document).on("click", ".print-btn", function(){
		var id = $(this).attr('data-set-id');
	  var NWin =  window.open('<?=base_url()?>sales/invprint/<?=$id?>','',"height=650,width=650");
	    if (window.focus)
		     {
		       NWin.focus();
		     }
		     return false;
  });
});

</script>
