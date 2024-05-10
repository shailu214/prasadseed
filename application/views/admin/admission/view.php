      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">

                      <div class="atd-block" style="float:left">
                        Admission Query List
                      </div>

                    <a href="<?=base_url()?>admission/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
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
                                  <td><input type="text" class="src-inp" name="src[name]" style="width:200px;"  placeholder="Student Name.." value="<?=$this->session->src['name']?>" /></td>
                                  <td><input type="text" class="src-inp" name="src[mob]"  style="width:200px;" placeholder="Contact No.." value="<?=$this->session->src['mob']?>" /></td>
                                  <td><button class="btn btn-primary btn-sm"><i class="fe fe-search"></i> Search</button></td>
                                </tr>
                              </table>
                            </form>
                          </td>
                        </tr>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Student Name</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Remark</th>
                          <th>Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=$sno; foreach ($result as $key => $val ) {  $i++;?>
                        <tr>
                          <td><span class="text-muted"><?=$i?></span></td>
                          <td> <?=$val['name']?>  </td>
                          <td> <?=$val['mobile'];?>  </td>
                          <td> <?=$val['email'];?>  </td>
                          <td> <?=$val['address'];?>  </td>
                          <td> <?=$val['remark'];?>  </td>

                          <td><?=date("d-M-Y", strtotime( $val['created'] ))?></td>
                          <td>
                          <a class="icon" href="<?=base_url()?>admission/edit/<?=$val['id']?>" title="Edit">
                            <i class="fe fe-edit"></i>
                          </a>
                           &nbsp; | &nbsp;
                          <a class="icon delete" href="javascript:void(0)" title="Delete" data-row-id="<?=$val['id']?>" data-path="<?=base_url()?>" data-tbl="admission_query">
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
