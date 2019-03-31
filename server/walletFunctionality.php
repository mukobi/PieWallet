<script>
// object to hold all info regarding wallet/cryptocurrency integration
var PieWallet = {
    marketValue: {
        btc: null,
        eth: null,
        ltc: null
    },
    marketChange: {
        btc: null,
        eth: null,
        ltc: null
    },
    balance: {
        btc: null,
        eth: null,
        ltc: null
    },
    balanceUSD: {
        btc: null,
        eth: null,
        ltc: null
    },
    transactions: {
        btc: [],
        eth: [],
        ltc: []
    },
    __publicAddresses: {
        btc: "<?php echo $myUserObject["btc_address"]; ?>",
        eth: "<?php echo $myUserObject["eth_address"]; ?>",
        ltc: "<?php echo $myUserObject["ltc_address"]; ?>"
    },
    publicAddresses: {
        btc: "1F1tAaz5x1HUXrCNLbtMDqcw6o5GNn4xqX",
        eth: "0x2c5457890ce19c8778FbA5f2cFA627D1cfd2b4A7",
        ltc: "3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAj"
    },
    privateKey: {
        key: ""
    }
};

var refreshMarketValue = function() {
    var xhttp1 = new XMLHttpRequest();
    xhttp1.onreadystatechange = function() {
        if (xhttp1.readyState == 4 && xhttp1.status == 200) {
            try {
                var response = JSON.parse(xhttp1.responseText);
                PieWallet.marketValue.btc = parseFloat(response.data[0].quote.USD.price);
                PieWallet.marketChange.btc = parseFloat(response.data[0].quote.USD.percent_change_1h);
                PieWallet.marketValue.ltc = parseFloat(response.data[7].quote.USD.price);
                PieWallet.marketChange.ltc = parseFloat(response.data[7].quote.USD.percent_change_1h);
                PieWallet.marketValue.eth = parseFloat(response.data[2].quote.USD.price);
                PieWallet.marketChange.eth = parseFloat(response.data[2].quote.USD.percent_change_1h);
                updateTickerHTML();
            }
            catch(err) {console.log(err);}
        }
    }
    xhttp1.open("GET", "/server/cmcProxy.php", true);
    xhttp1.send();
}

var refreshBalance = function() {
    if(PieWallet.publicAddresses.btc != "" &&
        PieWallet.publicAddresses.ltc != "" &&
        PieWallet.publicAddresses.eth != "") {
        var xhttp1 = new XMLHttpRequest();
        xhttp1.onreadystatechange = function() { 
            if (xhttp1.readyState == 4 && xhttp1.status == 200) {
                try {
                    var response = JSON.parse(xhttp1.responseText);
                    PieWallet.balance.btc = parseFloat(response.balance) / 100000000;  // satoshis to btc
                    PieWallet.transactions.btc = response.txs;
                    updateTickerHTML();
                }
                catch(err) {console.log(err);}
            }
        }
        xhttp1.open("GET", "https://api.blockcypher.com/v1/btc/main/addrs/" + PieWallet.publicAddresses.btc + "/full", true);
        xhttp1.send();
        var xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function() { 
            if (xhttp2.readyState == 4 && xhttp2.status == 200) {
                try {
                    var response = JSON.parse(xhttp2.responseText);
                    PieWallet.balance.ltc = parseFloat(response.balance) / 100000000;  // satoshis to ltc
                    PieWallet.transactions.ltc = response.txs;
                    updateTickerHTML();
                }
                catch(err) {console.log(err);}
            }
        }
        xhttp2.open("GET", "https://api.blockcypher.com/v1/ltc/main/addrs/" + PieWallet.publicAddresses.ltc + "/full", true);
        xhttp2.send();
        var xhttp3 = new XMLHttpRequest();
        xhttp3.onreadystatechange = function() { 
            if (xhttp3.readyState == 4 && xhttp3.status == 200) {
                try {
                    var response = JSON.parse(xhttp3.responseText);
                    PieWallet.balance.eth = parseFloat(response.balance) / 1000000000000000000;  // wei to eth
                    // NOTE! blockcypher ETH api currently doesn't work for /full endpoint, maybe try later
                    //PieWallet.transactions.eth = response.txs; 
                    updateTickerHTML();
                }
                catch(err) {console.log(err);}
            }
        }
        xhttp3.open("GET", "https://api.blockcypher.com/v1/eth/main/addrs/" + PieWallet.publicAddresses.eth + "/balance", true);
        xhttp3.send();
    }
    else {
        PieWallet.balance.btc = 0;
        PieWallet.balance.ltc = 0;
        PieWallet.balance.eth = 0;
    }
}

var updateTickerHTML = function() {
    // wait for all async requests to be finished
    if(PieWallet.marketValue.btc !== null && PieWallet.marketValue.ltc !== null && PieWallet.marketValue.eth !== null &&
       PieWallet.balance.btc !== null && PieWallet.balance.ltc !== null && PieWallet.balance.eth !== null) {
        var list = document.getElementsByClassName("market-btc");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = "$" + PieWallet.marketValue.btc.toString().substr(0,7);
        }
        list = document.getElementsByClassName("market-ltc");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = "$" + PieWallet.marketValue.ltc.toString().substr(0,7);
        }
        list = document.getElementsByClassName("market-eth");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = "$" + PieWallet.marketValue.eth.toString().substr(0,7);
        }

        list = document.getElementsByClassName("balance-btc");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = PieWallet.balance.btc.toString().substr(0,8) + " BTC";
        }
        list = document.getElementsByClassName("balance-ltc");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = PieWallet.balance.ltc.toString().substr(0,8) + " LTC";
        }
        list = document.getElementsByClassName("balance-eth");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = PieWallet.balance.eth.toString().substr(0,8) + " ETH";
        }
        
        list = document.getElementsByClassName("balance-btc-usd");
        for (var i = 0; i < list.length; i++) {
            PieWallet.balanceUSD.btc = PieWallet.balance.btc * PieWallet.marketValue.btc;
            list[i].innerHTML = "$" + (PieWallet.balanceUSD.btc).toString().substr(0,7);
        }
        list = document.getElementsByClassName("balance-ltc-usd");
        for (var i = 0; i < list.length; i++) {
            PieWallet.balanceUSD.ltc = PieWallet.balance.ltc * PieWallet.marketValue.ltc;
            list[i].innerHTML = "$" + (PieWallet.balanceUSD.ltc).toString().substr(0,7);
        }
        list = document.getElementsByClassName("balance-eth-usd");
        for (var i = 0; i < list.length; i++) {
            PieWallet.balanceUSD.eth = PieWallet.balance.eth * PieWallet.marketValue.eth;
            list[i].innerHTML = "$" + (PieWallet.balanceUSD.eth).toString().substr(0,7);
        }

        list = document.getElementsByClassName("balance-total-usd");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = ("$" 
                + (PieWallet.balance.btc * PieWallet.marketValue.btc
                + PieWallet.balance.ltc * PieWallet.marketValue.ltc
                + PieWallet.balance.eth * PieWallet.marketValue.eth)).toString().substr(0,8);
        }

        list = document.getElementsByClassName("change-btc");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = ((PieWallet.marketChange.btc > 0 ? "+" : "") + PieWallet.marketChange.btc.toString()).substr(0,5) + "%";
        }
        list = document.getElementsByClassName("change-ltc");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = ((PieWallet.marketChange.ltc > 0 ? "+" : "") + PieWallet.marketChange.ltc.toString()).substr(0,5) + "%";
        }
        list = document.getElementsByClassName("change-eth");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = ((PieWallet.marketChange.eth > 0 ? "+" : "") + PieWallet.marketChange.eth.toString()).substr(0,5) + "%";
        }

        updateTransactionHTML();
    }
}

var updateTransactionHTML = function() {
    // add all transactions into single array
    var allTransactions = [];
    PieWallet.transactions.btc.forEach(function(tx) {tx.coin = "btc"; allTransactions.push(tx);});
    PieWallet.transactions.ltc.forEach(function(tx) {tx.coin = "ltc"; allTransactions.push(tx);});
    PieWallet.transactions.eth.forEach(function(tx) {tx.coin = "eth"; allTransactions.push(tx);});
    // sort transactions array by date

    // create html list of transactions
    
    console.dir(allTransactions);
    var transactionsHTML = "";
    for(var i = 0; i < allTransactions.length; i++) {
        var tx = allTransactions[i];
        var myAddress = PieWallet.publicAddresses[tx.coin];
        var coin = tx.coin.toUpperCase();
        var conversion = coin === "ETH" ? 1000000000000000000 : 100000000;
        var inHTML = "";
        for(var j = 0; j < tx.inputs.length; j++) {
            if(tx.inputs[j].addresses !== undefined) {
                var address = tx.inputs[j].addresses == null ? 
                    "none" : tx.inputs[j].addresses[0];
                if(address === myAddress) address = 
                    "<span class='me-" + coin + "'>(me) " 
                    + address + "</span>";
                inHTML += "<p>" + tx.inputs[j].output_value / conversion + 
                    " from " + address + "</p>";
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
                outHTML += "<p>" + tx.outputs[j].value / conversion + 
                    " to " + address + "</p>";
            }
        }
        transactionsHTML += 
        "<div>" +
            "<h5 class='coin'>" + coin + " - " + tx.received + "</h5>" +
            "<div class='in'>" + inHTML + "</div>" +
            "<div class='out'>" + outHTML + "</div>" +
        "</div>";
    }

    // add transaction history to document
    list = document.getElementsByClassName("transaction-history-list");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = transactionsHTML;
    }
}

var refreshMoney = function() {
    refreshMarketValue();
    refreshBalance();
}

refreshMoney();  // called early while page loads

window.onload = function() {
    updateTickerHTML();  // only update page with values after loaded
}
</script>