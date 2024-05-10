
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
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-user-plus"></i> &nbsp;Staff Registration</h3>
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
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" placeholder="Email" data-validation="required"  name="data[email]" data-validation-error-msg="Please enter valid email address." value="<?=$email?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Contact No.</label>
                            <input type="text" class="form-control" placeholder="Contact Number.."  name="data[mobile]" data-validation="required number length" data-validation-length="10" maxlength="10"  data-validation-error-msg-length="Contact number should be 10 digit only."  data-validation-error-msg="Please enter contact number.." value="<?=$mobile?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" placeholder="Address.."  name="data[address]" value="<?=$address?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" placeholder="City.." name="data[city]" value="<?=$city?>">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-3"><br>
                      <center>
                        <?php if(strlen($image)) : ?>
                          <img src="<?=base_url()?>media/staff/<?=$image?>" width="180" style="border:3px solid #D4D4D4; cursor:pointer;" />
                        <?php else : ?>
                          <img src="<?=base_url()?>media/config/default.jpg" id="pimg" width="180" style="border:3px solid #D4D4D4; cursor:pointer;" />
                        <?php endif; ?>
                      <input type="file" name="image" id="img" style="border:3px solid #d4d4d4;width:180px;"/>
                    </center>
                    </div>

                    <div class="col-sm-4 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control" name="data[designation]" placeholder="Designation..." data-validation="required" data-validation-error-msg="Please enter designation.." value="<?=$designation?>">
                      </div>
                    </div>

                    <div class="col-sm-4 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Salary (monthly)</label>
                        <input type="text" class="form-control" name="data[fx_sallery]" placeholder="Monthly Salary..."  value="<?=$fx_sallery?>">
                      </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Salary (Rs/Hour)</label>
                        <input type="text" class="form-control" name="data[ph_sallery]" placeholder="Hourly Salary..." data-validation="required number" data-validation-error-msg="Please enter class sallry.." value="<?=$ph_sallery?>">
                      </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Working Hour</label>
                        <input type="text" class="form-control" name="data[work_hour]" data-validation="number" placeholder="Working Hour..."  value="<?=$work_hour?>">
                      </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Staff Code</label>
                        <input type="text" class="form-control" name="data[code]" placeholder="Code..." data-validation="required number" data-validation-error-msg="Please enter staff code.." value="<?=$code?>">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="data[status]"  class="form-control">
                          <option value="1" <?=($id>0 && $status == 1)? 'selected="selected"' : '';?>>Enable</option>
                          <option value="0" <?=($id>0 && $status == 0)? 'selected="selected"' : '';?>>Disable</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>staff.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
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
