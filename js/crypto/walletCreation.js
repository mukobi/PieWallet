var getRandomWords = function() {
    if(typeof bip39 == "undefined") {
        err = "can't find bip39 word list"
        alert(err);
        throw(err);
    }
    if(typeof window.crypto == "undefined") {
        err = "can't find window.crypto lib"
        alert(err);
        throw(err);
    }
    var array = new Uint32Array(12);
    window.crypto.getRandomValues(array);

    output = []
    for (var i = 0; i < array.length; i++) {
        output.push(bip39[array[i] % bip39.length]);
    }
    return output;
}

var showRandomWords = function(wordArr) {
    var wordsHtml = "";
    for(var i = 0; i < wordArr.length; i++) {
        wordsHtml += "<span>" + wordArr[i] + "</span> ";
    }
    document.getElementById("wallet-create-seed-words").innerHTML = wordsHtml.trim(); 
}

var generateAndShowRandomWords = function() {
    wordsArr = getRandomWords();
    showRandomWords(wordsArr);
    return wordsArr;
}

myWordsArr = generateAndShowRandomWords();

window.onload = function() {
    showRandomWords(myWordsArr);
}