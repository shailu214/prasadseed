
<div class="my-3 my-md-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <?php if( $alert ) : ?>
          <div class="alert alert-success"><i class="fe fe-check-circle"></i> &nbsp; Profile Updated Successfully</div>
        <?php endif; ?>
        <form method="post" class="card" enctype="multipart/form-data" >
          <div class="card-body p-6">
            <div class="row">
              <div class="col-md-6" style="border-right:1px solid #eee;">
                <div class="card-title"><i class="fe fe-user"></i> Profile Setting</div>
                <div class="form-group">
                  <label class="form-label">Institute Name</label>
                  <input type="text" class="form-control" value="<?=$com_name?>" data-validation="required" data-validation-error-msg="Please enter institute name." name="set[com_name]" placeholder="Enter Institute Name..">
                </div>
                <div class="form-group">
                  <label class="form-label">Contact No.</label>
                  <input type="text" class="form-control" value="<?=$mobile?>" data-validation="required number" data-validation-error-msg="Please enter contact no." name="set[mobile]" placeholder="Enter Contact No..">
                </div>
                <div class="form-group">
                  <label class="form-label">Email Address</label>
                  <input type="text" class="form-control" value="<?=$email?>" data-validation="required email" data-validation-error-msg="Please enter email." name="set[email]" placeholder="Enter Email Address..">
                </div>
                <div class="form-group">
                  <label class="form-label">Logo.</label>
                  <a href="javascript:;" id="logo">
                    <?php if($logo) : ?>
                      <img src="<?=base_url()?>media/config/<?=$logo?>" id="img"  width="150">
                    <?php else : ?>
                      <img src="<?=base_url()?>media/config/logo-def.jpg" id="img" width="150">
                    <?php endif; ?>
                  </a>
                  <input type="file" style="display:none" name="logo" id="inplogo" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="card-title"><i class="fe fe-settings"></i> General Setting</div>
                <div class="form-group">
                  <label class="form-label">Registration Fee.</label>
                  <input type="text" class="form-control" value="<?=$reg_fee?>" data-validation="required number" data-validation-error-msg="Please enter registration fee.." name="set[reg_fee]" placeholder="Enter Registration Fee..">
                </div>
                <!-----<div class="form-group">
                  <label class="form-label">SMS Username.</label>
                  <input type="text" class="form-control" value="<?=$sms_user?>" name="set[sms_user]" placeholder="Enter SMS Username..">
                </div>
                <div class="form-group">
                  <label class="form-label">SMS Password.</label>
                  <input type="text" class="form-control" value="<?=$sms_pass?>" name="set[sms_pass]" placeholder="Enter SMS Password..">
                </div>
                <div class="form-group">
                  <label class="form-label">SMS Sender ID.</label>
                  <input type="text" class="form-control" value="<?=$sender_id?>" name="set[sender_id]" placeholder="Enter Sender ID">
                </div>----->

              </div>

              <!----<div class="col-md-12">
                <hr>
                <div class="card-title"><i class="fe fe-settings"></i> SMS Setting</div>
                <div class="form-group">
                  <label class="form-label">SMS Fee Alert.</label>
                  <textarea class="form-control" data-validation="required" data-validation-error-msg="Please enter text for fee alert sms.." name="set[sms_fee_txt]" placeholder="Enter Fee Alert SMS Content.."><?=$sms_fee_txt?></textarea>
                </div>
                <div class="form-group">
                  <label class="form-label">SMS Absent Alert.</label>
                  <textarea class="form-control" data-validation="required" data-validation-error-msg="Please enter text for absent alert sms.." name="set[sms_abs_txt]" placeholder="Enter Absent Alert SMS Content.."><?=$sms_abs_txt?></textarea>
                </div>
                <br>
                <div class="card-title"><i class="fe fe-settings"></i> Mail Setting</div>
                <div class="form-group">
                  <label class="form-label">Mail Fee Alert.</label>
                  <textarea class="form-control" data-validation="required" data-validation-error-msg="Please enter text for fee alert mail." name="set[mail_fee_txt]" placeholder="Enter Fee Alert Mail Content.."><?=$mail_fee_txt?></textarea>
                </div>
                <div class="form-group">
                  <label class="form-label">Mail Absent Alert.</label>
                  <textarea class="form-control" data-validation="required" data-validation-error-msg="Please enter text for absent alert mail." name="set[mail_abs_txt]" placeholder="Enter Absent Alert Mail Content.."><?=$mail_abs_txt?></textarea>
                </div>
            </div>--------->
            <div class="form-footer">
              <button type="submit" class="btn btn-primary btn-block">UPDATE SETTINGS</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

});
</script>
