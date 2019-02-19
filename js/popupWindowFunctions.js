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
    // console.log(htmlContents);
    window.innerHTML = htmlContents;
}

function loadPage(page, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() { 
        if (xhttp.readyState == 4 && xhttp.status == 200)
            callback(xhttp.responseText);
    }
    xhttp.open("GET", page, true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(null);
}

function loadPageMultiCallback(page, resultCallback, otherCallback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() { 
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            resultCallback(xhttp.responseText);
            otherCallback();
        }

    }
    xhttp.open("GET", page, true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(null);
}