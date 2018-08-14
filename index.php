<?php session_start(); ?>
<?php 
ob_start();
@session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
$conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "paypeer1_litespeed"); 

//require_once 'block_io.php'; 

// require_once __DIR__ . "/blocktrail/vendor/autoload.php";
// use Blocktrail\SDK\BlocktrailSDK;
// use Blocktrail\SDK\Connection\Exceptions\ObjectNotFound;
// use Blocktrail\SDK\Wallet;
// use Blocktrail\SDK\WalletInterface;

// $client = new BlocktrailSDK(getenv('BLOCKTRAIL_SDK_APIKEY') ?: "aa958b2daea2d6579224fb2105fe83d4b7f1deae", getenv('BLOCKTRAIL_SDK_APISECRET') ?: "3c69765ea03a27d66c631d8037798fec87139bcc", "BTC", true /* testnet */, 'v1'); 
//print_r($client);
if(isset($_POST['action'])) : 

	if($_POST['action'] == 'unfollowed'){
		$followTo = $_GET['id'];
		$followBy = $_SESSION['ud_login']['pro_id'] ;
		$current_timestamp = date("Y-m-d H:i:s");
		//echo $current_timestamp;

		$already_followBy = "SELECT * FROM `ls_followers` WHERE (followBy = '".$followBy."' AND followTo = '".$followTo."')";
		$result = $conn->query($already_followBy);
		$row = $result->fetch_object();
		
		if($row){
			$stmt = " DELETE FROM `ls_followers` WHERE (followBy = '".$followBy."' AND followTo = '".$followTo."')";
			$result = $conn->query($stmt);
			if(!$result) {
			 echo "<script> alert('Some error occured while unfollowing'); </script>" ;
			}else{
			 echo "<script> alert('Account has been unfollowed'); </script>";
			}
		}			
	}

	if($_POST['action'] == 'followed'){
		$followTo = $_GET['id'];
		$followBy = $_SESSION['ud_login']['pro_id'] ;
		$current_timestamp = date("Y-m-d H:i:s");
		//echo $current_timestamp;

		$already_followBy = "SELECT * FROM `ls_followers` WHERE (followBy = '".$followBy."' AND followTo = '".$followTo."')";
		$result = $conn->query($already_followBy);
		$row = $result->fetch_object();
		//print_r($row);
		if($row ){
			
		}else{
			$stmt = " INSERT into ls_followers (followBy, followTo, followDate) VALUES ($followBy ,$followTo, ' ".$current_timestamp." '); ";
			$result = $conn->query($stmt);
			if(!$result) {
			 echo "<script> alert('Some error occured while following'); </script>" ;
			}else{
			 echo "<script> alert('Account has been followed'); </script>";
			}
		}	
	}

	if($_POST['action'] == 'acc_frm'){
		$profile_id = $_GET['id'];
		$user = $_POST['user'];
		$email = $_POST['email'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		
		$stmt = " UPDATE ls_users SET nickname = '". $user ."', firstname = '". $firstname ."', lastname = '". $lastname ."' WHERE id = ".$profile_id."; ";
		//echo $stmt;
		$result = $conn->query($stmt);
		if(!$result) {
		 echo "<script> alert('Some error occured while updating'); </script>" ;
		}else{
		 echo "<script> alert('Account has been updated'); </script>";
		}	
	}

	if($_POST['action'] == 'pass_updt'){
		
		$profile_id = $_GET['id'];
		$current_pass = $_POST['current_pass'];
		$new_pass = $_POST['new_pass'];
		$confirm_pass = $_POST['confirm_pass'];

		$stmt= "SELECT password FROM `ls_users` WHERE id=".$profile_id."; ";
		$result = $conn->query($stmt);
		$row= $result->fetch_object();
		$db_pass_hash = $row->password;

		$hash = $db_pass_hash;

		if (password_verify( $current_pass, $hash)) {
			if($confirm_pass == $new_pass){
			    
				$password = password_hash(htmlspecialchars(trim($new_pass)), PASSWORD_DEFAULT);
				$stmt = " UPDATE ls_users SET password = '". $password ."' WHERE id=".$profile_id."; ";
				
				$result = $conn->query($stmt);
				if(!$result) {
				 	echo "<script> alert('Some error occured while updating'); </script>" ;
				}else{
				 	echo "<script> alert('Password has been updated'); </script>";
				}
			}
			else{ echo "<script> alert('New Password doesn\'t match with confirm password'); </script>"; }
		} else {
		    echo "<script> alert('Your current password is wrong'); </script>";
		}			
	}

	if($_POST['action'] == 'dlt_acc'){
		
		$profile_id = $_GET['id'];
		$enter_pass = $_POST['enter_pass'];

		$stmt = "SELECT password FROM `ls_users` WHERE id=".$profile_id."; ";
		$result = $conn->query($stmt);
		$row = $result->fetch_object();
		$db_pass_hash = $row->password;

		$hash = $db_pass_hash;

		if (password_verify( $enter_pass, $hash)) {		  
				$stmt = " DELETE from ls_users WHERE id=".$profile_id."; ";			
				$result = $conn->query($stmt);
				if(!$result) {
				 	echo "<script> alert('Some error occured while deleting your account'); </script>" ;
				}else{
				 	echo "<script> alert('Your account has been deleted');</script>";
				 	header("Location:logout.php");
					exit;
				}
		} else {
		    echo "<script> alert('Enter correct password to delete your account'); </script>";
		}
	}
	
endif;
?>
<?php
echo '<?xml version="1.0" encoding="utf-8"?>' ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
    "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

	<head>
		<title>Dashboard - PayPeer.io</title>
		<link rel="stylesheet" href="https://changelly.com/widget.css">
		<link rel="stylesheet" href="/css/style11.css">
		<!-- <link rel="stylesheet" href="/css/buybox11.css"> -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
		<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
		<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
	</head>

	<body>
		<div id="main-container" class="content-main dashboard">
			<?php include_once("components/header.php"); ?>
			<?php include_once("components/navigation.php"); ?>
			<?php include_once("components/dashboard/coinwidgets.php"); ?>
			<?php include_once("components/dashboard/transactions.php"); ?>
			<?php include_once("components/exchange/exchange.php"); ?>
			<?php include_once("components/dashboard/shapeshift.php"); ?>
			<?php include_once("components/dashboard/graph.php"); ?>
		</div>
	</body>

	</html>