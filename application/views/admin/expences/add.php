
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
              <form method="post" class="card">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fa fa-money"></i> &nbsp;Add Rokad</h3>
                <hr style="margin:0px;">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Category</label>
                            <select class="form-control" name="data[cat]" id="cat" >
                              <option value="">---- Select Category ----</option>
                              <?php foreach ($cats as $key => $val) : ?>
                                <option value="<?=$val['id']?>"><?=$val['category']?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Sub Category</label>
                            <select class="form-control" name="data[sbcat]" id="sbcat">
                              <option value="">---- Select SubCategory ----</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Year</label>
                            <input type="date" class="form-control year" value="" placeholder="Mobile.." data-validation="required" name="data[created]" data-validation-error-msg="Please enter date.">
                            <input type="hidden" name="pkid" value="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="data[title]" class="form-control" data-validation="required" data-validation-error-msg="Please enter title."  placeholder="Enter a title." value="<?=$title?>" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="data[name]" class="form-control" data-validation="required" data-validation-error-msg="Please enter Name."  placeholder="Enter a Name." value="<?=$name?>" >
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label class="form-label">Amount</label>
                            <input type="text" name="data[amount]" class="form-control" data-validation-error-msg="Please enter amount." data-validation="required number"  placeholder="Enter amount.." value="<?=$amount?>" >
                          </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                        <label class="form-label">Type</label>
                        <div class="form-group">
                          <select name="data[type]" class="pament_mode form-control" fdprocessedid="j0b6v5">
                            <option value=""> Select Option </option>
                            <option value="1" <?php if(@$obj->type == 1) { echo 'selected'; } ?>>Deposit</option>
                            <option value="2" <?php if(@$obj->type == 2) { echo 'selected'; } ?>>Expenses</option>
                           </select><br>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>expence.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a> &nbsp;
                  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

<script>
$(document).ready(function(){
  $("#cat").change(function(){
    var id = $(this).val();
    $.ajax({
      type:"post",
      url:"<?=base_url()?>ajax/getSubCat",
      data:"id="+id,
      dataType:"json",
      success: function(res) {
        $("#sbcat").html('<option value=""> ---- Select SubCategory ---- </option>');
        $.each(res, function(i, row){
          $("#sbcat").append('<option value="'+row.id+'">'+row.category+'</option>');
        });
      }
    })

  });
});
</script>
