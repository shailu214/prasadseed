      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">

                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <td colspan="9"  style="border-bottom:1px solid #ddd">
                            <form method="post">
                              <table>
                                <tr>
                                  <td><input type="text" class="src-inp" name="src[code]" style="width:150px;"  placeholder="Exam Code.." value="<?=$this->session->src['code']?>" /></td>
                                  <td><input type="text" class="src-inp" name="src[name]" style="width:180px;"  placeholder="Student Name.." value="<?=$this->session->src['name']?>" /></td>
                                  <td>
                                    <select class="src-inp" name="src[course_id]" id="course" >
                                      <option value="0">All</option>
                                      <?php foreach ($course as $key => $val) : ?>
                                        <option value="<?=$val['id']?>" <?=($_SESSION['src']['course_id'] == $val['id'])? 'selected="selected"' : ''; ?>><?=$val['course']?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </td>
                                  <td>
                                    <select class="src-inp" name="src[batch_id]" id="batch">
                                      <option value="0"> ---- All Batch ---- </option>
                                      <?php foreach ($batch as $key2 => $val2) : ?>
                                        <option value="<?=$val2['id']?>" <?=($_SESSION['src']['batch_id'] == $val2['id'])? 'selected="selected"' : ''; ?>><?=$val2['batch_name']?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </td>
                                  <td>
                                    <select class="src-inp" name="src[status]" style="width:120px;">
                                      <option value="0">All</option>
                                      <option value="1">Passed</option>
                                      <option value="2">Failed</option>
                                    </select>
                                  </td>
                                  <td><button class="btn btn-primary btn-sm"><i class="fe fe-search"></i> Search</button></td>
                                  <td><a href="<?=base_url()?>exam/add" class="btn btn-success btn-sm"><i class="fe fe-plus"></i> Add New</a></td>
                                </tr>
                              </table>
                            </form>
                          </td>
                        </tr>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <!-- <th>Exam Code</th> -->
                          <th>Student Name</th>
                          <th>Student Code</th>
                          <th>Course</th>
                          <th>Batch</th>
                          <!-- <th>Total Marks</th>
                          <th>Status</th> -->
                          <th>Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=$sno; foreach ($result as $key => $val ) {  $i++;?>
                        <tr>
                          <td><span class="text-muted"><?=$i?></span></td>
                          <!-- <td><a href="<?=base_url()?>exam/detail/<?=$val['ex_code']?>"> <?=$val['ex_code'];?> </a>  </td> -->
                          <td> <?=$val['name']?>  </td>
                          <td> <?=$val['student_id']?>  </td>
                          <td> <?=$val['course'];?>  </td>
                          <td> <?=$val['batch_name'];?>  </td>
                          <!-- <td> <?=$val['total'];?>  </td> -->
                          <!-- <td>
                            <?php if($val['status'] == 1) : ?>
                              <span class="status-icon bg-success"></span> Passed
                            <?php else : ?>
                              <span class="status-icon bg-danger"></span> Failed
                            <?php endif; ?>
                          </td> -->
                          <td><?=date("d-M-Y", strtotime( $val['created'] ))?></td>
                          <td>
                              <!-- <a class="icon" href="<?=base_url()?>fee/add/<?=$val['code']?>" title="Add Fee">
                                <i class="fe fe-credit-card"></i>
                              </a>
                              &nbsp; | &nbsp;
                             <a class="icon" href="<?=base_url()?>student/attendance/<?=$val['code']?>" title="Attendance">
                               <i class="fe fe-calendar"></i>
                             </a>
                             &nbsp; | &nbsp; -->
                            <a class="icon" href="<?=base_url()?>exam/info/<?=$val['student_id']?>" target="_blank" title="Print">
                              <i class="fe fe-eye"></i> Detail
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
        $("#course").change(function(){
          var id = $(this).val();
          if(id > 0) {
            $.ajax({
              type:"post",
              url:"<?=base_url()?>ajax/getBatch",
              data:"cid="+id,
              dataType:"json",
              success: function( res ) {
                var htm='<option value="0">---- All Batch ----</option>';
                $.each(res, function(i, vl){
                  htm = htm+'<option value="'+vl.id+'">'+vl.batch_name+'</option>';
                });
                $("#batch").html(htm);
              }
            });
          }
        });
      });
      </script>
