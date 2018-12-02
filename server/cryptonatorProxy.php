<?php
if(isset($_GET["coin"])) {
    if($_GET["coin"] == "btc") {
        echo file_get_contents("https://api.cryptonator.com/api/ticker/btc-usd");
    }
}
?>