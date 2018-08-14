<?php 
	session_start();

	if (!isset($_SESSION['ud_login'])) {
		$_SESSION['exchange_data']['exchangedFrom']		 = $_POST['exchanged_from'];
		$_SESSION['exchange_data']['exchangedTo']		 = $_POST['exchanged_to'];
		$_SESSION['exchange_data']['exchangedFromAmount']= $_POST['you_have'];
		$_SESSION['exchange_data']['exchangedToAmount']	 = $_POST['you_get'];
		$_SESSION['msg-success'] = "You have to login first.";
		header('location:login');
	}else{
		$_SESSION['exchange_data']['exchangedFrom']		 = $_POST['exchanged_from'];
		$_SESSION['exchange_data']['exchangedTo']		 = $_POST['exchanged_to'];
		$_SESSION['exchange_data']['exchangedFromAmount']= $_POST['you_have'];
		$_SESSION['exchange_data']['exchangedToAmount']	 = $_POST['you_get'];
		
		header('location:cart');
	}

?>