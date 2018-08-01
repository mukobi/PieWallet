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
echo '<?xml version="1.0" encoding="utf-8"?>'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
    "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd"
>
<html
	xmlns="http://www.w3.org/1999/xhtml"
	xml:lang="en"
>
<head>
<title>Dashboard - PayPeer.io</title>
 <link rel="stylesheet" href="https://changelly.com/widget.css">
<link
	rel="stylesheet"
	href="/css/style11.css"
>
 <link rel="stylesheet" href="/css/buybox11.css">
<meta
	name="viewport"
	content="width=device-width, initial-scale=1.0"
>
<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
</head>
<body>
<!-- Start mobile heading -->
<div id="fixedheading">
<div class="fixedlogodiv">
<a href="/">
<img class="fixedlogo" src="/images/header-logo2.png" />
</a>
</div>
<!-- Start fixed menu buttons -->
<div class="fixedmenuwrapper">
<div class="navheadicon">
<a href="/dashboard">
<img class="imghead" src="/images/003-gauge.png" />
</a>
</div>
<div class="navheadicon">
<a href="/exchange">
<img class="imghead" src="/images/002-arrows.png" />
</a>
</div>
<div class="navheadicon">
<a href="/send">
<img class="imghead" src="/images/001-right-arrow.png" />
</a>
</div>
<div class="navheadicon">
<a href="/account">
<img class="imghead" src="/images/account.png" />
</a>
</div>
<div class="navheadicon">
<a href="/help">
<img class="imghead"src="/images/help.png" />
</a>
</div>
</div>
<!-- End Fixed menu buttons -->
</div>
<!-- End mobile heading -->
<div id="dashboard" class="content-main">
<div id="header" class="header genbox">
<div class="headlogodiv">
<a href="/">
<img class="headlogo" src="/images/header-logo2.png" />
</a>
</div>
		<div class="login">
			<?php if (isset($_SESSION['ud_login'])): ?>
					<?php if($_SESSION['ud_login']['pro_id']==1){ ?>
					<span class="login-button">
						<!-- <a href="manage-faq.php">Manage FAQ</a> -->
						<a target="_blank" href="https://info.paypeer.io/">Manage FAQ</a>
					</span>
					<?php } ?>
					<span class="login-button">
						<a style="text-transform: capitalize;" href="<?php
						$profile_id = $_SESSION['ud_login']['pro_id'] ;
						echo 'profile.php?id='.$profile_id;
						?>"><?php echo $_SESSION['ud_login']['firstname']; ?></a>
						&nbsp;<a href="/logout">Logout</a>
					</span>
			
                <?php else : ?>
                	<span class="login-button">
						<a href="/login">Sign in</a>
					</span>
					<span class="or">or</span>
					<a class="sign-up" aria-current="false" href="/signup">Sign up</a>

				<?php endif ?>	
			
		</div>
</div>
<!-- Start Left Menu -->
<div id="leftmenu" class="genbox">
<div class="navicon">
<a href="/dashboard">
<img class="imgleft" src="/images/003-gauge.png" />
</a>
</div>
<div class="navicon">
<a href="/exchange">
<img class="imgleft" src="/images/002-arrows.png" />
</a>
</div>
<div class="navicon">
<a href="/send">
<img class="imgleft" src="/images/001-right-arrow.png" />
</a>
</div>
<div class="navicon">
<a href="/account">
<img class="imgleft" src="/images/account.png" />
</a>
</div>
<div class="navicon">
<a href="/help">
<img class="imgleft"src="/images/help.png" />
</a>
</div>
<!--End Left Menu-->
</div>
<div class="left">
<div class="genbox balancebox"><h4>Balance</h4>
<div id="balance-content">
<?php
if ( !mysqli_connect_errno() ){
$email = $_SESSION['ud_login']['email'] ;
$stmt = " SELECT label from ls_users where email LIKE '".$email."'; " ;
$result = $conn->query($stmt);
if ( $result->num_rows > 0 ) {
$row = $result->fetch_assoc();
echo '<img src="images/litecoin.svg"> ';
?>
<span id="amount-lite-coin">0 LTC</span>
<?php	echo '  /  <img src="images/bitcoin.png"> '; ?>
<span id="amount-bit-coin">0 BTC</span>
<?php	}
else {
echo "Please login to see your balance";
}
}
?>
</div>
</div>
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container2 genbox">
<div class="tradingview-widget-container__widget"></div>
<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
{
"showChart": false,
"locale": "en",
"largeChartUrl": "",
"width": "100%",
"height": "100%",
"plotLineColorGrowing": "rgba(0, 0, 255, 1)",
"plotLineColorFalling": "#FF4A68",
"gridLineColor": "#e9e9ea",
"scaleFontColor": "#DADDE0",
"belowLineFillColorGrowing": "rgba(60, 188, 152, 0.05)",
"belowLineFillColorFalling": "rgba(255, 74, 104, 0.05)",
"symbolActiveColor": "#F2FAFE",
"tabs": [
{
"title": "Cryptocurrencies",
"symbols": [
{
"s": "BITFINEX:BTCUSD",
"d": "Bitcoin"
},
{
"s": "BITFINEX:LTCUSD",
"d": "Litecoin"
},
{
"s": "BITFINEX:ETHUSD",
"d": "Ethereum"
},
{
"s": "BITFINEX:XRPUSD",
"d": "Ripple"
},
{
"s": "BITFINEX:BTCUSD",
"d": "Bitcoin Cash"
}
]
}
]
}
</script>
</div>
<!-- TradingView Widget END -->
<div class="genbox buybox">
<h4 class="buybox">Buy Cryptocurrencies</h4>
<a id="changellyButton" href="https://changelly.com/widget/v1?auth=email&from=USD&to=BTC&merchant_id=b6b98ece50c8&address=&amount=100&ref_id=b6b98ece50c8&color=4977f1" target="_blank">
<img src="https://changelly.com/pay_button_buy_sell.png" />
</a>
<div id="changellyModal">
<div class="changellyModal-content">
<span class="changellyModal-close">x</span>
<iframe
src="https://changelly.com/widget/v1?auth=email&from=USD&to=BTC&merchant_id=b6b98ece50c8&address=&amount=100&ref_id=b6b98ece50c8&color=4977f1"
width="600"
height="500"
class="changelly"
scrolling="no"
style="overflow-y: hidden; border: none"
>
Can't load widget
</iframe>
</div>
<script type="text/javascript">
var changellyModal = document.getElementById('changellyModal');
var changellyButton = document.getElementById('changellyButton');
var changellyCloseButton = document.getElementsByClassName('changellyModal-close')[0];
</script>
</div>
</div>
<!-- End Buy Box -->
</div>

<div id="tradingview_c355b" class="main genbox loginbox">
<section class="about-us-wrapper">
	<div class="container" id="login-block">
		
		<h1>Login</h1>
		<p class="error-msg"><?php if (isset($_SESSION['msg'])) {
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
		} ?></p>
		<p class="success-msg"><?php if (isset($_SESSION['msg-success'])) {
		echo $_SESSION['msg-success'];
		unset($_SESSION['msg-success']);

		} ?></p>	
		<form action="loginProcess.php" method="post">
			<div class="row">
				<div class="col-sm-12 mb-12 form-group">
					<input id="loginEmail" type="text" name="email" class="form-control" placeholder="Email">
				</div>
				<div class="col-sm-12 mb-12 form-group">
					<input id="loginPassword" type="password" name="password" class="form-control" placeholder="Password" value="" >
				</div>
				
				<div class="col-sm-12 submit-btn">
					<input id="login" type="submit" class="btn btn-default" name="login" value="Login">
				</div>
			</div>
			 
		</form>

		<p ><a href="forgotPassword">Forgot password ? </a> Don't have an account ? <a href="signup">Sign up</a></p>
		<ul class="social-share">
			<li><a href="#"><img src="/images/web-design_11.png"></a></li>
			<li><a href="#"><img src="/images/web-design_13.png"></a></li>
			<li><a href="#"><img src="/images/web-design_03.png"></a></li>
			<li><a href="#"><img src="/images/web-design_08.png"></a></li>
			<li><a href="#"><img src="/images/web-design_05.png"></a></li>
		</ul>

	</div>
</section>
</div>
<div class="bottom">
<div class="genbox"><!--<h4>Transactions</h4>--></div>
</div>
</body>
</html>