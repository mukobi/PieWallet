<?php

include_once("server/components/handleTgLogin.php");

$conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "paypeer1_litespeed"); 

echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
    "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

	<head>
		<title>Account - PayPeer.io</title>
		<link rel="stylesheet" href="/css/style11.css">
		<link rel="stylesheet" href="/css/account.css">
		<!-- <link rel="stylesheet" href="/css/buybox11.css"> -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>
		<div id="main-container" class="content-main account">
			<?php include_once("components/header-mobile.php"); ?>
			<?php include_once("components/navigation.php"); ?>
			<?php include_once("components/account/accountwidget.php"); ?>
		</div>
	</body>
</html>