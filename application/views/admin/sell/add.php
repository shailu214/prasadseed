<?php
$isSelf = 'float:left';
if(@$obj->id > 0) {
	if($obj->self == 1) {
		$isSelf = 'display:none';
	}
}
?>
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
						<form method="post" action="<?php echo base_url().'vendors/add' ?>" class="card">
							<h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Vendor</h3>
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
										<input type="hidden" name="fromway" value="<?php echo 'sell/add'; ?>">
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
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Vendor Purchase </h3>
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
                            <label class="form-label">Year</label>
                            <input type="date" class="form-control year" value="<?=@$obj->year?>" placeholder="Mobile.." data-validation="required" name="data[year]" data-validation-error-msg="Please enter date.">
							<input type="hidden" name="pkid" value="<?=@$obj->id?>" />
						  </div>
                        </div>
						<div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Farmer Name</label>
							<select class="select2" style="width:100%">
								<option> </option>
							</select><br>
							<input type="hidden" id="farmer_id" value="<?=@$obj->farmer_id?>" name="data[farmer_id]">
							<span class="f_name"></span>
						  </div>
                        </div>
						<div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Lot</label>
							<select name="data[farmer_lot_id]" class="farmer_lot_id form-control" >
								<option value=""> Select Lot </option>
								<?php foreach($lots as $lotlist) { ?>
									<option <?php if($lotlist['id'] == @$obj->farmer_lot_id) { echo 'selected'; } ?> value="<?=$lotlist['id']?>" <?php if($lotlist['id'] == $farmer_lot_id) { echo 'selected'; } ?>>
										<?=$lotlist['lots']?>
									</option>
								<?php } ?>
							</select><br>
						  </div>
                        </div>
						<div class="col-md-3">
							<div class="col-md-3" style="float:left">
							<div class="form-group">
								<label class="form-label">Self </label>
								<input type="hidden" value="0" name="data[self]" checked>
								<input type="checkbox" id="self" <?php if(@$obj->self == 1) { echo 'checked'; } ?> value="1" name="data[self]">
								
							  </div>
							</div>
						
							<div class="col-md-9 vendor_name" style="<?php echo $isSelf; ?>">
							  <div class="form-group">
								<label class="form-label">Ventor Name <a style="float:right" href="#" class="farmerform">Add Vendor</a></label>
								<select name="" class="selectvendor2" style="width:100%">
									<option> </option>
								</select><br>
								<input type="hidden" id="vendor_id" value="<?=@$obj->vendor_id?>" name="data[vendor_id]">
								<span class="v_name"></span>
							  </div>
							</div>
						</div>
						
                      </div>

				<div class="card">
				<div class="card-header">
                    <h3 class="card-title" style="width:100%;">Cold Expenses
                    </h3>
                  </div>
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Lot detail
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
						  <th>Farmer</th>
						  <th>Lot No.</th>
                          <th>Date</th>
						  <th>Vegetable</th>
						  <th>Variety</th>
						  <th>Crop Category</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <tr class="get_load_detail"></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
				<div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Loan
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
						  <th>Farmer</th>
						  <th>Lot No.</th>
                          <th>Date</th>
						  <th>CREDIT AMOUNT</th>
						  <th>DEPOSIT AMOUNT</th>
						  <th>BALANCE AMOUNT</th>
                          <th>Comment</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="loadlist"></tr>
						
                     
                      </tbody>
                    </table>
                  </div>
                </div>
				<div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Bardana
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S.No.</th>
						  <th>Farmer</th>
                          <th>Date</th>
						  <th>Item</th>
						  <th>Qty</th>
						  <th>Remaining Qty</th>
                          <th>Comment</th>
                        </tr>
                      </thead>
                      <tbody class="bardana_list">
                        <tr>
						<td><span class="text-muted">1</span></td>
						  <td align="left"> 
							Shailendra 
						  </td>
						  <td align="left">25/10/2024</td>
                          <td align="left">Item1</td>
						  <td align="left"> 500</td>
						  <td align="left">250</td><td align="left"><textarea name="bardana_action[]"></textarea></td>
						</tr>
						
                     
                      </tbody>
                    </table>
                  </div>
                </div>

				<div class="row weightContainer">

						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Fare</label>
							<input type="text" class="form-control fare" value="<?=@$obj->credit_amount?>" disabled>
						  </div>
						</div>
						<div class="col-md-4">
						<label class="form-label">Comment</label>
						 <textarea name="data[fare_comment]"><?=@$obj->fare_comment?></textarea>
						</div>
					</div>
					<div class="row weightContainer">
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Tittle </label>
							<input type="text" class="form-control" value="<?=@$obj->title_one?>" name="data[title_one]">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value</label>
							<input type="text" class="form-control credit_amount" value="<?=@$obj->value_one?>" name="data[value_one]" >
						  </div>
						</div>
						<div class="col-md-4">
						 
						</div>
					</div>
					<div class="row weightContainer">
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Tittle </label>
							<input type="text" class="form-control" value="<?=@$obj->title_two?>" name="data[title_two]">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value</label>
							<input type="text" class="form-control credit_amount" value="<?=@$obj->value_two?>" name="data[value_two]" >
						  </div>
						</div>
						<div class="col-md-4">
						 
						</div>
					</div>
					<div class="row weightContainer">
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Tittle </label>
							<input type="text" class="form-control" value="<?=@$obj->title_three?>" name="data[title_three]">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value</label>
							<input type="text" class="form-control credit_amount" value="<?=@$obj->value_three?>" name="data[value_three]" >
						  </div>
						</div>
						<div class="col-md-4">
						 
						</div>
					</div>
					<div class="row weightContainer">
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Tittle </label>
							<input type="text" class="form-control" value="<?=@$obj->title_four?>" name="data[title_four]">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value</label>
							<input type="text" class="form-control credit_amount" value="<?=@$obj->value_four?>" name="data[value_four]" >
						  </div>
						</div>
						<div class="col-md-4">
						 
						</div>
					</div>
				
					  
					  <div class="row weightContainer">
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Quantity </label>
							<input type="text" class="form-control quantity" value="<?=@$obj->quantity?>" name="data[quantity]">
						  </div>
						</div>
						<div class="col-md-3 credit_amount_row" style="<?=$isSelf?>">
						  <div class="form-group">
							<label class="form-label">Price</label>
							<input type="text" class="form-control credit_amount prce" value="<?=@$obj->price?>" name="data[price]">
						  </div>
						</div>
						<div class="col-md-3 total_price_row" style="<?=$isSelf?>">
						  <div class="form-group">
							<label class="form-label">Total Price</label>
							<input type="text" value="<?=@$obj->quantity*@$obj->price?>"  class="form-control total_price"  disabled>
						  </div>
						</div>
						
						
						<div class="col-md-3">
						  <div class="form-group">
							<label class="form-label">Short Qty</label>
							<input type="text" value="<?=@$obj->short_qty?>" name="data[short_qty]"  class="form-control short_qty" >
						  </div>
						</div>
						
					</div>
					<div class="row weightContainer">
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Nikasi Date </label>
							<input type="date" class="form-control" value="<?=@$obj->nikasi_date?>" name="data[nikasi_date]">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Pament Mode</label>
							<div class="form-group">
								<select name="data[pament_mode]" class="pament_mode form-control" fdprocessedid="j0b6v5">
									<option value=""> Select Payment Option </option>
									<option value="1" <?php if(@$obj->pament_mode == 1) { echo 'selected'; } ?>>Cash</option>
									<option value="2" <?php if(@$obj->pament_mode == 2) { echo 'selected'; } ?>>Account Transfer</option>
									<option value="3" <?php if(@$obj->pament_mode == 3) { echo 'selected'; } ?>>Cash / Account </option>
								</select><br>
						  </div>
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Comment</label>
							<textarea name="data[comment]"><?=@$obj->comment?></textarea>
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
	  <?php if($obj != null) { ?>
		onChangeLot('<?php echo @$obj->id; ?>', '<?php echo @$obj->farmer_lot_id; ?>');
	  <?php } ?>
	  
	  function onChangeLot(obj, lotid) {
		$('.get_load_detail').html('');
		$('.loadlist').html('');

			$.ajax({
				url: '<?=base_url("vendors/getdata")?>',
				dataType: 'json',
				type: "get",
				data: {'lotid':lotid, 'pkid':obj},
				success: function(json){
					let obj = json.obj;
					console.log(obj);
					$('.fare').val(json.fare);
					
					let entry_management = json.entry_management;
					if(entry_management) {
						var bardanahtml = '';
						console.log(json);
						$.each(json.bardana, function(key,list) {  
							//console.log(key,list);
							let k = ++key;
							 bardanahtml += '<tr>';
							 bardanahtml += '<td>'+k+'</td>';
							 bardanahtml += '<td></td>';
							 bardanahtml += '<td>'+list.year+'</td>';
							 bardanahtml += '<td>'+list.item+'</td>';
							 bardanahtml += '<td>'+list.qty+'</td>';
							 bardanahtml += '<td>'+list.returnqty+'</td>';
							 let cmt = '';
							 if(list.iscomment === true) {
								 cmt = list.comment.comment;
							 }
							 bardanahtml += '<td><textarea name="bardanacomment['+list.id+']" >'+cmt+'</textarea></td>';
							 /*
							 if(typeof list.comment === 'undefined') {
								 bardanahtml += '<td><textarea name="bardanacomment['+list.id+']" ></textarea></td>';
							 } else {
								 let cmt = '';
								 if(list.commentid > 0) {
									 cmt = list.comment;
									 
								 }
								 bardanahtml += '<td><textarea name="bardanacomment['+list.id+']" >'+cmt+'</textarea></td>';
							 }
							 */
							 
							 bardanahtml += '</tr>';
						});
						$('.bardana_list').html(bardanahtml);
						
						
						let load_detail = '<td><span class="text-muted">1</span></td>';
						load_detail += '<td align="left"></td>';
						load_detail += '<td align="left">'+entry_management.sno+'/'+entry_management.qty+'</td>';
						load_detail += '<td align="left">25/10/2024</td>';
						load_detail += '<td align="left"> '+entry_management.vegetable_id+'</td>';
						load_detail += '<td align="left">'+entry_management.variety_id+'</td>';
						load_detail += '<td align="left">'+entry_management.title_category_id+'</td>';
						if(typeof obj.lot_detail_action === 'undefined') {
							load_detail += '<td align="left"><textarea name="data[lot_detail_action]"></textarea></td>';
						} else {
							load_detail += '<td align="left"><textarea name="data[lot_detail_action]">'+obj.lot_detail_action+'</textarea></td>';
						}
						
						$('.get_load_detail').html(load_detail);
						
						//$('.get_load_detail').html('<td><span class="text-muted">1</span></td><td align="left"></td><td align="left">'+entry_management.sno+'/'+entry_management.qty+'</td><td align="left">25/10/2024</td><td align="left"> '+entry_management.vegetable_id+'</td><td align="left">'+entry_management.variety_id+'</td><td align="left">'+entry_management.title_category_id+'</td><td align="left"><textarea name="data[lot_detail_action]">'+obj.lot_detail_action+'</textarea></td>');

						let loan = json.loan;
						if(loan) {
							let loadlist = '<td><span class="text-muted">1</span></td>';
							loadlist += '<td align="left"></td>';
							loadlist += '<td align="left">'+entry_management.sno+'/'+entry_management.qty+'</td>';
							loadlist += '<td align="left">'+loan.lending_date+'</td>';
							loadlist += '<td align="left">'+loan.credit_amount+'</td>';
							loadlist += '<td align="left">'+loan.deposit_amount+'</td>';
							loadlist += '<td align="left">'+loan.balance_amount+'</td>';
							
							if(typeof  obj.loan_action === 'undefined') {
								loadlist += '<td align="left"><textarea name="data[loan_action]"></textarea></td>';
							} else {
								loadlist += '<td align="left"><textarea name="data[loan_action]">'+obj.loan_action+'</textarea></td>';
							}
							
							
							$('.loadlist').html(loadlist);
						}
					}
					
				}
			});
	  }
	  
	  $(document).ready(function () { // 
	  
		  $('body').on('change', '#self', function() {
			  $('.vendor_name').removeAttr('style');
			  $('.credit_amount').val(0);
			  $('.total_price').val(0);
			  if ($(this).is(':checked')) {
				  $(this).attr('value', 1);
				  $('.credit_amount_row').attr('style', 'display:none');
				 $('.total_price_row').attr('style', 'display:none');
			  
				  $('.vendor_name').attr('style', 'float:left;display:none');
			  } else {
				   $(this).attr('value', 0);
				   $('.vendor_name').attr('style', 'float:left');
				   $('.credit_amount_row').removeAttr('style');
				 $('.total_price_row').removeAttr('style');
			  }
		  });
		  
		  $('body').on('keyup', '.quantity', function() {
			  let quantity = $(this).val();
			  let price = $('.prce').val();
			  $('.total_price').val(quantity*price);
		  });
		  
		  $('body').on('keyup', '.prce', function() {
			  let price = $(this).val();
			  let quantity = $('.quantity').val();
			  $('.total_price').val(quantity*price);
		  });
		  
		  
		$('body').on('click', '.farmerform', function() {
			$('.q4').removeClass('d-none');
		});
		
		$('body').on('change', '.farmer_lot_id', function() {
			onChangeLot('<?php echo @$obj->id; ?>', $(this).val());
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
		  $('.bardana_list').html('');
		  $('.get_load_detail').html('');
		  
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

function vensorformatState(d) {
	if(d.id != undefined) {
		var data = $(".selectvendor2 option:selected");
		if(d.id != '') {
			$("#vendor_id").val(d.id);
		}
		
		$('.v_name').html(d.text);
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
		  
		$(".selectvendor2").select2({
				//templateResult: formatResult,
				templateSelection: vensorformatState,

				minimumInputLength: 1,
				placeholder: '<?php echo $farmar_name; ?>',
				ajax: {
					url: '<?=base_url("vendors/vendorajax")?>',
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
