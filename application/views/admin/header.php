<body class="">
  <?=$this->session->flashdata('notify')?>

  <div class="page">
    <div class="page-main">

      <div class="header py-4">
        <div class="container">
          <div class="d-flex">
            <a class="header-brand" href="<?=base_url()?>">
              <img src="<?=base_url()?>media/config/my-logo.jpeg" class="header-brand-img" alt="<?=COM_NAME?>">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
			<?php if($_SESSION[ADMIN]['role'] == 1 || in_array(23, $_SESSION[ADMIN]['prms'])) : ?>
                <a href="<?=base_url()?>holiday.html" class="nav-link"><i class="fe fe-calendar"></i> &nbsp;Holiday Mngt.</a>
                &nbsp; | &nbsp;
              <?php endif; ?>
              <?php  ?>
                <a href="<?=base_url()?>sendsms.html" class="nav-link"><i class="fe fe-mail"></i> &nbsp;SMS</a>
                &nbsp; | &nbsp;
              <?php  ?>
              
                <!-- <div class="nav-item d-none d-md-flex">
                  <a href="https://github.com/tabler/tabler" class="btn btn-sm btn-outline-primary" target="_blank">Source code</a>
                </div> -->
              <div class="dropdown">
                <a href="javascript:;" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                  <span class="avatar" style="background-image: url(<?=base_url()?>media/config/admin.png)"></span>
                  <span class="ml-2 d-none d-lg-block">
                    <span class="text-default"><?=$_SESSION[ADMIN]['fname']?></span>
                    <small class="text-muted d-block mt-1">Administrator</small>
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <?php if($_SESSION[ADMIN]['role'] == 1 )  { ?>
                  <a class="dropdown-item" href="<?=base_url()?>profile.html">
                    <i class="dropdown-icon fe fe-settings"></i> Settings
                  </a>
				  <a class="dropdown-item" href="<?=base_url()?>dashboard/sync">
                    <i class="dropdown-icon fe fe-settings"></i> Sync
                  </a>
                  <?php } ?>
                  <a class="dropdown-item" href="<?=base_url()?>password.html">
                    <i class="dropdown-icon fe fe-lock"></i> Password
                  </a>
                  <a class="dropdown-item" href="<?=base_url()?>log.html">
                    <i class="dropdown-icon fe fe-list"></i> Block Log.
                  </a>
					<?php if($_SESSION[ADMIN]['role'] == 1 || in_array(2, $_SESSION[ADMIN]['prms'])) { ?>
                  <a target="_blank" class="dropdown-item" href="http://localhost/phpmyadmin/db_structure.php?server=1&db=prasadseeds">
                    <i class="dropdown-icon fe fe-database"></i> Database Backup.
                  </a>
					<?php } ?>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?=base_url()?>/logout.html">
                    <i class="dropdown-icon fe fe-log-out"></i> Sign out
                  </a>
                </div>
              </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
              <span class="header-toggler-icon"></span>
            </a>
          </div>
        </div>
      </div>
	  
      <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg order-lg-first">
              <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                <li class="nav-item ">
                  <a href="<?=base_url()?>dashboard.html" class="nav-link <?=($this->pageParam->nav == 'ss')? 'active' : ''?>"><i class="fe fe-home"></i> Home </a>
                </li>
				<li class="nav-item ">
                  <a href="javascript:void(0)" class="nav-link <?=($this->pageParam->nav == 'farmer')? 'active' : ''?>" data-toggle="dropdown"><i class="fe fe-user"></i> Farmer</a>
                  <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="<?=base_url()?>farmer/add.html" class="dropdown-item ">Add Farmer.</a>
                      <a href="<?=base_url()?>farmer.html" class="dropdown-item ">Farmer List.</a>
					 
                  </div>
                </li>
				
				<li class="nav-item ">
                  <a href="javascript:void(0)" class="nav-link <?=($this->pageParam->nav == 'entry')? 'active' : ''?>" data-toggle="dropdown"><i class="fe fe-user"></i> Entry</a>
                  <div class="dropdown-menu dropdown-menu-arrow">
					  <a href="<?=base_url()?>entry/add.html" class="dropdown-item ">Add Entry</a>
                      <a href="<?=base_url()?>entry.html" class="dropdown-item ">Entry Management List.</a>
                    
                  </div>
                </li>
				
                <li class="nav-item">
                  <a href="javascript:void(0)" class="nav-link <?=($this->pageParam->nav == 'bardana')? 'active' : ''?>" data-toggle="dropdown"><i class="fe fe-user"></i> Bardana</a>
                  <div class="dropdown-menu dropdown-menu-arrow">
					  <a href="<?=base_url()?>bardana/add.html" class="dropdown-item ">Add Bardana</a>
                      <a href="<?=base_url()?>bardana.html" class="dropdown-item ">Bardana List</a>
                    
                  </div>
                </li>
                <li class="nav-item">
                  <a href="javascript:void(0)" class="nav-link <?=($this->pageParam->nav == 'amount')? 'active' : ''?>" data-toggle="dropdown"><i class="fe fe-user"></i> Loan</a>
                  <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="<?=base_url()?>amount.html" class="dropdown-item ">Loan List</a>
                    
                  </div>
                </li>
                
             
               <li class="nav-item">
                  <a href="javascript:void(0)" class="nav-link <?=($this->pageParam->nav == 'fare')? 'active' : ''?>" data-toggle="dropdown"><i class="fe fe-user"></i> Fare</a>
                  <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="<?=base_url()?>fare.html" class="dropdown-item ">Fare List</a>
                    
                  </div>
                </li>
                <li class="nav-item">
                  <a href="javascript:void(0)" class="nav-link <?=($this->pageParam->nav == 'vendors')? 'active' : ''?>" data-toggle="dropdown"><i class="fe fe-user"></i> Vendors</a>
                  <div class="dropdown-menu dropdown-menu-arrow">
					            <a href="<?=base_url()?>vendors/add.html" class="dropdown-item ">Add Vendors</a>
                      <a href="<?=base_url()?>vendors.html" class="dropdown-item ">Vendors List</a>
                    
                  </div>
                </li>
                <li class="nav-item">
                  <a href="javascript:void(0)" class="nav-link <?=($this->pageParam->nav == 'sell')? 'active' : ''?>" data-toggle="dropdown"><i class="fe fe-user"></i> Vendors Purchase Entry</a>
                  <div class="dropdown-menu dropdown-menu-arrow">
					            <a href="<?=base_url()?>sell/add.html" class="dropdown-item ">Add Vendor Purchase Entry</a>
                      <a href="<?=base_url()?>sell.html" class="dropdown-item ">Vendor Purchase Entry List</a>
                    
                  </div>
                </li>
                <li class="nav-item">
                  <a href="javascript:void(0)" class="nav-link <?=($this->pageParam->nav == 'delivery')? 'active' : ''?>" data-toggle="dropdown"><i class="fe fe-user"></i>Delivery Order</a>
                  <div class="dropdown-menu dropdown-menu-arrow">
					            <a href="<?=base_url()?>delivery/add.html" class="dropdown-item ">Add Delivery Order</a>
                      <a href="<?=base_url()?>delivery.html" class="dropdown-item ">Delivery Order List</a>
                    
                  </div>
                </li>
                <li class="nav-item">
                  <a href="javascript:void(0)" class="nav-link <?=($this->pageParam->nav == 'challan')? 'active' : ''?>" data-toggle="dropdown"><i class="fe fe-user"></i>Challan</a>
                  <div class="dropdown-menu dropdown-menu-arrow">
					            <a href="<?=base_url()?>challan/add.html" class="dropdown-item ">Add Challan</a>
                      <a href="<?=base_url()?>challan.html" class="dropdown-item ">Challan List</a>
                    
                  </div>
                </li>
				<?php //if($this->pageParam->role == 1) { ?>
					<li class="nav-item">
					  <a href="javascript:void(0)" class="nav-link <?=($nav == 5)? 'active' : ''?>" data-toggle="dropdown"><i class="fe fe-user"></i> Staff</a>
					  <div class="dropdown-menu dropdown-menu-arrow">
						<?php //if($_SESSION[ADMIN]['role'] == 1 || in_array(2, $_SESSION[ADMIN]['prms'])) { ?>
						<a href="<?=base_url()?>staff.html" class="dropdown-item ">Staff List.</a>
						<?php //} ?>
						<?php //if($_SESSION[ADMIN]['role'] == 1 || in_array(3, $_SESSION[ADMIN]['prms']) )  { ?>
						<a href="<?=base_url()?>attendance/staff.html" class="dropdown-item ">Staff Report</a>
						<?php //} ?>
					  </div>
					</li>
				<?php //} ?>
			  
              </ul>
            </div>
          </div>
        </div>
      </div>
