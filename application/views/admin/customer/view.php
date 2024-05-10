      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Customer List
                    <a href="<?=base_url()?>customer/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <td colspan="9"  style="border-bottom:1px solid #ddd">
                            <form method="post">
                              <table>
                                <tr>
                                  <td><input type="text" class="src-inp" name="src[name]" style="width:350px;" placeholder="Customer Name.." value="<?=$this->session->src['name']?>" /></td>
                                  <td><input type="text" class="src-inp" name="src[mob]" style="width:250px;" placeholder="Contact No.." value="<?=$this->session->src['mob']?>" /></td>
                                  <td><button class="btn btn-primary btn-sm"><i class="fe fe-search"></i> Search</button></td>
                                  <td><a href="javascript:;" class="btn btn-danger btn-sm" id="reset"><i class="fe fe-refresh-cw"></i> &nbsp;Reset</a></td>

                                </tr>
                              </table>
                            </form>
                          </td>
                        </tr>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Customer Name</th>
                          <th>Mobile</th>
                          <th>Address</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($result as $key => $val ) { $sn++; ?>
                        <tr>
                          <td><span class="text-muted"><?=$sn?></span></td>
                          <td> <a href="<?=base_url()?>customer/detail/<?=$val['id']?>"><?=$val['customer_name']?>  </a></td>
                          <td> <?=$val['mobile'];?>  </td>
                          <td> <?=$val['address'];?>  </td>
                          <td align="center">
                            <a class="icon" href="<?=base_url()?>/customer/edit/<?=$val['id']?>">
                              <i class="fe fe-edit"></i>
                            </a>
                             &nbsp; | &nbsp;
                            <a class="icon delete" href="javascript:void(0)" data-path="<?=base_url()?>" data-row-id="<?=$val['id']?>" data-tbl="customer">
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
                window.location.href="<?=base_url()?>customer.html"
              }
          });
        });
      });
      </script>
