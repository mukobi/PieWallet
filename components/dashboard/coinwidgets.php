<div id="coin-widget-container" class="main-carousel js-flickity" data-flickity-options='{"wrapAround": true, "watchCSS": true, "setGallerySize": false, "pageDots": false}'>
    <div id="widget-bitcoin" class="coin-widget carousel-cell">
        <div class="ticker-main dashbox">
            <p class="title">1.3122314 BTC</p>
            <p>$8635.64</p>
            <img src="images/coins/bitcoin-trans.png" />
        </div>
        <div class="buttons">
            <a onClick="popupSendReceive(0,'send')"><img src="images/icons/send.png" />Send</a>
            <a onClick="popupSendReceive(0,'receive')"><img src="images/icons/receive.png" />Receive</a>
        </div>
    </div>
    <div id="widget-litecoin" class="coin-widget carousel-cell">
        <div class="ticker-main dashbox">
            <p class="title">24.36478 LTC</p>
            <p>$1369.08</p>
            <img src="images/coins/litecoin-trans.png" />
        </div>
        <div class="buttons">
            <a onClick="popupSendReceive(2,'send')"><img src="images/icons/send.png" />Send</a>
            <a onClick="popupSendReceive(2,'receive')"><img src="images/icons/receive.png" />Receive</a>
        </div>
    </div>
    <div id="widget-ethereum" class="coin-widget carousel-cell">
        <div class="ticker-main dashbox">
            <p class="title">3.87674 ETH</p>
            <p>$41,345.98</p>
            <img src="images/coins/ethereum-trans.png" />
        </div>
        <div class="buttons">
            <a onClick="popupSendReceive(1,'send')"><img src="images/icons/send.png" />Send</a>
            <a onClick="popupSendReceive(1,'receive')"><img src="images/icons/receive.png" />Receive</a>
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