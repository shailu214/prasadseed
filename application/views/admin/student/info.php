<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Student Details
              <!-- <a href="<?=base_url()?>exam/eprint/<?=$ex_code?>" style="color:#fff" class="btn btn-info btn-sm pull-right"><i class="fe fe-file"></i> Print</a> -->
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
                  <tr>

                    <th width="150">STUDENT CODE</th>
                    <td colspan="2"><?=$code?></td>
                    <th >STUDENT NAME</th>
                    <td colspan="2"><?=$fname.' '.$lname?></td>
                  </tr>
                  <tr>

                    <th width="150">MOBILE NO.</th>
                    <td colspan="2"><?=$mobile?></td>
                    <th >EMAIL ID</th>
                    <td colspan="2"><?=$email?></td>
                  </tr>
                  <tr>
                    <th width="150">FATHER NAME </th>
                    <td colspan="2"><?=$father_name?></td>
                    <th >MOBILE NO.</th>
                    <td colspan="2"><?=$mobile2?></td>
                  </tr>
                  <tr>
                    <th width="150">D.O.B. </th>
                    <td colspan="2"><?=date("d-m-Y", strtotime($created))?></td>
                    <th >DUE AMOUNT</th>
                    <td colspan="2"><?=$due?></td>
                  </tr>
                  <tr>
                    <th width="150">OTHER DETAILS </th>
                    <td colspan="5">
                      <a href="<?=base_url()?>fee/add/<?=$code?>"><i class="fa fa-money"></i> &nbsp;Fee Detail</a>
                      &nbsp; &nbsp; &nbsp; | &nbsp; &nbsp; &nbsp;
                      <a href="<?=base_url()?>student/download/<?=$code?>"><i class="fa fa-calendar"></i> &nbsp;Attendance Download</a>
                    </td>
                  </tr>
                  <tr><th colspan="6"> PREVIOUS &nbsp; RECORD</th></tr>
                  <tr>
                    <th>STUDENT CODE</th>
                    <th>STUDENT NAME</th>
                    <th>JOINING DATE</th>
                    <th>COURSE</th>
                    <th>BATCH</th>
                    <th>DUE</th>
                  </tr>
                  <?php foreach ($pres as $key => $val) : ?>
                    <tr>
                      <td><?=$val['code']?></td>
                      <td><a href="<?=base_url()?>student/info/<?=$val['id']?>"><?=$val['fname']." ".$val['lname']?></a></td>
                      <td><?=date("d-m-Y",strtotime($val['created']))?></td>
                      <td><?=$val['course']?></td>
                      <td><?=$val['batch_name']?></td>
                      <td><?=$val['due']?></td>
                    </tr>
                  <?php endforeach; ?>

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
