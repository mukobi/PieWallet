<?php
include_once('components/loginToDb.php');
include_once('components/handleTgLogin.php');
include_once('queryDbSocial.php');
include_once('components/pushToDb.php');

if(!isset($_GET["btc"]) || !isset($_GET["eth"]) || !isset($_GET["ltc"])) {
    header("Location: ../index.php");
}
$overrideConflictingAddress = false;
if(isset($_GET["override"]) && $_GET["override"] == "true") {
    $overrideConflictingAddress = true;
}

$addrBtc = $_GET["btc"];
$addrEth = $_GET["eth"];
$addrLtc = $_GET["ltc"];

if(($myUserObject["btc_address"] != "" ||
    $myUserObject["ltc_address"] != "" ||
    $myUserObject["eth_address"] != "") &&
    ($myUserObject["btc_address"] != $addrBtc ||
    $myUserObject["ltc_address"] != $addrLtc ||
    $myUserObject["eth_address"] != $addrEth) &&
    !$overrideConflictingAddress) :
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
"http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <title>Create PieWallet - PayPeer</title>
    <link rel="stylesheet" href="/css/style11.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/widgets/create-wallet-widget.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/TweenMax-latest-beta.js"></script>
</head>
<body>
    <div id="main-container" class="content-main login create-wallet">
        <div id="moving-floor-canvas-container">
            <canvas id="moving-floor-canvas">
            </canvas>
        </div>
        <script src="../js/moving-floor.js"></script>
        <style>
        .login-box #create-wallet-widget p {
            text-align: center;
            word-wrap: break-word;
        }
        </style>
        <div class="login-box">
            <div id="create-wallet-widget">
                <h5>Warning, these public addresses don't match what you had last time!</h5>
                <p>Are you sure you want to override your currently stored public addresses?</p>
                <div>
                    <p>Old/New BTC Address: <?php echo $myUserObject["btc_address"] ?></p>
                    <p><?php echo $addrBtc ?></p>
                </div>
                <div>
                    <p>Old/New LTC Address: <?php echo $myUserObject["ltc_address"] ?></p>
                    <p><?php echo $addrLtc ?></p>
                </div>
                <div>
                    <p>Old/New ETH Address: <?php echo $myUserObject["eth_address"] ?></p>
                    <p><?php echo $addrEth ?></p>
                </div>
                <div>
                    <a class="btn primary" href="?btc=<?php echo $addrBtc?>&ltc=<?php echo $addrLtc?>&eth=<?php echo $addrEth?>&override=true">Override Addresses</a>
                </div>
                <div>
                    <a class="btn secondary" href="../index.php">Cancel Override</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
else :  // address matches existing or no existing address
    updateAddressesInDb($conn, $tg_user, $addrBtc, $addrEth, $addrLtc);
    header("Location: ../index.php");
endif;
?>