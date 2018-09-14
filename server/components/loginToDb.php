<?php 
if(strpos($_SERVER['SERVER_NAME'], "000webhost") !== false) {
    $conn = new mysqli("localhost", "id6641582_paypeer1_lite1", "wwOpF+T3bDl&", "id6641582_piewallet_social"); 
}
else {
    $conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "piewallet_social"); 
}
?>