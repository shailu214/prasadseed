      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Bardana List
                    <a href="<?=base_url()?>bardana/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
					  
						<tr>
                          <td colspan="5"  style="border-bottom:1px solid #ddd">
                            <form method="get">
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
									<select name="" class="select2" style="width:100%">
										<option> </option>
									</select>
									<input type="hidden" id="farmer_id" name="data[farmer_id]">
									
								  </td>
								  
                                  <td><button class="btn btn-primary btn-sm"><i class="fe fe-search"></i> Search</button></td>
                                  <td><a href="<?php echo base_url(); ?>/bardana" class="btn btn-danger btn-sm" id="reset" style="color:#fff"><i class="fe fe-rotate-ccw"></i> Reset</a></td>
                                </tr>
                              </table>
                            </form>
                          </td>
						  <td colspan="4"  style="border-bottom:1px solid #ddd">
							<form method="get" id="nonexixtfarmerform"  class="">
								<input type="checkbox" class="nonexixtfarmer" name="farmersearch" value="1" />
							</form>
						 </td>
                        </tr>
					  
                        <tr>
                          <th class="w-1">S.No.</th>
						  <th>Farmer</th>
                          <th>Year</th>
						  <th>Item</th>
						  <th>Quantity</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						
						foreach ($result as $key => $val ) { $sn++; ?>
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
						  </td>
                          <td align="left">  <?=$val['year']; ?>  </td>
						  <td align="left"><?=$val['item']; ?></td>
						  <td align="left"><?=$val['qty']; ?></td>
						  <td align="left">  
							<a class="icon" href="<?=base_url()?>bardana/view/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>
							<a class="icon" href="<?=base_url()?>bardana/return/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              Return
                            </a>
							<?php if($this->pageParam->role == 1) { ?>
							<a class="icon" href="<?=base_url()?>bardana/add/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-edit"></i>
                            </a>
							<a class="icon delete" href="<?=base_url()?>bardana/delete/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
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
	$('body').on('change', '.nonexixtfarmer', function() {
		$('#nonexixtfarmerform').submit();
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