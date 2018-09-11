<div id="exchange-widget" class="dashbox">
    <link rel="stylesheet" href="../../css/widgets/exchangewidget.css" />
        <div class="button-bar">
                <button id="shapeshift-button" class="button active" onclick="changeTab('shapeshift')">Shapeshift</button>
                <button id="changelly-button" class="button" onclick="changeTab('changelly')">Changelly</button>
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