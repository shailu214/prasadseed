<div class="my-3 my-md-5">
  <div class="container">
    <div class="alert alert-success alert-dismissible " style="display:none;" id="palert">
      <button data-dismiss="alert" class="close"></button>
      <i class="fe fe-check"></i> &nbsp; <b>Congratulation!</b> record added successfully.
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form class="card" method="post" id="porder">
          <h3 class="card-title" style="margin:20px 25px;;"><i class="fe fe-shopping-cart"></i> &nbsp;Purchase Order</h3>
          <hr style="margin:0px;">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                <div class="col-md-4">
                  <label>Company Name</label>
                  <select name="vendor" id="vend" >
                    <?php foreach ($vendors as $key => $val) : ?>
                      <option value="<?=$val['id']?>"> <?=$val['company_name']?> ( <?=$val['vendor_name']?> )</option>
                    <?php  endforeach; ?>
                  </select>
                  <a href="javascript:;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#vndMode"><i class="fe fe-plus"></i></a>

                  <!-- <input type="text" name="customer" data-validation="required" data-validation-error-msg="Please enter customer name..." class="form-control" placeholder="Customer Name..."/> -->
                </div>
                <div class="col-md-5">
                  <!-- <label>Contact No.</label>
                  <input type="text" name="mobile" data-validation="required number" data-validation-error-msg="Please enter contact no." class="form-control" placeholder="Contact No."> -->

                </div>
                <div class="col-md-3">
                  <label>Date</label>
                  <input type="text" name="date" required="required" class="form-control date" placeholder="Date..." value="<?=date("d-m-Y")?>"/>
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

                            <a href="javascript:;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#prdMode"><i class="fe fe-plus"></i></a>
                          </div>
                        </td>
                        <td><input type="text" name="" id="price" readonly="readonly" placeholder="price..." class="form-control"></td>
                        <td><input type="text" name="" id="qty" placeholder="qty..."  class="form-control"></td>
                        <td width="180"><input type="text" name="" id="sbt" readonly="readonly" placeholder="subtotal..." class="form-control"></td>
                        <td><a href="javascript:;" class="btn btn-md btn-primary" id="addrow"> <i class="fa fa-plus"></i></a></td>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style="text-align:right" colspan="3">Sub-Total :</th>
                        <th id="total" width="100">Rs. <span>00</span></th>
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
                <button type="submit" class="btn btn-primary" id="makebill">Create Order</button> &nbsp;
              </div>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="prdMode" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Product</h4>
        <button type="button" class="close" data-dismiss="modal"></button>
      </div>
      <form method="post"  id="proFrom">
      <div class="modal-body">
        <div class="form-group">
          <label>Product Name.</label>
          <input type="text" class="form-control" id="pname" data-validation="required" data-validation-error-msg="Please enter product name." name="prod[product_name]" placeholder="Product Name..." />
        </div>
        <div class="form-group">
          <label>Retail Price.</label>
          <input type="text" class="form-control" id="rprice" name="prod[price]" data-validation="required number" data-validation-error-msg="Please enter retail price." placeholder="Retail Price..." />
        </div>
        <div class="form-group">
          <label>Selling Price.</label>
          <input type="text" class="form-control" id="sprice" name="prod[sell_price]" placeholder="Selling Price..." data-validation="required number" data-validation-error-msg="Please enter selling price." />
        </div>
        <div class="form-group">
          <label>Purchase Price.</label>
          <input type="text" class="form-control" id="pprice" name="prod[purchase_price]" placeholder="Purchase Price..." data-validation="required number" data-validation-error-msg="Please enter purchase price." />
        </div>
        <div class="form-group">
          <label>HSN Code.</label>
          <input type="text" class="form-control" id="hsn" name="prod[hsn]" placeholder="HSN Code..." />
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="advpro">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <!-- </form> -->
    </div>
  </div>
</div>


<div id="vndMode" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Vendor</h4>
        <button type="button" class="close" data-dismiss="modal"></button>
      </div>
      <form method="post"  id="proFrom">
      <div class="modal-body">
        <div class="form-group">
          <label>Company Name.</label>
          <input type="text" class="form-control" id="cname" data-validation="required" data-validation-error-msg="Please enter company name." placeholder="Company Name..." />
        </div>
        <div class="form-group">
          <label>Vendor Name.</label>
          <input type="text" class="form-control" id="vname" data-validation="required" data-validation-error-msg="Please enter vendor name." placeholder="Vendor Name..." />
        </div>
        <div class="form-group">
          <label>Mobile No.</label>
          <input type="text" class="form-control" id="vmob" placeholder="Mobile No." data-validation="required number" data-validation-error-msg="Please enter mobile no." />
        </div>
        <div class="form-group">
          <label>Email Address.</label>
          <input type="text" class="form-control" id="vmail" placeholder="Email Address.."  />
        </div>
        <div class="form-group">
          <label>Address.</label>
          <input type="text" class="form-control" id="vaddr"  placeholder="Address..." />
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="advnd">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <!-- </form> -->
    </div>
  </div>
</div>


<script>
$(document).ready(function(){
  $("#vend").select2();
  var prd = $("#prds").select2();
  prd.on("select2:select", function(e){
    var pid = $(e.currentTarget).val();
    $.ajax({
      type:"post",
      url:"<?=base_url()?>/ajax/prod_price.html",
      data:"act=2&pid="+pid,
      success : function (price) {
        $("#price").val(price);
        $("#qty").val('1');
        $("#sbt").val(price);

      }
    });
  });

  $(".date").datepicker({ format:'dd-mm-yyyy'});

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
  '<td class="price" align="left"> &nbsp; &nbsp;Rs. <span class="amt">'+sbt+'</span></td>'+
  '<td><a href="javascript:;" class="rem-prd"><i class="fe fe-trash"></i></a></td></tr>');

  if($(".amt").length) {
    $(".amt").each(function(){
      var amt = parseInt($(this).text());
      gsum = gsum+amt;
    });
    $("#total span ").text(gsum);
    $("#gtotal span ").text(gsum);
    // discval();
    // $("#prds").val('Select Product').change();
    $("#prds").val("0").trigger("change");
    $("#price").val('');
    $("#qty").val('');
    $("#sbt").val('');

  }
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
// discval();

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
    // discval();
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


$("#porder").submit(function( e ){
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
data: "sale=0&src="+src,
dataType: "json",
success: function( data ) {
$(".src-box ul").html("");
$.each(data, function(i, row){
//  price = Math.ceil((parseInt(row.sell_price) + ( parseInt(row.sell_price)/100)*parseInt(row.gst) ));
    $(".src-box ul").append('<li class="pr-li" data-price="'+row.purchase_price+'" data-row-id="'+row.id+'">'+row.product_name+'</li>');
});
$(".src-box").show();
}
});
} else {
$(".src-box").hide();
}
});



$("#advpro").click(function(e){

  var pname = $("#pname").val().trim();
  var prc = $("#rprice").val().trim();
  // alert(prc);
  var spr = $("#sprice").val().trim();
  var ppr = $("#pprice").val().trim();
  var hsn = $("#hsn").val().trim();
  if( (pname.length > 0 && prc.length > 0) && (spr.length > 0 && ppr.length > 0)) {
    e.preventDefault();
    // alert(pname.length);
  $.ajax({
    type:"POST",
    url: "<?=base_url()?>ajax/add_product",
    data: "product_name="+pname+"&sell_price="+spr+"&purchase_price="+ppr+"&price="+prc+"&hsn="+hsn,
    contactType:false,
    cache:false,
    processData:false,
    dataType:'json',
    success: function ( res ) {
      var newOption = new Option(res.text, res.id, false, false);
      $('#prds').append(newOption).trigger('change');
      $("#prdMode").modal('hide');

      $("#pname").val('');
      $("#rprice").val('');
      $("#sprice").val('');
      $("#pprice").val('');
      $("#hsn").val('');
      $("#palert").fadeIn();
    }
  })
}

});



$("#advnd").click(function(e){

  var cname = $("#cname").val().trim();
  var vname = $("#vname").val().trim();
  // alert(prc);
  var mob = $("#vmob").val().trim();
  var mail = $("#vmail").val().trim();
  var addr = $("#vaddr").val().trim();
  if( (cname.length > 0 && vname.length > 0) && (mob.length > 0)) {
    e.preventDefault();
    // alert(pname.length);
  $.ajax({
    type:"POST",
    url: "<?=base_url()?>ajax/add_vendor",
    data: "company_name="+cname+"&vendor_name="+vname+"&mobile="+mob+"&email="+mail+"&address="+addr,
    contactType:false,
    cache:false,
    processData:false,
    dataType:'json',
    success: function ( res ) {
      var newOption = new Option(res.text, res.id, false, false);
      $('#vend').append(newOption).trigger('change');
      $("#vndMode").modal('hide');

      $("#cname").val('');
      $("#vname").val('');
      $("#vmob").val('');
      $("#vmail").val('');
      $("#vaddr").val('');
      $("#palert").fadeIn();
    }
  })
}

});
</script>
