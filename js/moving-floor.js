window.onload = function() {
var refreshInterval;

function resizeAndDrawMovingFloor() {
    var canvas = document.getElementById("moving-floor-canvas");
    var canvasContainer = document.getElementById("moving-floor-canvas-container");
    var maxWidth = canvasContainer.offsetWidth;
    var maxHeight = canvasContainer.offsetHeight;
    canvas.setAttribute("width", maxWidth);
    canvas.setAttribute("height", maxHeight);

    var c=document.getElementById("moving-floor-canvas");
    var ctx=c.getContext("2d");

    ctx.strokeStyle = "white";

    var horizontalLineArray = [];
    function initHorizontalLines(numberLines, height) {
        horizontalLineArray = [];
        var base = Math.pow(height,(1/numberLines));
        for(var i=0; i < numberLines; i++) {
            var k = Math.pow(base, i) + 0.4 * i/numberLines * height;
            //var k = i/numberLines * height;
            horizontalLineArray.push(k);
        }
    }
    initHorizontalLines(10, maxHeight);

    var numberVerticalReys = 37;
    function updateAndDrawLines() {
        ctx.clearRect(0, 0, maxWidth, maxHeight);
        ctx.beginPath();
        console.log("update");
        for(var i = 0; i <= numberVerticalReys; ++i) {
            ctx.moveTo(0.2 * (maxWidth * i / numberVerticalReys + 2 * maxWidth), -100);
            ctx.lineTo(maxWidth * i / numberVerticalReys,maxHeight - 1);
        }
        console.log(horizontalLineArray);
        for(var i = 0; i < horizontalLineArray.length; ++i) {
             horizontalLineArray[i] = (1.01 * horizontalLineArray[i] + 0.5) % maxHeight; 

            ctx.moveTo(0, horizontalLineArray[i]);
            ctx.lineTo(maxWidth, horizontalLineArray[i]);
        }
        ctx.stroke();
    }
    clearInterval(refreshInterval);
    refreshInterval = setInterval(updateAndDrawLines, 20);
}
resizeAndDrawMovingFloor();
window.addEventListener('resize', resizeAndDrawMovingFloor);

}
