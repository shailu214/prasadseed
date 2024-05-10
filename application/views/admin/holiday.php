<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">
          <form method="post">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
                <a href="javascript:;">
                  <span class="atd-block" style="float:left"> <i class="fe fe-calendar"></i></span>
                </a>
                <span class="atd-block" style="float:left">Holiday Management.</span>

                <span class="atd-block" style="float:right;;">
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
                </span>

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
                            if(date("D", strtotime($y.'-'.$m.'-'.$i)) == 'Sun' ) {
                              echo 'tbl-col-yellow';
                            } elseif(in_array($i, $attd)) {
                              echo 'tbl-col-green';
                            } else {
                              echo 'tbl-col-red'; } ?>
                      ">
                      <?=$i?><br><small><?=date("D", strtotime($y.'-'.$m.'-'.$i))?></small>
                      <div>

                      </div>
                    <?php // if(date("D", strtotime($y.'-'.$m.'-'.$i)) != 'Sun' ) { ?>
                      <input type="checkbox" name="leave[]" value="<?=$i?>" <?=(in_array($i, $hday))? 'checked="checked"' : ''; ?> />
                    <?php // } // ?>
                    </td>
                    <?=($i==$days)? '</tr>' : ''; ?>
                  <?php } ?>
                  </tr>
                  <tfoot>
                    <td colspan="7" style="border:none" align="right">
                      <button type="submit" class="btn btn-primary pull-right btn-lg"> Submit</button>
                      <textarea type="text" name="caption" placeholder="caption" class="form-control pull-right" style="border:1px solid #999;width:250px; margin-right:15px;"></textarea>
                    </td>
                  </tfoot>
                </tbody>
              </table>
            </div>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

<script>

$(document).ready(function(){

  $("#month").change(function(){
    var m = $("#month").val();
    var y = $("#year").val();
    window.location.href="<?=base_url()?>holiday/"+m+"/"+y;
  });

  $("#year").change(function(){
    var m = $("#month").val();
    var y = $("#year").val();
    window.location.href="<?=base_url()?>holiday/"+m+'/'+y;
  });

});

</script>
