<?php 
$total_amount = $total_deposit = $total_due_amount = 0;
foreach ($resultsell as $objloop ) {
	$total_amount += $objloop['quantity']*$objloop['price'];
	
	$db->where('sell_id', $objloop['id']);
	$db->select_sum('amount');
	$totalPreAmount = $db->get("sell_deposit")->row();
	
	
	$total_due_amount += $objloop['total_amount']-$totalPreAmount->amount;
	$total_deposit += $totalPreAmount->amount;
} ?>
<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">
			<div class="card">
				<form method="post">
					<?php 
					$static_year = 2024;
					$current_year = date('Y'); ?>
					<select class="form-controls" name="data[search_year]">
						<option value="">Select Year</option>
						<?php for ($x = $static_year; $x <= $current_year; $x++) { ?>
							<option value="<?php echo $x; ?>"><?php echo $x; ?></option>
						<?php } ?>
					</select>
					<input type="submit" value="search" /> 
				</form>
			</div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Vendor Details
              <!-- <a href="<?=base_url()?>exam/eprint/<?=$ex_code?>" style="color:#fff" class="btn btn-info btn-sm pull-right"><i class="fe fe-file"></i> Print</a> -->
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
                  <tr>

                    <th width="150">Name</th>
                    <td colspan="2"><?=$obj->name?></td>
                    <th >Mobile</th>
                    <td colspan="2"><?=$obj->mobile?></td>
                  </tr>
                  <tr>
				  
				  <tr>

                    <th width="150">Father Name</th>
                    <td colspan="2"><?=$obj->father_name?></td>
                    <th >Reference Name</th>
                    <td colspan="2"><?=$obj->reference_name?></td>
                  </tr>
				  
				  <tr>

                    <th width="">Address</th>
                    <td colspan="4"><?=$obj->address?></td>
                    <th width=""> Total Amount </th>
                    <td colspan="4"><?=$total_amount?></td>
                  </tr>
                  <tr>

                    <th width="">Total Deposit</th>
                    <td colspan="4"><?=$total_deposit?></td>
                    <th width=""> Total Due Amount</th>
                    <td colspan="4"><?=$total_due_amount?></td>
                  </tr>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>
		  
		  <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Vendor Tittle Detail
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
					<tr>
					  <th class="w-1">S.No.</th>
						  <th>Farmer</th>
						  <th>Lot No.</th>
                          <th>Year</th>
						  <th>Vendor</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Total Price</th>
              <th>Due Amount </th>
						  <th>Action</th>
					</tr>
					
					<?php 
						
						foreach ($resultsell as $key => $val ) { $sn++;
							$vendorname = 'self';
							if($val['self'] == 0 && $val['vendor_id'] > 0) {
								$this->db->where('id', $val['vendor_id']);
								$vendor = $this->db->get('vendors')->row();
								if($vendor) {
									$vendorname = $vendor->name;
								}
							}
							
							/* $this->db->where('farmer_id', $val['farmer_id']);
							$this->db->where('farmer_lot_id', $val['farmer_lot_id']);
							$amtObj = $this->db->get('tbl_amount')->row();
							$creditAmount = $depositAmount = $balanceAmount = '';
							if($amtObj) {
								$creditAmount = $amtObj->credit_amount;
								$depositAmount = $amtObj->deposit_amount;
								$balanceAmount = $amtObj->balance_amount;
							} */
						?>
                        <tr>
                          <td><span class="text-muted"><?=$sn?></span></td>
						  <td align="left"> 

							<?php 
								$db->where('id', $val['farmer_id']);
								$obj = $db->get('farmer')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
						  </td>
							<td>
							
							<?php 
								$db->where('id', $val['farmer_lot_id']);
								$obj = $db->get('farmer_lots')->row();
								if($obj) {
									echo $obj->lots;
								}
							?>
							
							</td>
							
							
                          <td align="left">  <?=$val['year']; ?>  </td>
						  <td><?=$vendorname?></td>
						  <td><?=$val['quantity']?></td>
						  <td><?=$val['price']?></td>
						  <td><?=$val['quantity']*$val['price']?></td>
						  <td>
						  <?php
								$db->where('sell_id', $val['id']);
								$db->select_sum('amount');

								$totalPreAmount = $db->get("sell_deposit")->row();
								echo $val['total_amount']-$totalPreAmount->amount;
							?>
						  </td>
						  </td>
						  <td align="left">  
							<a class="icon" href="<?=base_url()?>sell/view/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>
							
						  </td>
                        </tr>
                      <?php } ?>
				 
                </tbody>
                <tfoot>
                </tfoot>
              </table>


              
            </div>
          </div>
		  
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
  $(".exsms").click(function(){
    var id = $(this).attr("data-exid");
    // alert(id);
  $.ajax({
      type:  "POST",
      url:"<?=base_url()?>ajax/exam_sms",
      data:"id="+id,
      success: function() {
        $("#ntxt").text("SMS Sent successfully.");
        $(".notidiv").fadeIn();
        setTimeout(function(){
          $(".notidiv").fadeOut();
        },1200);
      }
  });

});
});
</script>
