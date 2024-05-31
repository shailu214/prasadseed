<div class="my-3 my-md-5">
  <div class="container">
    <div class="row row-cards row-deck">

        <div class="col-12">
			<div class="card">
				<form method="post">
					<?php 
					$static_year = 2024;
					$current_year = date('Y'); ?>
					<select class="form-controls" name="data[search_year]">
						<option value="">Select Year</option>
						<?php for ($x = $static_year; $x <= $current_year; $x++) { ?>
							<option value="<?php echo $x; ?>"><?php echo $x; ?></option>
						<?php } ?>
					</select>
					<input type="submit" value="search" /> 
				</form>
			</div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Farmer Details
              <!-- <a href="<?=base_url()?>exam/eprint/<?=$ex_code?>" style="color:#fff" class="btn btn-info btn-sm pull-right"><i class="fe fe-file"></i> Print</a> -->
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
                  <tr>

                    <th width="150">Name</th>
                    <td colspan="2"><?=$obj->name?></td>
                    <th >Mobile</th>
                    <td colspan="2"><?=$obj->mobile?></td>
                  </tr>
                  <tr>
				  
				  <tr>

                    <th width="150">Father Name</th>
                    <td colspan="2"><?=$obj->father_name?></td>
                    <th >Reference Name</th>
                    <td colspan="2"><?=$obj->reference_name?></td>
                  </tr>
				  
				  <tr>

                    <th width="">Address</th>
                    <td colspan="4"><?=$obj->address?></td>
                  </tr>
                  <tr>

                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>
		  
		  <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> Entry Details
              <!-- <a href="<?=base_url()?>exam/eprint/<?=$ex_code?>" style="color:#fff" class="btn btn-info btn-sm pull-right"><i class="fe fe-file"></i> Print</a> -->
              </h3>
            </div>
			
			<div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
						<tr>
                          <td colspan="9"  style="border-bottom:1px solid #ddd">
                            
                          </td>
                        </tr>
						
                        <tr>
                          <th class="w-1">Lot No.</th>
						  <th>Farmer</th>
                          <th>Year</th>
						  <th>Vegetable</th>
						  <th>Variety</th>
						  <th>Quantity</th>
						  <th>Fare</th>
						  <th>Quality</th>
						  <th>Remaning Quantity</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						
						foreach($entry as $entryobj) { $sn++;
							$fullQty = false;
						?>
                        <tr>
                          <td><span class=""><?=$entryobj['sno']; ?>/<?=$entryobj['qty']; ?></span></td>
						  <td align="left"> 

							<?php 
								$db->where('id', $entryobj['farmer_id']);
								$obj = $db->get('farmer')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
						  </td>
                          <td align="left">  <?=$entryobj['year']; ?>  </td>
						  <td align="left">  
							<?php 
								$db->where('id', $entryobj['vegetable_id']);
								$obj = $db->get('vegetable')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
							</td>
							<td align="left">
							<?php 
								$db->where('id', $entryobj['variety_id']);
								$obj = $db->get('vegetable_variety')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
							</td>
							<td><span class=""><?=$entryobj['qty']; ?></span></td>
							<td><span class=""><?=$entryobj['fare']; ?></span></td>
							<td><span class=""><?=$entryobj['quality']; ?></span></td>
							<td>
								<span class="">
									<?php
									$db->where('farmer_lots.entry_management_id', $entryobj['id']);
									$db->join('farmer_lots', 'sell.farmer_lot_id = farmer_lots.id');
									//$db->select_sum('sell.quantity');
									$db->select('sell.quantity, sell.short_qty');
									$obj = $db->get('sell')->row();

									if($obj) {
										echo $val = $entryobj['qty'] - ($obj->quantity + $obj->short_qty);
										if($val == 0) { $fullQty = true; }
									}
									?>
								</span>
							</td>
						  <td align="left">  
							<a class="icon" href="<?=base_url()?>entry/view/<?=$entryobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>
							<a class="" href="<?=base_url()?>entry/lot/<?=$entryobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
								Sell Record
							</a>
							<?php if($fullQty == true) { ?>
								
							<?php } ?>
							
							<?php if($entryobj['verify'] == 1) { ?>
								<!---Not Clear---->
							<?php } else if($entryobj['verify'] == 2) { ?>
								<!---<button type="button" data-toggle="modal" data-target="#exampleModalLong<?=$entryobj['id']?>" class="btn btn-green verifiedcontent">
									Cleared <i class="fe fe-check"></i>
								</button>----->
								
								<div class="modal fade" id="exampleModalLong<?=$entryobj['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Comment</h5>
								
							  </div>
							  <div class="modal-body">
							  <div class="form-group">
							  
								<p style="white-space: normal !important;"><?=$entryobj['comment']?></p>
							</div>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
							  
							</div>
						  </div>
						</div>
								
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
		  
		  
		  
		  <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
				<i class="fe fe-user"></i> Bardana Details
              <!-- <a href="<?=base_url()?>exam/eprint/<?=$ex_code?>" style="color:#fff" class="btn btn-info btn-sm pull-right"><i class="fe fe-file"></i> Print</a> -->
              </h3>
            </div>
			
			<div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
					  
						<tr>
                          <td colspan="9"  style="border-bottom:1px solid #ddd">
                            
                          </td>
                        </tr>
					  
                        <tr>
                          <th class="w-1">S.No.</th>
						  <th>Farmer</th>
                          <th>Year</th>
						  <th>Item</th>
						  <th>Qty</th>
						  <th>Remaning Return Qty</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						$sn = 0;
						foreach($bardana as $bardanaobj) { 
						$tqty = ($bardanaobj['qty']+$bardanaobj['qty_two']+$bardanaobj['qty_three']+$bardanaobj['qty_four']);
						$qtyone = 0;
						$this->db->select_sum('return_qty');
							$db->where('bardana_id', $bardanaobj['id']);
							//$db->where('type', 1);
							$total_return_qty = $db->get('tbl_bardana_detail_return')->row();
							if($total_return_qty) {
								$qtyone = $tqty-$total_return_qty->return_qty;
							}
						if($qtyone > 0) {
						$sn++; ?>
                        <tr>
                          <td><span class="text-muted"><?=$sn?></span></td>
						  <td align="left"> 

							<?php 
								$db->where('id', $bardanaobj['farmer_id']);
								$obj = $db->get('farmer')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
						  </td>
                          <td align="left">  <?=$bardanaobj['year']; ?>  </td>
						  <td align="left"><?=$bardanaobj['item']; ?></td>
						  <td align="left"><?=$tqty; ?></td>
						  <td align="left">
							<?php 
							echo $qtyone;
							?>
						  </td>
						  <td align="left">  
							<!---<a class="icon" href="<?=base_url()?>bardana/view/<?=$bardanaobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>---->
							<a class="icon" href="<?=base_url()?>bardana/return/<?=$bardanaobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              Return
                            </a>
						  </td>
                        </tr>
						<?php } } ?>
					  <?php 
						foreach($bardana as $bardanaobj) {
							$qtytwo = 0;
							$this->db->select_sum('return_qty');
							$db->where('bardana_id', $bardanaobj['id']);
							$db->where('type', 2);
							$total_return_qty = $db->get('tbl_bardana_detail_return')->row();
							if($total_return_qty) {
								$qtytwo = $bardanaobj['qty_two']-$total_return_qty->return_qty;
							}
							if($qtytwo > 0) {
							$sn++; ?>
                        <tr>
                          <td><span class="text-muted"><?=$sn?></span></td>
						  <td align="left"> 

							<?php 
								$db->where('id', $bardanaobj['farmer_id']);
								$obj = $db->get('farmer')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
						  </td>
                          <td align="left">  <?=$bardanaobj['year']; ?>  </td>
						  <td align="left"><?=$bardanaobj['item_two']; ?></td>
						  <td align="left"><?=$bardanaobj['qty_two']; ?></td>
						  <td align="left">
							<?php
							echo $qtytwo;
							
							?>
						  </td>
						  <td align="left">  
							<!---<a class="icon" href="<?=base_url()?>bardana/view/<?=$bardanaobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>---->
							<a class="icon" href="<?=base_url()?>bardana/return/<?=$bardanaobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              Return
                            </a>
						  </td>
                        </tr>
						<?php } } ?>
					  <?php 
						foreach($bardana as $bardanaobj) { 
						$qtythree = 0;
						$this->db->select_sum('return_qty');
						$db->where('bardana_id', $bardanaobj['id']);
						$db->where('type', 3);
						$total_return_qty = $db->get('tbl_bardana_detail_return')->row();
						if($total_return_qty) {
							$qtythree = $bardanaobj['qty_three']-$total_return_qty->return_qty;
						}
						if($qtythree > 0) {
						$sn++; ?>
                        <tr>
                          <td><span class="text-muted"><?=$sn?></span></td>
						  <td align="left"> 

							<?php 
								$db->where('id', $bardanaobj['farmer_id']);
								$obj = $db->get('farmer')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
						  </td>
                          <td align="left">  <?=$bardanaobj['year']; ?>  </td>
						  <td align="left"><?=$bardanaobj['item_three']; ?></td>
						  <td align="left"><?=$bardanaobj['qty_three']; ?></td>
						  <td align="left">
							<?php 
							echo $qtythree;
							?>
						  </td>
						  <td align="left">  
							<!---<a class="icon" href="<?=base_url()?>bardana/view/<?=$bardanaobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>---->
							<a class="icon" href="<?=base_url()?>bardana/return/<?=$bardanaobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              Return
                            </a>
						  </td>
                        </tr>
						<?php } } ?>
					  <?php 
						foreach($bardana as $bardanaobj) { $sn++;
							$rqty = 0;
							$this->db->select_sum('return_qty');
							$db->where('bardana_id', $bardanaobj['id']);
							$db->where('type', 4);
							$total_return_qty = $db->get('tbl_bardana_detail_return')->row();
							if($total_return_qty) {
								$rqty = $bardanaobj['qty_four']-$total_return_qty->return_qty;
							}
							if($rqty > 0) {
						?>
                        <tr>
                          <td><span class="text-muted"><?=$sn?></span></td>
						  <td align="left"> 

							<?php 
								$db->where('id', $bardanaobj['farmer_id']);
								$obj = $db->get('farmer')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
						  </td>
                          <td align="left">  <?=$bardanaobj['year']; ?>  </td>
						  <td align="left"><?=$bardanaobj['item_four']; ?></td>
						  <td align="left"><?=$bardanaobj['qty_four']; ?></td>
						  <td align="left">
							<?=$rqty?>
						  </td>
						  <td align="left">  
							<!---<a class="icon" href="<?=base_url()?>bardana/view/<?=$bardanaobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>---->
							<a class="icon" href="<?=base_url()?>bardana/return/<?=$bardanaobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              Return
                            </a>
						  </td>
                        </tr>
						<?php } } ?>
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                    </table>
                  </div>
          </div>

			
			<div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
				<i class="fe fe-user"></i> Amount Details
              <!-- <a href="<?=base_url()?>exam/eprint/<?=$ex_code?>" style="color:#fff" class="btn btn-info btn-sm pull-right"><i class="fe fe-file"></i> Print</a> -->
              </h3>
            </div>
			
			<div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
					  
						<tr>
                          <td colspan="9"  style="border-bottom:1px solid #ddd">
                            
                          </td>
                        </tr>
					  
                        <tr>
                          <th class="w-1">Lot No.</th>
						  <th>Farmer</th>
                          <th>Year</th>
						  <th>LENDING DATE</th>
						  <th>Credit Amount</th>
						  <th>Deposit Amount</th>
						  <th>Balance Amount</th>
						  <th>Comment</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						$sn = 0;
						foreach($amount as $amountobj) { $sn++; ?>
                        <tr>
                          <td>
							  <?php 
								$db->where('id', $amountobj['farmer_lot_id']);
								$obj = $db->get('farmer_lots')->row();
								if($obj) {
									echo $obj->lots;
								}
							?>
							  
						 </td>
						  <td align="left"> 

							<?php 
								$db->where('id', $amountobj['farmer_id']);
								$obj = $db->get('farmer')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
						  </td>
							<td align="left">  <?=$amountobj['lending_date']; ?>  </td>
                          <td align="left">  <?=$amountobj['year']; ?>  </td>
						  <td align="left">  <?=$amountobj['credit_amount']; ?>  </td>
						  <td align="left">  <?=$amountobj['deposit_amount']; ?>  </td>
						  <td align="left">  <?=$amountobj['balance_amount']; ?>  </td>
						  <td align="left">  <?=$amountobj['comment']; ?>  </td>
						  <td align="left">  
							<a class="icon" href="<?=base_url()?>amount/view/<?=$amountobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>
						  </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                    </table>
                  </div>
          </div>

		<div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
				<i class="fe fe-user"></i> V.F.P
              <!-- <a href="<?=base_url()?>exam/eprint/<?=$ex_code?>" style="color:#fff" class="btn btn-info btn-sm pull-right"><i class="fe fe-file"></i> Print</a> -->
              </h3>
            </div>
			
			<div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
					  
						<tr>
                          <td colspan="9"  style="border-bottom:1px solid #ddd">
                            
                          </td>
                        </tr>
					  
                        <tr>
                          <th class="w-1">S.No.</th>
						  <th>Lot No.</th>
						  <th>Farmer</th>
                          <th>Year</th>
						  <th>Fare</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						$sn = 0;
						foreach($fare as $fareobj) { $sn++; ?>
                        <tr>
                          <td><span class="text-muted"><?=$sn?></span></td>
						  <td><?php 
								$db->where('id', $fareobj['farmer_lot_id']);
								$obj = $db->get('farmer_lots')->row();
								if($obj) {
									echo $obj->lots;
								}
							?></td>
						  <td align="left"> 

							<?php 
								$db->where('id', $fareobj['farmer_id']);
								$obj = $db->get('farmer')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
						  </td>
                          <td align="left">  <?=$fareobj['year']; ?>  </td>
						  <td align="left">  <?=$fareobj['add_fare']; ?>  </td>
						  <td align="left">  
							<a class="icon" href="<?=base_url()?>fare/view/<?=$fareobj['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>
						  </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                    </table>
                  </div>
          </div>
		  <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="width:100%;">
            <i class="fe fe-user"></i> List
              </h3>
            </div>
            <div class="table-responsive">
              <!-- <br> -->
              <table class="table table-bordered">
                <tbody>
					<tr>
					  <th class="w-1">S.No.</th>
					  	  <th>Lot No.</th>
						  <th>Tittle</th>
						  <th>Value</th>
                          <th>Tittle 2</th>
						  <th>Value 2</th>
						  
						  <th>Tittle 3</th>
						  <th>Value 3</th>
						  
						  <th>Tittle 4</th>
						  <th>Value 4</th>
					</tr>
					
					<?php 
						
						foreach ($resultsell as $key => $val ) { $sni++;
							
						?>
                        <tr>
                          <td><span class="text-muted"><?=$sni?></span></td>
						  <td>
						  <?php 
								$db->where('id', $val['farmer_lot_id']);
								$obj = $db->get('farmer_lots')->row();
								if($obj) {
									echo $obj->lots;
								}
							?>
							</td>
						  <td align="left"> 
							<?=$val['title_one'];?>
						  </td>
							<td><?=$val['value_one'];?></td>
							
                          <td align="left"><?=$val['title_two'];?></td>
						  <td><?=$val['value_two'];?></td>
						  <td><?=$val['title_three'];?></td>
						  <td><?=$val['value_three'];?></td>
						  <td><?=$val['title_four'];?></td>
						  <td><?=$val['value_four'];?></td>
						  </td>
                        </tr>
                      <?php } ?>
				 
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
			</div>

        </div>
      </div>
  </div>
</div>
<div class="notidiv">
  <i class="fe fe-check"></i> &nbsp; &nbsp;
  <span id="ntxt"></span>
</div>

<script>
$(document).ready(function(){
  $(".exsms").click(function(){
    var id = $(this).attr("data-exid");
    // alert(id);
  $.ajax({
      type:  "POST",
      url:"<?=base_url()?>ajax/exam_sms",
      data:"id="+id,
      success: function() {
        $("#ntxt").text("SMS Sent successfully.");
        $(".notidiv").fadeIn();
        setTimeout(function(){
          $(".notidiv").fadeOut();
        },1200);
      }
  });

});
});
</script>
