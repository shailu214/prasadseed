
      <div class="my-3 my-md-5">
        <div class="container">
          <?php if( $alert ) : ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record saved successfully.
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
                      <h4>Alpha Tutor</h4>
                      <p>
                        14 M Aliganj Kursi Road Lucknow.<br>
                        Mobile : +91 963 958 4712<br>
                        Email : mailus@alphatutor.com
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
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="3"><br>
                      <table class="item-tbl">
                        <tr>
                          <th>#</th>
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
                      </table>
                    </td>
                  </tr>
                </tbody>
                </table>

              </div>
            </div>
          </div>
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
