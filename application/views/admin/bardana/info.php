<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Bardana Details
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
                  </tr>

                  <tr>

                    <th  width="150">Item</th>
                    <td colspan="2"><?=$obj->item?></td>
					<th >Qty</th>
                    <td colspan="2"><?=$obj->qty?></td>
                  </tr>
				  
				  <tr>

                    <th  width="150">Measurement</th>
                    <td colspan="2"><?=$obj->measurement?></td>
					<th >Type</th>
                    <td colspan="2"><?=$obj->type?></td>
                  </tr>
				 
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>

        </div>
		
		<div class="card">
		<div class="table-responsive">
			<table class="table card-table table-vcenter text-nowrap">
			  <thead>
			  
				<tr>
				  <th class="w-1">S.No.</th>
				  <th>Title</th>
				  <th>Value</th>
				  <th>Value2</th>
				</tr>
			  </thead>
			  <tbody>
				<?php 
				$sn = 0;
				foreach ($details as $key => $detailsobj ) { $sn++; ?>
				<tr>
				  <td><span class="text-muted"><?=$sn?></span></td>
				  <td align="left"> 
					<?=$detailsobj['title']; ?>
					
				  </td>
				  <td align="left">  <?=$detailsobj['value']; ?>  </td>
				  <td align="left">  <?=$detailsobj['val']; ?>  </td>
				  
				</tr>
			  <?php } ?>
			  </tbody>
			  <tfoot>
				<tr>
				  
				<tr>
			  </tfoot>
			</table>
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
