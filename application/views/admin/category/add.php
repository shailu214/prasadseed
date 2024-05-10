
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
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Category Manage</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" placeholder="Category Name.." data-validation="required" name="data[category]" data-validation-error-msg="Please enter category name." value="<?=$category?>">
                          </div>
                        </div>

                        <div class="col-md-6">

                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>category.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
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
