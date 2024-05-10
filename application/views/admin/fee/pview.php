
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;"><i class="fa fa-money"></i>&nbsp; Pending Fee
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Code</th>
                          <th>Student Name</th>
                          <th>Contact No.</th>
                          <th>Course</th>
                          <th>Due Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($result as $key => $val ) { $sn++;?>
                        <tr>
                          <td ><?=$sn?></td>
                          <td align="center"> <?=$val['code']?>  </td>
                          <td align="center"> <?=$val['fname'].' '.$val['lname']?>  </td>
                          <td align="center"> <?=$val['mobile']?>  </td>
                          <td align="center"> <?=$val['course']?>  </td>
                          <td align="center"> <?=$val['fee']?>  </td>
                          <td align="center"><a href="<?=base_url()?>fee/add/<?=$val['code']?>" class="btn btn-primary btn-sm">Add Fee</a></td>
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
