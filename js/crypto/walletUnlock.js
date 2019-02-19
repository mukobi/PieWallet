var checkValidImports = function() {
  var err;
  if (typeof bip39 == "undefined") {
    err = "Can't find bip39 word list. Make sure you are on the right page";
    alert(err);
    throw err;
  }
  if (typeof window.crypto == "undefined") {
    err = "Can't find window.crypto lib. Try a different browser";
    alert(err);
    throw err;
  }
  if (typeof sha256 == "undefined") {
    err = "Can't find sha256 lib. Make sure you are on the right page";
    alert(err);
    throw err;
  }
  if (typeof BigInt != "function") {
    err = "Can't find BigInt function. Try a different browser";
    alert(err);
    throw err;
  }
  if (typeof window.ec == "undefined") {
    err = "Can't find elliptic lib. Make sure you are on the right page";
    alert(err);
    throw err;
  }
  if (typeof window.RIPEMD160 == "undefined") {
    err = "Can't find RIPEMD160 lib. Make sure you are on the right page";
    alert(err);
    throw err;
  }
  if (typeof window.keccak == "undefined") {
    err = "Can't find keccak lib. Make sure you are on the right page";
    alert(err);
    throw err;
  }
};

var showWords = function() {
  var words = document.getElementsByClassName("my-words-label");
  for (var i = 0; i < words.length; i++) {
    words[i].classList.remove("hidden");
  }
  var wordsHtml = "";
  for (var i = 0; i < myWordsArr.length; i++) {
    wordsHtml +=
      "<span>" + myWordsArr[i] + "</span>" + (i % 3 == 2 ? "<br>" : " ");
  }
  var words = document.getElementsByClassName("wallet-create-seed-words");
  for (var i = 0; i < words.length; i++) {
    words[i].innerHTML = wordsHtml.trim();
  }
};

var hideWords = function() {
  var words = document.getElementsByClassName("my-words-label");
  for (var i = 0; i < words.length; i++) {
    words[i].classList.add("hidden");
  }
};

var checkValidWords = function() {
  var val = document
    .getElementById("words")
    .value.trim()
    .toLowerCase();
  if (val === "") {
    alert("Please enter your 12 word seed");
    return false;
  }
  if (val.search("[^a-zA-Z ]") !== -1) {
    alert("Only enter letters and spaces");
    return false;
  }
  for (var i = 0; i < val.split(" ").length; i++) {
    if (!bip39.includes(val.split(" ")[i])) {
      alert(val.split(" ")[i] + " is not a recognised seed word.");
      return false;
    }
  }
  if (val.indexOf("  ") !== -1) {
    alert("Please remove double spaces");
    return false;
  }
  if (val.split(" ").length != 12) {
    alert("You must enter 12 words (found " + val.split(" ").length + ")");
    return false;
  }
  myWordsArr = val.split(" ");
  myWordsArrStr = val;
  return true;
};

var checkValidKey = function() {
  var val = document
    .getElementById("key")
    .value.trim()
    .toLowerCase();
  if (val === "") {
    alert("Please enter your private key");
    return false;
  }
  if (val.search("[^a-f0-9]") !== -1) {
    alert("Your key should only be numbers and letters (a-f)");
    return false;
  }
  if (val.length !== 64) {
    alert("Your key should be 64 characters long (found " + val.length + ")");
    return false;
  }
  myPrivateKey = val;
  return true;
};

var openGenerateWallet = function() {
  window.location.href = "/createWallet.php";
};

// 1 check imports
checkValidImports();

// 2 create wallet from seed or private key
var unlockWalletFromWords = function() {
  if (checkValidWords()) {
    generateWallet();
    showWords();
    setActiveWindow(1);
  }
};
var unlockWalletFromKey = function() {
  if (checkValidKey()) {
    showPrivateKey();
    generateAndShowAddresses();
    hideWords();
    setActiveWindow(1);
  }
};

// 3 generate wallet
var generateWallet = function() {
  generateAndShowPrivateKey();
  generateAndShowAddresses();
};

// 4 confirm wallet and store info when done
var confirmWallet = function() {
  if (myAddressBTC !== "") {
    window.location.href =
      "/server/storeAddresses.php?btc=" +
      myAddressBTC +
      "&eth=" +
      myAddressETH +
      "&ltc=" +
      myAddressLTC;
  }
};
