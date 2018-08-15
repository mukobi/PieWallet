<div id="sendreceive" class="dashbox">
    <style>
        .walletsellect, .bottomform {
            width: 100%;
        }
        .walletsellect {
            border-bottom: 3px solid teal;
        }
    </style>
    <div class="walletsellect">
        Select Wallet
    </div>
    <div class="bottomform">
        <div class="button-bar">
            <button class="button" onclick="changeTab('send')">Send</button>
            <button class="button" onclick="changeTab('receive')">Receive</button>
        </div>
        <div id="send" class="w3-container tab">
            <h2>Send</h2>
            <input type="text" />
        </div>
        <div id="receive" class="w3-container tab" style="display:none">
            <h2>Receive</h2>
            <p>Paris is the capital of France.</p> 
        </div>
        <script>
        function changeTab(tabName) {
            var i;
            var x = document.getElementsByClassName("tab");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            document.getElementById(tabName).style.display = "block";
        }
        </script>
    </div>
</div>