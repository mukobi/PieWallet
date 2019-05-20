var changeSendTabs = function() {
    var tabs = document.getElementsByClassName("tab");
    for(var i = 0; i < tabs.length; i++) {
        var tab = tabs[i];
        if(tab.classList.contains("active")) {
            tab.classList.remove("active");
        }
        else {
            tab.classList.add("active");
        }
    }
}

console.log(window.requests);
console.log(window.bitcoin);