
      <div class="my-3 my-md-5">
        <div class="container">
          <?php if( $alert ) : ?>
          <div class="alert alert-success alert-dismissible ">
            <button data-dismiss="alert" class="close"></button>
            <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record saved successfully.
          </div>
          <?php endif; ?>
          <div class="row">
            <div class="col-lg-12">
              <form class="card" method="post">
                <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-shopping-cart"></i> &nbsp;Purchase Order</h3>
                <hr style="margin:0px;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                      <div class="col-md-6">
                        <input type="text" name="vendor" data-validation="required" data-validation-error-msg="Please enter vendor name..." class="form-control" placeholder="Vendor Name..."/>
                      </div>
                      <div class="col-md-6">
                        <input type="text" name="mobile" data-validation="required number" data-validation-error-msg="Please enter customer name..." class="form-control"/ placeholder="Contact No.">
                      </div>
                    </div>
                    <br>
                      <div class="shop-cart">
                        <table class="cart-tbl pay-cart">
                          <tbody>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th align="right" colspan="2">Sub-Total</th>
                              <th id="total" width="100">Rs. <span>00</span></th>
                            </tr>
                            <tr>
                              <th align="right" colspan="2">Grand Total</th>
                              <th id="gtotal" width="100">Rs. <span>00</span></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <a href="<?=base_url()?>purchase" class="btn btn-default" id="makebill"><i class="fa fa-angle-double-left"></i> &nbsp;Back</a>
                      <button type="submit" class="btn btn-primary" id="makebill">Create Order</button> &nbsp;
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12">
                          <input type="text" name="" autocomplete="off" class="form-control" placeholder="Search Product..." id="src">
                        </div>
                      </div>
                      <div class="pro-box">
                        <table class="cart-tbl">
                          <?php foreach ($products as $key => $val) : ?>
                            <?php $price = ($val['price']+(($val['price'] / 100) * $val['gst'])); ?>
                            <tr>
                              <td><?=$val['product_name']?></td>
                              <td>Rs. <?=$price?></td>
                              <td align="right">
                                <a href="javascript:;" class="btn btn-primary btn-sm addcrt" data-set-id="<?=$val['id']?>" data-pname="<?=$val['product_name']?>" data-price="<?=$price?>">Add Cart</a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
<script>
$(document).ready(function(){
    $(document).on('click', ".addcrt", function(){
      var pid = $(this).attr('data-set-id');
      var pname = $(this).attr('data-pname');
      var price = $(this).attr('data-price');
      var gsum=0;
      $(".pay-cart tbody").append("<tr>"+
        '<td>'+pname+'<input type="hidden" name="pid[]" value="'+pid+'"></td>'+
        '<td><input class="pqty" data-price="'+price+'" placeholder="Qty." value="1" type="text" name="qty[]"></td>'+
        '<td class="price" align="center">Rs. <span class="amt">'+price+'</span></td></tr>');

        if($(".amt").length) {
          $(".amt").each(function(){
            var amt = parseFloat($(this).text());
            gsum = gsum+amt;
          });
          $("#total span ").text(Math.ceil(gsum));
          $("#gtotal span ").text(Math.ceil(gsum));

        } else {
        }
    });

    $(document).on("keyup",".pqty", function(){

      var vl = $(this).val();
      var prc = $(this).attr('data-price');
      var td = $(this).closest('tr').find('.amt');
      var sum, gsum=0;

        if(isNaN(vl)) {
          $(this).val(1);
          sum = prc*1;
          td.text(Math.ceil(sum));
        } else {
          sum = prc*vl;
          td.text(Math.ceil(sum));
        }

        $(".amt").each(function(){
          var amt = parseFloat($(this).text());
          gsum = parseFloat(gsum+amt);
        });
        $("#total span ").text(Math.ceil(gsum));
        $("#gtotal span ").text(Math.ceil(gsum));

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

    });


});



$("form").submit(function( e ){
  if( $(".amt").length == 0 ) {
    e.preventDefault();
  }
});


$("#src").keyup(function(){
  var src = $(this).val();
  $.ajax({
    type:"POST",
    url: "<?=base_url()?>ajax/getProducts",
    data: "src="+src,
    dataType: "json",
    success: function( data ) {
      $(".pro-box .cart-tbl").html("");
      $.each(data, function(i, row){
        price = (parseFloat(row.price) + ( parseFloat(row.price)/100)*parseFloat(row.gst));
          $(".pro-box .cart-tbl").append("<tr>"+
            "<td>"+row.product_name+"</td>"+
            "<td>Rs. "+price+"</td>"+
            '<td align="right">'+
              '<a href="javascript:;" class="btn btn-primary btn-sm addcrt" data-set-id="'+row.id+'" data-pname="'+row.product_name+'" data-price="'+price+'">Add Cart</a>'+
            '</td>'+
            "</tr>");
      });
    }
  });
});

</script>
