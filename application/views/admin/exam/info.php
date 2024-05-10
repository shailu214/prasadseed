<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-edit"></i> Exam Result
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
                    <th width="150">STUDENT NAME</th>
                    <td colspan="2"><?=$fname.' '.$lname?></td>
                  </tr>
                  <tr>
                    <th width="150">COURSE </th>
                    <td colspan="2"><?=$course?></td>
                    <th width="150">BATCH</th>
                    <td colspan="2"><?=$batch_name?></td>

                  </tr>
                  <tr>
                    <th width="150">Marksheet No. </th>
                    <td colspan="2"><?=$course?></td>
                    <th width="150">Certificate No.</th>
                    <td colspan="2"><?=$batch_name?></td>

                  </tr>

                  <tr><th colspan="6"> EXAMS &nbsp; LIST</th></tr>
                  <tr>
                    <th>EXAM CODE</th>
                    <th>EXAM NAME</th>
                    <th>TOTAL MARKS</th>
                    <th>OBTAIN MARKS</th>
                    <th>PERCENTAGE</th>
						<th>MARKSHEET NO.</th>
						<th>CERTIFICATE NO.</th>
                    <th>ACTION</th>
                  </tr>
                  <?php foreach ($exdata as $key => $val) : ?>
                  <tr>
                    <td> <a href="<?=base_url()?>exam/detail/<?=$val['ex_code']?>"><?=$val['ex_code']?> </a></td>
                    <td > <?=$val['title']; ?> </td>
                    <td > <?=$mx[] = $val['max_marks']; ?> </td>
                    <td> <?=$sum[] = $val['total']?></td>
                    <td> <?=$val['total']/$val['max_marks']*100; ?>%</td>
					<td > <?=$val['marksheet_number']; ?> </td>
					<td > <?=$val['certificate_number']; ?> </td>
                    <td> 
						<a class="icon certificat" href="#" data-type="certificate" data-student-id="<?=$val['student_id']?>" data-val="<?=$val['certificate_number']?>" title="Download Attendance">
                            Certificate <i class="fe fe-download"></i>
                          </a>
						  <a class="icon marksheet" href="#" data-type="marksheet" data-student-id="<?=$val['student_id']?>" data-val="<?=$val['marksheet_number']?>" title="Download Attendance">
                            Marksheet <i class="fe fe-download"></i>
                          </a>
						<a href="javascript:;" data-exid="<?=$val['id']?>" class="exsms"><i class="fe fe-send"></i> &nbsp;Send SMS</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2">Total</td>
                    <td ><?=$mxt = array_sum($mx)?></td>
                    <td ><?=array_sum($sum)?></td>
                    <td colspan="2"> <?=floor($total/$mxt*100); ?>%</td>
                  </tr>
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

<form method="post" id="pdfrc" action="<?=base_url()?>download-certificate" style="display:none">
	<input type="text" name="data[certificate_type]" id="form_certificate_type" />	
	<input type="text" name="data[roll_no]" id="form_roll_no" />	
	<input type="text" name="data[ceritficate_no]" id="form_ceritficate_no" />	
	<input class="btn btn-colored btn-theme-colored2 btn-danger btn-lg pl-40 pr-40 mt-18" value="View"  type="submit">
</form>
		
<script>
$(document).ready(function(){
	$("body").on('click', '.certificat', function(){
		let certificate_type = $(this).attr('data-type');
		let roll_no = $(this).attr('data-student-id');
		let ceritficate_no = $(this).attr('data-val');
		$('#form_certificate_type').val(certificate_type);
		$('#form_roll_no').val(roll_no);
		$('#form_ceritficate_no').val(ceritficate_no);
		$("#pdfrc").submit();
	});
	
	$("body").on('click', '.marksheet', function(){
		let certificate_type = $(this).attr('data-type');
		let roll_no = $(this).attr('data-student-id');
		let ceritficate_no = $(this).attr('data-val');
		$('#form_certificate_type').val(certificate_type);
		$('#form_roll_no').val(roll_no);
		$('#form_ceritficate_no').val(ceritficate_no);
		$("#pdfrc").submit();
	});
	
	
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
