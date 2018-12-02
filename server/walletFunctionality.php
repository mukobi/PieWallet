<script>
// object to hold all info regarding wallet/cryptocurrency integration
var PieWallet = {
    marketValue: {
        btc: 0,
        eth: 0,
        ltc: 0
    },
    marketChange: {
        btc: 0,
        eth: 0,
        ltc: 0
    },
    balance: {
        btc: 0,
        eth: 0,
        ltc: 0
    },
    publicAddresses: {
        btc: "<?php echo $myUserObject["btc_address"]; ?>",
        eth: "<?php echo $myUserObject["ltc_address"]; ?>",
        ltc: "<?php echo $myUserObject["eth_address"]; ?>"
    },
    privateKey: {
        key: ""
    }
};

var refreshMarketValue = function() {
    var xhttp1 = new XMLHttpRequest();
    xhttp1.onreadystatechange = function() { 
        console.dir(xhttp1);
        if (xhttp1.readyState == 4 && xhttp1.status == 200 && xhttp1.responseText.charAt(0) == "{") {
            try {
                console.log(xhttp1.responseText);
                var response = JSON.parse(xhttp1.responseText);
                console.log(response);
                PieWallet.marketValue.btc = parseFloat(response.ticker.price);
                PieWallet.marketChange.btc = parseFloat(response.ticker.change) / PieWallet.marketValue.btc * 100;
            }
            catch(err) {console.log(err);}
        }
    }
    xhttp1.open("GET", "https://api.cryptonator.com/api/ticker/btc-usd", true);
    xhttp1.send();
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() { 
        if (xhttp2.readyState == 4 && xhttp2.status == 200 && xhttp1.responseText.charAt(0) == "{") {
            try {
                var response = JSON.parse(xhttp2.responseText);
                PieWallet.marketValue.eth = parseFloat(response.ticker.price);
                PieWallet.marketChange.eth = parseFloat(response.ticker.change) / PieWallet.marketValue.eth * 100;
            }
            catch(err) {console.log(err);}
        }
    }
    xhttp2.open("GET", "https://api.cryptonator.com/api/ticker/eth-usd", true);
    xhttp2.send();
    var xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function() { 
        if (xhttp3.readyState == 4 && xhttp3.status == 200 && xhttp1.responseText.charAt(0) == "{") {
            try {
                var response = JSON.parse(xhttp3.responseText);
                PieWallet.marketValue.ltc = parseFloat(response.ticker.price);
                PieWallet.marketChange.ltc = parseFloat(response.ticker.change) / PieWallet.marketValue.ltc * 100;
            }
            catch(err) {console.log(err);}
        }
    }
    xhttp3.open("GET", "https://api.cryptonator.com/api/ticker/ltc-usd", true);
    xhttp3.send();
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
                    PieWallet.balance.btc = parseFloat(response.balance) / 100000000;
                }
                catch(err) {console.log(err);}
            }
        }
        xhttp1.open("GET", "https://api.blockcypher.com/v1/btc/main/addrs/" + PieWallet.publicAddresses.btc + "/balance", true);
        xhttp1.send();
        var xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function() { 
            if (xhttp2.readyState == 4 && xhttp2.status == 200) {
                try {
                    var response = JSON.parse(xhttp2.responseText);
                    PieWallet.balance.ltc = parseFloat(response.balance) / 100000000;
                }
                catch(err) {console.log(err);}
            }
        }
        xhttp2.open("GET", "https://api.blockcypher.com/v1/ltc/main/addrs/" + PieWallet.publicAddresses.ltc + "/balance", true);
        xhttp2.send();
        var xhttp3 = new XMLHttpRequest();
        xhttp3.onreadystatechange = function() { 
            if (xhttp3.readyState == 4 && xhttp3.status == 200) {
                try {
                    var response = JSON.parse(xhttp3.responseText);
                    PieWallet.balance.eth = parseFloat(response.balance) / 100000000;
                }
                catch(err) {console.log(err);}
            }
        }
        xhttp3.open("GET", "https://api.blockcypher.com/v1/eth/main/addrs/" + PieWallet.publicAddresses.eth + "/balance", true);
        xhttp3.send();
    }
}

var updateTickerHTML = function() {
    var list = document.getElementsByClassName("market-btc");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = "$" + PieWallet.marketValue.btc;
    }
    list = document.getElementsByClassName("market-ltc");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = "$" + PieWallet.marketValue.ltc;
    }
    list = document.getElementsByClassName("market-eth");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = "$" + PieWallet.marketValue.eth;
    }

    list = document.getElementsByClassName("balance-btc");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = PieWallet.balance.btc + " BTC";
    }
    list = document.getElementsByClassName("balance-ltc");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = PieWallet.balance.ltc + " LTC";
    }
    list = document.getElementsByClassName("balance-eth");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = PieWallet.balance.eth + " ETH";
    }
    
    list = document.getElementsByClassName("balance-btc-usd");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = "$" + PieWallet.balance.btc * PieWallet.marketValue.btc;
    }
    list = document.getElementsByClassName("balance-ltc-usd");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = "$" + PieWallet.balance.ltc * PieWallet.marketValue.ltc;
    }
    list = document.getElementsByClassName("balance-eth-usd");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = "$" + PieWallet.balance.eth * PieWallet.marketValue.eth;
    }

    list = document.getElementsByClassName("change-btc");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = (PieWallet.marketChange.btc > 0 ? "+" : "") + PieWallet.marketChange.btc + "%";
    }
    list = document.getElementsByClassName("change-ltc");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = (PieWallet.marketChange.ltc > 0 ? "+" : "") + PieWallet.marketChange.ltc + "%";
    }
    list = document.getElementsByClassName("change-eth");
    for (var i = 0; i < list.length; i++) {
        list[i].innerHTML = (PieWallet.marketChange.eth > 0 ? "+" : "") + PieWallet.marketChange.eth + "%";
    }
}

var refreshMoney = function() {
    refreshMarketValue();
    refreshBalance();
    updateTickerHTML();
}

window.onload = function() {
    refreshMoney();
}
</script>