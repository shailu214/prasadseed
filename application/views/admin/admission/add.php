
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
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-user-plus"></i> &nbsp;Add Query</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" placeholder="Full Name.." data-validation="required" name="data[name]" data-validation-error-msg="Please enter full name." value="<?=$name?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Father Name</label>
                            <input type="text" class="form-control" placeholder="Father Name.." data-validation="required" name="data[father_name]" data-validation-error-msg="Please enter father name." value="<?=$father_name?>">
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
                            <input type="text" class="form-control" placeholder="Contact Number.."  name="data[mobile]" data-validation="required number length" data-validation-length="10" maxlength="10"  data-validation-error-msg-length="Contact number should be 10 digit only." data-validation-error-msg="Please enter contact number.." value="<?=$mobile?>">
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">D.O.B</label>
                        <input type="text" class="form-control" name="data[dob]" placeholder="Date of Birth..." data-validation="required" data-validation-error-msg="Please enter date of birth.." value="<?=$dob?>">
                      </div>
                      <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="data[address]" placeholder="Address..." data-validation="required" data-validation-error-msg="Please enter address.." value="<?=$address?>">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Remark</label>
                        <textarea class="form-control" rows="4" name="data[remark]" placeholder="Remark.."><?=$remark?></textarea>
                      </div>
                    </div>

                  </div>
                  <hr>

                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>admission.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
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
