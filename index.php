<?php session_start(); ?>
<?php 
ob_start();

include_once("server/components/handleTgLogin.php");
include_once("server/components/loginToDb.php");
include_once("server/queryDbSocial.php");

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
			<?php include_once("components/header-mobile.php"); ?>
			<?php include_once("components/navigation.php"); ?>
			<?php include_once("components/dashboard/coinwidgets.php"); ?>
			<?php include_once("components/dashboard/transactions.php"); ?>
			<?php include_once("components/dashboard/profilewidget.php"); ?>
			<?php include_once("components/dashboard/shapeshift.php"); ?>
			<?php include_once("components/dashboard/graph.php"); ?>
			<?php include_once("components/dashboard/sendreceive.php"); ?>
		</div>
	</body>
</html>