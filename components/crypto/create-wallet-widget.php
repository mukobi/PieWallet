<div id="create-wallet-widget">
    <div class="wallet-create-window active">
        <h3>Let's Create Your PieWallet!</h3>
        <a class="btn secondary" onClick="openUnlockWallet()">Unlock Existing Wallet</a>
        <p>These are your seed of 12 random words from which we generate your wallet. This way, you can write down easy to remember information that can be used to unlock your wallet it the future.</p>
        <div class="row">
            <a class="btn secondary" onClick="generateAndShowRandomWords()">Random Words</a>
            <p class="wallet-create-seed-words superemphasis"></p>
            <a class="btn primary" onClick="generateWallet()">Generate Wallet</a>
        </div>
        <p>If you want new words, select "Random Words." When you are happy with your seed words, <b>be sure to write them down</b> then select "Generate Wallet."</p>
    </div>
    <div class="wallet-create-window">
        <h3>Your Private Key</h3>
        <a class="btn secondary" onClick="setActiveWindow(0)">Back to Words</a>
        <p class="wallet-create-private-key important-info"></p>
        <p>This is your private key. It is very important that you <b>DO NOT LOSE THIS KEY</b>, as otherwise you will not be able to use any of the funds in your wallet.</p>
        <p>You private key never gets sent to PayPeer's servers or stored on PayPeer's database, and we can't recover it for you. It is up to you to keep a secure, offline copy of it, so <b>write it down on paper</b> then click "Addresses" to see your public addresses.</p>
        <a class="btn primary" onClick="setActiveWindow(2)">Addresses</a>
    </div>
    <div class="wallet-create-window">
        <h3>Your Addresses</h3>
        <a class="btn secondary" onClick="setActiveWindow(1)">Back to Private Key</a>
        <p class="wallet-create-addresses important-info"></p>
        <p>These are your public addresses. Crypto sent to these is sent to you. You can then spend that crypto using your private key. Your addresses are public information that don't need protection. <b>PieWallet will store these addresses</b> for your convenience, but you should write them down anyway.</p>
        <a class="btn primary" onClick="setActiveWindow(3)">Summary</a>
    </div>
    <div class="wallet-create-window summary">
        <h3>Wrote it all down?</h3>
        <a class="btn secondary" onClick="setActiveWindow(2)">Back to Addresses</a>
        <p class="align-center">My Words:</p>
        <p class="wallet-create-seed-words superemphasis"></p>
        <p class="align-center">My Private Key:</p>
        <p class="wallet-create-private-key important-info"></p>
        <p class="align-center">My Public Addresses:</p>
        <p class="wallet-create-addresses important-info"></p>
        <a class="btn primary" onClick="confirmWallet()">Got It!</a>
    </div>
</div>
<script src="../../js/crypto/bip39.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.js"></script>
<script src="https://cdn.rawgit.com/h2non/jsHashes/master/hashes.js"></script>
<script src="../../js/crypto/buffer.js"></script>
<script src="../../js/crypto/base58.js"></script>
<!-- various crypto modules, like ECDSA, ripemd160, keccak256: -->
<script src="../../js/crypto/requirements.js"></script>
 <!-- wallet creation main script: -->
<script src="../../js/crypto/walletFunctionReqs.js"></script>
<script src="../../js/crypto/walletCreation.js"></script>