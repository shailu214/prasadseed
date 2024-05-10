
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
                <div class="card" style="padding:25px;">
                  <h4>Customer Detail &nbsp; <i class="fa fa-angle-double-right"></i>
                    <a href="<?=base_url()?>/customer.html" style="float:right; font-size:15px;color:#316cbe"><i class="fa fa-angle-double-left"></i> &nbsp;Back</a>
                  </h4>
                  <table style="width:100%;">
                    <thead>
                      <tr>
                        <th>Customer Code &nbsp;:</th>
                        <th><?=$code?></th>
                        <th>Customer Name &nbsp;:</th>
                        <th><?=$customer_name?></th>
                      </tr>
                      <tr>
                        <th>Mobile No. &nbsp;:</th>
                        <th><?=$mobile?></th>
                        <th>Address &nbsp;:</th>
                        <th><?=$address?></th>
                      </tr>
                      <tr>
                        <th>Total Paid &nbsp;:</th>
                        <th>Rs. <?=$paid?></th>
                        <th>Total Due &nbsp;:</th>
                        <th>Rs. <?=$due?></th>
                      </tr>
                    </thead>
                  <tbody>

                  </tbody>
                </table>

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-1" ></div>
            <div class="col-lg-10" >
                <div class="card" style="padding:25px;">
                  <h4>Due Payment Detail &nbsp; <i class="fa fa-angle-double-right"></i> </h4>
                <table class="pay-tbl" >
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Due Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                <tbody>
                  <?php foreach ($orders as $pk => $pv) : ?>
                  <tr>
                    <td><a href="<?=base_url()?>sales/invoice/<?=$pv['id']?>">#<?=$pv['code']?></a></td>
                    <td>Rs. <?=$pv['amount']?></td>
                    <td>Rs. <?=$pv['paid']?></td>
                    <td>Rs. <?=$pv['due']?></td>
                    <td><?=date("d-m-Y", strtotime($pv['created']))?></td>
                  </tr>
                <?php endforeach; ?>
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
