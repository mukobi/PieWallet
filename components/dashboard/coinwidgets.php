<div id="coin-widget-container">
    <div id="widget-bitcoin" class="coin-widget">
        <div class="ticker-main dashbox" onClick="popupWallet('btc')">
            <p class="title balance-btc"></p>
            <p class="balance-btc-usd">loading balance...</p>
            <img src="images/coins/bitcoin-trans.png" />
        </div>
        <div class="buttons">
            <a onClick="popupSendReceive(0,'send')"><img src="images/icons/send.png" />Send</a>
            <a onClick="popupSendReceive(0,'receive')"><img src="images/icons/receive.png" />Receive</a>
        </div>
    </div>
    <div id="widget-litecoin" class="coin-widget">
        <div class="ticker-main dashbox" onClick="popupWallet('ltc')">
            <p class="title balance-ltc"></p>
            <p class="balance-ltc-usd">loading balance...</p>
            <img src="images/coins/litecoin-trans.png" />
        </div>
        <div class="buttons">
            <a onClick="popupSendReceive(1,'send')"><img src="images/icons/send.png" />Send</a>
            <a onClick="popupSendReceive(1,'receive')"><img src="images/icons/receive.png" />Receive</a>
        </div>
    </div>
    <div id="widget-ethereum" class="coin-widget">
        <div class="ticker-main dashbox" onClick="popupWallet('eth')">
            <p class="title balance-eth"></p>
            <p class="balance-eth-usd">loading balance...</p>
            <img src="images/coins/ethereum-trans.png" />
        </div>
        <div class="buttons">
            <a onClick="popupSendReceive(2,'send')"><img src="images/icons/send.png" />Send</a>
            <a onClick="popupSendReceive(2,'receive')"><img src="images/icons/receive.png" />Receive</a>
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