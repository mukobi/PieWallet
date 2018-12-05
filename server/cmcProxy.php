<?php
$API_KEY = "a4cb7f63-967a-4328-83c5-52db1f896b1c";
$contents = file_get_contents("https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?CMC_PRO_API_KEY=" . $API_KEY);
echo $contents;
?>