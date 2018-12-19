<?php
include_once('components/loginToDb.php');
include_once('components/handleTgLogin.php');
include_once('components/pushToDb.php');

if(isset($_GET["btc"]) && isset($_GET["eth"]) && isset($_GET["ltc"])) {
    $addrBtc = $_GET["btc"];
    $addrEth = $_GET["eth"];
    $addrLtc = $_GET["ltc"];
    updateAddressesInDb($conn, $tg_user, $addrBtc, $addrEth, $addrLtc);
    header("Location: ../index.php");
}
else {
    header("Location: ../createWallet.php");
}
?>