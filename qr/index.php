<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/frontend/header.php";
   include_once($path);
?>

<body>

<style type="text/css">

body{
  background-color: black;
  padding: 0;
  margin: 0;
  width: 100%;
  height: 100%;
}

.wrapper {
  position: relative;
  display: block;
  width: 100%;
  height: 100%;
}

.qr-container {
  position: absolute;
  top: 45%;
  left: 50%;
  transform: translate(-50%, -50%);

/*  background-color: #202020;*/
  background-color: white;
  width: 320px;
  padding: 25px;
  border-radius: 30px;
/*  margin: 0 auto;*/
}

.controls-container {
  position: absolute;
  left: 50%;
  top: 105%;
/*  background-color: white;*/
  min-width: 320px;
/*  padding: 20px 20px;*/
/*  border-radius: 30px;*/
  left: 50%;
  transform: translate(-50%, 0%);
  text-align: center;
}

.link {
  text-align: center;
  word-wrap: ;
  color: #007bff;
}

.btn-title {
  color: grey;
  text-transform: uppercase;
  font-size: 0.8rem;
}

.btn {
  background-color: #007bff;
  color: white;
  padding: 8px 16px;
  border-radius: 10px;
  margin-right: 3.5px;
}

.btn:hover,
.btn:active {
  color: white;
  background-color: #113cae;
}
    
</style>

<div class="wrapper">
  <div class="qr-container">
    <div id="container"></div>
    <div class="controls-container">
      <p id="link" class="link"></p>
      <p class="btn-title">Download:</p>
      <button class="btn" onclick="downloadSvg()">SVG</button>
      <button class="btn" onclick="downloadPdf()">PDF</button>
      <button class="btn" onclick="downloadPng()">PNG</button>
      <button class="btn" onclick="downloadJpg()">JPG</button>
    </div>
  </div>
</div>






<script src="js/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/svg2pdf.js@1.5.0/dist/svg2pdf.min.js"></script> -->
<!-- <script src="js/jspdf.umd.min.js"></script> -->
<script src="js/svg2pdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>



<script>
// // QR Defaults
var paddingValue        = 0;
var widthValue          = 256;
var heightValue         = 256;
var colorValue          = "#000000";
var backgroundValue     = "none";
var joinValue           = false;
var eclValue            = "M";
var xmlDeclarationValue = false;


// Get the 'content' parameter from the URL
const contentValue = getUrlParameter('content');
const contentValueLink = contentValue.replace(/^https?:\/\//, '');

paddingValue      = getUrlParameter('padding')    === '' ? paddingValue : getUrlParameter('padding');
widthValue        = getUrlParameter('width')      === '' ? widthValue : getUrlParameter('width');
heightValue       = getUrlParameter('height')     === '' ? heightValue : getUrlParameter('height');
colorValue        = getUrlParameter('color')      === '' ? colorValue : getUrlParameter('color');
backgroundValue   = getUrlParameter('background') === '' ? backgroundValue : getUrlParameter('background');
eclValue          = getUrlParameter('ecl')        === '' ? eclValue : getUrlParameter('ecl');




// Create QR SVG
var qrcode = new QRCode({
  content: contentValue,
  padding: paddingValue,
  width: widthValue,
  height: heightValue,
  color: "colorValue",
  background: backgroundValue,
  container: "svg-viewbox", //Responsive use
  join: joinValue, //Crisp rendering and 4-5x reduced file size
  ecl: eclValue,
  xmlDeclaration: xmlDeclarationValue,
  // container: svg,
});
var svg = qrcode.svg();
document.getElementById("container").innerHTML = svg;

// Display link
document.getElementById("link").innerHTML = "<a href='"+contentValue+"'>" + contentValueLink + "</a>";




// Function to get URL parameters
function getUrlParameter(name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
  const results = regex.exec(location.search);
  return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

// Download functions
function downloadSvg () {
    const svg = document.getElementById('container');
    const base64doc = btoa(unescape(encodeURIComponent(svg.innerHTML)));
    const a = document.createElement('a');
    const e = new MouseEvent('click');
    a.download = contentValueLink + '.svg';
    a.href = 'data:image/svg+xml;base64,' + base64doc;
    a.dispatchEvent(e);
}

function downloadPdf () {
  // Define jsPDF
  window.jsPDF = window.jspdf.jsPDF;

  // Get the SVG element
  const svgElement = document.getElementById('container').firstElementChild;


  svgElement.getBoundingClientRect(); // force layout calculation
  const width = svgElement.width.baseVal.value;
  const height = svgElement.height.baseVal.value;
  const pdf = new jsPDF(width > height ? 'l' : 'p', 'pt', [width, height]);

  pdf.svg(svgElement, { width, height })
     .then(() => {
        //  save the created pdf
        pdf.save(contentValueLink + '.pdf');
      })
}


function downloadPng () {
        // Function to convert SVG to image and trigger download
            var svgElement = document.getElementById('container'); // Select your SVG element

            // Use html2canvas to render the SVG as an image
            html2canvas(svgElement).then(function(canvas) {
                // Convert canvas to data URL
                var dataUrl = canvas.toDataURL('image/png');

                // Create a temporary link element
                var link = document.createElement('a');
                link.href = dataUrl;
                link.download = contentValueLink + '.png';

                // Trigger a click event on the link to start the download
                link.click();
            });
}



function downloadJpg () {
        // Function to convert SVG to image and trigger download
            var svgElement = document.getElementById('container'); // Select your SVG element

            // Use html2canvas to render the SVG as an image
            html2canvas(svgElement).then(function(canvas) {
                // Convert canvas to data URL
                var dataUrl = canvas.toDataURL('image/jpeg');

                // Create a temporary link element
                var link = document.createElement('a');
                link.href = dataUrl;
                link.download = contentValueLink + '.jpg';

                // Trigger a click event on the link to start the download
                link.click();
            });
}

</script>


<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "/frontend/footer.php";
   include_once($path);
?>
</body>
</html>