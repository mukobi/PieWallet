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
                    PieWallet.balance.btc = parseFloat(response.balance) / 100000000;
                    updateTickerHTML();
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
                    updateTickerHTML();
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
    console.dir(PieWallet.marketValue);
    if(PieWallet.marketValue.btc !== null && PieWallet.marketValue.ltc !== null && PieWallet.marketValue.eth !== null &&
       PieWallet.balance.btc !== null && PieWallet.balance.ltc !== null && PieWallet.balance.eth !== null) {
        var list = document.getElementsByClassName("market-btc");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = "$" + PieWallet.marketValue.btc.toString().substr(0,8);
        }
        list = document.getElementsByClassName("market-ltc");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = "$" + PieWallet.marketValue.ltc.toString().substr(0,8);
        }
        list = document.getElementsByClassName("market-eth");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = "$" + PieWallet.marketValue.eth.toString().substr(0,8);
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
    }
}

var refreshMoney = function() {
    refreshMarketValue();
    refreshBalance();
}

window.onload = function() {
    refreshMoney();
}
</script>