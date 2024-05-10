
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
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Subject</h3>
                <hr style="margin:0px;">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Subject</label>
                            <input type="text" name="data[subject]" class="form-control" data-validation="required" data-validation-error-msg="Please enter subject name."  placeholder="Enter Subject Name." value="<?=$subject?>" >
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Marks</label>
                            <input type="text" name="data[marks]" class="form-control" data-validation="required" data-validation-error-msg="Please enter marks."  placeholder="Enter Marks." value="<?=$marks?>" >
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="data[status]" class="form-control">
                              <option value="1" <?=($status == 1)? 'selected="selected"' : '';?>>Enable</option>
                              <option value="0" <?=($status == 0 && $edit == 1)? 'selected="selected"' : '';?>>Disable</option>
                            </select>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>subject.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a> &nbsp;
                  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
