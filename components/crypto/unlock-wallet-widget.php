<div id="create-wallet-widget">
    <div class="wallet-create-window active">
        <h3>Unlock an Existing Wallet</h3>
        <a class="btn secondary" onClick="openGenerateWallet()">Create New Wallet</a>
        <a class="btn secondary" href="index.php">Back to Dashboard</a>
        <p>Enter either your 12 word seed phrase (separated by spaces) or your private key to unlock your wallet and see the rest of it's information.</p>
        <label for="words">12 Word Seed: </label>
        <input type="text" id="words" name="words"
            placeholder="enter your words here">
        <a class="btn primary" onClick="unlockWalletFromWords()">Unlock from 12 Word Seed</a>
        <label for="key">Private Key: </label>
        <input type="text" id="key" name="key"
            placeholder="enter your private key here">
        <a class="btn primary" onClick="unlockWalletFromKey()">Unlock from Private Key</a>
    </div>
    <div class="wallet-create-window summary">
        <h3>Wallet Unlocked</h3>
        <a class="btn secondary" onClick="setActiveWindow(0)">Back</a>
        <p class="align-center hidden my-words-label">My Words:</p>
        <p class="wallet-create-seed-words superemphasis my-words-label"></p>
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
<script src="../../js/crypto/walletUnlock.js"></script>