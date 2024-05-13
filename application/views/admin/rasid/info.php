<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Rasid
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

                    <th  width="150">Vendor Name</th>
                    <td colspan="2">

                  <?php 
                  $self = 'Self';
                  if($obj->self == 1) {
                    $self = 'Self';
                  } else{
                    
                    $self= $obj->vendor_id;
                  
                  }
                  echo $self;
                  
                  ?>

                    </td>
					<th >Kiraya Per Unit</th>
                    <td colspan="2"><?=$obj->kiraya?></td>
					<th >Total Amount	</th>
                    <td colspan="2"><?=$obj->total_amount	?></td>
                  </tr>
				  
				  
                  
                  <tr>
				 
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
