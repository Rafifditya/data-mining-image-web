<!DOCTYPE html>
<html>
<body>

<tr>
  <td>
    <form action="action-upload.php" method="POST" enctype="multipart/form-data">

      <input type="file" id="picField" name="pic"/>
      <input type="hidden" name="hue" id="hue"/>
      <input type="hidden" name="sat" id="sat"/>
      <input type="hidden" name="val" id="val"/>
      <input type="submit"/>
    </form>
  </td>
  <td>
    <img id="scream" width="220" height="277">
  </td>
  <td><canvas id="myCanvas" width="220" height="277">
  Your browser does not support the HTML5 canvas tag.</canvas></td>
  <td>
    <p id="hasil"></p>
  </td>
  <td>
    <p id="convertrgb"></p>
  </td>
  <td><p>warna yg diambil:</p></td>
  <td><canvas id="finalfas" width="220" height="277">
  Your browser does not support the HTML5 canvas tag.</canvas></td>
</td>


  <br>
  <!-- <h1>warna dominan :</h1>
  <canvas id="finally" width="300" height="150" style="border:1px solid #d3d3d3;"> -->
<script>

function rgb2hsv () {
    var rr, gg, bb,
        r = arguments[0] / 255,
        g = arguments[1] / 255,
        b = arguments[2] / 255,
        h, s,
        v = Math.max(r, g, b),
        diff = v - Math.min(r, g, b),
        diffc = function(c){
            return (v - c) / 6 / diff + 1 / 2;
        };

    if (diff == 0) {
        h = s = 0;
    } else {
              s = diff / v;
              rr = diffc(r);
              gg = diffc(g);
              bb = diffc(b);

              if (r === v) {
                  h = bb - gg;
              }else if (g === v) {
                  h = (1 / 3) + rr - bb;
              }else if (b === v) {
                  h = (2 / 3) + gg - rr;
              }
              if (h < 0) {
                  h += 1;
              }else if (h > 1) {
                  h -= 1;
              }
          }
          return [
             Math.round(h * 360),
             Math.round(s * 100),
             Math.round(v * 100)
         ];
      }

      function hsvToRgb(h, s, v) {
          var r, g, b;
          var i;
          var f, p, q, t;

          // Make sure our arguments stay in-range
          h = Math.max(0, Math.min(360, h));
          s = Math.max(0, Math.min(100, s));
          v = Math.max(0, Math.min(100, v));

          // We accept saturation and value arguments from 0 to 100 because that's
          // how Photoshop represents those values. Internally, however, the
          // saturation and value are calculated from a range of 0 to 1. We make
          // That conversion here.
          s /= 100;
          v /= 100;

          if(s == 0) {
              // Achromatic (grey)
              r = g = b = v;
              return [
                  Math.round(r * 255),
                  Math.round(g * 255),
                  Math.round(b * 255)
              ];
          }

          h /= 60; // sector 0 to 5
          i = Math.floor(h);
          f = h - i; // factorial part of h
          p = v * (1 - s);
          q = v * (1 - s * f);
          t = v * (1 - s * (1 - f));

          switch(i) {
              case 0:
                  r = v;
                  g = t;
                  b = p;
                  break;

              case 1:
                  r = q;
                  g = v;
                  b = p;
                  break;

              case 2:
                  r = p;
                  g = v;
                  b = t;
                  break;

              case 3:
                  r = p;
                  g = q;
                  b = v;
                  break;

              case 4:
                  r = t;
                  g = p;
                  b = v;
                  break;

              default: // case 5:
                  r = v;
                  g = p;
                  b = q;
          }

          return [
              Math.round(r * 255),
              Math.round(g * 255),
              Math.round(b * 255)
          ];
      }


document.getElementById('picField').onchange = function (evt) {
          var tgt = evt.target || window.event.srcElement,
              files = tgt.files;

          // FileReader support
          if (FileReader && files && files.length) {
              var fr = new FileReader();
              fr.onload = function () {
                  document.getElementById("scream").src = fr.result;
              }
              fr.readAsDataURL(files[0]);
          }

          // Not supported
          else {
              // fallback -- perhaps submit the input to an iframe and temporarily store
              // them on the server until the user's session ends.
          }
      }

document.getElementById("scream").onload = function() {
var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");
var img = document.getElementById("scream");
ctx.drawImage(img,0,0);

var redArray = [];
var greenArray = [];
var blueArray = [];
var hue=[];
var sat=[];
var val=[];

for (var i = 0; i < 256; i++) {
  redArray[i] = 0;
  greenArray[i] = 0;
  blueArray[i] = 0;
}
for (var i = 0; i < 361; i++) {
  hue[i] = 0;
  sat[i] = 0;
  val[i] = 0;
}
for (var i = 0; i < 101; i++) {
  sat[i] = 0;
  val[i] = 0;
}

    var imgData = ctx.getImageData(0, 0, c.width, c.height);
    var hsv=[];
    for (i = 0; i < imgData.data.length; i += 4) {
      red = imgData.data[i];
      green = imgData.data[i+1];
      blue = imgData.data[i+2];
      hsv = rgb2hsv(red,green,blue);
      hue[hsv[0]] += 1;
      sat[hsv[1]] += 1;
      val[hsv[2]] += 1;
    }

var countmax = 0;
var countsat = 0;
var countval = 0;
var dominan;
var dominansat;
var dominanval;
var rgb = [];
for (var i = 0; i < 361; i++) {
  if (i != 0) {
    if (countmax < hue[i]) {
      countmax = hue[i];
      dominan = i;
    }
  }
}

for (var i = 0; i < 101; i++) {
  if (i > 10) {
    if (countsat < sat[i]) {
      countsat = sat[i];
      dominansat = i;
    }
    if (countval < val[i]) {
      countval = val[i];
      dominanval = i;
    }
  }
}

// rgb = HSVtoRGB(43,100,100);
rgb = hsvToRgb(dominan,100,100);

document.getElementById("hasil").innerHTML = "Warna HSV yg dominan : H:"+dominan+" S:"+dominansat+" V:"+dominanval;
document.getElementById("convertrgb").innerHTML = "Warna RGB nya r:"+rgb[0]+" g:"+ rgb[1] +" b:"+ rgb[2];

document.getElementById("hue").value = dominan;
document.getElementById("sat").value = dominansat;
document.getElementById("val").value = dominanval;

var fin=document.getElementById("finalfas");
var ctk=fin.getContext("2d");
ctk.fillStyle='rgb('+ rgb[0] +','+ rgb[1] +','+ rgb[2] +')';
ctk.fillRect(20,20,150,100);
};



</script>

<!-- <p><strong>Note:</strong> The canvas tag is not supported in Internet
Explorer 8 and earlier versions.</p> -->

</body>
</html>
