window.onload = function() {

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
    ctx.beginPath();

    var numberVerticalReys = 37;
    for(var i = 0; i <= numberVerticalReys; ++i) {
        ctx.moveTo(maxWidth / 2, 0);
        ctx.lineTo(maxWidth * i / numberVerticalReys,maxHeight - 1);
        ctx.stroke();
    }


}
resizeAndDrawMovingFloor();
window.addEventListener('resize', resizeAndDrawMovingFloor);

}
