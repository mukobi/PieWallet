<div id="sendreceive" class="dashbox">
    <link rel="stylesheet" href="../../css/sendreceive.css" />
    <div class="x-out" onClick="xOutOfSendReceive()"><img src="images/icons/x-out.png" alt="Close"></div>
    <form action="#" id="sendreceiveform">
        <div class="walletsellect">
            <h4>Select Wallet</h4>
            <select id="send-receive-coin-select">
                <option value="btc">BTC</option>
                <option value="eth">ETH</option>
                <option value="ltc">LTC</option>
            </select>
        </div>
        <div class="button-bar">
            <button id="send-button" class="button active" onclick="changeSendReceiveTab('send')">Send</button>
            <button id="receive-button" class="button" onclick="changeSendReceiveTab('receive')">Receive</button>
        </div>
        <h4 id="send-receive-window-title"></h4>
        <div id="send-receive-window-image-container" > 
            <img id="send-receive-window-coin-img" src="images/coins/btc-small.png" />
        </div>
        <div class="bottomform">
            <div id="send" class="tab-sendreceive">
                <div class="input-row">
                    <p id="wallet-send-instructions"></p>
                </div>
                <div class="input-row">
                    <input type="text" name="search" placeholder="Search Users" id="user-search-bar"/>
                </div>
                <div class="input-row">
                    <a class="btn primary" onClick="searchForUser()">Search</a>
                </div> 
            </div>
            <div id="receive" class="tab-sendreceive" style="display:none">
                <div class="input-row">
                    <p><a target="_blank" href="https://web.telegram.org">Share your public address</a> by text or QR code to let someone send you cryptocurrency.</p>
                </div> 
                <div class="input-row">
                    <a href="#">
                        <div id="send-receive-window-address-qrcode"></div>
                    </a>
                </div> 
                <p class="input-row address" id="send-receive-window-public-address"></p>
            </div>
            <script src="../../js/lib/qrcode.min.js"></script>
            <script>
            function changeSendReceiveTab(tabName) {
                // change tab
                var i;
                var x = document.getElementsByClassName("tab-sendreceive");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";  
                }
                document.getElementById(tabName).style.display = "block";
                // change highlighted button
                var x = document.getElementsByClassName("button");
                for (i = 0; i < x.length; i++) {
                    x[i].classList.remove("active");
                }
                document.getElementById(tabName + "-button").classList.add("active");
                
                var coinMap = {0:"BTC", 1:"LTC", 2:"ETH"};
                var coin = coinMap[document.getElementById("send-receive-coin-select").selectedIndex];
                // console.log("Coin: " + coin);
                
                tabName = tabName.charAt(0).toUpperCase() + tabName.slice(1);

                document.getElementById("send-receive-window-title").innerHTML = tabName + " " + coin;

                document.getElementById("send-receive-window-coin-img").src = "images/coins/" + coin.toLowerCase() + "-small.png";
                
                document.getElementById("send-receive-window-image-container").classList.remove("BTC", "LTC", "ETH");
                document.getElementById("send-receive-window-image-container").classList.add(coin);

                var sendMessages = {
                    "BTC": "<ol><li><a href='unlockWallet.php'>Unlock your private key</a></li><li>Import your private key into <a href='https://login.blockchain.com/en/#/settings/addresses/btc'>Blockchain.com</a> or your favorite BTC wallet</li><li>Search users below and send BTC to their address</li></p>", 
                    "LTC": "",
                    "ETH": ""
                };
                document.getElementById("wallet-send-instructions").innerHTML = sendMessages[coin];

                document.getElementById("send-receive-window-public-address").innerHTML = PieWallet.publicAddresses[coin.toLowerCase()];
                
                document.getElementById("send-receive-window-address-qrcode").innerHTML = "";
                var qrcode = new QRCode("send-receive-window-address-qrcode", {
                    text: PieWallet.publicAddresses[coin.toLowerCase()],
                    width: 128,
                    height: 128,
                    colorLight : "#ffffff",
                    colorDark : "#000000",
                    correctLevel : QRCode.CorrectLevel.H
                });
            }

            function searchForUser() {
                window.location.href = "search.php?query=" + document.getElementById("user-search-bar").value;
            }

            function xOutOfSendReceive() {
                document.getElementById("sendreceive").classList.add("transparent");
                setTimeout(function() {
                    document.getElementById("sendreceive").classList.remove("active");
                }, 500);
            }
            </script>
        </div>
    </form>
</div>