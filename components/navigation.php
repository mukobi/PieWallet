<div id="navigation-menu" class="genbox">
    <script defer src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/TweenMax-latest-beta.js"></script>
    <script defer src="js/gradient-color-change.js"></script>
    <div class="navicon headlogodiv">
        <a href="/">
            <img class="headlogo desktop" src="/images/header-logo2.png" />
        </a>
    </div>
    <div class="navicon empty"></div>
    <div class="navicon dashboard 
        <?php if(basename($_SERVER['PHP_SELF']) == "index.php") {
            echo "active";
        } ?>">
        <a href="/">
            <img class="imgleft" src="/images/navigation/dashboard.png" />
            <p>DASHBOARD</p>
            
        </a>
    </div>
    <div class="navicon exchange 
        <?php if(basename($_SERVER['PHP_SELF']) == "exchange.php") {
            echo "active";
        } ?>">
        <a href="/exchange.php">
            <img class="imgleft" src="/images/navigation/exchange.png" />
            <p>EXCHANGE</p>
        </a>
    </div>
    <div class="navicon chat 
        <?php if(basename($_SERVER['PHP_SELF']) == "chat.php") {
            echo "active";
        } ?>">
        <a href="/chat.php">
            <img class="imgleft" src="/images/navigation/chat.png" />
            <p>CHAT</p>
        </a>
    </div>
    <div class="navicon account 
        <?php if(basename($_SERVER['PHP_SELF']) == "account.php") {
            echo "active";
        } ?>">
        <a href="/account.php">
            <img class="imgleft" src="/images/navigation/account.png" />
            <p>ACCOUNT</p>
        </a>
    </div>
    <div class="navicon empty"></div>
    <div class="navicon login-logout">
        <a href="?logout=1">
            <img class="imgleft" src="/images/navigation/logout.png" />
            <p>LOGOUT</p>
        </a>
    </div>
</div>