
      <div class="my-3 my-md-5">
        <div class="container">
          <!-- <hr> -->
            <div class="row row-cards row-deck">

              <div class="col-12" style="margin-bottom:10px;">
                <div class="col-md-2pull-right">
                  <a href="<?=base_url()?>fee/add" class="btn btn-success btn-sm" style="float:right"><i class="fe fe-plus"></i> COLLECT FEE</a>
                </div>
              </div>
              <div class="col-12">
                <div class="row">
                  <?php foreach ($results as $key => $val) : ?>
                    <div class="col-sm-6 col-lg-3">
                      <div class="card p-3">
                        <div class="d-flex align-items-center">
                          <div>
                            <h4 class="m-0" style="width:100%;" ><a href="<?=base_url()?>fee/batch/<?=$val['id']?>" ><?=strtoupper($val['batch_name'])?>
                              &nbsp; &nbsp; <i class="fe fe-arrow-right-circle"></i>
                            </a>
                            </h4>
                              <small class="text-primary"><b>AMOUNT : <?=$val['amt']?></b></small><br>
                              <small class="text-success"><b>PAID : <?=$val['paid']?></b></small> &nbsp; &nbsp; | &nbsp; &nbsp;<a href="<?=base_url()?>fee/batch/page/<?=$val['id']?>/1" style="font-size:13px;">View All</a><br>
                            <small class="text-danger"><b>DUE : <?=$val['due']?></b></small> &nbsp; &nbsp; &nbsp;| &nbsp; &nbsp;<a href="<?=base_url()?>fee/due/<?=$val['id']?>" style="font-size:13px;">View All</a>
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
