
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">
                      <span class="atd-block" style="float:left;"><i class="fe fe-list"></i> &nbsp; <?=($prs=='present_list')? 'PRESENT' : 'ABSENT'; ?> &nbsp;LIST</span>
                      <span class="atd-block" style="float:right;width:280px; padding:0px;">
                        <span style="position:relative">
                          <div class="input-group">
                          <input type="text" name="datep" class="form-control dps" value="<?=($date)? $date : date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" style="border:none;width:200px;" />
                          <a href="javascript:;" id="search" class="btn btn-primary"><i class="fe fe-search"></i></a>
                          <!-- <i class="fa fa-caret-down" style="position:absolute;right:3px;top:4px"></i> -->
                        </div>
                        </span>
                      </span>
                    <!-- <a href="<?=base_url()?>attendance/stf_download/<?=$m?>/<?=$y?>" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-download"></i> Download</a> -->
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Name</th>
                          <th>Contact No.</th>
                          <th>Email</th>
                          <th>Course</th>
                          <th>Batch</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach ($result as $key => $val ) { $i++; ?>
                        <tr>
                          <td><span class="text-muted"><?=$i?></span></td>
                          <td> <?=$val['fname'].' '.$val['lname']?>  </td>
                          <td> <?=$val['mobile']?> </td>
                          <td> <?=$val['email']?>  </td>
                          <td> <?=$val['course']?> </td>
                          <td> <?=$info['batch_name']?>   </td>
                          <?php if($prs == 'present_list') : ?>
                            <td> <span class="text-green">PRESENT</span> </td>
                          <?php else : ?>
                            <td> <span class="text-red">ABSENT</span>   </td>
                          <?php endif; ?>
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
          $(".dps").datepicker({format:"dd-mm-yyyy", endDate: '+0d', autoclose: true});
          $("#search").click(function(){
            var val = $(".dps").val();
            window.location.href="<?=base_url()?>attendance/<?=$prs?>/<?=$info['id']?>/"+val;

          });
        });
      </script>
