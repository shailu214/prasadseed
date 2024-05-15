      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Entry List
                    <a href="<?=base_url()?>entry/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
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
                                  <td><a href="<?php echo base_url(); ?>/entry" class="btn btn-danger btn-sm" id="reset" style="color:#fff"><i class="fe fe-rotate-ccw"></i> Reset</a></td>
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
						  <th>Vegetable</th>
						  <th>Value</th>
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
						  <td align="left">  <?=$val['sno']; ?>/<?=$val['qty']; ?>  </td>
                          <td align="left">  <?=$val['year']; ?>  </td>
						  <td align="left">  
							<?php 
								$db->where('id', $val['vegetable_id']);
								$obj = $db->get('vegetable')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
							</td>
							<td align="left">
							<?php 
								$db->where('id', $val['variety_id']);
								$obj = $db->get('vegetable_variety')->row();
								if($obj) {
									echo $obj->name;
								}
							?>
							</td>
						  <td align="left">  
							<a class="icon" href="<?=base_url()?>entry/view/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-eye"></i>
                            </a>
							
							<?php if($this->pageParam->role == 1) { ?>
							<a class="icon" href="<?=base_url()?>entry/add/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
                              <i class="fe fe-edit"></i>
                            </a>
							<a class="delete icon" href="<?=base_url()?>entry/delete/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
							  <i class="fe fe-trash"></i>
							</a>
							<a class="" href="<?=base_url()?>entry/lot/<?=$val['id']?>" data-row-id="<?=$val['id']?>" data-tbl="category">
								Lot
							</a>
							<?php } ?>
							<?php if($val['verify'] == 1) { ?>
							<button type="button" class="btn btn-primary verifiedcontent" data-id="<?=$val['id']?>" data-toggle="modal" data-target="#exampleModalLong<?=$val['id']?>">
							Not Clear
							</button>
							<?php } else { ?>
								<button type="button" data-toggle="modal" data-target="#exampleModalLong<?=$val['id']?>" class="btn btn-green verifiedcontent">
								Cleared  <i class="fe fe-check"></i>
								</button>
							<?php } ?>
						  </td>
                        </tr>
						
						<div class="modal fade" id="exampleModalLong<?=$val['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Comment</h5>
								
							  </div>
							  <div class="modal-body">
							  <div class="form-group">
							  <form class="verifiedcontentform<?=$val['id']?>">
								<?php if($val['verify'] == 1) { ?>
									<input type="hidden" name="updateid" value="0" />
								<?php } else { ?>
									<input type="hidden" name="updateid" value="1" />
								<?php } ?>
									<input type="hidden" name="pkid" value="<?=$val['id']?>" />
									<label for="exampleFormControlTextarea1">Enter Your Comment</label>
									<textarea class="form-control comment"  name="comment" id="exampleFormControlTextarea1" rows="5"><?=$val['comment']?></textarea>
								</div>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" id="verifiedcontentbutton<?=$val['id']?>" class="btn btn-primary  verifiedcontentbutton" data-id="<?=$val['id']?>">Submit</button>
							  </div>
							  </form>
							</div>
						  </div>
						</div>
						
						
						
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