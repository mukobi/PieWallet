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
                    <input type="text" name="ammount" placeholder="Enter Amount"/>
                </div>  
                <div class="input-row">
                    <input type="text" name="to" placeholder="Enter Address"/>
                </div>
                <div>
                    <h5>Fee: </h5>
                </div> 
                <div class="input-row">
                    <input type="submit" value="Send" />
                </div> 
            </div>
            <div id="receive" class="tab-sendreceive" style="display:none">
                <div class="input-row">
                    <a href="#">
                        <img src="images/icons/qrcodedefault.png" alt="QR Code" />
                    </a>
                </div> 
                <p class="input-row address">
                    Je5Keh74bWsMd83rw3Lkx
                </p>
            </div>
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
                var i;
                var x = document.getElementsByClassName("button");
                for (i = 0; i < x.length; i++) {
                    x[i].classList.remove("active");
                }
                document.getElementById(tabName + "-button").classList.add("active");
                
                var coinMap = {0:"BTC", 1:"LTC", 2:"ETH"};
                var coin = coinMap[document.getElementById("send-receive-coin-select").selectedIndex];
                console.log("Coin: " + coin);
                
                tabName = tabName.charAt(0).toUpperCase() + tabName.slice(1);

                document.getElementById("send-receive-window-title").innerHTML = tabName + " " + coin;

                document.getElementById("send-receive-window-coin-img").src = "images/coins/" + coin.toLowerCase() + "-small.png";
                
                document.getElementById("send-receive-window-image-container").classList.remove("btc", "ltc", "eth");
                document.getElementById("send-receive-window-image-container").classList.add(coin);
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