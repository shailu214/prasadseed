
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row row-cards row-deck">
            <div class="col-sm-6 col-lg-3">
              <div class="card p-3">
                <div class="d-flex align-items-center">
                  <span class="stamp stamp-md bg-blue mr-3">
                    <i class="fa fa-money fa-2x"></i>
                  </span>
                  <div>
                    <h4 class="m-0"><a href="javascript:void(0)">
                      Rs. <?=$total?><br>
                      <small>Total Amount</small></a>
                    </h4>
                  </div>
                </div>
              </div>
            </div>

              <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3">
                      <i class="fa fa-money fa-2x"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)">
                        Rs. <?=$paid?><br>
                        <small>Paid Amount</small></a>
                      </h4>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                  <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-red mr-3">
                      <i class="fa fa-money fa-2x"></i>
                    </span>
                    <div>
                      <h4 class="m-0"><a href="javascript:void(0)">Rs. <?=$due?>
                        <br><small>Due Amount</small></a></h4>
                    </div>
                  </div>
                </div>
              </div>

            <div class="col-12">
                <div class="card">
                  <form method="post">
                  <div class="card-header">
                    <h3 class="card-title" style="width:100%;"><i class="fe fe-shopping-cart"></i>&nbsp; Sales Note
                        <span style="float:right">
                          <select class="sml2" name="src[cust]" id="cus">
                            <option value="0">All Customer</option>
                            <?php if($_SESSION['src']['cust']>0) : ?>
                              <option value="<?=$_SESSION['src']['cust']?>" selected="selected"><?=$_SESSION['src']['cname']?></option>
                            <?php endif; ?>
                          </select> &nbsp;
                          <select name="src[stats]" style="padding:4px 8px; border:1px solid #ddd;">
                            <option value="0">All</option>
                            <option value="1" <?=($_SESSION['src']['stats']==1)? 'selected' : '';?>>Paid</option>
                            <option value="2" <?=($_SESSION['src']['stats']==2)? 'selected' : '';?>>Due</option>
                          </select>
                          &nbsp; &nbsp;
                          From : <input type="text" class="nt-inp dps" name="src[sdate]" placeholder="From Date.." value="<?=$this->session->src['sdate']?>" />
                          &nbsp; &nbsp;
                          To : <input type="text" class="nt-inp dps" name="src[edate]" placeholder="From Date.." value="<?=$this->session->src['edate']?>" />
                          &nbsp;
                          <button type="submit" class="btn btn-primary btn-sm"><i class="fe fe-search"></i></button> &nbsp; | &nbsp;
                          <button type="submit" class="btn btn-success btn-sm nbtn" ><i class="fe fe-mail"></i></button>
                          &nbsp; | &nbsp;
                          <a href="javascript:;" class="btn btn-danger btn-sm" id="reset"><i class="fe fe-refresh-cw " style="color:#fff;"></i></a>

                        </span>
                    </h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1"><input type="checkbox" id="chkall" /></th>
                          <th>Description</th>
                          <th>Billed</th>
                          <th>Paid</th>
                          <th>Due</th>
                          <th>Created</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($payment as $key => $val ) { $sn++;?>
                        <tr>
                          <td ><?=($val['due']>0)? '<input type="checkbox" class="chk" name="chk[]" value="'.$val['code'].'"/>' : ''; ?></td>
                          <td> <a href="<?=base_url()?>sales/invoice/<?=$val['oid']?>">#<?=$val['code']?></a> - <?=$val['customer_name']?> &nbsp;(<?=$val['mobile']?>)</td>
                          <td> <?=$val['total']?></td>
                          <td> <?=$val['paid']?></td>
                          <td> <?=$val['due']?></td>
                          <td><?=date("d-m-Y", strtotime( $val['created'] ))?></td>
                          <td>
                          <?=($val['due']>0)? '<span class="text-danger">DUE</span>' : '<span class="text-success">PAID</span>'; ?>
                        </td>
                        <td>
                          <?php if($val['due']>0) : ?>
                            <a href="javascript:;" class="sms_send" data-code="<?=$val['code']?>"  >Send SMS</a>
                          <?php endif; ?>
                        </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="6" align="right">
                            <nav aria-label="Page navigation example">
                              <?=$pages?>
                            </nav>
                          </td>
                        <tr>
                      </tfoot>
                    </table>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="notidiv">
        <i class="fe fe-check"></i> &nbsp; &nbsp;
        <span id="ntxt"></span>
      </div>
  <?php if($sms_alt) : ?>
  <script>
    $("#ntxt").text("SMS Sent Successfully.");
    $(".notidiv").fadeIn();
    setTimeout(function(){
      $(".notidiv").fadeOut();
    },1200);

    </script>
<?php endif; ?>
      <Script>
        $(".dps").datepicker({ format:'dd-mm-yyyy'});
        $("#sts").select2({width:"100px"});
        $("#cus").select2({
          ajax: {
            url: '<?=base_url()?>ajax/getCustomer',
            type:'post',
            dataType: 'json'
          }
        });

        $(document).ready(function(){
          $(".sms_send").click(function(){
            var code = $(this).attr('data-code');
            $.ajax({
              type:"post",
              url:"<?=base_url()?>/action/dueSMS.html",
              data: "code="+code,
              success: function(  ) {
                $("#ntxt").text("SMS Sent Successfully.");
                $(".notidiv").fadeIn();
                setTimeout(function(){
                  $(".notidiv").fadeOut();
                },1200);
              }
            });
          });
        });


        $("#chkall").click(function(){
          if($(this).prop('checked') == true ) {
            $(".chk").prop("checked",true);
          } else {
            $(".chk").prop("checked",false);
          }
        });


        $(".nbtn").click(function( e ){
          if($('.chk:checked').length == 0) {
            e.preventDefault();
            alert("Please check an invoice to send sms");
          }
        });

        $("#reset").click(function(){
          $.ajax({
              type:"post",
              url:"<?=base_url()?>ajax/resetsrc",
              data:"",
              success: function( res ) {
                window.location.href="<?=base_url()?>sales/note.html"
              }
          });
        });
      </script>
