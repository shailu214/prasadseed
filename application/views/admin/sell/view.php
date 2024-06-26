      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Vendor Purchase List
					<a href="#" class="export btn btn-primary btn-sm pull-" style="color:#fff;"> Export</a>
                    <a href="<?=base_url()?>sell/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
						<tr>
                          <td colspan="9"  style="border-bottom:1px solid #ddd">
                            <form method="get" id="formsubmit" action="<?=base_url()?>sell/index">
                              <table>
                                <tr>
								
                                  <td>
									<?php 
									$static_year = 2024;
									$current_year = date('Y'); ?>
									<select class="form-control" name="data[search_year]">
										<option value="">Select Year</option>
										<?php for ($x = $static_year; $x <= $current_year; $x++) { ?>
											<option value="<?php echo $x; ?>"><?php echo $x; ?></option>
										<?php } ?>
									</select>

									
								  </td>
								  
								  <td>
										From <input type="date" id="fdate" name="data[fdate]">
										To <input type="date" id="tdate" name="data[tdate]">
									</td>
									
									
								  
									<td>
										<select name="" class="select2" style="width:100%">
											<option> </option>
										</select>
										<input type="hidden" id="farmer_id" name="data[farmer_id]">
									
									</td>
									
									<td>
										<select name="" id="vendorselect3" style="width:100%">
											<option> </option>
										</select>
										<input type="hidden" id="vendor_id" name="data[vendor_id]">
									
									</td>
									
									<td>
										Due Date <input type="date" id="due_date" name="data[due_date]">
									</td>
								  
                                  <td><button class="btn btn-primary btn-sm"><i class="fe fe-search"></i> Search</button></td>
                                  <td><a href="<?php echo base_url(); ?>/sell" class="btn btn-danger btn-sm" id="reset" style="color:#fff"><i class="fe fe-rotate-ccw"></i> Reset</a></td>
                                </tr>
                              </table>
                            </form>
                          </td>
                        </tr>
						
                        <tr>
                          <th class="w-1">S.No.</th>
						  <th>Farmer</th>
						  <th>Lot No.</th>
                          <th>Year</th>
						  <th>Vendor</th>
						  <th>Qty</th>
						  <th>Price</th>
						  <th>Total Price</th>
						  <th>Due Date</th>
						  <th>Due Amount</th>
                          <!--<th>Action</th>---->
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						
						foreach ($result as $key => $val ) { $sn++;
							$vendorname = 'self';
							if($val['self'] == 0 && $val['vendor_id'] > 0) {
								$this->db->where('id', $val['vendor_id']);
								$vendor = $this->db->get('vendors')->row();
								if($vendor) {
									$vendorname = $vendor->name;
								}
							}
							
							/* $this->db->where('farmer_id', $val['farmer_id']);
							$this->db->where('farmer_lot_id', $val['farmer_lot_id']);
							$amtObj = $this->db->get('tbl_amount')->row();
							$creditAmount = $depositAmount = $balanceAmount = '';
							if($amtObj) {
								$creditAmount = $amtObj->credit_amount;
								$depositAmount = $amtObj->deposit_amount;
								$balanceAmount = $amtObj->balance_amount;
							} */
						?>
                        <tr>
                          <td><span class="text-muted"><?=$sn?></span></td>
						  <td align="left"> 

							<?php 
								$db->where('id', $val['farmer_id']);
								$obj = $db->get('farmer')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
							<br>

							<a class="icon"  href="<?=base_url()?>sell/view/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye" style="color:#90DFAA"></i>
                            </a>
							<?php if($this->pageParam->role == 1) { ?>
							<a class="icon" href="<?=base_url()?>sell/add/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-edit" style="color:#FFA500"></i>
                            </a>|
							<a class="icon delete" href="<?=base_url()?>sell/delete/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-trash" style="color:#FF0000"></i>
                            </a>
							<a class="icon" href="<?=base_url()?>sell/deposit/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="deposit">
                              Deposit
                            </a> |
							<a class="icon" href="<?=base_url()?>sell/load/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="load">
                              Loading
                            </a>
							
							<?php } ?>

						  </td>
							<td>
							
							<?php 
								$db->where('id', $val['farmer_lot_id']);
								$obj = $db->get('farmer_lots')->row();
								if($obj) {
									echo $obj->lots;
								}
							?>
							
							</td>
							
                          <td align="left">  <?=$val['year']; ?>  </td>
						  <td><?=$vendorname?></td>
						  <td><?=$val['quantity']?></td>
						  <td><?=$val['price']?></td>
						  <td><?=$val['total_amount']?></td>
						  <td>
						  <?php 
								$db->where('sell_id', $val['id']);
								$db->limit(1);
								$db->order_by('id', 'desc');
								$obj = $db->get('sell_deposit')->row();
								if($obj) {
									echo $obj->due_date;
								}
							?>
							</td>
							
							<td>
						  <?php
								$db->where('sell_id', $val['id']);
								$db->select_sum('amount');

								$totalPreAmount = $db->get("sell_deposit")->row();
								echo $val['total_amount']-$totalPreAmount->amount;
							?>
							</td>
							
						  <td align="left">  
							
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
	
	$('body').on('click', '.submit', function() {
		$('#formsubmit').attr('action', '<?=base_url()?>sell/index');
		return true;
	});
	
	$('body').on('click', '.export', function() {
		//$('#formsubmit').submit();
		$('#formsubmit').attr('action', '<?=base_url()?>sell/export');
		document.getElementById("formsubmit").submit()

		//return true;
	});
});

$(function(){
	$(".select2").select2({
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
	var data = $(".select2 option:selected");
	$("#farmer_id").val(data.val());
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


</script>
