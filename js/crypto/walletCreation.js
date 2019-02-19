var openUnlockWallet = function() {
    window.location.href = 
        "/unlockWallet.php";
}


// 1 check imports
checkValidImports();

// 2 generate random words
generateAndShowRandomWords();

if(window.addEventListener){  // show words again when doc loaded
    window.addEventListener('load', showRandomWords)
} else{
    window.attachEvent('onload', showRandomWords)
}

// 3 generate wallet
var generateWallet = function() {
    generateAndShowPrivateKey();
    generateAndShowAddresses();
}

// 4 confirm wallet and store info when done
var confirmWallet = function() {
    if(myAddressBTC !== "") {
        window.location.href = 
            "/server/storeAddresses.php?btc=" + myAddressBTC
            + "&eth=" + myAddressETH
            + "&ltc=" + myAddressLTC;
    }
}
