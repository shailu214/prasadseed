<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Challan Details
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
                    <th  width="150">M/S Name</th>
                    <td colspan="2"><?=$obj->ms_name?></td>
                  </tr>
				  
				        <tr>
                    
                    <th  width="150">Vechicle No.</th>
                    <td colspan="2"><?=$obj->vechicle_no?></td>
                    <th  width="150">No. Of Bori</th>
                    <td colspan="2"><?=$obj->no_of_bori_count?></td>
                    <th  width="150">No. Of Bori(In Word)</th>
                    <td colspan="2"><?=$obj->no_of_bori_count_word?></td>
					
                  </tr>
                  <tr>
                    <th  width="150">Account No.</th>
                    <td colspan="2"><?=$obj->bank_account?></td>
                    <th  width="150">Gaddi Bhada</th>
                    <td colspan="2"><?=$obj->gaddi_bhada?> Per Quintol/ Per Bora</td>
                    
					
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
