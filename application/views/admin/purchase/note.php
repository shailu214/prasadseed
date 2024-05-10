
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">
            <div class="col-sm-6 col-lg-3">
              <div class="card p-3">
                <div class="d-flex align-items-center">
                  <span class="stamp stamp-md bg-blue mr-3">
                    <i class="fa fa-money fa-2x"></i>
                  </span>
                  <div>
                    <h4 class="m-0"><a href="javascript:void(0)">
                      Rs. <?=$total?><br>
                      <small>Total Amount</small></a>
                    </h4>
                    <!-- <small class="text-muted">12 waiting payments</small> -->
                  </div>
                </div>
              </div>
            </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fa fa-money fa-2x"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)">
                        Rs. <?=$paid?><br>
                        <small>Paid Amount</small></a>
                      </h4>
                      <!-- <small class="text-muted">12 waiting payments</small> -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fa fa-money fa-2x"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)">Rs. <?=$due?>
                        <br><small>Due Amount</small></a></h4>
                    </div>
                  </div>
                </div>
              </div>

            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;"><i class="fe fe-shopping-cart"></i>&nbsp; Purchase Note
                      <form method="post">
                        <span style="float:right">
                        <select class="sel2" name="src[vnd]">
                          <option value="0">All Vendor</option>
                          <?php foreach ($vendors as $vnkey => $vnal) : ?>
                            <option value="<?=$vnal['id']?>" <?=($_SESSION['src']['vnd']==$vnal['id'])? 'selected="selected"' : '';?>><?=$vnal['company_name']?> - (<?=$vnal['vendor_name']?>)</option>
                          <?php endforeach; ?>
                        </select>
                        &nbsp; &nbsp;
                          From : <input type="text" class="nt-inp dps" name="src[sdate]" placeholder="From Date.." value="<?=$this->session->src['sdate']?>" />
                          &nbsp; &nbsp;
                          To : <input type="text" class="nt-inp dps" name="src[edate]" placeholder="From Date.." value="<?=$this->session->src['edate']?>" />
                          &nbsp;
                          <button type="submit" class="btn btn-primary btn-sm"><i class="fe fe-search"></i></button>
                          &nbsp; | &nbsp;
                          <a href="javascript:;" class="btn btn-danger btn-sm" id="reset"><i class="fe fe-refresh-cw " style="color:#fff;"></i></a>

                        </span>
                      </form>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Description</th>
                          <th>Billed</th>
                          <th>Paid</th>
                          <th>Due</th>
                          <th>Created</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($payment as $key => $val ) { $sn++;?>
                        <tr>
                          <td ><?=$sn?></td>
                          <td> <a href="<?=base_url()?>purchase/detail/<?=$val['pid']?>"><?=$val['code']?></a>  - <?=$val['company_name']?> (<?=$val['vendor_name']?>)</td>
                            <td> <?=$val['total']?></td>
                            <td> <?=$val['paid']?></td>
                            <td> <?=$val['due']?></td>
                          <!-- <td><?=($val['trx_type']==2)? 'Rs. '.$val['amount'] : '--'; ?></td>
                          <td><?=($val['trx_type']==1)? 'Rs. '.$val['amount'] : '--'; ?></td> -->
                          <td><?=date("d-m-Y", strtotime( $val['created'] ))?></td>
                          <td><?=($val['due']>0)? '<span class="text-danger">DUE</span>' : '<span class="text-success">PAID</span>';?></td>
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
<Script>
  $(".dps").datepicker({ format:'dd-mm-yyyy'});
  $(".sel2").select2();

  $("#reset").click(function(){
    $.ajax({
        type:"post",
        url:"<?=base_url()?>ajax/resetsrc",
        data:"",
        success: function( res ) {
          window.location.href="<?=base_url()?>purchase/note.html"
        }
    });
  });
</script>
