<?php

include_once('../../server/components/loginToDb.php');
include_once('../../server/components/handleTgLogin.php');
include_once("../../server/queryDbSocial.php");

if(isset($_GET['coin'])) { 
	if($_GET['coin'] == 'btc'){
		$walletType       = 'bitcoin';
		$walletTitle      = 'Bitcoin Wallet';
		$coinAbbreviation = 'BTC';
		$popupCode        = '0';
	}
	else if($_GET['coin'] == 'ltc'){
		$walletType       = 'litecoin';
		$walletTitle      = 'Litecoin Wallet';
		$coinAbbreviation = 'LTC';
		$popupCode        = '1';
	}
	else if($_GET['coin'] == 'eth'){
		$walletType       = 'ethereum';
		$walletTitle      = 'Ethereum Wallet';
		$coinAbbreviation = 'ETH';
		$popupCode        = '2';
	}
	else {	
		echo "Sorry, something went wrong.";
	}
}
else {
	echo "Sorry, something went wrong.";
}
?>

<div id    = "wallet-container" class = "wallet-view">
<div class = "coin-widget widget-<?php echo $walletType;?>">
		<h2><?php echo $walletTitle;?></h2>
		<div class = "ticker-main dashbox">
		<p   class = "title balance-<?php echo strtolower($coinAbbreviation);?>"></p>
		<p   class = "balance-<?php echo strtolower($coinAbbreviation);?>-usd"></p>
		<img src   = "images/coins/<?php echo $walletType;?>-trans.png" />
		</div>
		<div class   = "buttons">
		<a   onClick = "popupSendReceive(<?php echo $popupCode;?>,'send')"><img src    = "images/icons/send.png" />Send</a>
		<a   onClick = "popupSendReceive(<?php echo $popupCode;?>,'receive')"><img src = "images/icons/receive.png" />Receive</a>
		</div>
	</div>
    <script defer>
		function updateTickers() {
			console.log("tick " + coin);
			document.getElementById("wallet-coin-counter").innerHTML = "lalala";
			document.getElementById("wallet-coin-counter").classList.remove("balance-btc", "balance-ltc", "balance-eth");
			document.getElementById("wallet-coin-counter").classList.add("balance-" + coin);
			document.getElementById("wallet-coin-usd-counter").classList.remove("balance-btc-usd", "balance-ltc-usd", "balance-eth-usd");
			document.getElementById("wallet-coin-usd-counter").classList.add("balance-" + coin + "-usd");
			updateTickerHTML();
		}
        function popupSendReceive(coin, action) {
            document.getElementById("send-receive-coin-select").selectedIndex = coin;
            changeSendReceiveTab(action);
            document.getElementById("sendreceive").classList.remove("transparent");
			document.getElementById("sendreceive").classList.add("active");
		}
		if(window.addEventListener){  // show words again when doc loaded
			window.addEventListener('load', updateTickers)
		} else{
			window.attachEvent('onload', updateTickers)
		}
    </script>
</div>