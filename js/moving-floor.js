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
        for(var i=0; i < numberLines; i++) {
            var k = i/numberLines * height;
            horizontalLineArray.push(k);
        }
    }
    initHorizontalLines(20, maxHeight);

    var numberVerticalReys = 45;
    function updateAndDrawLines() {
        ctx.clearRect(0, 0, maxWidth, maxHeight);
        ctx.beginPath();
        for(var i = 0; i <= numberVerticalReys; ++i) {
            ctx.moveTo(maxWidth * i / numberVerticalReys, 0);
            ctx.lineTo(maxWidth * i / numberVerticalReys,maxHeight - 1);
        }
        //console.log(horizontalLineArray);
        for(var i = 0; i < horizontalLineArray.length; ++i) {
            horizontalLineArray[i] = (horizontalLineArray[i] + 0.002 * maxHeight) % maxHeight; 
            var roundedPosition = Math.round(horizontalLineArray[i]);
            ctx.moveTo(0, roundedPosition);
            ctx.lineTo(maxWidth, roundedPosition);
        }
        ctx.stroke();
    }
    clearInterval(refreshInterval);
    refreshInterval = setInterval(updateAndDrawLines, 16);
}
resizeAndDrawMovingFloor();
window.addEventListener('resize', resizeAndDrawMovingFloor);

}
