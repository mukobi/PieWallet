<?php
$apiKey = "76ac-1f64-4284-9dd4"; //ltc test api
$apiKeyBTC = "640f-6855-04c0-8296"; //btc test api
$version = 2; // API version
$pin = "00000000";
$block_io = new BlockIo($apiKey, $pin, $version);
$block_ioBTC = new BlockIo($apiKeyBTC, $pin, $version);
?>