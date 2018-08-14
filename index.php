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
		<div id="dashboard" class="content-main">
			<div id="header" class="header genbox">
				<div class="headlogodiv">
					<a href="/">
						<img class="headlogo desktop" src="/images/header-logo2.png" />
						<img class="headlogo mobile" src="/images/piewallet-long-logo.png" />
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
						?>">
							<?php echo $_SESSION['ud_login']['firstname']; ?>
						</a>
						&nbsp;
						<a href="/logout">Logout</a>
					</span>

					<?php else : ?>
					<!-- <span class="login-button">
						<a href="/login">Sign in</a>
					</span>
					<span class="or">or</span>
					<a class="sign-up" aria-current="false" href="/signup">Sign up</a> -->

					<?php endif ?>

				</div>
			</div>
			<div id="coin-widget-container" class="main-carousel js-flickity" data-flickity-options='{"wrapAround": true, "watchCSS": true, "setGallerySize": false, "pageDots": false}'>
				<div id="widget-bitcoin" class="coin-widget dashbox carousel-cell">
					<img class="coin-logo" src="images/Bitcoin-logo.png" alt="Bitcoin Logo">
					<h3>BTC</h3>
				</div>
				<div id="widget-litecoin" class="coin-widget dashbox carousel-cell">
					<img class="coin-logo" src="images/Litecoin-logo.png" alt="Litecoin Logo">
					<h3>LTC</h3>
				</div>
				<div id="widget-ethereum" class="coin-widget dashbox carousel-cell">
					<img class="coin-logo" src="images/Ethereum-logo.png" alt="Ethereum Logo">
					<h3>ETH</h3>
				</div>
			</div>
			<!-- Start Left Menu -->
			<div id="navigation-menu" class="genbox">
				<div class="navicon active dashboard">
					<a href="/">
						<img class="imgleft" src="/images/navigation/dashboard.png" />
						<p>DASHBOARD</p>
					</a>
				</div>
				<div class="navicon exchange">
					<a href="/exchange">
						<img class="imgleft" src="/images/navigation/exchange.png" />
						<p>EXCHANGE</p>
					</a>
				</div>
				<div class="navicon chat">
					<a href="/send">
						<img class="imgleft" src="/images/navigation/chat.png" />
						<p>CHAT</p>
					</a>
				</div>
				<div class="navicon account">
					<?php
					if ( !mysqli_connect_errno()  && isset($_SESSION['ud_login'])){
						$email = $_SESSION['ud_login']['email'] ;
						$stmt = " SELECT label from ls_users where email LIKE '".$email."'; " ;
						$result = $conn->query($stmt);
						if ( $result->num_rows > 0 ) {
							echo '<a href="/account">' ;
						} else {
							echo '<a href="/login">' ;
						}
					} else {
						echo '<a href="/login">' ;
					}
					?>
						<img class="imgleft" src="/images/navigation/account.png" />
						<p>ACCOUNT</p>
						</a>
				</div>
				<div class="navicon login-logout">
					<a href="#">
						<img class="imgleft" src="/images/navigation/logout.png" />
						<p>LOGOUT</p>
					</a>
				</div>
			</div>
			<div id="transactions" class="dashbox genbox balancebox">
				<h3>Transaction History</h3>
				</br>
				<div id="balance-content">
					<?php
					if ( !mysqli_connect_errno() && isset($_SESSION['ud_login'])){

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
							<?php	
					}
						else {
							echo "Please login to see your balance";
						}
					}
					else {
						echo "Please login to see your balance";
					}
					?>
				</div>
				<div class="placeholder-history">
					<ul class="balancetable">
						<li>
							<p>Transaction 1</p>
						</li>
						<li>
							<p>Transaction 2</p>
						</li>
						<li>
							<p>Transaction 3</p>
						</li>
						<li>
							<p>Transaction 4</p>
						</li>
						<li>
							<p>Transaction 5</p>
						</li>
						<li>
							<p>Transaction 6</p>
						</li>
						<li>
							<p>Transaction 7</p>
						</li>
						<li>
							<p>Transaction 8</p>
						</li>
						<li>
							<p>Transaction 9</p>
						</li>
						<li>
							<p>Transaction 10</p>
						</li>
						<li>
							<p>Transaction 11</p>
						</li>
						<li>
							<p>Transaction 12</p>
						</li>
						<li>
							<p>Transaction 13</p>
						</li>
						<li>
							<p>Transaction 14</p>
						</li>
						<li>
							<p>Transaction 15</p>
						</li>
						<li>
							<p>Transaction 16</p>
						</li>
						<li>
							<p>Transaction 17</p>
						</li>
						<li>
							<p>Transaction 18</p>
						</li>
						<li>
							<p>Transaction 19</p>
						</li>
						<li>
							<p>Transaction 20</p>
						</li>
						<li>
							<p>Transaction 21</p>
						</li>
						<li>
							<p>Transaction 22</p>
						</li>
						<li>
							<p>Transaction 23</p>
						</li>
						<li>
							<p>Transaction 24</p>
						</li>
						<li>
							<p>Transaction 25</p>
						</li>
						<li>
							<p>Transaction 26</p>
						</li>
						<li>
							<p>Transaction 27</p>
						</li>
						<li>
							<p>Transaction 28</p>
						</li>
						<li>
							<p>Transaction 29</p>
						</li>
						<li>
							<p>Transaction 30</p>
						</li>
					</ul>
				</div>
			</div>
			<div id="sendreceive" class="dashbox">
				<h3>Send/Receive</h3>
			</div>
			<div id="shapeshift" class="dashbox">
				<h3>ShapeShift</h3>
				<div class="genbox buybox">
					<h4 class="buybox">Buy Cryptocurrencies</h4>
					<a id="changellyButton" href="https://changelly.com/widget/v1?auth=email&from=USD&to=BTC&merchant_id=b6b98ece50c8&address=&amount=100&ref_id=b6b98ece50c8&color=4977f1"
					    target="_blank">
						<img src="https://changelly.com/pay_button_buy_sell.png" />
					</a>
					<div id="changellyModal">
						<div class="changellyModal-content">
							<span class="changellyModal-close">x</span>
							<iframe src="https://changelly.com/widget/v1?auth=email&from=USD&to=BTC&merchant_id=b6b98ece50c8&address=&amount=100&ref_id=b6b98ece50c8&color=4977f1"
							    width="600" height="500" class="changelly" scrolling="no" style="overflow-y: hidden; border: none">
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
			</div>

			<div id="trading-graph" class="dashbox">
				<div id="tradingview_c355b" class="main"></div>
				<script type="text/javascript">
					new TradingView.widget({
						"autosize": true,
						"symbol": "BITFINEX:BTCUSD",
						"interval": "D",
						"timezone": "Etc/UTC",
						"theme": "Dark",
						"style": "3",
						"locale": "en",
						"toolbar_bg": "#f1f3f6",
						"enable_publishing": true,
						"withdateranges": true,
						"hide_side_toolbar": false,
						"allow_symbol_change": true,
						"details": true,
						"referral_id": "10394",
						"container_id": "tradingview_c355b"
					});
				</script>
				<!-- TradingView Widget END -->
			</div>
		</div>
	</body>

	</html>