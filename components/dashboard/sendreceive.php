<div id="sendreceive" class="dashbox">
    <link rel="stylesheet" href="../../css/sendreceive.css" />
    <form action="#" id="sendreceiveform">
        <div class="walletsellect">
            <h4>Select Wallet</h4>
            <select>
                <option value="btc">BTC</option>
                <option value="eth">ETH</option>
                <option value="ltc">LTC</option>
            </select>
            <div>
                <h4>Balance: </h4><p id="address">3534.4524 ($23454.34)</p>
            </div>
        </div>
        <div class="button-bar">
                <button id="send-button" class="button active" onclick="changeTab('send')">Send</button>
                <button id="receive-button" class="button" onclick="changeTab('receive')">Receive</button>
            </div>
        <div class="bottomform">
            <div id="send" class="tab">
                <div class="input-row">
                    <h4>Ammount: </h4><input type="text" name="ammount"/>
                </div>  
                <div class="input-row">
                    <h4>To: </h4><input type="text" name="to"/>
                </div>
                <div>
                    <h4>Fee: </h4>
                </div> 
                <div class="input-row">
                    <input type="submit" value="Send" />
                </div> 
            </div>
            <div id="receive" class="tab" style="display:none">
                <div class="input-row address">
                    <p id="address">   
                        Your Public Key: JHD87nd43oqw8SHD2l8edfh82gwerf3
                    </p>
                </div>
                <div class="input-row">
                    <a href="#">
                        <img src="images/qrcode.png" alt="QR Code" />
                    </a>
                </div> 
            </div>
            <script>
            function changeTab(tabName) {
                // change tab
                var i;
                var x = document.getElementsByClassName("tab");
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
            }
            </script>
        </div>
    </form>
</div>