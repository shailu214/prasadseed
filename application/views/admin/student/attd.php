<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
                <a href="<?=base_url()?>student.html">
                  <span class="atd-block" style="float:left"> <i class="fe fe-arrow-left"></i></span>
                </a>
                <span class="atd-block" style="float:left"> <i class="fe fe-user"></i> <?=$name ?></span>

                <span class="atd-block" style="float:left; margin-left: 15%;">
                  <span style="position:relative">
                    <select id="month">
                      <?php for($i=1; $i<=12; $i++) { ?>
                        <option value="<?=$i?>" <?=($i==$m)? 'selected' : ''; ?>><?=date('F', strtotime('1-'.$i.'-'.$y))?></option>
                      <?php } ?>
                    </select>
                    <i class="fa fa-caret-down" style="position:absolute;right:3px;top:4px"></i>
                  </span>
                  &nbsp; &nbsp;
                  <span style="position:relative">
                    <?php
                    $date = date('Y');
                    $yr = ($date-2);
                    if($_SESSION['fee']['y']) { $ys= $_SESSION['fee']['y']; } else { $ys=$y;}
                    ?>
                    <select id="year">
                      <?php for($j=$yr; $j<=$date; $j++) { ?>
                        <option value="<?=$j?>" <?=($j==$ys)? 'selected' : ''; ?>><?=date('Y', strtotime('01-01-'.$j))?></option>
                      <?php } ?>
                    </select>
                    <i class="fa fa-caret-down" style="position:absolute;right:3px;top:4px"></i>
                  </span>
                  <!-- <?=$y?> -->

                </span>

                <span class="atd-block"> <i class="fe fe-edit-3"></i> Presents &nbsp;:&nbsp; <?=$prestnt?>d</span>
                <span class="atd-block"> <i class="fe fe-layers"></i> Absent &nbsp;:&nbsp; <?=$absent?>d </span>
              <!-- <a href="<?=base_url()?>staff/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a> -->
              </h3>
            </div>
            <div class="table-responsive">
              <table class="cal-tbl">
                <tbody>
                  <?php for ($i=1; $i<=$days; $i++ ) { ?>
                    <?=($i==1)? '<tr>' : ''; ?>
                    <?=($i%7==1)? '</tr><tr>' : ''; ?>
                    <td class="
                      <?php
                            if(in_array($i, $hday) ) {
                              echo 'tbl-col-yellow';
                            } elseif(in_array($i, $leave)) {
                              echo 'tbl-col-blue';
                            } elseif(in_array($i, $attd)) {
                              echo 'tbl-col-green';
                            } else {
                              echo 'tbl-col-red'; } ?>
                      ">
                      <?=$i?><br><small><?=date("D", strtotime($y.'-'.$m.'-'.$i))?></small>
                      <div>
                        <?php if(strlen($logs[$i]['login'])) : ?>
                        Login : <?=date("h:i a", strtotime($logs[$i]['login']))?><br>
                        Logout : <?=($logs[$i]['logout'])? date("h:i a", strtotime($logs[$i]['logout'])) : '';?>
                      <?php endif; ?>
                      <?php if(in_array($i, $leave)) { ?>
                        Leave
                      <?php } ?>
                      </div>
                    </td>
                    <?=($i==$days)? '</tr>' : ''; ?>
                  <?php } ?>
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
