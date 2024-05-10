
      <div class="my-3 my-md-5">
        <div class="container">
         
		  
          <div class="row">

            <div class="col-lg-12">
              <form method="post" class="card ">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Return List</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
					
                    <div class="col-md-12">
                      <div class="row">
					  <?php foreach($list as $data) { ?>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Return Qty</label>
								<?=$data->return_qty?>
							</div>
                        </div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Return Date</label>
								<?=$data->return_date?>
							</div>
                        </div>
					  <?php } ?>
                        

                      </div>
					  
						
						
					</div>
					</div>
					  
                    </div>
					<div class="card-footer text-right">
                  <a href="<?=base_url()?>bardana.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
                  <button type="submit" class="btn btn-primary">Update RECORD</button>
                </div>
                  </div>
				  
                </div>
                
              </form>

            </div>
          </div>
        </div>
      </div>
