<div class="send-widget">
    <?php include_once('components/account/getSingleResult.php'); ?>
    <link rel="stylesheet" href="css/widgets/sendwidget.css">
    <div class="tab-container">
        <div class="tab form active">
            <h3>Send Bitcoin</h3>
            <p>To: <input type="text" id="send-form-to-address" placeholder="Address to send BTC"></p>
            <p><i>Hint: find the address of another user by <a href="search.php">searching for them on PieWallet</a></i></p>
            <p>From: <input type="text" id="send-form-from-private-key" placeholder="Your private Bitcoin key"></p>
            <p>Amount: <input type="text" id="send-form-amount" placeholder="Amount in BTC"></p>
            <a class="btn primary search-button">Send</a>
        </div>
        <div class="tab results">
            <h3>Transaction Results</h3>
            <p class="status">loading...</p>
            <p></p>
            <p></p>
        </div>
    </div>
    <script src="../../js/crypto/requirements.js"></script>
    <script src="../../js/crypto/send.js"></script>
</div>