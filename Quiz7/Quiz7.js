let c = document.getElementById('draw');
let v = document.getElementById('video1');
let ctx = c.getContext("2d");
let i;

v.addEventListener("play",
                   function() {
                      i = window.setInterval(function()
                        {ctx.drawImage(v,5,5,390,390)}
                        ,33);
                   }, false);
v.addEventListener("ended", function() {clearInterval(i);}, false); 

ctx.setTransform(1,0,0,1,0,0);

let videoWidth = v.clientWidth;
let videoHeight = v.clientHeight;

let rotation = 30;

function rotate()
{
  ctx.clearRect(0, 0, c.width, c.height);
  let angleInRadians = rotation * Math.PI/180;
  let x = 0, y = 0;

  ctx.translate(x+.5*videoWidth, y+.5*videoHeight);
  ctx.rotate(angleInRadians);

  ctx.restore();
  rotation ++;
  
}



