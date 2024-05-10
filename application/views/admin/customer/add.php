
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
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-user-plus"></i> &nbsp;Customer Registration</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Customer Name</label>
                            <input type="text" class="form-control" placeholder="Customer Name.." data-validation="required" name="data[customer_name]" data-validation-error-msg="Please enter customer name." value="<?=$customer_name?>">
                          </div>
                          <div class="form-group">
                            <label class="form-label">Contact No.</label>
                            <input type="text" class="form-control" placeholder="Contact No.." data-validation="required number length" data-validation-length="10" maxlength="10" name="data[mobile]" data-validation-error-msg="Please enter contact no." data-validation-error-msg-number="Contact No. should be numeric only." data-validation-error-msg-length="Please enter 10 digit number." value="<?=$mobile?>">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea name="data[address]" class="form-control" rows="4" ><?=$address?></textarea>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>customer.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
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
