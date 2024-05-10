
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Batch List
                      <a href="<?=base_url()?>batch/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
                      <form method="post">
                        <select class="src-inp" id="course" name="src[course_id]" style="float:right; margin-right:25px; ">
                          <option value="0">All</option>
                          <?php foreach ($course as $key => $val) : ?>
                            <option value="<?=$val['id']?>" <?=($_SESSION['src']['course_id'] == $val['id'])? 'selected="selected"' : ''; ?>><?=$val['course']?></option>
                          <?php endforeach; ?>
                        </select>
                      </form>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Batch Name</th>
                          <th>Course</th>
                          <th>Status</th>
                          <th>Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=$sno; foreach ($result as $key => $val ) { $i++;?>
                        <tr>
                          <td><span class="text-muted"><?=$i?></span></td>
                          <td> <?=$val['batch_name']?>  </td>
                          <td> <?=$val['course']?>  </td>
                          <td>
                            <?php if($val['status'] == 1) : ?>
                              <span class="status-icon bg-success"></span> Enable
                            <?php else : ?>
                              <span class="status-icon bg-danger"></span> Disable
                            <?php endif; ?>
                          </td>
                          <td><?=date("d-M-Y", strtotime( $val['created'] ))?></td>
                          <td>
                            <a class="icon" href="<?=base_url()?>fee/batch/<?=$val['id']?>" title="Report">
                              <i class="fe fe-list"></i>
                            </a>
                            &nbsp; | &nbsp;
                            <a class="icon" href="<?=base_url()?>/batch/edit/<?=$val['id']?>" title="Edit">
                              <i class="fe fe-edit"></i>
                            </a>
                             &nbsp; | &nbsp;
                            <a class="icon delete" href="javascript:;" data-path="<?=base_url()?>" data-row-id="<?=$val['id']?>" data-tbl="batch" title="Delete">
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
$(document).ready(function() {
  $("#course").change(function(){
    id = $(this).val();
    $('form').submit();
  });

});
</script>
