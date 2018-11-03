<div id="mobile-coins-container">
    <div id="widget-bitcoin" class="coin-widget">
        <div class="icon">
            <img src="images/coins/btc-small.png" />
        </div>
        <div class="market">
            <p>BTC</p>
            <p>$8635.64</p>
        </div>
        <div class="balance">
            <p>$3534</p>
            <p>0.432 coins</p>
        </div>
        <div class="growth">
            <p>+10%</p>
        </div>
    </div>
    <div id="widget-litecoin" class="coin-widget">
        <div class="icon">
            <img src="images/coins/ltc-small.png" />
        </div>
        <div class="market">
            <p>LTC</p>
            <p>$8635.64</p>
        </div>
        <div class="balance">
            <p>$3534</p>
            <p>0.432 coins</p>
        </div>
        <div class="growth">
            <p>+10%</p>
        </div>
    </div>
    <div id="widget-ethereum" class="coin-widget">
        <div class="icon">
            <img src="images/coins/eth-small.png" />
        </div>
        <div class="market">
            <p>ETH</p>
            <p>$8635.64</p>
        </div>
        <div class="balance">
            <p>$3534</p>
            <p>0.432 coins</p>
        </div>
        <div class="growth">
            <p>+10%</p>
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