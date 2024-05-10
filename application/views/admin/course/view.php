
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Class List
                    <a href="<?=base_url()?>course/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Course</th>
                          <th>Course Fee</th>
                          <th>Status</th>
                          <th>Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=$sno; foreach ($result as $key => $val ) { $i++;?>

                        <tr>
                          <td><span class="text-muted"><?=$i?></span></td>
                          <td> <?=$val['course']?>  </td>
                          <td>Rs. <?=$val['fee']?> </td>
                          <td>
                            <?php if($val['status'] == 1) : ?>
                              <span class="status-icon bg-success"></span> Enable
                            <?php else : ?>
                              <span class="status-icon bg-danger"></span> Disable
                            <?php endif; ?>
                          </td>
                          <td><?=date("d-M-Y", strtotime( $val['created'] ))?></td>
                          <td>
                            <a class="icon" href="<?=base_url()?>/course/edit/<?=$val['id']?>">
                              <i class="fe fe-edit"></i>
                            </a>
                             &nbsp; | &nbsp;
                            <a class="icon delete" href="javascript:void(0)" data-path="<?=base_url()?>" data-row-id="<?=$val['id']?>" data-tbl="course">
                              <i class="fe fe-trash"></i>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tfoot>
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
        // $('.table').dynmoTbl({
        //   url:'<?=base_url()?>/ajax',
        //   data:['id','course','fee','tpl','date', 'tpl'],
        //   tpl: [
        //     '<span class="status-icon bg-success"></span> Enable',
        //     '<a class="icon" href="javascript:void(0)"> <i class="fe fe-edit"></i> </a>',
        //   ],
        //   paging:true
        //  });
      });
      </script>
