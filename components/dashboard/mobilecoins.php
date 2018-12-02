<div id="mobile-coins-container">
    <div id="widget-bitcoin" class="coin-widget" onClick="popupWallet('btc')">
        <div class="icon">
            <img src="images/coins/btc-small.png" />
        </div>
        <div class="market">
            <p>BTC</p>
            <p class="market-btc"></p>
        </div>
        <div class="balance">
            <p class="balance-btc-usd"></p>
            <p class="balance-btc"></p>
        </div>
        <div class="growth">
            <p>+10%</p>
        </div>
    </div>
    <div id="widget-litecoin" class="coin-widget" onClick="popupWallet('ltc')">
        <div class="icon">
            <img src="images/coins/ltc-small.png" />
        </div>
        <div class="market">
            <p>LTC</p>
            <p class="market-ltc"></p>
        </div>
        <div class="balance">
            <p class="balance-ltc-usd"></p>
            <p class="balance-ltc"></p>
        </div>
        <div class="growth">
            <p>+10%</p>
        </div>
    </div>
    <div id="widget-ethereum" class="coin-widget" onClick="popupWallet('eth')">
        <div class="icon">
            <img src="images/coins/eth-small.png" />
        </div>
        <div class="market">
            <p>ETH</p>
            <p class="market-eth"></p>
        </div>
        <div class="balance">
            <p class="balance-eth-usd"></p>
            <p class="balance-eth"></p>
        </div>
        <div class="growth">
            <p>+10%</p>
        </div>
    </div>
    <script>
        function popupWallet(coin) {
            changePopupWindowContents("");
            loadPage(`components/dashboard/wallets.php?coin=${coin}`, changePopupWindowContents);
            showPopupWindow();
        }
    </script>
</div>