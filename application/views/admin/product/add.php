
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
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-shopping-cart"></i> &nbsp;Product Mangt</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" placeholder="Product Name.." data-validation="required" name="data[product_name]" data-validation-error-msg="Please enter product name." value="<?=$product_name?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Retail Price</label>
                            <input type="text" class="form-control" placeholder="Price.." data-validation="required" name="data[price]" data-validation-error-msg="Please enter price." value="<?=$price?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Selling Price</label>
                            <input type="text" class="form-control" placeholder="Selling Price.." data-validation="required" name="data[sell_price]" data-validation-error-msg="Please enter selling price." value="<?=$sell_price?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Purchase Price</label>
                            <input type="text" class="form-control" placeholder="Purchase Price.." data-validation="required"  name="data[purchase_price]" data-validation-error-msg="Please enter purchase price." value="<?=$purchase_price?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">HSN Code</label>
                            <input type="text" class="form-control" placeholder="HSN Code.." name="data[hsn]" value="<?=$hsn?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Tax</label>
                            <select class="form-control" name="data[gst]">
                              <option value="0">None</option>
                              <?php foreach ( $taxes as $key => $val ) : ?>
                                <option value="<?=$val['val']?>" <?=($val['val'] == $gst)? 'selected="selected"' : ''?>> <?=$val['tax']?> </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="data[status]" class="form-control">
                              <option value="1" <?=($status == 1)? 'selected="selected"' : ''?> >Enable</option>
                              <option value="0" <?=($status == 0 && $id>0)? 'selected="selected"' : ''?>>Disable</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>product.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
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
