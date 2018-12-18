// global vars
myWordsArr = [];
myWordsArrStr = "";
myPrivateKey = "";
myAddressBTC = "";
myAddressLTC = "";
myAddressETH = "";

var checkValidImports = function() {
    if(typeof bip39 == "undefined") {
        err = "Can't find bip39 word list. Try a different browser"
        alert(err);
        throw(err);
    }
    if(typeof window.crypto == "undefined") {
        err = "Can't find window.crypto lib. Try a different browser"
        alert(err);
        throw(err);
    }
    if(typeof sha256 == "undefined") {
        err = "Can't find sha256 lib. Try a different browser"
        alert(err);
        throw(err);
    }
    if(typeof BigInt != "function") {
        err = "Can't find BigInt function. Try a different browser"
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
        wordsHtml += "<span>" + myWordsArr[i] + "</span> ";
    }
    document.getElementById("wallet-create-seed-words").innerHTML = wordsHtml.trim(); 
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

var showPrivateKey = function() {
    document.getElementById("wallet-create-private-key").innerHTML = myPrivateKey;
    setActiveWindow(1);
}

var generateAndShowPrivateKey = function() {
    generatePrivateKey();
    showPrivateKey();
}

var generateAddresses = function() {

}

var generateAndShowAddresses = function() {
    generateAddresses();
}


// 1 check imports
checkValidImports();

// 2 generate random words
generateAndShowRandomWords();
window.onload = function() {
    showRandomWords(myWordsArr);  // if wasn't able to correctly show earlier
}

// 3 generate wallet
var generateWallet = function() {
    generateAndShowPrivateKey();
    generateAndShowAddresses();
}

