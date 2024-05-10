
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
              <form method="post" class="card " id="posthandler">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Return</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
					<?php if($this->session->flashdata('errors_1')) {
						echo implode(',<br>', $this->session->flashdata('errors_1'));
					}  ?>
                    <div class="col-md-12">
                      <div class="row">
					  <?php //echo '<pre>'; print_r($list); ?> 
					 <div class="table-responsive">
						<table class="table card-table table-vcenter text-nowrap">
						  <thead>
							<tr>
							  <th>Item</th>
							  <th>Qty</th>
							  <th>Measurement</th>
							</tr>
							<tr>
							  <td><?=$list->item?></td>
							  <td><?=$list->qty?></td>
							  <td><?=$list->measurement?></td>
							</tr>
						  </thead>
						  <tbody>
						  
						  </tbody>
						  </thead>
						</table>
						
							<table class="table card-table table-vcenter text-nowrap">
							  <thead>
								<tr>
								  <th>Return Date</th>
								  <th>Return Qty</th>
								</tr>
								<?php
								$qty = 0;
								foreach($returnlist as $returnlistobj) {
									$qty += $returnlistobj['return_qty'];
									?>
								<tr>
								  <td><input type="date" value="<?=$returnlistobj['return_date']?>" readOnly  /></td>
								  <td><input type="text" value="<?=$returnlistobj['return_qty']?>"  readOnly /></td>
								</tr>
								<?php } ?>
								<?php if($list->qty != $qty) { ?>
								<tr>
									<input type="hidden" name="bardana_id" value="<?=$id?>" />
									<input type="hidden" name="type" value="1" />
								  <td><input type="date" name="return_date"  /></td>
								  <td><input type="text" name="return_qty" value="0"  />
								  <?php echo ($list->qty - $qty).' Quantity should be remove'; ?>
								  </td>
								</tr>
								<?php } ?>
							  </thead>
							  <tbody>
							  
							  </tbody>
							  </thead>
							</table>
						

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
			
			<div class="row">

            <div class="col-lg-12">
              <form method="post" class="card " id="posthandler">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Return</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
					<?php if($this->session->flashdata('errors_2')) {
						echo implode(',<br>', $this->session->flashdata('errors_2'));
					}  ?>
                    <div class="col-md-12">
                      <div class="row">
					  <?php //echo '<pre>'; print_r($list); ?> 
					 <div class="table-responsive">
						<table class="table card-table table-vcenter text-nowrap">
						  <thead>
							<tr>
							  <th>Item</th>
							  <th>Qty</th>
							  <th>Measurement</th>
							</tr>
							<tr>
							  <td><?=$list->item_two?></td>
							  <td><?=$list->qty_two?></td>
							  <td><?=$list->measurement_two?></td>
							</tr>
						  </thead>
						  <tbody>
						  
						  </tbody>
						  </thead>
						</table>
						
							<table class="table card-table table-vcenter text-nowrap">
							  <thead>
								<tr>
								  <th>Return Date</th>
								  <th>Return Qty</th>
								</tr>
								<?php
								$qty = 0;
								foreach($returnlist_two as $returnlistobj) {
									$qty += $returnlistobj['return_qty'];
									?>
								<tr>
								  <td><input type="date" value="<?=$returnlistobj['return_date']?>" readOnly  /></td>
								  <td><input type="text" value="<?=$returnlistobj['return_qty']?>"  readOnly /></td>
								</tr>
								<?php } ?>
								<?php if($list->qty_two != $qty) { ?>
								<tr>
									<input type="hidden" name="type" value="2" />
									<input type="hidden" name="bardana_id" value="<?=$id?>" />
								  <td><input type="date" name="return_date"  /></td>
								  <td><input type="text" name="return_qty" value="0"  />
								  <?php echo ($list->qty_two - $qty).' Quantity should be remove'; ?>
								  </td>
								</tr>
								<?php } ?>
							  </thead>
							  <tbody>
							  
							  </tbody>
							  </thead>
							</table>
						

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
			
			
			<div class="row">

            <div class="col-lg-12">
              <form method="post" class="card " id="posthandler">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Return</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
					<?php if($this->session->flashdata('errors_3')) {
						echo implode(',<br>', $this->session->flashdata('errors_3'));
					}  ?>
                    <div class="col-md-12">
                      <div class="row">
					  <?php //echo '<pre>'; print_r($list); ?> 
					 <div class="table-responsive">
						<table class="table card-table table-vcenter text-nowrap">
						  <thead>
							<tr>
							  <th>Item</th>
							  <th>Qty</th>
							  <th>Measurement</th>
							</tr>
							<tr>
							  <td><?=$list->item_three?></td>
							  <td><?=$list->qty_three?></td>
							  <td><?=$list->measurement_three?></td>
							</tr>
						  </thead>
						  <tbody>
						  
						  </tbody>
						  </thead>
						</table>
						
							<table class="table card-table table-vcenter text-nowrap">
							  <thead>
								<tr>
								  <th>Return Date</th>
								  <th>Return Qty</th>
								</tr>
								<?php
								$qty = 0;
								foreach($returnlist_three as $returnlistobj) {
									$qty += $returnlistobj['return_qty'];
									?>
								<tr>
								  <td><input type="date" value="<?=$returnlistobj['return_date']?>" readOnly  /></td>
								  <td><input type="text" value="<?=$returnlistobj['return_qty']?>"  readOnly /></td>
								</tr>
								<?php } ?>
								<?php if($list->qty_three != $qty) { ?>
								<tr>
									<input type="hidden" name="type" value="3" />
									<input type="hidden" name="bardana_id" value="<?=$id?>" />
								  <td><input type="date" name="return_date"  /></td>
								  <td><input type="text" name="return_qty" value="0"  />
								  <?php echo ($list->qty_three - $qty).' Quantity should be remove'; ?>
								  </td>
								</tr>
								<?php } ?>
							  </thead>
							  <tbody>
							  
							  </tbody>
							  </thead>
							</table>
						

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
			
			<div class="row">

            <div class="col-lg-12">
              <form method="post" class="card " id="posthandler">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Return</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
					<?php if($this->session->flashdata('errors_4')) {
						echo implode(',<br>', $this->session->flashdata('errors_4'));
					}  ?>
                    <div class="col-md-12">
                      <div class="row">
					  <?php //echo '<pre>'; print_r($list); ?> 
					 <div class="table-responsive">
						<table class="table card-table table-vcenter text-nowrap">
						  <thead>
							<tr>
							  <th>Item</th>
							  <th>Qty</th>
							  <th>Measurement</th>
							</tr>
							<tr>
							  <td><?=$list->item_four?></td>
							  <td><?=$list->qty_four?></td>
							  <td><?=$list->measurement_four?></td>
							</tr>
						  </thead>
						  <tbody>
						  
						  </tbody>
						  </thead>
						</table>
						
							<table class="table card-table table-vcenter text-nowrap">
							  <thead>
								<tr>
								  <th>Return Date</th>
								  <th>Return Qty</th>
								</tr>
								<?php
								$qty = 0;
								foreach($returnlist_four as $returnlistobj) {
									$qty += $returnlistobj['return_qty'];
									?>
								<tr>
								  <td><input type="date" value="<?=$returnlistobj['return_date']?>" readOnly  /></td>
								  <td><input type="text" value="<?=$returnlistobj['return_qty']?>"  readOnly /></td>
								</tr>
								<?php } ?>
								<?php if($list->qty_four != $qty) { ?>
								<tr>
									<input type="hidden" name="type" value="4" />
									<input type="hidden" name="bardana_id" value="<?=$id?>" />
								  <td><input type="date" name="return_date"  /></td>
								  <td><input type="text" name="return_qty" value="0"  />
								  <?php echo ($list->qty_four - $qty).' Quantity should be remove'; ?>
								  </td>
								</tr>
								<?php } ?>
							  </thead>
							  <tbody>
							  
							  </tbody>
							  </thead>
							</table>
						

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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('body').on('submit', '#posthandler', function() {
		
		$(this).find(":submit").attr('disabled', 'disabled');
		return true;
	});
});

</script>