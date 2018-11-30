<script>
// object to hold all info regarding wallet/cryptocurrency integration
var PieWallet = {
    marketValue: {
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
        if (xhttp1.readyState == 4 && xhttp1.status == 200) {
            var response = JSON.parse(xhttp1.responseText);
            PieWallet.marketValue.btc = parseFloat(response.ticker.price);
        }
    }
    xhttp1.open("GET", "https://api.cryptonator.com/api/ticker/btc-usd", true);
    xhttp1.send();
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() { 
        if (xhttp2.readyState == 4 && xhttp2.status == 200) {
            var response = JSON.parse(xhttp2.responseText);
            PieWallet.marketValue.eth = parseFloat(response.ticker.price);
        }
    }
    xhttp2.open("GET", "https://api.cryptonator.com/api/ticker/eth-usd", true);
    xhttp2.send();
    var xhttp3 = new XMLHttpRequest();
    xhttp3.onreadystatechange = function() { 
        if (xhttp3.readyState == 4 && xhttp3.status == 200) {
            var response = JSON.parse(xhttp3.responseText);
            PieWallet.marketValue.ltc = parseFloat(response.ticker.price);
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
                var response = JSON.parse(xhttp1.responseText);
                PieWallet.balance.btc = parseFloat(response.balance) / 100000000;
            }
        }
        xhttp1.open("GET", "https://api.blockcypher.com/v1/btc/main/addrs/" + PieWallet.publicAddresses.btc + "/balance", true);
        xhttp1.send();
        var xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function() { 
            if (xhttp2.readyState == 4 && xhttp2.status == 200) {
                var response = JSON.parse(xhttp2.responseText);
                PieWallet.balance.ltc = parseFloat(response.balance) / 100000000;
            }
        }
        xhttp2.open("GET", "https://api.blockcypher.com/v1/ltc/main/addrs/" + PieWallet.publicAddresses.ltc + "/balance", true);
        xhttp2.send();
        var xhttp3 = new XMLHttpRequest();
        xhttp3.onreadystatechange = function() { 
            if (xhttp3.readyState == 4 && xhttp3.status == 200) {
                var response = JSON.parse(xhttp3.responseText);
                PieWallet.balance.eth = parseFloat(response.balance) / 100000000;
            }
        }
        xhttp3.open("GET", "https://api.blockcypher.com/v1/eth/main/addrs/" + PieWallet.publicAddresses.eth + "/balance", true);
        xhttp3.send();
    }
}

refreshMarketValue();
refreshBalance();
</script>