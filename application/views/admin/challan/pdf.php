<style>

.header{
    background-color: #a7a4af;
    padding: 10px !important;
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
</style>
<button style="background-color:#DA0C29; color:#fff;" id="downloadPDF">Download</button>
<div class="container pdf" id="downloadPDFData" style="border-radius: 20px;max-width: 60%;">
  <div class="header text-center" style="padding:5px;">
    <div class="row">
      <div class="col-md-7 text-center" style="display: flex;justify-content: end;">
        <h4 style="padding: 12px 50px;background-color:#fff;border:1px solid #120c21;border-radius:20px;">चालान</h4>
      </div>
      <div class="col-md-5">
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 text-center">
        <h3 style="font-size: 40px;">प्रसाद एग्रो इंडस्ट्रीज <span style="font-size: 16px;">(कोल्ड स्टोरेज)</span></h3>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
</div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>


<script>

// Slightly adapted function from this SO answer: https://stackoverflow.com/a/21937796/2159528
// It now returns the objects formatted for pdfMake
function getClippedRegion(image, x, y, width, height) {
  var canvas = document.createElement("canvas"),
      ctx = canvas.getContUnder Constructionext("2d");

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

      let splitAt = 850; // A page height which fits for "LETTER" pageSize...

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
      pdfMake.createPdf(docDefinition).download("report.pdf"); 
      
    
    }
  });
});
</script>