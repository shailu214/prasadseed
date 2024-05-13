
      <div class="my-3 my-md-5">
        <div class="container">
          <?php if($this->session->flashdata('success_entry')) { ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record saved successfully.
          </div>
          <?php } ?>
		  
		  
		  
          <div class="row">

            <div class="col-lg-12">
              <form method="post" class="card">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Amount</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
					<?php if($this->session->flashdata('errors')) {
						echo implode(',<br>', $this->session->flashdata('errors'));
					}  ?>
                    <div class="col-md-12">
						<?php foreach([] as $v) { ?>
							<div class="row">
								<div class="col-md-3">
								  <div class="form-group">
									<label class="form-label">Deposit Date</label>
									<input type="date" class="form-control" value="<?=$v['date']?>">
								  </div>
								</div>
								
								<div class="col-md-3">
								  <div class="form-group">
									<label class="form-label">Deposit Amount</label>
									<input type="text" class="form-control" value="<?=$v['amount']?>">
								  
								  </div>
								</div>
								
								<div class="col-md-3">
								  <div class="form-group">
									<label class="form-label">Due Date</label>
									<input type="date" class="form-control" value="<?=$v['due_date']?>">
								  </div>
								</div>
							</div>
						<?php } ?>
					
					
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Deposit Date</label>
                            <input type="date" class="form-control year" name="data[date]">
							<input type="hidden" name="pkid" value="<?=$obj->id?>" />
						  </div>
                        </div>
						
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Deposit Amount</label>
							<input type="text" class="form-control amount" name="data[amount]">
						  
						  </div>
						</div>
						
						<div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Due Date</label>
                            <input type="date" class="form-control year" name="data[due_date]">
						  </div>
                        </div>
					</div>
					  
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>amount.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
                  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
	 <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

	  
      <script type="text/javascript">
	 
      </script>
