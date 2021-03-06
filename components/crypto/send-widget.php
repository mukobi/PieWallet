<div class="send-widget">
    <?php include_once('components/account/getSingleResult.php'); ?>
    <link rel="stylesheet" href="css/widgets/sendwidget.css">
    <div class="tab-container">
        <div class="tab send-form active">
            <h3>Send Bitcoin</h3>
            <p>To Address: <input type="text" id="send-form-to-address" placeholder="Address to send BTC"></p>
            <p><i>Hint: find the address of another user by <a href="search.php">searching for them on PieWallet.</a></i></p>
            <p>Your Address: <input type="text" id="send-form-from-address" placeholder="Your address"></p>
            <p>Your Private Key (WIF): <input type="text" id="send-form-from-private-key" placeholder="Your private key (WIF)"></p>
            <p><i>Hint: <a href="unlockWallet.php">unlock your PieWallet</a> to find your address and private key.</i></p>
            <p>Amount: <input type="text" id="send-form-amount" placeholder="Amount in BTC"></p>
            <a class="btn primary search-button" onClick="sendTx()">Send</a>
        </div>
        <div class="tab response">
            <h3>Transaction Results</h3>
            <div id="send-response-results-container">loading...</div>
            <a class="btn primary search-button" onClick="changeSendTabs()">New Transaction</a>
        </div>
    </div>
    <script src="../../js/values/values.js"></script>	
    <script src="../../js/crypto/txRequirementsBroswerified.js"></script>
    <script src="../../js/crypto/txSender.js"></script>	
</div>