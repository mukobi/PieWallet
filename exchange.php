<?php

include_once("server/components/handleTgLogin.php");
include_once("server/components/loginToDb.php");

echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
    "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

	<head>
		<title>Exchange - PayPeer.io</title>
		<link rel="stylesheet" href="/css/style11.css">
		<link rel="stylesheet" href="/css/exchange.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>
		<div id="main-container" class="content-main exchange">
			<?php include_once("components/exchange/exchangewidget.php"); ?>
			<?php include_once("components/navigation.php"); ?>
		</div>
	</body>
</html>