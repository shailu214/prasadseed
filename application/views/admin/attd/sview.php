
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">
                      <span class="atd-block" style="float:left;"><i class="fe fe-list"></i> &nbsp;Student &nbsp;Report</span>
                      <span class="atd-block" style="float:left; margin-left: 18%;">
                        <span style="position:relative">
                          <select id="month">
                            <?php for($i=1; $i<=12; $i++) { ?>
                              <option value="<?=$i?>" <?=($i==$m)? 'selected' : ''; ?>><?=date('F', strtotime('1-'.$i.'-'.$y))?></option>
                            <?php } ?>
                          </select>
                          <i class="fa fa-caret-down" style="position:absolute;right:3px;top:4px"></i>
                        </span>
                      </span>
                      <span class="atd-block" style="float:left;">
                        <span style="position:relative">
                          <select id="year">
                            <?php for($j=2015; $j<=date("Y"); $j++) { ?>
                              <option value="<?=$j?>" <?=($j==$y)? 'selected' : ''; ?>><?=date('Y', strtotime('01-01-'.$j))?></option>
                            <?php } ?>
                          </select>
                          <i class="fa fa-caret-down" style="position:absolute;right:3px;top:4px"></i>
                        </span>
                      </span>
                      <a href="<?=base_url()?>attendance/std_download/<?=$b_id?>/<?=$m?>/<?=$y?>" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-download"></i> Download</a>
                      <a href="<?=base_url()?>attendance/batch" class="btn btn-secondary btn-sm pull-right" style=" margin-right:10px;"><i class="fe fe-arrow-left"></i> Back</a>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Student Name</th>
                          <th>Attendance</th>
                          <th>Sunday</th>
                          <th>Absent</th>
                          <th>Percent</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach ($result as $key => $val ) { $i++; ?>
                        <tr>
                          <td><span class="text-muted"><?=$i?></span></td>
                          <td> <?=$val['fname'].' '.$val['lname']?>  </td>
                          <td> <?=$val['atd']?>  d</td>
                          <td> <?=$val['sunday']?>  d</td>
                          <td> <?=$val['absent']?>  d</td>
                          <td> <?=$val['prc']?> % </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="6" align="right">
                            <nav aria-label="Page navigation example">
                              <?=$pages?>
                            </nav>
                          </td>
                        <tr>
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
            var m = $(this).val();
            var y = $("#year").val();
              window.location.href="<?=base_url()?>attendance/student/<?=$b_id?>/"+m+"/"+y;
          });
          $("#year").change(function(){
            var m = $("#month").val();
            var y = $(this).val();
              window.location.href="<?=base_url()?>attendance/student/<?=$b_id?>/"+m+"/"+y;
          });
        });
      </script>
