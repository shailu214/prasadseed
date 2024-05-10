<form method="post" class="card">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Name Manage</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
					<?php if($this->session->flashdata('errors')) {
						echo implode(',<br>', $this->session->flashdata('errors'));
					}  ?>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name.." data-validation="required" name="data[name]" data-validation-error-msg="Please enter name." value="<?=@$obj->name?>">
							<input type="hidden" name="pkid" value="<?=@$obj->id?>">
						 </div>
                        </div>
						
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Mobile</label>
                            <input type="text" class="form-control" value="<?=@$obj->mobile?>" placeholder="Mobile.." data-validation="required" name="data[mobile]" data-validation-error-msg="Please enter category name.">
                          </div>
                        </div>
						
						<div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Father Name</label>
                            <input type="text" class="form-control" value="<?=@$obj->father_name?>" placeholder="father Name.." data-validation="required" name="data[father_name]" data-validation-error-msg="Please enter Father name.">
                          </div>
                        </div>
						
						<div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Address</label>
							<select name="" class="select2" style="width:100%">
								<option></option>
							</select><br>
							<input type="hidden" id="addressid" name="addressid" value="<?=@$obj->address?>">
							<input type="hidden" id="addressname" name="addressname">

						  </div>
                        </div>
						
						<div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Reference Name</label>
                            <input type="text" class="form-control" name="data[reference_name]" placeholder="Reference Name.." value="<?=@$obj->reference_name?>">
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>farmer.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
                  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
                </div>
              </form>