
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
              <form class="card" method="post">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-user-plus"></i> &nbsp;Batch Registration</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Course</label>
                        <select class="form-control select-input" name="data[course_id]"  data-validation="required" data-validation-error-msg="Please select a course.">
                          <?php foreach ($course as $key => $val) : ?>
                            <option value="<?=$val['id']?>" <?=($course_id == $val['id'])? 'selected="selected"' : ''; ?>><?=$val['course']?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Batch</label>
                        <input type="text" class="form-control" placeholder="Batch Name... " name="data[batch_name]"  data-validation="required" data-validation-error-msg="Please enter batch name." value="<?=$batch_name?>">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Roll No.</label>
                        <select class="form-control select-input" name="data[status]">
                          <option value="1" <?=($status == 1)? 'selected="selected"' : ''; ?>>Enable</option>
                          <option value="0" <?=($status == 0 && $edit == 1)? 'selected="selected"' : ''; ?>>Disable</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>batch.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
                  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
