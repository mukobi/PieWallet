var myWordsArr = [];
var myWordsArrStr = "";
var myPrivateKey = "";
var myPrivateKeyWIFBTC = "";
var myPrivateKeyWIFLTC = "";
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

var getRandomWords = function() {
    var array = new Uint32Array(12);
    window.crypto.getRandomValues(array);

    myWordsArr = []
    for (var i = 0; i < array.length; i++) {
        myWordsArr.push(bip39[array[i] % bip39.length]);
    }
}

var showRandomWords = function() {
    var wordsHtml = "";
    for(var i = 0; i < myWordsArr.length; i++) {
        wordsHtml += "<span>" + myWordsArr[i] + "</span>" + (i % 3 == 2 ? "<br>" : " ");
    }
    var words = document.getElementsByClassName("wallet-create-seed-words");
    for(var i = 0; i < words.length; i++) {
        words[i].innerHTML = wordsHtml.trim();
    }
}

var generateAndShowRandomWords = function() {
    getRandomWords();
    showRandomWords();
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

var showPrivateKeys = function() {
    var privates = document.getElementsByClassName("wallet-create-private-key");
    for(var i = 0; i < privates.length; i++) {
        privates[i].innerHTML = 
        "<span>Uncompressed/ETH: " + myPrivateKey + "</span>" +
        "<span>BTC WIF: " + myPrivateKeyWIFBTC + "</span>" + 
        "<span>LTC WIF: " + myPrivateKeyWIFLTC + "</span>";
    }
    setActiveWindow(1);
}

var createPublicKey = function() {
	var keys = ec.keyFromPrivate(myPrivateKey, 'hex');  
    __publicKey = keys.getPublic('hex');
    // compress public key
    var yIsEven = parseInt(__publicKey.substring(128), 16) % 2 == 0;
    __publicKey = (yIsEven ? "02" : "03") + __publicKey.substring(2, 66);
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

var createPrivateKeyWIF = function(prefixedHash) {
	var checksum = sha256(buffer.Buffer.from(
				   sha256(buffer.Buffer.from(prefixedHash, 'hex')), 'hex'))
				   .substring(0, 8);
	return window.Base58.encode(buffer.Buffer.from(prefixedHash + checksum, 'hex'));
}

var createAllPrivateKeysWIF = function() {
    var suffix = "01"; // indicates compressed public keys
	myPrivateKeyWIFBTC = createPrivateKeyWIF(STRINGS.networkPrefixes.private.btc + myPrivateKey + suffix);
	myPrivateKeyWIFLTC = createPrivateKeyWIF(STRINGS.networkPrefixes.private.ltc + myPrivateKey + suffix);
}

var createAddressBTC = function() {
    myAddressBTC = createBTCStyleAddress(STRINGS.networkPrefixes.address.btc);
}

var createAddressLTC = function() {
	myAddressLTC = createBTCStyleAddress(STRINGS.networkPrefixes.address.ltc);
}

var createAddressETH = function() {
    myAddressETH = "0x"
        + new window.keccak(256).update(buffer.Buffer.from(__publicKey, 'hex')).digest('hex')
        .substring(24);
}

var generateAndShowPrivateKeys = function() {
    generatePrivateKey();
    createAllPrivateKeysWIF();
    showPrivateKeys();
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