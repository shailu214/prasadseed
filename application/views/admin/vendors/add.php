
      <div class="my-3 my-md-5">
        <div class="container">
          <?php if($alert) : ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record saved successfully.
          </div>
          <?php endif; ?>
		  
		  
		  
          <div class="row">

            <div class="col-lg-12">
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
                  <a href="<?=base_url()?>vendors.html" class="btn btn-default"><i class="fa fa-angle-double-left"></i> &nbsp;BACK</a>
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
		$addr = '';
		if(isset($obj->address)) {
			$db->where('id', $obj->address);
			$dataaddr = $db->get('address')->row();
			if($dataaddr) {
				$addr = $dataaddr->address;
			}											
		} ?>
      <script>
	   $(function(){
			$(".select2").select2({
				minimumInputLength: 2,
				placeholder: '<?php echo $addr; ?>',
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
			var data = $(".select2 option:selected");
			$("#addressid").val(data.val());
			$("#addressname").val(data.text());
		  });
		});
	 /*  $(function(){
		 
	  // turn the element to select2 select style
	  $('.select2').select2({
			placeholder: "Select a state"
		  }).on('change', function(e) {
			var data = $(".select2 option:selected").text();
			$("#test").val(data);
		  });

		 
		 }); */
      </script>
