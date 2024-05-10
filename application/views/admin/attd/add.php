
      <div class="my-3 my-md-5">
        <div class="container">
          <?php if( $alert ) : ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record saved successfully.
          </div>
          <?php endif; ?>
          <div class="row">
            <div class="col-lg-12">
              <form class="card" method="post" enctype="multipart/form-data">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-upload"></i> &nbsp;Upload Attendance</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">User Type</label>
                        <select class="form-control select-input" name="role"  data-validation="required" data-validation-error-msg="Please select a role.">
                          <option value="">-- User Type --</option>
                          <option value="1">Student</option>
                          <option value="2">Staff</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Upload</label>
                        <input type="file" class="form-control" name="file" data-validation="required mime" data-validation-error-msg="Please select a file." data-validation-allowing="txt">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <!--<a href="<?=base_url()?>batch.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>-->
                  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
