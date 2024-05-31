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
    background-color: #ff9933;
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
        <p class="text-left" style="padding: 12px 50px;background-color:#fff;border:2px solid #120c21;border-radius:20px;font-weight:900;">वितरण आदेश</p>
      </div>
      
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 text-center">
        <p class="text-left" style="font-size: 40px; font-weight:900;color:#120c21;padding:0 0 0 80px">प्रसाद एग्रो इंडस्ट्रीज <span style="font-size: 16px;">(कोल्ड स्टोरेज)</span></p>
      </div>
      <div class="col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 text-center">
        <p class="text-left" style="font-size: 22px;border:2px solid #120c21;border-radius:20px;padding:0 0 0 60px;font-weight:900;">रूरा-अकबरपुर रोड, ग्राम नरिहा, कानपुर देहात (यूo पीo)</p>
      </div>
      <div class="col-md-2"></div>
    </div>
    <div style="background-color: #ff9933;">
    <div class="row" >
        <div class="col-md-8 text-left" style="padding: 20px; font-size:22px; font-weight:900"  >
            नाम: <?=@$obj->farmer?><br>
            <br>
            पता: <?=@$obj->address?>
          </div>
        <div class="col-md-4" style="">
        <table>
              <tr>
                <td style="vertical-align: top; padding: 0px;"><p class="text-left" style="font-size: 22px;font-weight:900">कर्मांक: </p></td>
                <td style="padding: 20px;">
                  <p class="text-left" style="margin:0;font-weight:900; font-size:22px"><?=@$obj->id?></p>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top; padding: 0px;"><p class="text-left" style="font-size: 22px;font-weight:900">दिनांक: </p></td>
                <td style="padding:0px;">
                  <p class="text-left" style="margin:0;font-weight:900; font-size:22px"><?=@$obj->year?></p>
                </td>
              </tr>
            </table>
        </div>
      </div>
    </div>
    <div style="background-color: #ff9933;">
    <div>
      <table class="table-bordered " style="min-height: 380px;">
        <thead class="text-center" style="background-color: #595273;color:#fff">
          <th style="width: 500px; text-align:center"><p class="text-left" style="font-size: 22px; font-weight:900">लॉट नंo</p></th>
          <th style="width: 500px; text-align:center"><p class="text-left" style="font-size: 22px; font-weight:900">बोरे सo</p></th>
        </thead>
        <tbody>
              <tr>
                <td style="font-size: 22px; font-weight:900"><?=@$obj->farmer_lot_id?></td>
                <td style="font-size: 22px; font-weight:900"><?=@$obj->bori_no?></td>
              </tr>
              
        </tbody>
      </table>
    </div>
    <div style="background-color: #ff9933;">
    <div class="row" >
        <div class="col-md-12">
          <table>
              
              <tr>
                <td style="padding: 20px; width:650px">
                  <p class="text-left" style="margin:0">अभिकर्ता के हस्ताक्षर</p>
                </td>
                <!---<td style="padding: 20px; width:350px">
                <p class="text-left" style="margin:0">लाइसेंस गृहीता/ अधिकृत</p>
                  <p class="text-left" style="margin:0">अभिकर्ता के हस्ताक्षर</p>
                </td>----->
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