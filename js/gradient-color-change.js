var colorsArray = ["#005ba1","#704ac7","#ff6666","#7249c9","#4286f4","#c35bff","#005972","#d4baff","#350072","#0c58a5","#d9a0ff","#ce1257","#67d4fc","#4f0749","#e099ff"];
var gradientIndex = 3;
function changeGradient() {
    var color1 = colorsArray[gradientIndex];
    var color2 = colorsArray[(gradientIndex + 1) % colorsArray.length];
    TweenMax.to("html", 7, {"--color1": color1, "--color2": color2});
    gradientIndex++;
    gradientIndex %= colorsArray.length;
}
setTimeout(changeGradient, 10);
setInterval(changeGradient, 6000);