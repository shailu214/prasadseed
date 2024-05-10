
<div class="my-3 my-md-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <?php if( $alert ) : ?>
          <div class="alert alert-success"><i class="fe fe-check-circle"></i> &nbsp; SMS Sent Successfully</div>
        <?php endif; ?>
        <form method="post" class="card" enctype="multipart/form-data" >
          <div class="card-body p-6">
            <div class="card-title"><i class="fe fe-mail"></i> SEND SMS</div>
            <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <select class="form-control" id="type" name="set[type]"  data-validation="required" data-validation-error-msg="Please select a option for sms.">
                      <option value="" >None</option>
                      <option value="1">Batch</option>
                      <option value="2">Staff</option>
                      <option value="3">Admission Query</option>
                      <option value="4">Customers</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 btc"  style="display:none">
                  <div class="form-group">
                    <select class="form-control" name="set[batch]">
                    <?php foreach ($batch as $key => $val)  : ?>
                      <option value="<?=$val['id']?>"><?=$val['batch_name']?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 btc" style="display:none">
                  <div class="form-group">
                    <select class="form-control" name="set[to]"  data-validation="required" data-validation-error-msg="Please select a option for sms.">
                      <option value="1" >Parent</option>
                      <option value="2">Student</option>
                      <option value="3">Both</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">Message.</label>
                    <textarea class="form-control" rows="4" data-validation="required" data-validation-error-msg="Please your message.." name="set[msg]" placeholder="Enter Your Message.."></textarea>
                  </div>
              </div>

            <div class="form-footer">

              <button type="submit" class="btn btn-primary btn-block">SEND SMS</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $("#type").change(function(){
    val = $(this).val();
    if(val == 1) {
      $(".btc").show();
    } else {
      $(".btc").hide();
    }
  })
});
</script>
