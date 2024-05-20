<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>

.header{
    background-color: #d6d167;
    padding: 1px !important;
    border-radius: 20px;
    border: 1px solid #120c21;
}
.pdf{
  border:1px solid #a7a4af;
  padding: 10px;
}
.header h3{
  color:#2e2b3a;
}
.table-bordered th, .text-wrap table th, .table-bordered td, .text-wrap table td {
    border: 2px solid #666;
}
</style>
<button style="background-color:#DA0C29; color:#fff;" id="downloadPDF">Download</button>
<div class="container pdf" id="downloadPDFData" style="border-radius: 20px;max-width: 60%;">
  <div class="header text-center" style="padding:5px;">
    <div class="row">
      <div class="col-md-12 text-center" style="display: flex;justify-content: center;">
        <h4 style="padding: 12px 50px;background-color:#fff;border:1px solid #120c21;border-radius:20px;">धन प्राप्त रसीद</h4>
      </div>
      
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 text-center">
        <h3 style="font-size: 40px;">प्रसाद एग्रो इंडस्ट्रीज <span style="font-size: 16px;">(कोल्ड स्टोरेज)</span></h3>
      </div>
      <div class="col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 text-center">
        <h3 style="font-size: 18px;border:1px solid #120c21;border-radius:20px;padding:10px">रूरा-अकबरपुर रोड, ग्राम नरिहा, कानपुर देहात (यूo पीo)</h3>
      </div>
      <div class="col-md-2"></div>
    </div>
    <div style="background-color: #d6d167;">
    <div class="row" >
        <div class="col-md-8 text-left" style="padding: 20px;"  >
            नाम: <?=@$obj->farmer?><br>
            विक्रेता का नाम:  <?php 
                  $self = 'Self';
                  if($obj->self == 1) {
                    $self = 'Self';
                  } else{
                    
                    $self= $obj->vendor_id;
                  
                  }
                  echo $self;
                  
                  ?>
            <br>
            पता: <?=@$obj->address?>
          </div>
        <div class="col-md-4" style="">
        <table>
              <tr>
                <td style="vertical-align: top; padding: 20px;">कर्मांक: </td>
                <td style="padding: 20px;">
                  <p class="text-left" style="margin:0"><?=@$obj->id?></p>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top; padding: 0px;">दिनांक: </td>
                <td style="padding:0px;">
                  <p class="text-left" style="margin:0"><?=@$obj->year?></p>
                </td>
              </tr>
            </table>
        </div>
      </div>
    </div>
    <div style="background-color: #d6d167;">
    <div>
      <table class="table-bordered " style="min-height: 380px;">
        <thead class="text-center" style="background-color: #595273;color:#fff">
          <th style="width: 500px; text-align:center">लॉट नंo</th>
          <th style="width: 200px; text-align:center">तौल</th>
          <th style="width: 200px; text-align:center">किराया दर</th>
          <th style="width: 100px; text-align:center">कीमत</th>
        </thead>
        <tbody>
              <tr>
                <td><?=@$obj->farmer_lot_id?></td>
                <td><?=@$obj->quantity?></td>
                <td><?=@$obj->kiraya?></td>
                <td><?=@$obj->total_amount?> </td>
              </tr>
              
        </tbody>
      </table>
    </div>
    <div style="background-color: #d6d167;">
    <div class="row" >
        <div class="col-md-12">
          <table>
              <tr>
                <td style="padding: 20px;">
                  <p class="text-left" style="margin:0">रुपया ( शब्दों में ) : <?=@$obj->total_amount_word?></p>
                </td>
              </tr>
              <tr>
                <td style="padding: 20px; width:650px">
                  <p class="text-left" style="margin:0">किराया दाता/ अधिकृत</p>
                  <p class="text-left" style="margin:0">अभिकर्ता के हस्ताक्षर</p>
                </td>
                <td style="padding: 20px; width:350px">
                <p class="text-left" style="margin:0">लाइसेंस गृहीता/ अधिकृत</p>
                  <p class="text-left" style="margin:0">अभिकर्ता के हस्ताक्षर</p>
                </td>
              </tr>
            </table>
          </div>
      </div>
    </div>
    
  </div>
  </div>
</div>

<script src="<?=base_url()?>/assets/pdf/forpdf-jquery.min.js"></script>
<script src="<?=base_url()?>/assets/pdf/forpdf-pdfmake.min.js"></script>
<script src="<?=base_url()?>/assets/pdf/forpdf-html2canvas.min.js"></script>
<script src="<?=base_url()?>/assets/pdf/forpdf-html2canvas.min.js"></script>
<?php /*
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
*/ ?>

<script>
function getClippedRegion(image, x, y, width, height) {
  var canvas = document.createElement("canvas"),
      ctx = canvas.getContext("2d");

  canvas.width = width;
  canvas.height = height;

  //                   source region         dest. region
  ctx.drawImage(image, x, y, width, height, 0, 0, width, height);

  return {
    // Those are some pdfMake params
    image: canvas.toDataURL(),
    width: 510
  };
}


$("body").on("click", "#downloadPDF", function () {
	$('#downloadPDF').hide();
  html2canvas($("#downloadPDFData")[0], {
    onrendered: function (canvas) {
	// Few necessary setting options
			/*const imgWidth = 208;
			const pageHeight = 295;
			const imgHeight = canvas.height * imgWidth / canvas.width;
			const heightLeft = imgHeight;

			const contentDataURL = canvas.toDataURL('image/png');
			const pdf = new jspdf('p', 'mm', 'a4'); // A4 size page of PDF
            var canvas = pdf.canvas;
        canvas.height = 72 * 11;
        canvas.width=72 * 8.5;;
			const position = 0;
			pdf.addImage(contentDataURL, 'PNG', 0, position, imgWidth, imgHeight);
			pdf.save('report.pdf'); */// Generated PDF  
      // split the canvas produced by html2canvas into several, based on desired PDF page height

      let splitAt = 920; // A page height which fits for "LETTER" pageSize...

      let images = [];
      let y = 0;
      while (canvas.height > y) {
        images.push(getClippedRegion(canvas, 0, y, canvas.width, splitAt));
        y += splitAt;
      }

      // PDF creation using pdfMake
      var docDefinition = {
        content: images,
        pageSize: "A4"
      };
      pdfMake.createPdf(docDefinition).download("Rasid.pdf"); 
      
    
    }
  });
});
</script>

</body>
</html>