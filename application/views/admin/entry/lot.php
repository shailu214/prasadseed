      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Entry Lot List
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
						
						
                        <tr>
                          <th class="w-1">S.NO.</th>
                          <th>LOT NO.</th>
						  <th>YEAR</th>
						  <th>VENDOR</th>
						  <th>QTY</th>
						  <th>PRICE</th>
						  <th>TOTAL PRICE</th>
						  <th>DUE DATE</th>
                          <th>DUE AMOUNT</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
						<?php foreach($lots as $lotObj) {
								$vendorname = 'self';
								if($lotObj->self == 0 && $lotObj->vendor_id > 0) {
									$this->db->where('id', $lotObj->vendor_id);
									$vendor = $this->db->get('vendors')->row();
									if($vendor) {
										$vendorname = $vendor->name;
									}
								}
						   ?>
						  <tr>
                          <th class="w-1">S.NO.</th>
                          <th>
						  <?php 
								$this->db->where('id', $lotObj->farmer_lot_id);
								$lotObjobj = $this->db->get('farmer_lots')->row();
								if($lotObjobj) {
									echo $lotObjobj->lots;
								}
							?>
						  </th>
						  <th><?php echo $lotObj->year; ?></th>
						  <th><?php echo $vendorname; ?></th>
						  <th><?=$lotObj->quantity?></th>
						  <th><?=$lotObj->price?></th>
						  <th><?=$lotObj->price*$lotObj->quantity?></th>
						  <th>
						  <?php 
								$this->db->where('sell_id', $lotObj->id);
								$this->db->limit(1);
								$this->db->order_by('id', 'desc');
								$dueobj = $this->db->get('sell_deposit')->row();
								if($dueobj) {
									echo $dueobj->due_date;
								}
							?>
						  </th>
                          <th>
						   <?php
								$this->db->where('sell_id', $lotObj->id);
								$this->db->select_sum('amount');

								$totalPreAmount = $this->db->get("sell_deposit")->row();
								echo $lotObj->total_amount-$totalPreAmount->amount;
							?>
						  </th>
						  <th>
						  <a class="icon" href="<?=base_url()?>sell/view/<?=$lotObj->id?>" data-row-id="4" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>
						  </th>
                        </tr>
					   <?php } ?>
						
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="6">
                            <nav aria-label="Page navigation example">
                              
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
	$('body').on('click', '.verifiedcontentbutton', function() {
		let pkid = $(this).attr('data-id');
		let target = $('.verifiedcontentform'+pkid);
		
		let comment = $('.comment', target).val();
		let form = $('.verifiedcontentform'+pkid).serialize();
		$(this).attr('disable', 'disable');
		document.getElementById("verifiedcontentbutton"+pkid).disabled = true;
		$.ajax({
		  type: "post",
		  url: "<?=base_url("entry/verify")?>",
		  data: form,
		  dataType: 'json',
		  cache: false,
		  success: function(response){
			 document.getElementById("verifiedcontentbutton"+pkid).disabled = false;
			if(response.status == 'success') {
				alert("successfully Update");
				    location.reload();

			} else if(response.status == 'error') {
				alert(response.message);
			}
		  }
		});
		return false;
	});
	$('body').on('click', '.delete', function() {
		if (confirm('Are you sure you want delete this record')) {
			return true;
		}
		return false;
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
		
		</script>