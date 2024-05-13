
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
										<input type="hidden" name="fromway" value="<?php echo 'challan/add'; ?>">
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
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Challan</h3>
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
                        <div class="col-md-6">
						  <div class="form-group">
							<label class="form-label">M/S Name</label>
							<input type="text" value="<?=@$obj->ms_name?>"  name="data[ms_name]"  class="form-control">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Vechicle No.</label>
							<input type="text" value="<?=@$obj->vechicle_no?>"  name="data[vechicle_no]"  class="form-control">
						  
						  </div>
						</div>
						<div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Vegetable ( potato, matar , sabji , e.t.c)</label>
							<select name="" class="selectVegetable2" style="width:100%">
								<option> </option>
							</select><br>
								<input type="hidden" id="vegetable_id" value="<?=@$obj->vegetable_id?>" name="data[vegetable_id]">
								<input type="hidden" id="vegetable_name" name="vegetable_name">
								<?php
								$vname = '';
								if(@$obj->id > 0) {
									$db->where('id', $obj->vegetable_id);
									$vegetable = $db->get('vegetable')->row();
									if($vegetable) {
										$vname = $vegetable->name;
					
									} 
								}
								
								?>
								<span class="vegetable_name"><?=$vname;?></span>
                          </div>
                        </div>
						<div class="col-md-2">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori_count?>"  name="data[no_of_bori_count]"  class="form-control">
						  
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">No. of Bori(In word)</label>
							<input type="text" value="<?=@$obj->no_of_bori_count_word?>"  name="data[no_of_bori_count_word]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Gaddi Bhada (Per Quintol/ Per Bora)</label>
							<input type="text" value="<?=@$obj->gaddi_bhada?>"  name="data[gaddi_bhada]"  class="form-control">
						  
						  </div>
						</div>
						<div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Bank Account</label>
							<select name="data[bank_account]" class="form-control" style="">
								<option value="">Select Bank Account</option>
								<option value="Prasad Agro Industries" <?php  if(@$obj->bank_account == 'Prasad Agro Industries') { echo 'selected'; } ?>>Prasad Agro Industries</option>
								<option value="Krishna Trading Company" <?php  if(@$obj->bank_account == 'Krishna Trading Company') { echo 'selected'; } ?>>Krishna Trading Company</option>
							</select>				
						  </div>
                        </div>
                      </div>
					  <div class="row">

					  	<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori?>"  name="data[no_of_bori]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Nisaan</label>
							<input type="text" value="<?=@$obj->nisaan?>"  name="data[nisaan]"  class="form-control ">
						  
						  </div>
						</div>

					  </div>
					  <div class="row">

					  	<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori1?>"  name="data[no_of_bori1]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Nisaan</label>
							<input type="text" value="<?=@$obj->nisaan1?>"  name="data[nisaan1]"  class="form-control ">
						  
						  </div>
						</div>

					  </div>
					  <div class="row">

					  	<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori2?>"  name="data[no_of_bori2]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Nisaan</label>
							<input type="text" value="<?=@$obj->nisaan2?>"  name="data[nisaan2]"  class="form-control ">
						  
						  </div>
						</div>

					  </div>
					  <div class="row">

					  	<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori3?>"  name="data[no_of_bori3]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Nisaan</label>
							<input type="text" value="<?=@$obj->nisaan3?>"  name="data[nisaan3]"  class="form-control ">
						  
						  </div>
						</div>

					  </div>
					  <div class="row">

					  	<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori4?>"  name="data[no_of_bori4]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Nisaan</label>
							<input type="text" value="<?=@$obj->nisaan4?>"  name="data[nisaan4]"  class="form-control ">
						  
						  </div>
						</div>

					  </div>
					  <div class="row">

					  	<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori5?>"  name="data[no_of_bori5]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Nisaan</label>
							<input type="text" value="<?=@$obj->nisaan5?>"  name="data[nisaan5]"  class="form-control ">
						  
						  </div>
						</div>

					  </div>
					  <div class="row">

					  	<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori6?>"  name="data[no_of_bori6]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Nisaan</label>
							<input type="text" value="<?=@$obj->nisaan6?>"  name="data[nisaan6]"  class="form-control ">
						  
						  </div>
						</div>

					  </div>
					  <div class="row">

					  	<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori7?>"  name="data[no_of_bori7]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Nisaan</label>
							<input type="text" value="<?=@$obj->nisaan7?>"  name="data[nisaan7]"  class="form-control ">
						  
						  </div>
						</div>

					  </div>
					  <div class="row">

					  	<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori8?>"  name="data[no_of_bori8]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Nisaan</label>
							<input type="text" value="<?=@$obj->nisaan8?>"  name="data[nisaan8]"  class="form-control ">
						  
						  </div>
						</div>

					  </div>
					  <div class="row">

					  	<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">No. of Bori</label>
							<input type="text" value="<?=@$obj->no_of_bori9?>"  name="data[no_of_bori9]"  class="form-control ">
						  
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Nisaan</label>
							<input type="text" value="<?=@$obj->nisaan9?>"  name="data[nisaan9]"  class="form-control ">
						  
						  </div>
						</div>

					  </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>delivery.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
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
		  $('.').val('');
		  $('.balance_amount').val('');
		  if(amt != '' && per != '') {
			  let val = (parseFloat(amt)*per)/100;
			  $('.').val(val);
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
	 

		$(function(){
			$(".selectVegetable2").select2({
				minimumInputLength: 1,
				placeholder: '<?php echo $vegetable; ?>',
				ajax: {
					url: '<?=base_url("entry/vegetableajax")?>',
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
									text: item.name,
									id: item.id
								}
							})
						};
					}

			}
		}).on('change', function(e) {
			var data = $(".selectVegetable2 option:selected");
			$("#vegetable_id").val(data.val());
			$("#vegetable_name").val(data.text());
		  });
		});

	 
      </script>
