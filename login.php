<?php session_start(); ?>
<?php 
ob_start();
@session_start();

if(isset($_SESSION['login'])) {
	header("Location:index.php");
}
$conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "paypeer1_litespeed"); 
?>
<?php
echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
"http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>Login - PayPeer</title>
		<link rel="stylesheet" href="/css/style11.css">
		<link rel="stylesheet" href="/css/login.css">
		<!-- <link rel="stylesheet" href="/css/buybox11.css"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script defer src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/TweenMax-latest-beta.js"></script>
        <script defer src="js/gradient-color-change.js"></script>
	</head>
	<body>
		<div id="main-container" class="content-main login">
		</div>
	</body>
</html>