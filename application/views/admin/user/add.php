
      <div class="my-3 my-md-5">
        <div class="container">
          <?php if($alert) : ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record saved successfully.
          </div>
          <?php endif; ?>
          <div class="row">

            <div class="col-lg-12">
              <form method="post" class="card" enctype="multipart/form-data">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-user-plus"></i> &nbsp;Employee Registration</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-9">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="First Name.." data-validation="required" name="data[fname]" data-validation-error-msg="Please enter first name." value="<?=$fname?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name.." data-validation="required" name="data[lname]" data-validation-error-msg="Please enter last name." value="<?=$lname?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="Username.." data-validation="required"  name="data[username]" data-validation-error-msg="Please enter username." value="<?=$username?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password.."  name="data[password]" data-validation="required" data-validation-error-msg="Please enter password.." value="<?=$password?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Role</label>
                            <select name="data[role]" class="form-control"data-validation="required" >
                              <option value="" > --- Select Role --- </option>
                              <option value="2" <?=($role == 2)? 'selected="selected"' : '';?>>Manager</option>
                              <option value="3" <?=($role == 3)? 'selected="selected"' : '';?>>Staff</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <?php $opt = explode(',', $perm_opt); ?>

                  <?php if ( in_array(1, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <b>Student Mangt.</b><br>
                  <input type="checkbox" name="opt[]" value="1" <?=(in_array(1, $opt))? 'checked="checked"' : '';?> />&nbsp; Student Mangt. &nbsp; &nbsp; &nbsp;
                  <!-- <input type="checkbox" name="opt[]" value="2" <?=(in_array(2, $opt))? 'checked="checked"' : '';?>/>&nbsp; Staff Mangt. &nbsp; &nbsp; &nbsp; -->
                  <hr style="margin:20px 0px 20px 0px;">
                  <?php } ?>
                  <?php if ( in_array(2, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <b>Student Mangt.</b><br>
                  <input type="checkbox" name="opt[]" value="2" <?=(in_array(2, $opt))? 'checked="checked"' : '';?> />&nbsp; Staff List. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="3" <?=(in_array(3, $opt))? 'checked="checked"' : '';?>/>&nbsp; Staff Report. &nbsp; &nbsp; &nbsp;
                  <hr style="margin:20px 0px 20px 0px;">
                  <?php } ?>

                  <?php if ( in_array(3, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <b>Institute Mangt.</b><br>
                  <input type="checkbox" name="opt[]" value="4" <?=(in_array(4, $opt))? 'checked="checked"' : '';?> />&nbsp; Class Mangt. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="5" <?=(in_array(5, $opt))? 'checked="checked"' : '';?> />&nbsp; Batch Mangt. &nbsp; &nbsp; &nbsp;
                  <hr style="margin:20px 0px 20px 0px;">
                  <?php } ?>

                  <?php if ( in_array(4, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <b>Attendance Mangt.</b><br>
                  <input type="checkbox" name="opt[]" value="6" <?=(in_array(6, $opt))? 'checked="checked"' : '';?> />&nbsp; Upload Attendance. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="7" <?=(in_array(7, $opt))? 'checked="checked"' : '';?> />&nbsp; Today's Attendance Report. &nbsp; &nbsp; &nbsp;
                  <hr style="margin:20px 0px 20px 0px;">
                  <?php } ?>
                  <?php if ( in_array(5, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <b>Sale Mangt.</b><br>
                  <input type="checkbox" name="opt[]" value="8" <?=(in_array(8, $opt))? 'checked="checked"' : '';?> />&nbsp; Product Mangt. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="9" <?=(in_array(9, $opt))? 'checked="checked"' : '';?> />&nbsp; Customer Mangt. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="10" <?=(in_array(10, $opt))? 'checked="checked"' : '';?> />&nbsp; Vendor Mangt. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="11" <?=(in_array(11, $opt))? 'checked="checked"' : '';?> />&nbsp; Sale Mangt. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="12" <?=(in_array(12, $opt))? 'checked="checked"' : '';?> />&nbsp; Purchase Mangt. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="13" <?=(in_array(13, $opt))? 'checked="checked"' : '';?> />&nbsp; Sale Log. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="14" <?=(in_array(14, $opt))? 'checked="checked"' : '';?> />&nbsp; Purchase Log. &nbsp; &nbsp; &nbsp;
                  <hr style="margin:20px 0px 20px 0px;">
                  <?php } ?>
                  <?php if ( in_array(6, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <b>Fee Mangt.</b><br>
                  <input type="checkbox" name="opt[]" value="15" <?=(in_array(15, $opt))? 'checked="checked"' : '';?> />&nbsp; Fee Mangt. &nbsp; &nbsp; &nbsp;
                  <hr style="margin:20px 0px 20px 0px;">
                  <?php } ?>
                  <?php if ( in_array(7, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <b>Expenses Mangt.</b><br>
                  <input type="checkbox" name="opt[]" value="16" <?=(in_array(16, $opt))? 'checked="checked"' : '';?> />&nbsp; Category Mangt. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="17" <?=(in_array(17, $opt))? 'checked="checked"' : '';?> />&nbsp; SubCategory Mangt. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="18" <?=(in_array(18, $opt))? 'checked="checked"' : '';?> />&nbsp; Add Expenses. &nbsp; &nbsp; &nbsp;
                  <hr style="margin:20px 0px 20px 0px;">
                  <?php } ?>
                  <?php if ( in_array(8, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <b>Exam Mangt.</b><br>
                  <input type="checkbox" name="opt[]" value="23" <?=(in_array(23, $opt))? 'checked="checked"' : '';?> />&nbsp; Subject Mangt. &nbsp; &nbsp; &nbsp;
                  <input type="checkbox" name="opt[]" value="24" <?=(in_array(24, $opt))? 'checked="checked"' : '';?> />&nbsp; Result Mangt. &nbsp; &nbsp; &nbsp;
                  <hr style="margin:20px 0px 20px 0px;">
                  <?php } ?>
                  <b>Others.</b><br>
                  <?php if ( in_array(9, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <input type="checkbox" name="opt[]" value="19" <?=(in_array(19, $opt))? 'checked="checked"' : '';?> />&nbsp; Admission Query. &nbsp; &nbsp; &nbsp;
                  <?php } ?>
                  <?php if ( in_array(10, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <input type="checkbox" name="opt[]" value="20" <?=(in_array(20, $opt))? 'checked="checked"' : '';?> />&nbsp; Due Fee List. &nbsp; &nbsp; &nbsp;
                  <?php } ?>
                  <?php if ( in_array(11, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <input type="checkbox" name="opt[]" value="21" <?=(in_array(21, $opt))? 'checked="checked"' : '';?> />&nbsp; Absent List. &nbsp; &nbsp; &nbsp;
                  <?php } ?>
                  <?php if ( in_array(12, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <input type="checkbox" name="opt[]" value="22" <?=(in_array(22  , $opt))? 'checked="checked"' : '';?> />&nbsp; SMS. &nbsp; &nbsp; &nbsp;
                  <?php } ?>
                  <?php if ( in_array(13, $_SESSION['APP_OPT_ALLOW']) ) { ?>
                  <input type="checkbox" name="opt[]" value="25" <?=(in_array(25  , $opt))? 'checked="checked"' : '';?> />&nbsp; Employee Mangt. &nbsp; &nbsp; &nbsp;
                  <?php } ?>

                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>user.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
                  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
      <script>
      $(document).ready(function(){

        $("#img").change(function(){
          if(this.files && this.files[0]) {
          var reader =new FileReader();
          reader.onload = function(e) {
              $("#pimg").attr('src',e.target.result);
              }
              reader.readAsDataURL(this.files[0]);
            }
        });

        $("#course").change(function(){
          var id = $(this).val();
          $.ajax({
            type:'post',
            url:'<?=base_url()?>ajax/getBatch',
            data:'cid='+id,
            dataType:'json',
            success: function( res ) {
              var htm='<option value="">---- Select Batch ----</option>';
              $.each(res, function(i, vl){
                htm = htm+'<option value="'+vl.id+'">'+vl.batch_name+'</option>';
              });
              $("#bat").html(htm);
            }

        });

      });

    });
      </script>
