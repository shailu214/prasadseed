<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i>V.F.P
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
                  <tr>

                    <th  width="150">Title</th>
                    <td colspan="2"><?=$obj->title?></td>
					<th >Amount</th>
                    <td colspan="2"><?=$obj->add_fare?></td>
                  </tr>
				  
				  <tr>

                    <th  width="150">Farmer</th>
                    <td colspan="2"><?=$obj->farmer_id?></td>
                    <th >Address</th>
                    <td colspan="2"><?=$obj->farmer_address?></td>
					
                  </tr>

					<tr>
          <th >Year</th>
                    <td colspan="2"><?=$obj->year?></td>

                    <th  width="150">Value</th>
                    <td colspan="2"><?=$obj->value?></td>
				
                  </tr>
                  <tr>
                  <th >Value2</th>
                    <td colspan="2"><?=$obj->value_two?></td>
                    <th  width="150">Lot No.</th>
                    <td colspan="2">
                    <?php
						$this->db->where('id', $obj->farmer_lot_id);
						$farmer_lot = $this->db->get("farmer_lots")->row();
						if($farmer_lot) {
							echo $farmer_lot->lots;
						}
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
