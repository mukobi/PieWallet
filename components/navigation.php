<?php include_once("components/mobile-nav-toggle.php"); ?>
<div id="navigation-menu" class="genbox">
    <script defer src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/TweenMax-latest-beta.js"></script>
    <div class="navicon headlogodiv noeffect">
        <a href="/">
            <img class="headlogo desktop" src="/images/navigation/header-logo.png" />
        </a>
    </div>
    <div class="navicon empty"></div>
    <div class="navicon dashboard 
        <?php if(basename($_SERVER['PHP_SELF']) == "index.php") {
            echo "active";
        } ?>">
        <a href="/">
            <img class="imgleft" src="/images/navigation/dashboard.png" />
            <p>Dashboard</p>
            
        </a>
    </div>
    <div class="navicon account 
        <?php if(basename($_SERVER['PHP_SELF']) == "account.php") {
            echo "active";
        } ?>">
        <a href="/account.php">
            <img class="imgleft" src="/images/navigation/account.png" />
            <p>Account</p>
        </a>
    </div>
    <div class="navicon transactions 
        <?php if(basename($_SERVER['PHP_SELF']) == "transactions.php") {
            echo "active";
        } ?>">
        <a href="/transactions.php">
            <img class="imgleft" src="/images/navigation/transactions.png" />
            <p>Transactions</p>
        </a>
    </div>
    <div class="navicon unlock 
        <?php if(basename($_SERVER['PHP_SELF']) == "unlock.php") {
            echo "active";
        } ?>">
        <a href="/unlockWallet.php">
            <img class="imgleft" src="/images/navigation/transactions.png" />
            <p>Unlock</p>
        </a>
    </div>
    <div class="navicon exchange 
        <?php if(basename($_SERVER['PHP_SELF']) == "exchange.php") {
            echo "active";
        } ?>">
        <a href="/exchange.php">
            <img class="imgleft" src="/images/navigation/exchange.png" />
            <p>Exchange</p>
        </a>
    </div>
    <div class="navicon search 
        <?php if(basename($_SERVER['PHP_SELF']) == "search.php") {
            echo "active";
        } ?>">
        <a href="/search.php">
            <img class="imgleft" src="/images/navigation/search.png" />
            <p>Search</p>
        </a>
    </div>
    <div class="navicon empty"></div>
    <div class="navicon logout noeffect">
        <a href="?logout=1" class="hollow-button">
            <p>Logout</p>
        </a>
    </div>
</div>