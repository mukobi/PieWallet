<div id="create-wallet-widget">
    <div id="wallet-create-window-0" class="wallet-create-window active">
        <h3>Let's Create Your PieWallet!</h3>
        <p>These are your seed of 12 random words from which we generate your wallet. This way, you can write down easy to remember information that can be used to unlock your wallet it the future.</p>
        <div class="row">
            <a class="btn secondary" onClick="generateAndShowRandomWords()">Random Words</a>
            <p id="wallet-create-seed-words" class="superemphasis"></p>
            <a class="btn primary" onClick="generateWallet()">Generate Wallet</a>
        </div>
        <p>If you want new words, select "Random Words." When you are happy with your seed words, <b>be sure to write them down</b> then select "Generate Wallet."</p>
    </div>
    <div id="wallet-create-window-1" class="wallet-create-window">
        <h3>Your Private Key</h3>
        <p id="wallet-create-private-key"></p>
        <p>This is your private key. It is very important that you <b>DO NOT LOSE THIS KEY</b>, as otherwise you will not be able to use any of the funds in your wallet.
    </div>
    <div id="wallet-create-window-2" class="wallet-create-window">
    </div>
</div>
<script src="../../js/crypto/bip39.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js"></script>
<script src="../../js/crypto/walletCreation.js"></script>