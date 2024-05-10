<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-edit"></i> Exam Result
              <a href="<?=base_url()?>exam/eprint/<?=$ex_code?>" style="color:#fff" class="btn btn-info btn-sm pull-right"><i class="fe fe-file"></i> Print</a>
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th width="150">EXAM CODE</th>
                    <td ><?=$ex_code?></td>
                    <th width="150">STUDENT CODE</th>
                    <td><?=$student_id?></td>
                    <th width="150">STUDENT NAME</th>
                    <td><?=$name?></td>
                  </tr>
                  <tr>
                    <th width="150">COURSE </th>
                    <td ><?=$course?></td>
                    <th width="150">BATCH</th>
                    <td><?=$batch_name?></td>
                    <th width="150">OBTAIN MARKS</th>
                    <td><?=$total?></td>
                  </tr>
                  <tr>
                    <th width="150">RESULT </th>
                    <td ><?=($status==1)? 'PASSED' : 'FAILED'; ?></td>
                    <th width="150">DIVISION </th>
                    <td ><?php
                          if( $divs == 1) {  echo '1st'; }
                          elseif( $divs == 2) { echo '2nd'; }
                          elseif( $divs == 3) { echo '3rd'; }
                          else { echo '--'; }
                        ?>
                    </td>
                    <th width="150">CREATED</th>
                    <td><?=date("d-m-Y", strtotime($created))?></td>
                    <!-- <th colspan="6"></th> -->
                  </tr>
                  <tr><th colspan="6"> Subjects &nbsp; and &nbsp; Marks</th></tr>
                  <tr>
                    <th colspan="2">SUBJECT</th>
                    <th colspan="2">MAXIMUM MARKS</th>
                    <th>OBTAIN MARKS</th>
                    <th>PERCENTAGE</th>
                  </tr>
                  <?php foreach ($marks as $key => $val) : ?>
                  <tr>
                    <td colspan="2"> <?=$val['subject']?> </td>
                    <td colspan="2"> <?=$mx[] = $val['mx_marks']; ?> </td>
                    <td> <?=$val['marks']?></td>
                    <td> <?=$val['marks']/$val['mx_marks']*100; ?>%</td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="2">Total</th>
                    <th colspan="2"><?=$mxt = array_sum($mx)?></th>
                    <th ><?=$total?></th>
                    <td > <?=floor($total/$mxt*100); ?>%</td>

                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

        </div>
      </div>
  </div>
</div>

<script>
$(document).ready(function(){
$("#month").change(function(){
  var m = $("#month").val();
  var y = $("#year").val();
  window.location.href="<?=base_url()?>student/attendance/<?=$id?>/"+m+"/"+y;
});
$("#year").change(function(){
  var m = $("#month").val();
  var y = $("#year").val();
  window.location.href="<?=base_url()?>student/attendance/<?=$id?>/"+m+'/'+y;
});
});
</script>
