<?php
if(strpos($_SERVER['SERVER_NAME'], "000webhost") != false) {  // test server
    define('TG_BOT_TOKEN', '637599184:AAFhVYf-dJEIVLqAWQWj4mk_RYE0vOuEcYk');
    define('TG_BOT_NAME', 'PiewalletBot');
}
else {  // dev
    define('TG_BOT_TOKEN', '628350776:AAGMY3nI9ctd-XlAeBQBSO38PSutOT9_lbM');
    define('TG_BOT_NAME', 'PayPeerBot');
}
?>