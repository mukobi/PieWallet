var sendTx = function() {
    var input = gatherInput();
    if(validateInput(input)) {
        changeSendTabs();
        // TODO Make TX request with window.sendBitcoin
    }
}

var gatherInput = function() {
    var input = {};
    input.toAddress = document.getElementById("send-form-to-address").value;
    input.fromAddress = document.getElementById("send-form-from-address").value;
    input.fromPrivateKey = document.getElementById("send-form-from-private-key").value;
    input.amount = document.getElementById("send-form-amount").value;
    return input;
}

var validateInput = function(input) {
    // TODO validate user input
    // TODO alert for confirmation of sending amount to address
    return true;
}

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

var displayTxResponse = function(response, isError) {
    // TODO Display response on page
}