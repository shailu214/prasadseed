
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
										<input type="hidden" name="fromway" value="<?php echo 'fare/add'; ?>">
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
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;VFP</h3>
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
                            <label class="form-label">Farmer <a style="float:right" href="#" class="farmerform">Add Farmer</a></label> <select name="" class="select2" style="width:100%">
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
						
						<div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control title" value="<?=@$obj->title?>" placeholder="Title.." data-validation="required" name="data[title]" data-validation-error-msg="Please enter title.">
							<input type="hidden" name="pkid" value="<?=@$obj->id?>" />
						 </div>
                        </div>
						
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="form-label">Year</label>
                            <input type="date" class="form-control year" value="<?=@$obj->year?>" placeholder="Mobile.." data-validation="required" name="data[year]" data-validation-error-msg="Please enter date.">
                          </div>
                        </div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Amount</label>
							<input type="text" class="form-control" value="<?=@$obj->add_fare?>" name="data[add_fare]">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value</label>
							<input type="text" class="form-control" name="data[value]" value="<?=@$obj->value?>">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value2</label>
							<input type="text" class="form-control" name="data[value_two]" value="<?=@$obj->value_two?>">
						  
						  </div>
						</div>
						
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="<?=base_url()?>fare.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
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
