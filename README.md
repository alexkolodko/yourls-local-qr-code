# YOURLS Local QR Code in SVG, PDF &amp; Image Plugin

Allows you to get the QR code by by adding `.qr` to the end of the short URL. 

## Installation

1. Move the `qr` folder into the root folder. The interface for displaying QR codes will be at `YOURLS_SITE/qr` 
1. Move the `qr-code-svg-local` folder into the `/users/plugins` folder. Then, activate the plugin in the admin interface.
1. Go to the Plugins Administration page and activate the plugin.
1. Have fun! 🤖

## QR Parameters

You can also use the parameters to generate QR codes via url.

List of options (same with `qrcode-svg` library):
* content - QR Code content (yourls short link), the only **required** parameter
* padding - white space padding, default: `0` modules, `4` for classic use
* width - QR Code width in pixels, default: `256 px`
* height - QR Code height in pixels, default:  `256 px`
* color - color of modules (squares), color name or hex string, e.g. #FF0000, default: `#000000`
* background - color of background, color name or hex string, e.g. white, default: `none` 
* ecl - error correction level: L, M, H, Q. Default: `М`
* xmlDeclaration - prepend XML declaration to the SVG document, i.e. `<?xml version="1.0" standalone="yes"?>`, default: `false`
<!-- * join - join modules (squares) into one shape, into the SVG path element, recommended for web and responsive use, default: false -->


## Dependecies

Main functionality of adding a QR code is borrowed from Ozh's orginal plugin code.

QR code generation and convert made possible by
* [qrcode-svg](https://github.com/papnkukn/qrcode-svg)
* [jsPDF](https://github.com/parallax/jsPDF)
* [svg2pdf](https://github.com/yWorks/svg2pdf.js)
* [html2canvas](https://html2canvas.hertzen.com/)



## Legal notice

```
Licensed under the MIT license:
http://www.opensource.org/licenses/mit-license.php

The word "QR Code" is registered trademark of DENSO WAVE INCORPORATED
http://www.denso-wave.com/qrcode/faqpatent-e.html
```