<?php

include_once('components/loginToDb.php');
include_once('components/handleTgLogin.php');

if(isset($_GET['coin'])) { 
	if($_GET['coin'] == 'btc'){
		$walletType = 'bitcoin';
		$walletTitle = 'Bitcoin Wallet';
		$coinAbbreviation = 'BTC';
		$popupCode = '0';
	}
	else if($_GET['coin'] == 'ltc'){
		$walletType = 'litecoin';
		$walletTitle = 'Litecoin Wallet';
		$coinAbbreviation = 'LTC';
		$popupCode = '1';
	}
	else if($_GET['coin'] == 'eth'){
		$walletType = 'ethereum';
		$walletTitle = 'Ethereum Wallet';
		$coinAbbreviation = 'ETH';
		$popupCode = '2';
	}
	else {	
		echo "Sorry, something went wrong.";
	}
}
else {
	echo "Sorry, something went wrong.";
}
?>

<div id="coin-widget-container" class="wallet-view">
    <div id="widget-<?php echo $walletType;?>" class="coin-widget">
        <div class="ticker-main dashbox">
            <p class="title">1.3122314 <?php echo $coinAbbreviation;?></p>
            <p>$8635.64</p>
            <img src="images/coins/<?php echo $walletType;?>-trans.png" />
        </div>
        <div class="buttons">
            <a onClick="popupSendReceive(<?php echo $popupCode;?>,'send')"><img src="images/icons/send.png" />Send</a>
            <a onClick="popupSendReceive(<?php echo $popupCode;?>,'receive')"><img src="images/icons/receive.png" />Receive</a>
        </div>
    </div>
    <script>
        function popupSendReceive(coin, action) {
            document.getElementById("send-receive-coin-select").selectedIndex = coin;
            changeSendReceiveTab(action);
            document.getElementById("sendreceive").classList.remove("transparent");
            document.getElementById("sendreceive").classList.add("active");
        }
    </script>
</div>