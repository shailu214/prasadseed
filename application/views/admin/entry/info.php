<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Entry Details
              <!-- <a href="<?=base_url()?>exam/eprint/<?=$ex_code?>" style="color:#fff" class="btn btn-info btn-sm pull-right"><i class="fe fe-file"></i> Print</a> -->
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
                  
				  
				  <tr>
					<th >Year</th>
                    <td colspan="2"><?=$obj->year?></td>
                    <th  width="150">Farmer</th>
                    <td colspan="2"><?=$obj->farmer_id?></td>
					<th  width="150">MOBILE</th>
                    <td colspan="2"><?=$obj->mobile_no?></td>
                  </tr>
					
					<tr>
                    <th  width="150">Father Name</th>
                    <td colspan="2"><?=$obj->father?></td>
					<th  width="150">Reference</th>
                    <td colspan="2"><?=$obj->reference?></td>
					<th  width="150">Address</th>
                    <td colspan="2"><?=$obj->farmer_address?></td>
                  </tr>
				  
				  <tr>

                    <th width="150">Vegetable</th>
                    <td colspan="2"><?=$obj->vegetable_id?></td>
					<th width="150">Variety</th>
                    <td colspan="2"><?=$obj->variety_id?></td>
					<th width="150">Lot No.</th>
                    <td colspan="2"><?=$obj->sno?>/<?=$obj->qty?></td>
                    
                  </tr>
                  
				  
				  <tr>

                    <th  width="150">Sno</th>
                    <td colspan="2"><?=$obj->sno?></td>
                  </tr>
					<tr>
					<th width="150">Quantity</th>
                    <td colspan="2"><?=$obj->qty?></td>
					  <td colspan="2"><?=$obj->qty_value?></td>
                  </tr>
					
					<tr>
                    <th width="150">Fare</th>
                    <td colspan="2"><?=$obj->fare?></td>
					<td colspan="2"><?=$obj->fare_val?></td>
					
                  </tr>
					<tr>
                    <th width="150">Quality</th>
                    <td colspan="2"><?=$obj->quality?></td>
					<th width="150">short Qty</th>
					<td colspan="2"><?=$shortQty?></td>
					<th width="150">Remaning Qty</th>
					<td colspan="2"><?=$obj->quality-$shortQty?></td>
					<?php /* <td colspan="2"><?=$obj->quality_value?></td> */ ?>
					
                  </tr>
					<tr>
						<th width="150">Other</th>
						<td colspan="2"><?=$obj->tatpatti?></td>
						<td colspan="2"><?=$obj->tatpatti_value?></td>
					
                  </tr>
					
				  <tr>
					<th width="150">Crop Category</th>
                    <td colspan="2">
						<?php
						$this->db->where('id', $obj->title_category_id);
						$title_category = $this->db->get("title_category")->row();
						if($title_category) {
							echo $title_category->name;
						}
						?>
					</td>
                    <td colspan="2">
					<?php
						$this->db->where('id', $obj->title_category_value_id);
						$title_category_val = $this->db->get("title_category_value")->row();
						if($title_category_val) {
							echo $title_category_val->name;
						}
						?>
					</td>
                    <td colspan="2">
						<?=$obj->title_category_val?>
					</td>
                    
                  </tr>
				  <tr>

                    <th width="150">Packaging Type</th>
                    <td colspan="2">
						<?php
							$this->db->where('id', $obj->type_id);
							$typeobj = $this->db->get("type")->row();
							if($typeobj) {
								echo $typeobj->name;
							}
						?>
					</td>
                    <td colspan="2">
						<?php
							$this->db->where('id', $obj->type_value_id);
							$typevalueobj = $this->db->get("type_value")->row();
							if($typevalueobj) {
								echo $typevalueobj->name;
							}
						?>
					</td>
                    <td colspan="2"><?=$obj->type_value?></td>
                    
                  </tr>
				  
				  
				 
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
