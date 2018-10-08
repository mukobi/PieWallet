<div id="exchange-widget">
    <link rel="stylesheet" href="../../css/widgets/exchangewidget.css" />
    <div class="button-bar">
        <div id="changelly-button" class="tab-change-button active" onclick="changeTab('changelly')">
            <img src="images/icons/changelly.png" />
            <p>Changelly</p>
        </div>
        <div id="shapeshift-button" class="tab-change-button" onclick="changeTab('shapeshift')">
            <img src="images/icons/shapeshift.png" />
            <p>Shapeshift</p>
        </div>
    </div>
    <div class="content-area">
        <?php include("components/exchange/shapeshift.php"); ?>
        <?php include("components/exchange/changelly.php"); ?>
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
            var x = document.getElementsByClassName("tab-change-button");
            for (i = 0; i < x.length; i++) {
                x[i].classList.remove("active");
            }
            document.getElementById(tabName + "-button").classList.add("active");
        }
        </script>
    </div>
</div>