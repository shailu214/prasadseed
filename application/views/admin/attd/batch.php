
      <div class="my-3 my-md-5">
        <div class="container">
          <!-- <hr> -->
            <div class="row row-cards row-deck">

              <div class="col-12" style="margin-bottom:10px;">
                <!-- <div class="col-md-2pull-right">
                  <a href="<?=base_url()?>fee/add" class="btn btn-success btn-sm" style="float:right"><i class="fe fe-plus"></i> ADD FEE</a>
                </div> -->
              </div>
              <div class="col-12">
                <div class="row">
                  <?php foreach ($batch as $key => $val) : ?>
                    <div class="col-sm-6 col-lg-3">
                      <div class="card p-3">
                        <div class="d-flex align-items-center">
                          <span class="stamp stamp-md bg-blue mr-3">
                            <i class="fe fe-book-open" style="font-size:32px;"></i>
                          </span>
                          <div>
                            <h4 class="m-0"><a href="<?=base_url()?>attendance/student/<?=$val['id']?>"> <?=strtoupper($val['batch_name'])?> </a></h4>
                              <small class="text-primary"><b>STUDENT : <?=$val['studs']?></b></small><br>
                              <small class="text-success"><b>PRESENT : <?=$val['attds']?></b> &nbsp; &nbsp; | &nbsp; <a href="<?=base_url()?>attendance/present_list/<?=$val['id']?>">View All</a></small><br>
                            <small class="text-danger"><b>ABSENT : &nbsp; <?=$val['studs']-$val['attds']?></b> &nbsp; &nbsp; | &nbsp; <a href="<?=base_url()?>attendance/absent_list/<?=$val['id']?>">View All</a></small>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>

                </div>
              </div>
            </div>
        </div>
      </div>
