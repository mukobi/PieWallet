<?php
session_start();
unset($_SESSION['ud_login']);
session_destroy();
header("Location:http://paypeer.io/");
exit;
?>
