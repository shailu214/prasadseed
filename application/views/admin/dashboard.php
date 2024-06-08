<style>
	.font-md{
	font-size:16px;
	}
</style>

<div class="container">
          <br/>
            <div class="row row-cards">

              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fa fa-money fa-2x"></i>
                    </span>
                    <div>
                      <h2 class="m-0">
                        <a href="javascript:void(0)">
                        <span style="font-size:25px;"><?=($farmers)? $farmers : 0; ?></span> <span style="font-size:18px;"> Farmer</span>
						  </a><br>
                          <a href="<?=base_url()?>farmer/add.html" class="btn btn-primary btn-sm font-md">Add Farmer</a>
						  <a href="<?=base_url()?>farmer.html" class="btn btn-primary btn-sm font-md">Farmer List</a>
                      </h2>
                      <small class="text-muted"></small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fa fa-money fa-2x"></i>
                    </span>
                    <div>
                      <h4 class="m-0">
                        <a href="javascript:void(0)">
                        <span style="font-size:25px;"><?=($entry)? $entry : 0;?></span> <span style="font-size:18px;">Entry</span> 
                        </a><br><br>
						  <a href="<?=base_url()?>entry/add.html" class="btn btn-primary btn-sm font-md">Add Entry</a>
						  <a href="<?=base_url()?>entry.html" class="btn btn-primary btn-sm font-md">Entry List</a>
                      </h4>
                      <small class="text-muted"></small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3">
                      <i class="fe fe-users fa-2x"></i>
                    </span>
                    <div>
                      <h4 class="m-0">
                        <a href="javascript:void(0)">
                        <span style="font-size:25px;"><?=($bardana)? $bardana : 0; ?></span> <span style="font-size:18px;">Bardana</span> <br><br>
                        </a>
						  <a href="<?=base_url()?>bardana/add.html" class="btn btn-primary btn-sm font-md">Add Bardana</a>
						  <a href="<?=base_url()?>bardana.html" class="btn btn-primary btn-sm font-md">Bardana List</a>
                      </h4>
                      <small class="text-muted"></small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-yellow mr-3">
                      <i class="fe fe-users fa-2x"></i>
                    </span>
                    <div>
                      <h4 class="m-0">
                        <a href="javascript:void(0)">
							<span style="font-size:25px;"><?=($amount)? $amount : 0;?></span> <span style="font-size:18px;">Amount</span> 
						  </a><br><br>
						   <a href="<?=base_url()?>amount/add.html" class="btn btn-primary btn-sm font-md">Add Amount</a>
						  <a href="<?=base_url()?>amount.html" class="btn btn-primary btn-sm font-md">Amount List</a>
                      </h4>
                      <small class="text-muted"></small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-yellow mr-3">
                      <i class="fe fe-edit-3 fa-2x"></i>
                    </span>
                    <div>
                      <h4 class="m-0">
                        <a href="javascript:void(0)">
                        <span style="font-size:25px;"><?=($fare)? $fare : 0;?></span> <span style="font-size:18px;">V.F.P.</span> 
                        </a><br><br>
						  <a href="<?=base_url()?>fare/add.html" class="btn btn-primary btn-sm font-md">Add Fare</a>
						  <a href="<?=base_url()?>fare.html" class="btn btn-primary btn-sm font-md">Fare List</a>
                      </h4>
                      <small class="text-muted"></small>
                    </div>
                  </div>
                </div>
              </div>
				<div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-yellow mr-3">
                      <i class="fe fe-edit-3 fa-2x"></i>
                    </span>
                    <div>
                      <h4 class="m-0">
                        <a href="javascript:void(0)">
                        <span style="font-size:36px;"><?=($staff)? $staff : 0;?></span> <span style="font-size:18px;">Staff</span>  
                        </a><br> 
						  <a href="<?=base_url()?>staff/add.html" class="btn btn-primary btn-sm font-md">Add Staff</a>
						  <a href="<?=base_url()?>staff.html" class="btn btn-primary btn-sm font-md">Staff List</a>
                      </h4>
                      <small class="text-muted"></small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-yellow mr-3">
                      <i class="fe fe-edit-3 fa-2x"></i>
                    </span>
                    <div>
                      <h4 class="m-0">
                        <a href="javascript:void(0)">
                        <span style="font-size:18px;">Total Quantity: </span> <span style="font-size:25px;"><?php  echo $total_qty->qty; ?></span> 
                        </a><br>
                        <a href="javascript:void(0)">
                        <span style="font-size:18px;">Total Sale: </span> <span style="font-size:25px;"><?php  echo $total_qty_sell->quantity; ?></span> 
                        </a><br> 
                        <a href="javascript:void(0)">
                        <span style="font-size:18px;">Remaining Quantity: </span> <span style="font-size:25px;"><?php  echo $total_qty->qty - $total_qty_sell->quantity; ?></span> 
                        </a><br>
                        
                      </h4>
                      <small class="text-muted"></small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
