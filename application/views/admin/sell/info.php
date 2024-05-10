<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Amount Details
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

                    <th  width="150">Lending Date</th>
                    <td colspan="2"><?=$obj->lending_date?></td>
					<th >Credit Amount</th>
                    <td colspan="2"><?=$obj->credit_amount?></td>
					<th >Per</th>
                    <td colspan="2"><?=$obj->per?></td>
                  </tr>
				  
				  <tr>

                    <th  width="150">Cal</th>
                    <td colspan="2"><?=$obj->cal_per?></td>
					<th >Deposit Amount</th>
                    <td colspan="2"><?=$obj->deposit_amount?></td>
					<th >Balance Amount</th>
                    <td colspan="2"><?=$obj->balance_amount?></td>
                  </tr>
                  <tr>

                    <th  width="150">Comment</th>
                    <td colspan="2"><?=$obj->comment?></td>
					
                    
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
					</tr>
					
					<?php foreach($amount_deposit as $k=>$deposit) { ?>
					<tr>
					  <th class="w-1"><?=++$k?></th>
					  <th><?=$deposit['date']?></th>
					  <th><?=$deposit['amount']?></th>
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
