      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Staff List
                    <a href="<?=base_url()?>staff/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
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
                                  <td><input type="text" class="src-inp" name="src[code]" style="width:120px;"  placeholder="Code.." value="<?=$this->session->src['code']?>" /></td>
                                  <td><input type="text" class="src-inp" name="src[name]" style="width:260px;"  placeholder="Staff Name.." value="<?=$this->session->src['name']?>" /></td>
                                  <td>
                                    <select class="src-inp" name="src[status]" style="width:160px;">
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
                          <th>Staff Name</th>
                           <th>Code</th> 
                          <th>Mobile</th>
                          <th>Designation</th>
                          <!-- <th>Salary</th> -->
                          <th>Status</th>
                          <th>Created</th>
                          <th>Attendance</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=$sno; foreach ($result as $key => $val ) {  $i++;?>
                        <tr>
                          <td><span class="text-muted"><?=$i?></span></td>
                          <td> <?=$val['fname'].' '.$val['lname']?>  </td>
                           <td> <?=$val['code'];?>  </td> 
                          <td> <?=$val['mobile'];?>  </td>
                          <td> <?=$val['designation'];?>  </td>
                          <!-- <td> <?=$val['fx_sallery'];?>  </td> -->
                          <td>
                            <?php if($val['status'] == 1) : ?>
                              <span class="status-icon bg-success"></span> Enable
                            <?php else : ?>
                              <span class="status-icon bg-danger"></span> Disable
                            <?php endif; ?>
                          </td>
                          <td> <?=date("d M Y", strtotime($val['created']));?>  </td>
                          <td align="center">
                            <?php if($val['att_id'] > 0) { ?>
                              <?php if( strlen($val['login_time'] ) > 0 && $val['logout_time'] == 0 ) : ?>
                                <a href=" javascript:;" id="login" data-row-id="<?=$val['code']?>">Logout</a>
                              <?php elseif( strlen($val['login_time'] ) > 0 && strlen($val['logout_time'] ) > 0 ) : ?>
                                <span class="badge badge-success">Added</span>
                              <?php else :  ?>
                                <a href=" javascript:;" id="login" data-row-id="<?=$val['code']?>">Login</a>
                              <?php endif; ?>
                            <?php } else { ?>
                              <a href=" javascript:;" id="login" data-row-id="<?=$val['code']?>">Login</a>
                            <?php } ?>
                          </td>
                          <td>
                            <a class="icon" href="<?=base_url()?>/staff/edit/<?=$val['id']?>">
                              <i class="fe fe-edit"></i>
                            </a>
                            &nbsp; | &nbsp;
                            <a class="icon delete" href="javascript:void(0)" title="ATTENDANCE" data-path="<?=base_url()?>" data-row-id="<?=$val['id']?>" data-tbl="staff">
                              <i class="fe fe-trash"></i>
                            </a>
                            &nbsp; | &nbsp;
                            <a class="icon" href="<?=base_url()?>staff/attendance/<?=$val['code']?>/<?=date('n')?>" title="ATTENDANCE" data-toggle="tooltip">
                              <i class="fe fe-calendar"></i>
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
  $(document).on("click", "#login", function(){

    var uid = $(this).attr("data-row-id");
    var td = $(this).parent('td');
    var txt = $(this).text();

    td.html('<div class="lds-css ng-scope">'+
              '<div style="width:100%;height:100%" class="lds-eclipse">'+
                '<div></div>'+
              '</div>'+
            '</div>');

    $.ajax({
        type:"post",
        url:"<?=base_url()?>ajax/setAttd",
        data:"id="+uid,
        success: function( res ) {
          setTimeout(function(){
            if(txt == 'Login') {
              td.html('<a href=" javascript:;" id="login" data-row-id="'+uid+'">Logout</a>');
            } else {
              td.html('<span class="badge badge-success">Added</span>');
            }
          },2000);
        }
    });
  });


  $("#reset").click(function(){
    $.ajax({
        type:"post",
        url:"<?=base_url()?>ajax/resetsrc",
        data:"",
        success: function( res ) {
          window.location.href="<?=base_url()?>/staff.html"
        }
    });
  });

});
</script>
