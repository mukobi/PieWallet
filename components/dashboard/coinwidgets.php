<div id="coin-widget-container" class="main-carousel js-flickity" data-flickity-options='{"wrapAround": true, "watchCSS": true, "setGallerySize": false, "pageDots": false}'>
    <div id="widget-bitcoin" class="coin-widget carousel-cell">
        <div class="ticker-main dashbox">
            <div class="title"><span>BITCOIN</span><span>$7535.35</span></div>
            <p>+1.52%</p>
            <p>1.3122314 ($8635.64)</p>
            <img src="images/coins/bitcoin-trans.png" />
        </div>
        <div class="buttons">
            <a onClick="popupSendReceive(0,'send')"><img src="images/icons/send.png" />Send</a>
            <a onClick="popupSendReceive(0,'receive')"><img src="images/icons/receive.png" />Receive</a>
        </div>
    </div>
    <div id="widget-litecoin" class="coin-widget carousel-cell">
        <div class="ticker-main dashbox">
            <div class="title"><span>LITECOIN</span><span>$7535.35</span></div>
            <p>+1.52%</p>
            <p>1.3122314 ($8635.64)</p>
            <img src="images/coins/litecoin-trans.png" />
        </div>
        <div class="buttons">
            <a onClick="popupSendReceive(2,'send')"><img src="images/icons/send.png" />Send</a>
            <a onClick="popupSendReceive(2,'receive')"><img src="images/icons/receive.png" />Receive</a>
        </div>
    </div>
    <div id="widget-ethereum" class="coin-widget carousel-cell">
        <div class="ticker-main dashbox">
            <div class="title"><span>ETHEREUM</span><span>$7535.35</span></div>
            <p>+1.52%</p>
            <p>1.3122314 ($8635.64)</p>
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