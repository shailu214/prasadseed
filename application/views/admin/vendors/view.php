      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Vendors List
                    <a href="<?=base_url()?>vendors/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
						<tr>
                          <td colspan="9"  style="border-bottom:1px solid #ddd">
                            <form method="get">
                              <table>
                                <tr>
								<td>
										<select name="" id="vendorselect3" style="width:100%">
											<option> </option>
										</select>
										<input type="hidden" id="vendor_id" name="src[vendor_id]">
									
									</td>
                                  <td><input type="text" class="src-inp" name="src[name]" style="width:190px;"  placeholder="Name.."  /></td>
								  <td><input type="text" class="src-inp" name="src[mobile]" style="width:190px;"  placeholder="Mobile.."  /></td>
                                 <td>
									<select name="" class="select2" style="width:100%">
										<option> </option>
									</select>
									<input type="hidden" class="src-inp addrfilter" name="src[address]" style="width:190px;"  />
								 </td>
                                  
                                  <td><button class="btn btn-primary btn-sm"><i class="fe fe-search"></i> Search</button></td>
                                  <td><a href="<?php echo base_url(); ?>vendors" class="btn btn-danger btn-sm" id="reset" style="color:#fff"><i class="fe fe-rotate-ccw"></i> Reset</a></td>
                                </tr>
                              </table>
                            </form>
                          </td>
                        </tr>
						
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Name</th>
                          <th>Mobile</th>
						  <th>Address</th>
						  <th>Refrence Name</th>
						  <th>Comment</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						
						foreach ($result as $key => $val ) { $sn++; ?>
                        <tr>
                          <td><span class="text-muted"><?=$sn?></span></td>
                          <td align="left">  <?=$val['name']?>  </td>
                          <td align="left">  <?=$val['mobile']; ?>  </td>
                          <td align="left"> 

							<?php 
								$db->where('id', $val['address']);
								$obj = $db->get('address')->row();
								if($obj) {
									echo $obj->address;
								}
							?>
						  </td>
                          <td width="200">
                            <?=$val['reference_name']; ?>
                          </td>
						  <td align="left">  <?=$val['comment']?>  </td>
						  <td align="left">  
							<a class="icon" href="<?=base_url()?>vendors/view/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>
							<?php if($this->pageParam->role == 1) { ?>
								<a class="icon" href="<?=base_url()?>vendors/add/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
								  <i class="fe fe-edit"></i>
								</a>
								<a class="delete icon" href="<?=base_url()?>vendors/delete/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
								  <i class="fe fe-trash"></i>
								</a>
							<?php } ?>
						  </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="6">
                            <nav aria-label="Page navigation example">
                              <?=$pages?>
                            </nav>
                          </td>
                        <tr>
                      </tfoot>
                    </table>
                  </div>
                </div>

              </div>
            </div>
        </div>
      </div>

	 <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
$(document).ready(function() {
	$('body').on('click', '.delete', function() {
		if (confirm('Are you sure you want delete this record')) {
			return true;
		}
		return false;
	});
});
	   $(function(){
			$(".select2").select2({
				minimumInputLength: 2,
				//templateResult: formatState,
				ajax: {
					url: '<?=base_url("vendors/ajax")?>',
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
			$(".addrfilter").val(data.text());
		  });
		  
		  
		});

		$(function(){
	$("#vendorselect3").select2({
		placeholder: "Search Vendor...",
		minimumInputLength: 1,
		//templateResult: formatState,
			ajax: {
				url: '<?=base_url("sell/vendorsearchajax")?>',
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
		var data = $("#vendorselect3 option:selected");
		$("#vendor_id").val(data.val());
	});
});
		
		$(function(){
			$(".select3").select2({
				placeholder: "Search Farmer...",
				minimumInputLength: 1,
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
			var data = $(".select3 option:selected");
			$("#farmer_id").val(data.val());
		  });
		});
		
		</script>