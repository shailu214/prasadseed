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
            <i class="fe fe-user"></i> Vendor Tittle Detail
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
					<tr>
					  <th class="w-1">S.No.</th>
						  <th>Tittle</th>
						  <th>Value</th>
                          <th>Tittle 2</th>
						  <th>Value 2</th>
						  
						  <th>Tittle 3</th>
						  <th>Value 3</th>
						  
						  <th>Tittle 4</th>
						  <th>Value 4</th>
					</tr>
					
					<?php 
						
						foreach ($resultsell as $key => $val ) { $sni++;
							
						?>
                        <tr>
                          <td><span class="text-muted"><?=$sni?></span></td>
						  <td align="left"> 
							<?=$val['title_one'];?>
						  </td>
							<td><?=$val['value_one'];?></td>
							
                          <td align="left"><?=$val['title_two'];?></td>
						  <td><?=$val['value_two'];?></td>
						  <td><?=$val['title_three'];?></td>
						  <td><?=$val['value_three'];?></td>
						  <td><?=$val['title_four'];?></td>
						  <td><?=$val['value_four'];?></td>
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
