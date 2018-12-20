var myWordsArr = [];
var myWordsArrStr = "";
var myPrivateKey = "";
var myAddressBTC = "";
var myAddressLTC = "";
var myAddressETH = "";
// long public key info used only for address creation
var __publicKey = ""; 
var __publicKeyHash = "";

var checkValidImports = function() {
    var err;
    if(typeof bip39 == "undefined") {
        err = "Can't find bip39 word list. Make sure you are on the right page";
        alert(err);
        throw(err);
    }
    if(typeof window.crypto == "undefined") {
        err = "Can't find window.crypto lib. Try a different browser";
        alert(err);
        throw(err);
    }
    if(typeof sha256 == "undefined") {
        err = "Can't find sha256 lib. Make sure you are on the right page";
        alert(err);
        throw(err);
    }
    if(typeof BigInt != "function") {
        err = "Can't find BigInt function. Try a different browser";
        alert(err);
        throw(err);
    }
    if(typeof window.ec == "undefined") {
      err = "Can't find elliptic lib. Make sure you are on the right page";
      alert(err);
      throw(err);
    }
    if(typeof window.RIPEMD160 == "undefined") {
      err = "Can't find RIPEMD160 lib. Make sure you are on the right page";
      alert(err);
      throw(err);
    }
    if(typeof window.keccak == "undefined") {
        err = "Can't find keccak lib. Make sure you are on the right page";
        alert(err);
        throw(err);
    }
}

var setActiveWindow = function(number) {
    var windows = document.getElementsByClassName("wallet-create-window");
    for(var i = 0; i < windows.length; ++i) {
        if(windows[i].classList.contains("active")) {
            windows[i].classList.remove("active");
        }
    }
    windows[number].classList.add("active");
}

var getWordsArrStr = function() {
    myWordsArrStr = "";
    for(var i = 0; i < myWordsArr.length; ++i) {
        myWordsArrStr += myWordsArr[i] + " ";
    }
    myWordsArrStr = myWordsArrStr.trim();
}

var generatePrivateKey = function() {
    getWordsArrStr();
    var maxValue = BigInt("0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFEBAAEDCE6AF48A03BBFD25E8CD0364140");  
    myPrivateKey = (BigInt("0x" + sha256(myWordsArrStr)) % maxValue).toString(16);
}

var showPrivateKey = function() {
    var privates = document.getElementsByClassName("wallet-create-private-key");
    for(var i = 0; i < privates.length; i++) {
        privates[i].innerHTML = myPrivateKey;
    }
}

var generateAndShowPrivateKey = function() {
    generatePrivateKey();
    showPrivateKey();
}

var createPublicKey = function() {
	var keys = ec.keyFromPrivate(myPrivateKey, 'hex');  
	__publicKey = keys.getPublic('hex');
}

var createPublicKeyHash = function() {
    var hash = sha256(buffer.Buffer.from(__publicKey, 'hex'));
	__publicKeyHash = new RIPEMD160().update(buffer.Buffer.from(hash, 'hex')).digest('hex');
}

var createBTCStyleAddress = function(prefix) {
	var prefixedHash = prefix + __publicKeyHash;
	var checksum = sha256(buffer.Buffer.from(
				   sha256(buffer.Buffer.from(prefixedHash, 'hex')), 'hex'))
				   .substring(0, 8);
	return window.Base58.encode(buffer.Buffer.from(prefixedHash + checksum, 'hex'));
}

var createAddressBTC = function() {
    myAddressBTC = createBTCStyleAddress("00");
}

var createAddressLTC = function() {
	myAddressLTC = createBTCStyleAddress("30");  // only difference from BTC is network prefix
}

var createAddressETH = function() {
    myAddressETH = "0x"
        + new window.keccak(256).update(buffer.Buffer.from(__publicKey, 'hex')).digest('hex')
        .substring(24);
}
	
var generateAddresses = function() {
    createPublicKey();
    createPublicKeyHash();
	createAddressBTC();
	createAddressETH();
	createAddressLTC();
}

var showAddresses = function() {
    var addresses = document.getElementsByClassName("wallet-create-addresses");
    for(var i = 0; i < addresses.length; i++) {
        addresses[i].innerHTML = 
        "<span>BTC: " + myAddressBTC + "</span>" + 
        "<span>ETH: " + myAddressETH + "</span>" + 
        "<span>LTC: " + myAddressLTC + "</span>";
    }
}

var generateAndShowAddresses = function() {
    generateAddresses();
    showAddresses();
}

var showWords = function() {
    document.getElementsByClassName("my-words-label")[0].classList.remove("hidden");
    var wordsHtml = "";
    for(var i = 0; i < myWordsArr.length; i++) {
        wordsHtml += "<span>" + myWordsArr[i] + "</span>" + (i % 3 == 2 ? "<br>" : " ");
    }
    var words = document.getElementsByClassName("wallet-create-seed-words");
    for(var i = 0; i < words.length; i++) {
        words[i].innerHTML = wordsHtml.trim();
    }
}

var checkValidWords = function() {
    var val = document.getElementById("words").value.trim().toLowerCase();
    if(val === "") {
        alert("Please enter your 12 word seed");
        return false;
    }
    if(val.search("[^a-zA-Z ]") !== -1) {
        alert("Only enter letters and spaces");
        return false;
    }
    for(var i = 0; i < val.split(" ").length; i++) {
        if(!bip39.includes(val.split(" ")[i])) {
            alert(val.split(" ")[i] + " is not a recognised seed word.");
            return false;
        }
    }
    if(val.indexOf("  ") !== -1) {
        alert("Please remove double spaces");
        return false;
    }
    if(val.split(" ").length != 12) {
        alert("You must enter 12 words (found " + val.split(" ").length + ")");
        return false;
    }
    myWordsArr = val.split(" ");
    myWordsArrStr = val;
    return true;
}


// 1 check imports
checkValidImports();

// 2 create wallet from seed or private key
var unlockWalletFromWords = function() {
    if (checkValidWords()) {
        generateWallet();
        showWords();
        setActiveWindow(1);
    }
}
var unlockWalletFromKey = function() {
    if (checkValidKey()) {

    }
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
