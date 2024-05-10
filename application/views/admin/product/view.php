<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;"><i class="fe fe-shopping-cart"></i> &nbsp;Product List
              <a href="<?=base_url()?>product/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
              </h3>
            </div>
            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap">
                <thead>
                  <tr>
                    <td colspan="10"  style="border-bottom:1px solid #ddd">
                      <form method="post">
                        <table>
                          <tr>
                            <td><input type="text" class="src-inp" name="src[name]" style="width:350px;" placeholder="Product Name.." value="<?=$this->session->src['name']?>" /></td>
                            <td>
                              <select name="src[sts]" class="src-inp" style="width:200px;">
                                <option value=""> --- Select Status --- </option>
                                <option value="1" <?=($_SESSION['src']['sts'] == 1)? 'selected="selected"' : ''; ?>> Enable </option>
                                <option value="0" <?=(strlen($_SESSION['src']['sts'])>0 && $_SESSION['src']['sts'] == 0)? 'selected="selected"' : ''; ?>> Disable </option>
                              </select>
                            </td>
                            <td><button class="btn btn-primary btn-sm"><i class="fe fe-search"></i> Search</button></td>
                            <td><a href="javascript:;" class="btn btn-danger btn-sm" id="reset"><i class="fe fe-refresh-cw"></i> &nbsp;Reset</a></td>
                          </tr>
                        </table>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="2"></th>
                    <th style="text-align:center; font-weight:600" colspan="3">Price</th>
                    <th style="text-align:center; font-weight:600" colspan="3">Quantity</th>
                    <th colspan="2"></th>
                  </tr>
                  <tr>
                    <th class="w-1">S.No.</th>
                    <th style="text-align:left; font-weight:600">Product Name</th>
                    <th style="text-align:center; font-weight:600">Retail</th>
                    <th style="text-align:center; font-weight:600">Purchase</th>
                    <th style="text-align:center; font-weight:600">Selling</th>
                    <th style="text-align:center; font-weight:600">Purchased</th>
                    <th style="text-align:center; font-weight:600">Sold</th>
                    <th style="text-align:center; font-weight:600">Available</th>
                    <th style="text-align:left; font-weight:600">Status</th>
                    <th style="text-align:left; font-weight:600">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($result as $key => $val ) { $sn++ ?>
                  <tr>
                    <td><span class="text-muted"><?=$sn?></span></td>
                    <td> <?=$val['product_name']?>  </td>
                    <td align="center"> <?=$val['price'];?>  </td>
                    <td align="center"> <?=$val['purchase_price'];?>  </td>
                    <td align="center"> <?=$val['sell_price'];?>  </td>
                    <td align="center"> <?=$val['pqty'];?>  </td>
                    <td align="center"> <?=$val['pqty']-$val['qty'];?>  </td>
                    <td align="center"> <?=$val['qty'];?>  </td>
                    <td>
                      <?php if($val['status'] == 1) : ?>
                        <span class="status-icon bg-success"></span> Enable
                      <?php else : ?>
                        <span class="status-icon bg-danger"></span> Disable
                      <?php endif; ?>
                    </td>
                    <td>
                      <a class="icon" href="<?=base_url()?>/product/edit/<?=$val['id']?>">
                        <i class="fe fe-edit"></i>
                      </a>
                       &nbsp; | &nbsp;
                      <a class="icon delete" href="javascript:void(0)" data-row-id="<?=$val['id']?>" data-tbl="product" data-path="<?=base_url()?>">
                        <i class="fe fe-trash"></i>
                      </a>
                    </td>
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
  $("#reset").click(function(){
    $.ajax({
        type:"post",
        url:"<?=base_url()?>ajax/resetsrc",
        data:"",
        success: function( res ) {
          window.location.href="<?=base_url()?>product.html"
        }
    });
  });
});
</script>
