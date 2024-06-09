
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;">Expenses List
                    <a href="<?=base_url()?>expence/add" class="btn btn-primary btn-sm pull-right" style="color:#fff;"><i class="fe fe-plus"></i> Add New</a>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <td colspan="9"  style="border-bottom:1px solid #ddd">
						  
                            <form method="post" id="formdata" action="">
                              <table>
                              <td>
                                <?php 
                                $static_year = 2024;
                                $current_year = date('Y'); ?>
                                <select class="form-control" name="src[search_year]">
                                  <option value="">Select Year</option>
                                  <?php for ($x = $static_year; $x <= $current_year; $x++) { ?>
                                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                  <?php } ?>
                                </select>
                                </td>
                                <tr>
                                  <td>
                                    <select class="src-inp" name="src[cat]" id="cat">
                                      <option value="0"> --- Category --- </option>
                                      <?php foreach ($cats as $ck => $cv) : ?>
                                        <option value="<?=$cv['id']?>"><?=$cv['category']?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    <!-- <input type="text" class="src-inp" name="src[oid]" placeholder="Order ID.." value="<?=$this->session->src['oid']?>" />
                                  -->
                                </td>
                                  <td>
                                    <select class="src-inp" name="src[sbcat]" id="sbcat">
                                      <option value="0"> --- SubCategory --- </option>
                                      <?php foreach ($scats as $sck => $scv) : ?>
                                        <option value="<?=$scv['id']?>" ><?=$scv['category']?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </td>
                                  <!-- <td><input type="text" class="src-inp" name="src[mob]" placeholder="Contact No.." value="<?=$this->session->src['mob']?>" /></td> -->
                                  <td style="width:150px"></td>
                                  <td><input type="text" class="src-inp dps" name="src[sdate]" placeholder="From Date.." value="" /></td>
                                  <td><input type="text" class="src-inp dps" name="src[edate]" placeholder="To Date.." value="" /></td>
                                  <td><button class="btn btn-primary btn-sm"><i class="fe fe-search"></i> Search</button></td>
                                  <td><a href="<?php echo base_url(); ?>/expence" class="btn btn-danger btn-sm" id="reset" style="color:#fff"><i class="fe fe-rotate-ccw"></i> Reset</a></td>
                                  <td><a href="<?=base_url()?>expence/download.html" class="btn btn-success btn-sm downloadfilter"><i class="fe fe-download"></i> Download</a></td>
                                </tr>
                              </table>
                            </form>
							
							
                          </td>
                        </tr>
                        <tr>
                          <th class="w-1">S.No.</th>
                          <th>Category</th>
                          <th>SubCategory</th>
                          <th>Title</th>
                          <th>Amount</th>
                          <th>Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
					
						$i=$sno; foreach ($result as $key => $val ) { $i++;?>
                        <tr>
                          <td><span class="text-muted"><?=$val['id']?></span></td>
                          <td> <?=$val['pcat']?>  </td>
                          <td> <?=$val['category']?>  </td>
                          <td> <?=$val['title']?>  </td>
                          <td> Rs. <?=$val['amount']?>
                          <?php
                              if($val['type'] == 1) {
								 
                                echo 'Deposit';
                              }else if($val['type'] == 2) {
                               
                                              echo 'Expense'; 
                                            } 
                                          ?> 
                        </td>
                          <td><?=date("d-M-Y", strtotime( $val['created'] ))?></td>
                          <td>
                            <a class="icon" href="<?=base_url()?>/expence/edit/<?=$val['id']?>">
                              <i class="fe fe-edit"></i>
                            </a>
                             &nbsp; | &nbsp;
                            <a class="icon delete" href="javascript:void(0)" data-path="<?=base_url()?>" data-row-id="<?=$val['id']?>" data-tbl="expences">
                              <i class="fe fe-trash"></i>
                            </a>
                          </td>
                        </tr>
                       
                      <?php } 
					  ?>
                      </tbody>
                      <tfoot>
                        <tr style="border-top:1px solid #ddd">
                          <th colspan="" style="text-align:right; color:#333; font-weight:600; font-size:18px;">TOTAL Deposit &nbsp; &nbsp; </th>
                          <th style="text-align:center; color:#333; font-weight:600; font-size:20px;"><span style="text-transform:capitalize">Rs.</span> <?=$deposit_sum?></th>
                          <th colspan="" style="text-align:right; color:#333; font-weight:600; font-size:18px;">TOTAL EXPENSE &nbsp; &nbsp; </th>
                          <th style="text-align:center; color:#333; font-weight:600; font-size:20px;"><span style="text-transform:capitalize">Rs.</span> <?=$expense_sum?></th>
                          <th colspan="" style="text-align:right; color:#333; font-weight:600; font-size:18px;">Balance Amount &nbsp; &nbsp; </th>
                          <th style="text-align:center; color:#333; font-weight:600; font-size:20px;"><span style="text-transform:capitalize">Rs.</span> <?php echo $deposit_sum- $expense_sum; ?> </th>
                        
                        </tr>
                      </tfoot>

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

      <script>
      $(document).ready(function(){
		  
        $(".dps").datepicker({ format:'dd-mm-yyyy'});

        $("#cat").change(function(){
          var id = $(this).val();
          $.ajax({
            type:"post",
            url:"<?=base_url()?>ajax/getSubCat",
            data:"id="+id,
            dataType:"json",
            success: function(res) {
              $("#sbcat").html('<option value=""> --- SubCategory --- </option>');
              $.each(res, function(i, row){
                $("#sbcat").append('<option value="'+row.id+'">'+row.category+'</option>');
              });
            }
          })

        });
      });
      </script>
