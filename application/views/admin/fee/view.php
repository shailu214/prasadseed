
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">
            <div class="col-sm-6 col-lg-3"  style="height:80px; margin-bottom:0px;">
              <div class="card p-3 m-0">
                <div class="d-flex align-items-center">
                  <span class="stamp bg-blue mr-3" style="padding:10px;height:50px;">
                    <i class="fe fe-user" style="font-size:28px;"></i>
                  </span>
                  <div>
                    <h2 class="m-0"><?=$btc['course']?></h2>
                    <h4 class="m-0"><?=$btc['batch_name']?></h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-1"  style="height:80px; margin-bottom:0px;"></div>
            <div class="col-sm-6 col-lg-5"  style="height:80px; margin-bottom:0px;">
              <div class="card p-3 m-0">
                <div class="d-flex align-items-center">
                  <span class="atd-block" style="margin-left:20px;width:200px;">
                    <span style="position:relative">
                      <select id="month">
                        <?php for($i=1; $i<=12; $i++) { ?>
                          <option value="<?=$i?>" <?=($i==$_SESSION['fee']['m'])? 'selected' : ''; ?>><?=date('F', strtotime('1-'.$i.'-'.$y))?></option>
                        <?php } ?>
                      </select>
                      <i class="fa fa-caret-down" style="position:absolute;right:3px;top:4px"></i>
                    </span>
                    &nbsp; &nbsp;
                    <span style="position:relative">
                      <?php
                      $yr = ($y-5);
                      if($_SESSION['fee']['y']) { $ys= $_SESSION['fee']['y']; } else { $ys=$y;}
                      ?>
                      <select id="year">
                        <?php for($j=$yr; $j<=$y; $j++) { ?>
                          <option value="<?=$j?>" <?=($j==$ys)? 'selected' : ''; ?>><?=date('Y', strtotime('01-01-'.$j))?></option>
                        <?php } ?>
                      </select>
                      <i class="fa fa-caret-down" style="position:absolute;right:3px;top:4px"></i>
                    </span>
                  </span>

                  <span class="atd-block" style="margin-left:60px;">
                    <span style="position:relative">
                      <select id="type">
                        <option value="1" <?=($_SESSION['fee']['type'] == 1)? 'selected' : ''; ?>>Collected</option>
                        <option value="2" <?=($_SESSION['fee']['type'] == 2)? 'selected' : ''; ?>>Pending</option>
                      </select>
                      <i class="fa fa-caret-down" style="position:absolute;right:3px;top:4px"></i>
                    </span>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3"  style="height:80px; margin-bottom:20px;">
              <div class="card p-3 m-0">
                <div class="d-flex align-items-center">
                  <span class="stamp bg-blue mr-3" style="padding:10px;height:50px;">
                    <i class="fe fe-dollar-sign" style="font-size:28px;"></i>
                  </span>
                  <div>
                    <h4 class="m-0 text-success">PAID : <?=$paid?></h4>
                    <h4 class="m-0 text-danger">DUE : <?=$due?></h4>
                  </div>
                </div>
              </div>
            </div>

              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;"><i class="fa fa-money"></i>&nbsp; Fee Payment
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <?php if($_SESSION['fee']['type'] == 2) : ?>
                      <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                          <tr>
                            <th class="w-1">S.No.</th>
                            <th>Student Name</th>
                            <th>Contact No.</th>
                            <th>Course</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($result as $key => $val ) { $sn++;?>
                          <tr>
                            <td ><?=$sn?></td>
                            <td> <?=$val['fname'].' '.$val['lname']?>  </td>
                            <td> <?=$val['mobile']?> </td>
                            <td> <?=$val['course']?> </td>
                            <td><a href="<?=base_url()?>fee/add/<?=$val['code']?>"><i class="fe fe-plus"></i> Add Fee</a></td>
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
                    <?php else : ?>
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.NO.</th>
                          <th>Code</th>
                          <th>Student Name</th>
                          <th>Contact No.</th>
                          <th>Course</th>
                          <th>Amount</th>
                          <th>PAID</th>
                          <th>Month</th>
                          <th>Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($result as $key => $val ) { $sn++;?>
                        <tr>
                          <td ><?=$sn?></td>
                          <td> <?=$val['code']?>  </td>
                          <td> <?=$val['name'].' '.$val['lname']?>  </td>
                          <td> <?=$val['mobile']?>  </td>
                          <td> <?=$val['course']?>  </td>
                          <td> <?=$val['amount']?>  </td>
                          <td> <?=$val['paid']?>  </td>
                          <td>
                            <?php
                              $date = explode(",", $val['month']);
                              foreach ($date as $key2 => $val2) {
                                $dts[] = date("M", strtotime("5-".$val2."-2018"));
                              }
                              echo implode(", ", $dts);
                              unset($dts);
                             ?>
                          </td>
                          <td ><?=date("d-m-Y", strtotime( $val['created'] ))?></td>
                          <td><a href="javascript:;" class="fee-print" data-set-id="<?=$val['id']?>"><i class="fa fa-print"></i> Print</a></td>
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
                  <?php endif; ?>

                  </div>
                </div>

              </div>
            </div>
        </div>
      </div>

      <script>
      $(document).ready(function(){
        $(document).on("click", ".fee-print", function(){
      		var id = $(this).attr('data-set-id');
      	  var NWin =  window.open('<?=base_url()?>fee/feeprint/'+id,'',"height=250,width=250");
      	    if (window.focus)
      		     {
      		       NWin.focus();
      		     }
      		     return false;
        });

        $("#month, #year").change(function(){
          var m = $("#month").val();
          var y = $("#year").val();
          $.ajax({
            type:"post",
            url:"<?=base_url()?>/ajax/src_fee",
            data:"m="+m+"&y="+y,
            success: function() {
              window.location.reload();
            }
          });
        });


        $("#type").change(function(){
          var m = $(this).val();
          $.ajax({
            type:"post",
            url:"<?=base_url()?>/ajax/src_fee",
            data:"type="+m,
            success: function() {
              window.location.reload();
            }
          });
        });

      });

      </script>
