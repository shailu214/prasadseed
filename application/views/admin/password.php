
<div class="my-3 my-md-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <?php if( $alert ) : ?>
          <div class="alert alert-success"><i class="fe fe-check-circle"></i> &nbsp;Password Changed Successfully</div>
        <?php endif; ?>
        <form method="post" class="card" >
          <div class="card-body p-6">
            <div class="card-title">Change your password</div>
            <div class="form-group">
              <label class="form-label">New Password</label>
              <input type="text" class="form-control" data-validation="required" data-validation-error-msg="Please enter username.." name="newpass" placeholder="Enter Username..">
            </div>
            <!-- <div class="form-group">
              <label class="form-label">
                Repeat Password
              </label>
              <input type="password" class="form-control" data-validation="confirmation" data-validation-confirm="newpass" placeholder="Enter Password..">
            </div> -->

            <div class="form-footer">
              <button type="submit" class="btn btn-primary btn-block">Change Password</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
