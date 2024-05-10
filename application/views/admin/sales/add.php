      <div class="my-3 my-md-5">
        <div class="container">

          <?php if( $alert == 1  ) : ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record saved successfully.
          </div>
        <?php elseif( $alert == 2  ) : ?>
            <div class="alert alert-success alert-dismissible ">
              <button data-dismiss="alert" class="close"></button>
              <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> New customer added successfully.
            </div>
          <?php endif; ?>

          <div class="row">
            <div class="col-lg-12">
              <form class="card" method="post">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-shopping-cart"></i> &nbsp;Sales
                  <span style="font-size:16px; float:right; color:#CD201F;" id="pdeu"></span>
                </h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-5">
                          <label>Customer Name</label>
                          <br>
                          <select id="cus" name="customer_id">
                            <option>--- Select Customer ---</option>
                          </select>
                          &nbsp;
                          <a href="javascript:;" id="adcus" class="btn btn-primary" data-toggle="modal" data-target="#cusMod">
                            <i class="fe fe-user-plus"></i>
                          </a>
                        </div>
                        <div class="col-md-4"><input type="hidden" name="customer" value="" id="cs_name" /></div>
                        <div class="col-md-3">
                          <label>Contact No.</label>
                          <input ty?pe="text" name="mobile" id="mob" data-validation="required number" data-validation-error-msg="Please enter contact no." class="form-control" placeholder="Contact No.">
                        </div>
                    </div>
                    <br>
                      <div class="shop-cart">
                        <table class="cart-tbl pay-cart bordered">
                          <thead>
                            <tr>
                              <td>
                                <select id="prds">
                                  <option value="0">Select Product</option>
                                  <?php foreach ($products as $pkey => $pval) : ?>
                                    <option value="<?=$pval['id']?>" data-prc="<?=$pval['purchase_price']?>"><?=$pval['product_name']?> </option>
                                  <?php endforeach; ?>
                                </select>
                              </td>
                              <td><input type="text" name="" id="price" readonly="readonly" placeholder="price..." class="form-control"></td>
                              <td><input type="text" name="" id="qty" placeholder="qty..." class="form-control"></td>
                              <td width="180"><input type="text" name="" readonly="readonly" id="sbt" placeholder="subtotal..." class="form-control"></td>
                              <td><a href="javascript:;" class="btn btn-md btn-primary" id="addrow"> <i class="fa fa-plus"></i></a></td>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th style="text-align:right" colspan="3">Sub-Total :</th>
                              <th id="total" width="100" >Rs. <span>00</span></th>
                              <th></th>
                            </tr>
                            <tr>
                              <th style="text-align:right" colspan="3">Discount :</th>
                              <th id="total" width="100">
                                <input type="text"  id="disc" name="disc" value="0" style="width:80px">
                              </th>
                              <th></th>
                            </tr>
                            <tr>
                              <th style="text-align:right" colspan="3">Grand Total :</th>
                              <th id="gtotal" width="100" align="left" >Rs. <span>00</span></th>
                              <th></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <a href="<?=base_url()?>sales" class="btn btn-default" id="makebill"><i class="fa fa-angle-double-left"></i> &nbsp;Back</a>
                      <button type="submit" class="btn btn-primary" id="makebill">Create Bill</button> &nbsp;
                    </div>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    <!-- Trigger the modal with a button -->
    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adcus">Open Modal</button> -->
    <!-- Modal -->

    <div id="cusMod" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fe fe-user"></i> New Customer</h4>
            <button type="button" class="close" data-dismiss="modal"></button>
          </div>
          <form method="post" >
          <div class="modal-body">
            <div class="form-group">
              <label>Customer Name.</label>
              <input type="text" class="form-control" data-validation="required" data-validation-error-msg="Please enter customer name" name="cus[customer_name]"/>
            </div>
            <div class="form-group">
              <label>Mobile No.</label>
              <input type="text" class="form-control" name="cus[mobile]" data-validation="required number length" data-validation-length="10" maxlength="10" data-validation-error-msg="Please enter mobile no." />
            </div>
            <div class="form-group">
              <label>Address.</label>
              <input type="text" class="form-control" name="cus[address]" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
        </div>
      </div>
    </div>

<script>
$(document).ready(function(){

  $("#cus").select2({
    ajax: {
      url: '<?=base_url()?>ajax/getCustomer',
      type:'post',
      dataType: 'json'
    }
  });

  $('#cus').on('select2:select', function (e) {
    var data = e.params.data;
      $.ajax({
        type:"post",
        url: "<?=base_url()?>ajax/customerInfo",
        data: "cid="+data.id,
        dataType: 'json',
        success: function( res ) {

          $("#mob").val(res.mobile);
          $("#addr").val(res.address);
          $("#cs_name").val(res.customer_name);
          if(parseInt(res.due) > 0) {
            $("#pdeu").text("Previous Due : Rs. "+res.due);
          } else {
            $("#pdeu").text("");
          }
        }
      });
  });

  $("#vend").select2();
  var prd = $("#prds").select2();
  prd.on("select2:select", function(e){
    var pid = $(e.currentTarget).val();
    $.ajax({
      type:"post",
      url:"<?=base_url()?>/ajax/prod_price.html",
      data:"act=1&pid="+pid,
      success : function (price) {
        $("#price").val(price);
        $("#qty").val('1');
        $("#sbt").val(price);

      }
    });
  });

    $(document).on('click', "#addrow", function(){

      var data = $("#prds").select2('data');
      var pid = data[0].id;
      var pname = data[0].text;
      var price = $("#price").val();
      var qty = $("#qty").val();
      var sbt = $("#sbt").val();

      if(pid >0) {

      var gsum=0;
      $(".pay-cart tbody").append("<tr>"+
        '<td>'+pname+'<input type="hidden" name="pid[]" value="'+pid+'"></td>'+
        '<td class="price">Rs. '+price+'</td>'+
        '<td>'+qty+' <input type="hidden" name="qty[]" value="'+qty+'" ></td>'+
        '<td class="price" align="center" >Rs. <span class="amt">'+sbt+'</span></td>'+
        '<td><a href="javascript:;" class="rem-prd"><i class="fe fe-trash"></i></a></td></tr>');

        if($(".amt").length) {
          $(".amt").each(function(){
            var amt = parseInt($(this).text());
            gsum = gsum+amt;
          });
          $("#total span ").text(gsum);
          $("#gtotal span ").text(gsum);
          discval();
        }

        $("#prds").val("0").trigger("change");
        $("#price").val('');
        $("#qty").val('');
        $("#sbt").val('');
      } else {
        alert("Please select product..");
      }

    });

    $(document).on("keyup","#qty", function(){

      var qty = parseInt($(this).val());
      var prc = parseInt($("#price").val());
      $("#sbt").val((prc*qty));
    });

    $(document).on("blur",".pqty", function(){
      var vl = $(this).val();
      var prc = $(this).attr('data-price');
      var td = $(this).closest('tr').find('.amt');
      var sum,gsum=0;

      if(vl.length == 0 || vl == 0) {
        $(this).val(1);
        sum = prc*1;
        td.text(sum);
      }

      $(".amt").each(function(){
        var amt = parseInt($(this).text());
        gsum = gsum+amt;
      });

      $("#total span ").text(gsum);
      $("#gtotal span ").text(gsum);
      discval();

    });

    $("#disc").blur(function() {
      discval();
    });

    $(document).on('click', '.rem-prd', function(){
        $(this).closest('tr').remove();

        var gsum=0;

        if($(".amt").length) {
          $(".amt").each(function(){
            var amt = parseInt($(this).text());
            gsum = gsum+amt;
          });
          $("#total span ").text(gsum);
          $("#gtotal span ").text(gsum);
          discval();
        } else {
          $("#total span ").text('0');
          $("#gtotal span ").text('0');
          $("#disc").val(0);
        }
    });

});


function discval() {

  var dis = $("#disc").val();
  var sb = parseInt($("#total span").text());

  if(sb > dis){
    if( dis.length ) {
      if(isNaN(dis)) {
        $("#disc").val(0);
      } else {
        sum = sb-dis;
        $("#gtotal span").text(sum);
      }
    } else {
      $("#disc").val(0);
      $("#gtotal span").text(sb);
    }
  } else {
    alert("Invalid value.");
    $("#disc").val(0);
    $("#gtotal span").text(sb);
  }

}


$(".card").submit(function( e ){
  if( $(".amt").length == 0 ) {
    e.preventDefault();
  }
});


$("#prod").keyup(function(){
  var src = $(this).val();
  if(src.length > 2) {
  $.ajax({
    type:"POST",
    url: "<?=base_url()?>ajax/getProducts",
    data: "sale=1&src="+src,
    dataType: "json",
    success: function( data ) {
      $(".src-box ul").html("");
      $.each(data, function(i, row){
    //  price = Math.ceil((parseInt(row.sell_price) + ( parseInt(row.sell_price)/100)*parseInt(row.gst) ));
          $(".src-box ul").append('<li class="pr-li" data-price="'+row.sell_price+'" data-row-id="'+row.id+'">'+row.product_name+'</li>');
      });
      $(".src-box").show();
    }
  });
} else {
  $(".src-box").hide();
}
});

</script>
