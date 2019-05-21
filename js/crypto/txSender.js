var sendTx = function() {
    var input = gatherInput();
    if(validateInput(input)) {
        changeSendTabs();
        // Make TX request using txRequireNode.js (browserified)
        try {
            // this function will call displayTxSuccess() or displayTxErrors()
            window.sendBitcoin(
                input.amount, 
                input.toAddress, 
                input.fromAddress, 
                input.fromPrivateKey
            );
        }
        catch(e) {
            displayTxErrors([{error: e}]);
        }
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

var displayTxSuccess = function(tx) {
    var coin = "btc";
    var myAddress = PieWallet.publicAddresses[coin];
    var coin = coin.toUpperCase();
    var conversion = coin === "ETH" ? 1000000000000000000 : 100000000;
    var inHTML = "";
    for(var j = 0; j < tx.inputs.length; j++) {
        if(tx.inputs[j].addresses !== undefined) {
            var address = tx.inputs[j].addresses == null ? 
                "none" : tx.inputs[j].addresses[0];
            if(address === myAddress) address = 
                "<span class='me-" + coin + "'>(me) " 
                + address + "</span>";
            inHTML += "<p><span class='from'>" + tx.inputs[j].output_value / conversion + 
                "</span> from " + address + "</p>";
        }
    }
    var outHTML = "";
    for(var j = 0; j < tx.outputs.length; j++) {
        if(tx.outputs[j].addresses !== undefined) {
            var address = tx.outputs[j].addresses == null ? 
                "none" : tx.outputs[j].addresses[0];
            if(address === myAddress) address = 
                "<span class='me-" + coin + "'>(me) " 
                + address + "</span>";
            outHTML += "<p><span class='to'>" + tx.outputs[j].value / conversion + 
                "</span> to " + address + "</p>";
        }
    }
    // better format time
    var dateTime = tx.received.replace(/T|Z/gi, " ");
    transactionsHTML = 
    "<h5>" + coin + " transaction successful!</h5>" +
    "<div><p>Received at " + dateTime + "</p></div>" +
    "<div>" + inHTML + "</div>" +
    "<div>" + outHTML + "</div>";
    document.getElementById("send-response-results-container").innerHTML = transactionsHTML;
}

var displayTxErrors = function(errorList) {
    var errorHTML = "<h5>The following errors were found:</h5><ul>";
    for(var i = 0; i < errorList.length; i++) {
        errorHTML += "<li>" + errorList[i].error + "</li>";
    }
    errorHTML += "</ul>";
    document.getElementById("send-response-results-container").innerHTML = errorHTML;
}