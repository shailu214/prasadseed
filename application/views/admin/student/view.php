      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck" style="margin-right:-4.75rem;margin-left:-4.75rem;">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">

                      <div class="atd-block" style="float:left">
                        Student List
                      </div>
                      <div class="block-info" style="margin-left:20%">
                        <div class="bs-child" > <i class="fe fe-user"></i> TOTAL &nbsp;: &nbsp;<b ><?=$total?></b></div>
                      </div>
                      <div class="block-success" >
                        <div class="bs-child" > <i class="fe fe-eye"></i> ACTIVE &nbsp;: &nbsp;<b><?=$active?></b></div>
                      </div>
                      <div class="block-danger">
                        <div class="bs-child" > <i class="fe fe-eye-off"></i> INACTIVE  &nbsp;: &nbsp;<b ><?=$inactive?></b></div>
                      </div>
                    <a href="<?=base_url()?>student/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
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
                                  <td><input type="text" class="src-inp" name="src[code]" style="width:90px;"  placeholder="Code.." value="<?=$this->session->src['code']?>" /></td>
                                  <td><input type="text" class="src-inp" name="src[name]" style="width:180px;"  placeholder="Student Name.." value="<?=$this->session->src['name']?>" /></td>
                                  <!-- <td><input type="text" class="src-inp" name="src[mob]"  style="width:150px;" placeholder="Contact No.." value="<?=$this->session->src['mob']?>" /></td> -->
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
                                      <option value="1">Enable</option>
                                      <option value="2">Disable</option>
                                    </select>
                                  </td>
                                  <td><button class="btn btn-primary btn-sm"><i class="fe fe-search"></i> Search</button></td>
                                  <td><a class="btn btn-danger btn-sm" id="reset" style="color:#fff"><i class="fe fe-rotate-ccw"></i> Reset</a></td>
                                </tr>
                              </table>
                            </form>
                          </td>
                        </tr>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Student Name</th>
                          <th>Code</th>
                          <th>Course</th>
                          <th>Batch</th>
                          <th>Services</th>
                          <th>Status</th>
                          <!-- <th>Created</th> -->
                          <th width="290">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=$sno; foreach ($result as $key => $val ) {  $i++;?>
                        <tr>
                          <td><span class="text-muted"><?=$i?></span></td>
                          <td><a href="<?=base_url()?>student/info/<?=$val['id']?>" ><?=$val['fname'].' '.$val['lname']?></a>  </td>
                          <td> <?=$val['code'];?>  </td>
                          <td> <?=$val['course'];?>  </td>
                          <td> <?=$val['batch_name'];?>  </td>
                          <td>
                            <?php $r=0;
                            $usrv = explode(',', $val['services']);
                            foreach ($services as $sk => $sv) { $r++; ?>
                              <?php if($r%2==1) { echo '<br>'; } ?>
                              <?php if(in_array($sv['id'], $val['act'])) { ?>
                                <span class="text-success"><i class="fe fe-check"></i> <?=$sv['service_name']?></span>
                              <?php } elseif( in_array($sv['id'], $usrv)) { ?>
                                <input type="checkbox" name="" checked class="srv" value="<?=$sv['id']?>" data-row-id="<?=$val['id']?>" /> <?=$sv['service_name']?>
                            <?php } else {?>
                                <input type="checkbox" name=""  class="srv" value="<?=$sv['id']?>" data-row-id="<?=$val['id']?>" /> <?=$sv['service_name']?>
                            <?php } ?>
                              <?php if($r%2==1) { echo ' &nbsp; | &nbsp; '; } ?>

                          <?php } ?>
                          </td>
                          <td>
                            <?php if($val['status'] == 1) : ?>
                              <span class="status-icon bg-success"></span> Enable
                            <?php else : ?>
                              <span class="status-icon bg-danger"></span> Disable
                            <?php endif; ?>
                          </td>
                          <!-- <td> <?=date("d M Y", strtotime($val['created']));?>  </td> -->
                          <td>
                            <a class="icon" href="<?=base_url()?>fee/add/<?=$val['code']?>" title="Add Fee">
                              <i class="fe fe-credit-card"></i>
                            </a>

                            &nbsp; | &nbsp;
                           <a class="icon" href="<?=base_url()?>student/attendance/<?=$val['code']?>" title="Attendance">
                             <i class="fe fe-calendar"></i>
                           </a>
                           &nbsp; | &nbsp;
                          <a class="icon" href="<?=base_url()?>student/download/<?=$val['code']?>" title="Download Attendance">
                            <i class="fe fe-download"></i>
                          </a>
						 
                          &nbsp; | &nbsp;
                          <?php if( strlen( $val['qr_img'] ) ) : ?>
                           <a class="icon" href="<?=base_url()?>qr-code/<?=$val['qr_img']?>" title="QR Download" download>
                             <i class="fe fe-cpu"></i>
                           </a>
                           &nbsp; | &nbsp;
                          <?php endif; ?>
                          <a class="icon" href="<?=base_url()?>leave/<?=$val['code']?>" title="Leave">
                            <i class="fe fe-clock"></i>
                          </a>
                           &nbsp; | &nbsp;
                          <a class="icon" href="<?=base_url()?>/student/edit/<?=$val['id']?>" title="Edit">
                            <i class="fe fe-edit"></i>
                          </a>
                           &nbsp; | &nbsp;
                          <a class="icon delete" href="javascript:void(0)" title="Delete" data-row-id="<?=$val['id']?>" data-path="<?=base_url()?>" data-tbl="student">
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

      <div class="notidiv">
        <i class="fe fe-check"></i> &nbsp; &nbsp;
        <span id="ntxt"></span>
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

        $("#reset").click(function(){
          $.ajax({
              type:"post",
              url:"<?=base_url()?>ajax/resetsrc",
              data:"",
              success: function( res ) {
                window.location.href="<?=base_url()?>student.html"
              }
          });
        });

        $(".srv").click(function(){
          id = $(this).attr('data-row-id');
          sid = $(this).val();
          if($(this).prop('checked') == true) {
            act = "set";
          } else {
            act = "unset";
          }
          $.ajax({
              type:"post",
              url:"<?=base_url()?>ajax/set_service",
              data:"id="+id+"&sid="+sid+"&act="+act,
              success: function( res ) {
                $("#ntxt").text("Service Updated Successfully.");
                $(".notidiv").fadeIn();
                setTimeout(function(){
                  $(".notidiv").fadeOut();
                },1200);
              }
          });
        });

      });
      </script>
