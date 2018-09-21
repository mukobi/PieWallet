function showPopupWindow() {
    document.getElementById("popup-window").classList.remove("transparent");
    document.getElementById("popup-window").classList.add("active");
}

function xOutOfPopupWindow() {
    document.getElementById("popup-window").classList.add("transparent");
    setTimeout(function() {
        document.getElementById("popup-window").classList.remove("active");
    }, 500);
}

function changePopupWindowContents(htmlContents) {
    var window = document.getElementById("popup-window-contents");
    window.innerHTML = "";
    console.log(htmlContents);
    window.innerHTML = htmlContents;
}