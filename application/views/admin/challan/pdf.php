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
    background-color: #a7a4af;
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
      <div class="col-md-7 text-center" style="display: flex;justify-content: end;">
        <p class="text-left" style="padding: 5px 50px;background-color:#fff;border:2px solid #120c21;border-radius:20px;font-weight:900;font-size:20px; margin:0;max-height:50px">चालान</p>
      </div>
      <div class="col-md-5" style="display: flex;justify-content: end;">
          <table>
            <tr>
              <td style="font-size: 20px; font-weight:900;color:#120c21">Mobile:</td>
              <td>
                <p style="margin-bottom:0; font-size: 20px; font-weight:900;color:#120c21">+91-6386945728</p>
                <p style="font-size: 20px; font-weight:900;color:#120c21">+91-7618961160</p>
              </td>
            </tr>
          </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 text-center">
       <p class="text-left" style="font-size: 40px;color:#120c21;font-weight:900;padding:10px 10px 10px 80px; margin:0">प्रसाद एग्रो इंडस्ट्रीज <span style="font-size: 16px;color:#120c21;">(कोल्ड स्टोरेज)</span></p>
      </div>
      <div class="col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 text-center">
        <p class="text-left" style="font-size: 22px;border:2px solid #120c21;border-radius:20px;padding:0 0 0 20px;font-weight:900;color:#120c21">रूरा-अकबरपुर रोड, ग्राम नरिहा, कानपुर देहात (यूo पीo)</p>
      </div>
      <div class="col-md-2"></div>
    </div>
    <div style="background-color: #fff; border: 3px solid #666; border-radius:20px 20px 0 0;">
    <div class="row" >
        <div class="col-md-8" style="border-right: 4px solid #666; border-radius:15px" >
          <table>
              <tr>
                <td style="vertical-align: top; padding:0 30px;padding: 20px;"><p class="text-left" style="font-size:22px; font-weight:900;color:#120c21">मेसर्स: </p></td>
                <td style="padding: 20px;">
                  <p class="text-left" style="margin:0;font-size:22px; font-weight:900;color:#120c21"><?=@$obj->ms_name?></p>
                  <p class="text-left" style="margin:0;font-size:22px; font-weight:900;color:#120c21"><?=@$obj->state?>, <?=@$obj->city?></p>
                </td>
              </tr>
            </table>
          </div>
        <div class="col-md-4" style="border-left: 4px solid #666; border-radius:15px">
        <table>
              <tr>
                <td style="vertical-align: top; padding: 0px;"><p class="text-left" style="font-size:22px; font-weight:900;color:#120c21">कर्मांक: </p></td>
                <td style="padding: 0px;">
                  <p class="text-left" style="margin:0;font-size:22px; font-weight:900;color:#120c21"><?=@$obj->id?></p>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top; padding: 5px 5px 5px 0px;"><p class="text-left" style="font-size:22px; font-weight:900;color:#120c21">दिनांक: </p></td>
                <td style="padding:0px;">
                  <p class="text-left" style="margin:0;font-size:22px; font-weight:900;color:#120c21"><?=@$obj->year?></p>
                </td>
              </tr>
            </table>
        </div>
      </div>
    </div>
    <div style="background-color: #fff;">
    <div class="row">
      <div class="col-md-12">
        <p class="text-left" style="font-size:19px;padding:0 10px; color:#120c21;margin:0 ">महोदय,</p>
        <p class="text-left" style="font-size: 19px;padding:0 10px; color:#120c21 ">आज दिन गाड़ी नम्बर <?=@$obj->vechicle_no?> से  <?=@$obj->vegetable?> <?=@$obj->no_of_bori_count?> बोरा शब्दों में <?=@$obj->no_of_bori_count_word?>, बिक्री हेतु आपके पास भेज रहा हूं सो आप माल संभालकर उतरवा लीजिएगा ।। गाड़ी भाड़ा बिल्टी मुजिब रुपए  <?=@$obj->gaddi_bhada?> प्रति किग्रा / प्रति बोरा के हिसाब से जोड़कर दे देना ।। माल बिक्री का पूरा रुपया हमारे खाता नाम  <?=@$obj->account_name?> , बैंक का नाम: <?=@$obj->bank_name?>, खाता नंबर: <?=@$obj->account_number?>, आई एफ एस सी कोड: <?=@$obj->ifsc_code?>, बैंक का पता: <?=@$obj->bank_address?>  में ही करें ।। <br>धन्यबाद
</p>
      </div>
      
    </div>
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <p class="text-left"  style="font-size: 22px;border:2px solid #120c21;border-radius:20px;padding:10px 10px 10px 80px;font-weight:900;color:#120c21">माल का विवरण</p>
      </div>
      <div class="col-md-4"></div>
    </div>
    <div>
      <table class="table-bordered ">
        <thead class="text-center" style="background-color: #595273;color:#fff">
          <th style="width: 100px; text-align:center"><p class="text-left" style="font-size: 22px; font-weight:900;color:#fff;margin:0">क्रम.</p></th>
          <th style="width: 500px; text-align:center"><p class="text-left" style="font-size: 22px; font-weight:900;color:#fff;margin:0">भेजने वाले का नाम</p></th>
          <th style="width: 200px; text-align:center"><p class="text-left" style="font-size: 22px; font-weight:900;color:#fff;margin:0">ग्राम</p></th>
          <th style="width: 100px; text-align:center"><p class="text-left" style="font-size: 22px; font-weight:900;color:#fff;margin:0">बोरा</p></th>
          <th style="width: 100px; text-align:center"><p class="text-left" style="font-size: 22px; font-weight:900;color:#fff;margin:0">निशान</p></th>
        </thead>
        <tbody>
              <tr>
                <td style="font-size: 22px; font-weight:900;color:#120c21">1</td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->farmer?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->address?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->no_of_bori?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->nisaan?> </td>
              </tr>
              <tr>
                <td style="font-size: 22px; font-weight:900;color:#120c21">2</td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->no_of_bori1?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->nisaan1?> </td>
              </tr>
              <tr>
                <td style="font-size: 22px; font-weight:900;color:#120c21">3</td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->no_of_bori2?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->nisaan2?></td>
              </tr>
              <tr>
                <td style="font-size: 22px; font-weight:900;color:#120c21">4</td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->no_of_bori3?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->nisaan3?></td>
              </tr>
              <tr>
                <td style="font-size: 22px; font-weight:900;color:#120c21">5</td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->no_of_bori4?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->nisaan4?></td>
              </tr>
              <tr>
                <td style="font-size: 22px; font-weight:900;color:#120c21">6</td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->no_of_bori5?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->nisaan5?></td>
              </tr>
              <tr>
                <td style="font-size: 22px; font-weight:900;color:#120c21">7</td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->no_of_bori6?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->nisaan6?></td>
              </tr>
              <tr>
                <td style="font-size: 22px; font-weight:900;color:#120c21">8</td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->no_of_bori7?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->nisaan7?></td>
              </tr>
              <tr>
                <td style="font-size: 22px; font-weight:900;color:#120c21">9</td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->no_of_bori8?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->nisaan8?></td>
              </tr>
              <tr>
                <td style="font-size: 22px; font-weight:900;color:#120c21">10</td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->no_of_bori9?></td>
                <td style="font-size: 22px; font-weight:900;color:#120c21"><?=@$obj->nisaan9?></td>
              </tr>
        </tbody>
      </table>
    </div>
    <div style="background-color: #fff;">
    <div class="row" >
        <div class="col-md-8">
          <table>
              <tr>
                <td style="vertical-align: top; padding:0 30px;padding: 20px; font-size: 20px; font-weight:900;color:#120c21">नोट: </td>
                <td style="padding: 20px;">
                  <p class="text-left" style="margin:0;font-size: 20px; font-weight:900;color:#120c21">कृपया आलू की धर्म कांटा तौल  की पर्ची एवं आपके मंडी की प्रवेश पर्ची हमारे WhatsApp Number +91-6386945728 पर माल उतारने के बाद अवश्य ही प्रेषित करने का कष्ट करें।।</p>
                </td>
              </tr>
            </table>
          </div>
        <div class="col-md-4" style="display: flex;justify-content: center; ;">
        <table>
              <tr>
                <td style="vertical-align: top; padding: 20px 5px; text-align:center">
                <p class="text-left" style="font-size: 16px;font-size: 20px; font-weight:900;color:#120c21">भवदीए</p>
                <p class="text-left" style="font-size: 16px;font-size: 20px; font-weight:900;color:#120c21">वास्ते प्रसाद एग्रो इंडस्ट्रीज</p>
              </td>
                
              </tr>
            </table>
        </div>
      </div>
    </div>
    <div style="background-color: #fff;">
    <div class="row" >
        <div class="col-md-8" style="display: flex;justify-content: center; ;">
          <table>
              <tr>
                <td style="vertical-align: top; padding:0 30px;padding: 20px;"><p class="text-left" style="font-size: 20px; font-weight:900;color:#120c21">हस्ताक्षर ड्राइवर / व्यापारी</p></td>
              </tr>
            </table>
          </div>
        <div class="col-md-4" style="display: flex;justify-content: center; ;">
        <table>
              <tr>
                <td style="vertical-align: top; padding: 20px 5px; text-align:center">
                <table>
              <tr>
                <td style="vertical-align: top; padding:0 30px;padding: 5px;"><p class="text-left" style="font-size: 20px; font-weight:900;color:#120c21">मैनेजर</p></td>
              </tr>
            </table>
               
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

      let splitAt =1362; // A page height which fits for "LETTER" pageSize...

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
      pdfMake.createPdf(docDefinition).download("Challan.pdf"); 
      
    
    }
  });
});
</script>

</body>
</html>