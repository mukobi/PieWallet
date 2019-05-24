<?
if (strpos($_SERVER['SERVER_NAME'], "piewallet") !== false) {
    $conn = new mysqli("localhost", "piewalle_php_login_bot", "eH2JKwHdEyrvdA9", "piewalle_piewallet_social"); 
}
else if(strpos($_SERVER['SERVER_NAME'], "000webhost") !== false) {
    $conn = new mysqli("localhost", "id6641582_paypeer1_lite1", "wwOpF+T3bDl&", "id6641582_piewallet_social"); 
}
else {
    $conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "piewallet_social"); 
}
?>