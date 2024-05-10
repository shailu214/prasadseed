
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;"><i class="fe fe-shopping-cart"></i>&nbsp; Purchase Order
                    <a href="<?=base_url()?>purchase/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-edit"></i> &nbsp; Create Order</a>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <td colspan="7"  style="border-bottom:1px solid #ddd">
                            <form method="post">
                              <table>
                                <tr>
                                  <td><input type="text" class="src-inp" name="src[oid]" placeholder="Order ID.." value="<?=$this->session->src['oid']?>" /></td>
                                  <td>
                                    <select class="src-inp" name="src[vid]" id="vnd" style="width:250px;">
                                      <option value="0">All</option>
                                      <?php foreach ($vendors as $vk => $vls) : ?>
                                        <option value="<?=$vls['id']?>"><?=$vls['company_name']?> - (<?=$vls['vendor_name']?>)</option>
                                      <?php endforeach; ?>
                                    </select>
                                    <!-- <input type="text" class="src-inp" name="src[name]" placeholder="Customer Name.." value="<?=$this->session->src['name']?>" /> -->
                                  </td>
                                  <!-- <td><input type="text" class="src-inp" name="src[mob]" placeholder="Contact No.." value="<?=$this->session->src['mob']?>" /></td> -->
                                  <td style="width:150px"></td>
                                  <td><input type="text" class="src-inp dps" name="src[sdate]" placeholder="From Date.." value="<?=$this->session->src['sdate']?>" /></td>
                                  <td><input type="text" class="src-inp dps" name="src[edate]" placeholder="To Date.." value="<?=$this->session->src['edate']?>" /></td>
                                  <td><button class="btn btn-primary btn-sm"><i class="fe fe-search"></i> Search</button></td>
                                  <td><a href="javascript:;" class="btn btn-danger btn-sm" id="reset"><i class="fe fe-refresh-cw"></i></a></td>

                                </tr>
                              </table>
                            </form>
                          </td>
                        </tr>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Order ID</th>
                          <th>Company Name</th>
                          <th>Contact No.</th>
                          <th>Amount</th>
                          <th>Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($result as $key => $val ) { $sn++;?>
                        <tr>
                          <td ><?=$sn?></td>
                          <td> <?=$val['code']?>  </td>
                          <td> <?=$val['company_name']?>  </td>
                          <td> <?=$val['vmobile']?>  </td>
                          <td> <?=$val['amount']?>  </td>
                          <td><?=date("d-m-Y", strtotime( $val['purchase_date'] ))?></td>
                          <!-- <td align="center"> <?=$val['gst_amt']?>  </td>
                          <td align="center"> <?=$val['total']?>  </td> -->
                          <td>
                            <?php if($val['total'] > $val['paid']) : ?>
                              <a href="<?=base_url()?>purchase/detail/<?=$val['id']?>"><i class="fe fe-file"></i> Pay </a> </td>
                            <?php else : ?>
                              <span class="text-success">PAID</span>
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
  $(".dps").datepicker({ format:'dd-mm-yyyy'});
  $("#vnd").select2();

  $("#reset").click(function(){
    $.ajax({
        type:"post",
        url:"<?=base_url()?>ajax/resetsrc",
        data:"",
        success: function( res ) {
          window.location.href="<?=base_url()?>purchase.html"
        }
    });
  });

})
</script>
