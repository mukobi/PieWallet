<?php

include_once("server/components/handleTgLogin.php");
include_once("server/components/loginToDb.php");
include_once("server/queryDbSocial.php");

echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
    "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

	<head>
		<title>Transactions - PayPeer.io</title>
		<link rel="stylesheet" href="/css/style11.css">
		<link rel="stylesheet" href="/css/transactions.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php include_once("server/walletFunctionality.php"); ?>
	</head>

	<body>
		<div id="main-container" class="content-main transactions">
			<?php
			 	include_once("components/navigation.php");
				include_once("components/dashboard/transactions-widget.php");
			?>
		</div>
	</body>
</html>