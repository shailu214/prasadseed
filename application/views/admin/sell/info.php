<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Vendor Purchase Entry Details
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
				
				  <tr>

                    <th  width="150">Farmer</th>
                    <td colspan="2"><?=$obj->farmer_id?></td>
					<th >Year</th>
                    <td colspan="2"><?=$obj->year?></td>
					<th >Lot No.</th>
                    <td colspan="2">
						<?php
						$this->db->where('id', $obj->farmer_lot_id);
						$farmer_lot = $this->db->get("farmer_lots")->row();
						if($farmer_lot) {
							echo $farmer_lot->lots;
						}
					?></td>
                  </tr>

                  <tr>
				  
				  <tr>

                    <th  width="150">Vendor Name</th>
                    <td colspan="2"><?=$obj->vendor_id?></td>
					<th >Quantity</th>
                    <td colspan="2"><?=$obj->quantity?></td>
					<th >Short Qty</th>
                    <td colspan="2"><?=$obj->short_qty?></td>
                  </tr>
				  
				  <tr>

                    <th  width="150">Price</th>
                    <td colspan="2"><?=$obj->price?></td>
					<th >Total Price</th>
                    <td colspan="2">
                      
                    <?php
						
						echo $obj->quantity*$obj->price;
						
					?>
                    
                    
					<th >Nikasi Date</th>
                    <td colspan="2"><?=$obj->nikasi_date?></td>
                  </tr>
                  <tr>

                    <th  width="150">Payment Mode</th>
                    <td colspan="2"><?php
                    if($obj->pament_mode == 1) {
							echo 'CASH';
						} else if($obj->pament_mode == 2) {
              echo 'Account'; 
            } else if($obj->pament_mode == 3) { 
              echo 'CASH / Account';

            }
                  ?>  
                    
                  </td>
                    <th  width="150">Total Deposit Amount</th>
                    <td colspan="2">
                      
                    <?php
                    echo $totalamt;
                    ?>
                  
                    </td>
					
                    
                  </tr>

                  <tr>
				 
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>
		  
		  <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Deposit Amount
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
					<tr>
					  <th class="w-1">S.No.</th>
					  <th>Date</th>
					  <th>Deposit Amount</th>
					  <th>Due Date</th>
					</tr>
					
					<?php foreach($amount_deposit as $k=>$deposit) { ?>
					<tr>
					  <th class="w-1"><?=++$k?></th>
					  <th><?=$deposit['date']?></th>
					  <th><?=$deposit['amount']?></th>
					  <th><?=$deposit['due_date']?></th>
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
