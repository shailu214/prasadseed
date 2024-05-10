
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
										<input type="hidden" name="fromway" value="<?php echo 'amount/add'; ?>">
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
			
              <form method="post" class="card">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Amount</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
					<?php if($this->session->flashdata('errors')) {
						echo implode(',<br>', $this->session->flashdata('errors'));
					}  ?>
                    <div class="col-md-12">
                      <div class="row">
						<div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Farmer <a style="float:right" href="#" class="farmerform">Add Farmer</a></label>
							<select name="" class="select2" style="width:100%">
								<option> </option>
							</select><br>
							<input type="hidden" id="farmer_id" value="<?=@$obj->farmer_id?>" name="data[farmer_id]">
							<span class="f_name"></span>
						  </div>
                        </div>
						
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Year</label>
                            <input type="date" class="form-control year" value="<?=@$obj->year?>" placeholder="Mobile.." data-validation="required" name="data[year]" data-validation-error-msg="Please enter date.">
							<input type="hidden" name="pkid" value="<?=@$obj->id?>" />
						  </div>
                        </div>
						
						<div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Lot</label>
							<select name="data[farmer_lot_id]" class="farmer_lot_id form-control" >
								<option> Select Lot </option>
								<?php foreach($lots as $lotlist) { ?>
									<option value="<?=$lotlist['id']?>" <?php if($lotlist['id'] == $farmer_lot_id) { echo 'selected'; } ?>>
										<?=$lotlist['lots']?>
									</option>
								<?php } ?>
							</select><br>
						  </div>
                        </div>
						
						<div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Advanced</label>
							<input type="hidden" name="data[advanced]" value="0" />
							<input type="checkbox" name="data[advanced]" <?php if($advanced == 1) { echo 'checked'; } ?> value="1" />
							<br>
						  </div>
                        </div>
						
                      </div>
					  
					  <div class="row weightContainer">
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Lending Date</label>
							<input type="date" class="form-control" value="<?=@$obj->lending_date?>" name="data[lending_date]">
						  
						  </div>
						</div>

						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Comment</label>
							<textarea class="form-control" value="<?=@$obj->comment?>" name="data[comment]" rows="3"></textarea>
						  
						  </div>
						</div>
						
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Lending Amount</label>
							<input type="text" class="form-control credit_amount" value="<?=@$obj->credit_amount?>" name="data[credit_amount]">
						  
						  </div>
						</div>
						
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Per%</label>
							<select name="data[per]" class="form-control credit_per" >
								<option value=""> Select Per </option>
								<option value="0" <?php if($persent == 0) { echo 'selected'; } ?>> 0% </option>
								<option value="1" <?php if($persent == 1) { echo 'selected'; } ?>> 1% </option>
								<option value="1.25" <?php if($persent == 1.25) { echo 'selected'; } ?>> 1.25% </option>
								<option value="1.5" <?php if($persent == 1.5) { echo 'selected'; } ?>> 1.5% </option>
								<option value="1.75" <?php if($persent == 1.75) { echo 'selected'; } ?>> 1.75% </option>
								<option value="2" <?php if($persent == 2) { echo 'selected'; } ?>> 2% </option>
								<option value="2.5" <?php if($persent == 2.5) { echo 'selected'; } ?>> 2.5% </option>
								<option value="3" <?php if($persent == 3) { echo 'selected'; } ?>> 3% </option>
								<option value="3.5" <?php if($persent == 3.5) { echo 'selected'; } ?>> 3.5% </option>
								<option value="4" <?php if($persent == 4) { echo 'selected'; } ?>> 4% </option>
								<option value="4.5" <?php if($persent == 4.5) { echo 'selected'; } ?>> 4.5% </option>
								<option value="5" <?php if($persent == 5) { echo 'selected'; } ?>> 5% </option>
							</select><br>
						  </div>
						</div>
						
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Interest Amount</label>
							<input type="text" value="<?=@$obj->cal_per?>"  class="form-control interest_amt"  disabled>
						  
						  </div>
						</div>
						
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Balance Amount</label>
							<input type="text" class="form-control balance_amount" value="<?=@$obj->balance_amount?>" name="data[balance_amount]" disabled>
						  
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
	 <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

	  
      <script type="text/javascript">
	  $(document).ready(function () {
	$('body').on('click', '.farmerform', function() {
		$('.q4').removeClass('d-none');
	});
});
	  function handlepricecal(amt, per) {
		  let date = '<?php echo date('Y-m-d'); ?>';
		  let lending_date = '<?php echo @$obj->lending_date; ?>';
		  $('.interest_amt').val('');
		  $('.balance_amount').val('');
		  if(amt != '' && per != '') {
			  let val = (parseFloat(amt)*per)/100;
			  $('.interest_amt').val(val);
			  $('.balance_amount').val((parseFloat(amt)+parseFloat(val)));
		  }
	  }
	  $(document).ready(function() {
		 
		  $('body').on('change', '.credit_per', function() {
			  let amt = $('.credit_amount').val();
			  let per = $(this).val();
			  handlepricecal(amt, per);
		  });
		  
		  $('body').on('keyup', '.credit_amount', function() {
			  let per = $('.credit_per').val();
			  let amt = $(this).val();
			  handlepricecal(amt, per);
		  });
	  });
	  //
	  
	  function formatState(d) {
			if(d.lots != undefined) {
				let list = $('.farmer_lot_id');
				let res= d.lots;
				list.empty();
				list.append("<option value=''>Select Lot</option>");
				$.each(res, function(index, option) {
					list.append("<option value='" + option.id + "'>" + option.lots + "</option>");
				  
				});
			}
			if(d.id != undefined) {
				var data = $(".select2 option:selected");
				if(d.id != '') {
					$("#farmer_id").val(d.id);
				}
				
				$('.f_name').html(d.text);
			}
			
		}



	   $(function(){
			$(".select2").select2({
				//templateResult: formatResult,
				templateSelection: formatState,

				minimumInputLength: 1,
				placeholder: '<?php echo $farmar_name; ?>',
				ajax: {
					url: '<?=base_url("entry/farmerajax")?>',
					dataType: 'json',
					type: "POST",
					data: function (params) {
						return {
							searchTerm: params.term 
						};
					},
					processResults: function (res) {
						return {
							results: $.map(res, function (item) {
								return {
									lots: item.lots,
									text: item.search,
									id: item.id
								}
							})
						};
					}

			},
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
