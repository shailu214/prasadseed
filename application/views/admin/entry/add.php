<style>
	.pd-top{
		padding-top:10px;
	}
</style>
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
										<input type="hidden" name="fromway" value="<?php echo 'entry/add'; ?>">
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
				
              <form method="post" class="card" id="form-handler">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-list"></i> &nbsp;Entity</h3>
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
							<input type="hidden" value="<?=@$obj->farmer_id?>" id="farmer_id" name="data[farmer_id]">
							
						  </div>
                        </div>
                        

						<div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Vegetable ( potato, matar , sabji , e.t.c)
</label>
							<select name="" class="selectVegetable2" style="width:100%">
								<option> </option>
							</select><br>
								<input type="hidden" id="vegetable_id" value="<?=@$obj->vegetable_id?>" name="data[vegetable_id]">
								<input type="hidden" id="vegetable_name" name="vegetable_name">
                          </div>
                        </div>

						<div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Variety ( suger free , simple e.t.c)</label>
							<select name="" class="selectVariety2" style="width:100%">
								<option> </option>
							</select><br>
								<input type="hidden" id="variety_id" value="<?=@$obj->variety_id?>" name="data[variety_id]">
							<input type="hidden" id="variety_name" name="variety_name">
							
                          </div>
                        </div>
						<div class="col-md-3">
                          <div class="form-group">
                            <label class="form-label">Year</label>
                            <input type="date" class="form-control year" value="<?=@$obj->year?>" placeholder="Mobile.." data-validation="required" name="data[year]" data-validation-error-msg="Please enter date.">
							<input type="hidden" value="<?=@$obj->id?>" name="pkid">
                          </div>
                        </div>
						
                      </div>
					  
					  <div class="row  ">
						
						<div class="col-md-1">
						  <div class="form-group">
							<label class="form-label pd-top">S.No</label>
							
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<input type="text"value="<?=@$obj->sno?>" class="form-control value" name="data[sno]" placeholder="Enter Serial No.">
						  
						  </div>
						</div>
						
						<div class="col-md-7">
						  
						</div>
						
						
						
						<div class="col-md-1">
						  <div class="form-group">
							<label class="form-label pd-top">Quantity</label>
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<input type="text" name="data[qty]" value="<?=@$obj->qty?>" class=" value form-control" placeholder="Enter Quantity">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<input type="text" class="form-control value2" name="data[qty_value]" value="<?=@$obj->qty_value?>">
						  </div>
						</div>
						   <div class="col-md-3">
						  
						</div>
						  <div class="col-md-1">
						  <div class="form-group">
							<label class="form-label pd-top">Fare</label>
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<input type="text" name="data[fare]" value="<?=@$obj->fare?>" class=" value form-control" placeholder="Enter Fare">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<input type="text" class="form-control value2" value="<?=@$obj->fare_val?>" name="data[fare_val]">
						  
						  </div>
						</div>
						   <div class="col-md-3">
						  
						</div>
						  
						  <div class="col-md-1">
						  <div class="form-group">
							<label class="form-label pd-top">Quality</label>
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<input type="text" name="data[quality]" value="<?=@$obj->quality?>" class=" value form-control" placeholder="Enter Quality">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<input type="text" class="form-control  value2" value="<?=@$obj->quality_value?>" name="data[quality_value]" >
						  
						  </div>
						</div>
						  <div class="col-md-3">
						  
						</div>
						  <div class="col-md-1">
						  <div class="form-group">
							<label class="form-label pd-top">Other</label>
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<input type="text" class="form-control value" name="data[tatpatti]" value="<?=@$obj->tatpatti?>" placeholder="Other">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<input type="text" class="form-control value2" name="data[tatpatti_value]" value="<?=@$obj->tatpatti_value?>">
						  
						  </div>
						</div>
						  <div class="col-md-3">
						  
						</div>
						  <div class="col-md-1">
						  <div class="form-group">
								<label class="form-label pd-top">Lot No.</label>
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<?php 
							$lot = '';
								if(isset($obj->sno) && isset($obj->qty)) {
									$lot = $obj->sno.'/'.$obj->qty;
								}
							?>
							<input type="text" value="<?=$lot?>" class=" value form-control" disabled placeholder="Disabled">
						  
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Crop category</label>
							<select name="" class="title_category_id" style="width:100%">
								<option> </option>
							</select><br>
							<input type="hidden" id="title_category_id" value="<?=@$obj->title_category_id?>" name="data[title_category_id]">
							<input type="hidden" id="title_category_name" name="title_category_name">
								
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value</label>
							<select name="" class="title_category_value_id" style="width:100%">
								<option> </option>
							</select><br>
							<input type="hidden" id="title_category_value_id" value="<?=@$obj->title_category_value_id?>" name="data[title_category_value_id]">
							<input type="hidden" id="title_category_value_name" name="title_category_value_name">
						 </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value2</label>
							<input type="text" class="form-control value2" value="<?=@$obj->title_category_val?>" name="data[title_category_val]">
						  
						  </div>
						</div>
						
						
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Packaging Type</label>
							<select name="" class="type_id" style="width:100%">
								<option> </option>
							</select><br>
							<input type="hidden" id="type_id" value="<?=@$obj->type_id?>" name="data[type_id]">
								<input type="hidden" id="type_name" name="type_name">
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value</label>
							<select name="" class="type_value_id" style="width:100%">
								<option> </option>
							</select><br>
							<input type="hidden" id="type_value_id" name="data[type_value_id]" value="<?=@$obj->type_value_id?>">
							<input type="hidden" id="type_value_name" name="type_value_name">
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label class="form-label">Value2</label>
							<input type="text" class="form-control value2" name="data[type_value]" value="<?=@$obj->type_value?>">
						  
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
	  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php 
$vegetable = $variety = $farmar_name = $title_category_name = $title_category_value_name = $type_name = $type_value_name = '';
if(isset($obj->id)) {
	if(isset($obj->variety_id)) {
		$db->where('id', $obj->variety_id);
		$varietyObj = $db->get('vegetable_variety')->row();
		
		if($varietyObj) {
			$variety = $varietyObj->name;
		}										
	}
	
	if(isset($obj->vegetable_id)) {
		$db->where('id', $obj->vegetable_id);
		$vegetable = $db->get('vegetable')->row();
		
		if($vegetable) {
			$vegetable = $vegetable->name;
		}										
	}
	
	if(isset($obj->farmer_id)) {
		$db->where('id', $obj->farmer_id);
		$farmar = $db->get('farmer')->row();
		
		if($farmar) {
			$farmar_name = $farmar->name;
		}										
	}
	
	if(isset($obj->title_category_id)) {
		$db->where('id', $obj->title_category_id);
		$title_category = $db->get('title_category')->row();
		if($title_category) {
			$title_category_name = $title_category->name;
		}											
	}
	
	if(isset($obj->title_category_value_id)) {
		$db->where('id', $obj->title_category_value_id);
		$title_category_value = $db->get('title_category_value')->row();
		if($title_category_value) {
			$title_category_value_name = $title_category_value->name;
		}											
	}
	
	if(isset($obj->type_id)) {
		$db->where('id', $obj->type_id);
		$type = $db->get('type')->row();
		if($type) {
			$type_name = $type->name;
		}											
	}
	
	if(isset($obj->type_value_id)) {
		$db->where('id', $obj->type_value_id);
		$type_value = $db->get('type_value')->row();
		if($type_value) {
			$type_value_name = $type_value->name;
		}											
	}
} ?>

	 <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
$(document).ready(function () {
	$('body').on('click', '.farmerform', function() {
		$('.q4').removeClass('d-none');
	});
  function loadDoc() {

    var url = $('#q6 input').val()

    var link = "<iframe id='myframe' src='https://www.google.com/' width='100%' height='600px'></iframe>"
    document.getElementById("q4").innerHTML = link; //Insert your hyperlink into my Custom HTML Field (q34 in my case)

  }
  //loadDoc();

});
</script>
	  
      <script>
		  
		  $('body').on('submit', '#form-handler', function() {
			  
	  $(document).ready(function() {
			
			
		  });
	  });
	   $(function(){
			$(".select2").select2({
				minimumInputLength: 2,
				placeholder: '<?php echo $farmar_name; ?>',
				//templateResult: formatState,
				ajax: {
					url: '<?=base_url("entry/farmerajax")?>',
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
		
		
		$(function(){
			$(".selectVariety2").select2({
				minimumInputLength: 1,
				placeholder: '<?php echo $variety; ?>',
				ajax: {
					url: '<?=base_url("entry/varietyajax")?>',
					dataType: 'json',
					type: "POST",
					data: function (params) {
						return {
							searchTerm: params.term,
							searchId: $('#vegetable_id').val()
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
			var data = $(".selectVariety2 option:selected");
			$("#variety_id").val(data.val());
			$("#variety_name").val(data.text());
		  });
		});
		
		$(function(){
			$(".title_category_id").select2({
				minimumInputLength: 1,
				placeholder: '<?php echo $title_category_name; ?>',
				ajax: {
					url: '<?=base_url("entry/title_category")?>',
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
			var data = $(".title_category_id option:selected");
			$("#title_category_id").val(data.val());
			$("#title_category_name").val(data.text());
		  });
		  
		  $(".title_category_value_id").select2({
				minimumInputLength: 1,
				placeholder: '<?php echo $title_category_value_name; ?>',
				ajax: {
					url: '<?=base_url("entry/title_category_value")?>',
					dataType: 'json',
					type: "POST",
					data: function (params) {
						return {
							searchTerm: params.term,
							title_category_id: $('#title_category_id').val()
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
			var data = $(".title_category_value_id option:selected");
			$("#title_category_value_id").val(data.val());
			$("#title_category_value_name").val(data.text());
		  });
		  
		  
		  
		  $(".type_id").select2({
				minimumInputLength: 1,
				placeholder: '<?php echo $type_name; ?>',
				ajax: {
					url: '<?=base_url("entry/typeajax")?>',
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
			var data = $(".type_id option:selected");
			$("#type_id").val(data.val());
			$("#type_name").val(data.text());
		  });
		  
		  $(".type_value_id").select2({
				minimumInputLength: 1,
				placeholder: '<?php echo $type_value_name; ?>',
				ajax: {
					url: '<?=base_url("entry/typevalueajax")?>',
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
			var data = $(".type_value_id option:selected");
			$("#type_value_id").val(data.val());
			$("#type_value_name").val(data.text());
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
