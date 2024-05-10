
      <div class="my-3 my-md-5">
        <div class="container">
          <?php if($this->session->flashdata('success_entry')) { ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record saved successfully.
          </div>
          <?php } ?>
		  
		  
		  
          <div class="row">

			<div class="card-body q4 d-none">
					<div class="row">
						<form method="post" action="<?php echo base_url().'farmer/add' ?>" class="card">
							<h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Farmer</h3>
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
										<input type="text" class="form-control" placeholder="Name.." data-validation="required" name="data[name]" data-validation-error-msg="Please enter name." value="">
										<input type="hidden" name="pkid" value="">
										<input type="hidden" name="fromway" value="<?php echo 'bardana/add'; ?>">
									 </div>
									</div>
									
									<div class="col-md-6">
									  <div class="form-group">
										<label class="form-label">Mobile</label>
										<input type="text" class="form-control" placeholder="Mobile.." data-validation="required" name="data[mobile]" data-validation-error-msg="Please enter category name.">
									  </div>
									</div>
									
									<div class="col-md-6">
									  <div class="form-group">
										<label class="form-label">Father Name</label>
										<input type="text" class="form-control" placeholder="father Name.." data-validation="required" name="data[father_name]" data-validation-error-msg="Please enter Father name.">
									  </div>
									</div>
									
									<div class="col-md-6">
									  <div class="form-group">
										<label class="form-label">Address</label>
										<select name="" class="addressfarmer" style="width:100%">
											<option></option>
										</select><br>
										<input type="hidden" id="addressid" name="addressid">
										<input type="hidden" id="addressname" name="addressname">

									  </div>
									</div>
									
									<div class="col-md-6">
									  <div class="form-group">
										<label class="form-label">Reference Name</label>
										<input type="text" class="form-control" name="data[reference_name]" placeholder="Reference Name..">
									  </div>
									</div>

								  </div>
								</div>
							  </div>
							</div>
							<div class="card-footer text-right">
							  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
							</div>
						  </form>
					</div>
				</div>

            <div class="col-lg-12">
              <form method="post" class="card">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Bardana</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
					<?php if($this->session->flashdata('errors')) {
						echo implode(',<br>', $this->session->flashdata('errors'));
					}  ?>
                    <div class="col-md-12">
                      <div class="row">
						<div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Farmer <a style="float:right" href="#" class="farmerform">Add Farmer</a></label>
							<select name="" class="select2" style="width:100%">
								<option> </option>
							</select><br>
							<input type="hidden" id="farmer_id" value="<?php echo @$obj->farmer_id; ?>" name="data[farmer_id]">
							
						  </div>
                        </div>
						
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Year</label>
                            <input type="date" class="form-control year" value="<?php echo @$obj->year; ?>" placeholder="Mobile.." data-validation="required" name="data[year]" data-validation-error-msg="Please enter date.">
							<input type="hidden" name="pkid" value="<?php echo @$obj->id; ?>" />
						  </div>
                        </div>
						
						<div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Type</label>
							<select name="data[type]" class="form-control" style="">
								<option value="">Select Option</option>
								<option value="Company" <?php if(isset($obj->type) && $obj->type == 'Company') { echo 'selected'; }?>>Company</option>
							</select>				
						  </div>
                        </div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Item</label>
							<input type="text" class="form-control" value="<?php echo @$obj->item; ?>" name="data[item]">
						  
						  </div>
						</div>

						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Qty</label>
							<input type="text" class="form-control"  value="<?php echo @$obj->qty; ?>" name="data[qty]">
						  
						  </div>
						</div>

						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Measurement</label>
							<input type="text" class="form-control" value="<?php echo @$obj->measurement; ?>" name="data[measurement]">
						  
						  </div>
						</div>
						
                      </div>
					  
					  <div class="row weightContainer">
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Item2</label>
							<input class="form-control" value="<?php echo @$obj->item_two; ?>" name="data[item_two]" type="text" class="form-control">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value</label>
							<input class="form-control" value="<?php echo @$obj->qty_two; ?>" name="data[qty_two]" type="text" class="form-control">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value2</label>
							<input class="form-control" value="<?php echo @$obj->measurement_two; ?>" name="data[measurement_two]" type="text">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Item3</label>
							<input class="form-control" value="<?php echo @$obj->item_three; ?>" name="data[item_three]" type="text" class="form-control">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value</label>
							<input class="form-control" value="<?php echo @$obj->qty_three; ?>" name="data[qty_three]" type="text" class="form-control">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value2</label>
							<input class="form-control" value="<?php echo @$obj->measurement_three; ?>" name="data[measurement_three]" type="text">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Item4</label>
							<input class="form-control" value="<?php echo @$obj->item_four; ?>" name="data[item_four]" type="text" class="form-control">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value</label>
							<input class="form-control" value="<?php echo @$obj->qty_four; ?>" name="data[qty_four]" type="text" class="form-control">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value2</label>
							<input class="form-control" value="<?php echo @$obj->measurement_four; ?>" name="data[measurement_four]" type="text">
						  
						  </div>
						</div>
						
					</div>
					  
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>entry.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
                  <button type="submit" class="btn btn-primary">SAVE RECORD</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
	  
	 <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<?php  
	$farmar_name = '';
	if(isset($obj->id)) {
		if(isset($obj->farmer_id)) {
			$db->where('id', $obj->farmer_id);
			$farmar = $db->get('farmer')->row();
			
			if($farmar) {
				$farmar_name = $farmar->name;
			}										
		}
	}
	
	
	?>
	  
      <script>
$(document).ready(function () {
	$('body').on('click', '.farmerform', function() {
		$('.q4').removeClass('d-none');
	});
});
	  
	   $(function(){
			$(".select2").select2({
				minimumInputLength: 1,
				placeholder: '<?php echo $farmar_name; ?>',
				//templateResult: ,
				ajax: {
					url: '<?=base_url("farmer/farmerajax")?>',
					dataType: 'json',
					type: "POST",
					data: function (params) {
						return {
							searchTerm: params.term 
						};
					},
					processResults: function (data) {
						return {
							results: $.map(data, function (item) {
								return {
									text: item.search,
									id: item.id
								}
							})
						};
					}

			}
		}).on('change', function(e) {
			var data = $(".select2 option:selected");
			$("#farmer_id").val(data.val());
		  });
		  
		  $(".addressfarmer").select2({
				minimumInputLength: 1,
				ajax: {
					url: '<?=base_url("farmer/ajax")?>',
					dataType: 'json',
					type: "POST",
					data: function (params) {
						return {
							searchTerm: params.term 
						};
					},
					processResults: function (data) {
						return {
							results: $.map(data, function (item) {
								return {
									text: item.address,
									id: item.id
								}
							})
						};
					}

			}
		}).on('change', function(e) {
			var data = $(".addressfarmer option:selected");
			$("#addressid").val(data.val());
			$("#addressname").val(data.text());
		  });
		  
		});
	 
	 
      </script>
