      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">SubCategory List
                    <a href="<?=base_url()?>subcategory/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Category</th>
                          <th>SubCategory</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($result as $key => $val ) { $sn++; ?>
                        <tr>
                          <td><span class="text-muted"><?=$sn?></span></td>
                          <td align="left">  <?=$val['pcat']?> </td>
                          <td align="left">  <?=$val['category']?>  </td>
                          <td align="left">  <?=($val['status'] == 1)? 'Enable' : 'Disable'; ?>  </td>
                          <td  width="200">
                            <a class="icon" href="<?=base_url()?>/subcategory/edit/<?=$val['id']?>">
                              <i class="fe fe-edit"></i>
                            </a>
                             &nbsp; | &nbsp;
                            <a class="icon delete" href="javascript:void(0)" data-path="<?=base_url()?>" data-row-id="<?=$val['id']?>" data-tbl="sub_category">
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
