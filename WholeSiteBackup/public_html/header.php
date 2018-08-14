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
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>PayPeer</title>
	<link rel="stylesheet" type="text/css" href="fonts/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
   	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="js/app.js" ></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" href="css/faq-style.css">
        <link rel="stylesheet" href="https://changelly.com/widget.css">
	<!-- <script src="https://mining-profit.com/js/mp-btc-chart.js"></script> -->
	<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

<style>
.tab-content>.active {
    display: block;
}
.main-content {
    padding: 0px;
    padding-top: 50px;
}
div.buybox {
        display: none;
	background-color: rgba(255, 255, 255, 0.9);
	border-style: solid;
	border-color: #009FFF;
	border-width: 0.1em;
	border-radius: 1em;
	font-size:     1.2em;
	padding: 1em;
	color: black;
        width: 13em;
	text-align: center;
}
span.buybox {
        display: block;
	text-align: center;
	font-family: 'Montserrat', sans-serif;
}
a[id=changellyButton] {
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	width: 50%;
}
</style>

</head>
<body class="dashboard">
	
<header class="main-header">
	<div class="top-bar">
		<div class="logo">	
			<a href="/">		
				<img src="images/header-logo.png">
			</a>
		</div>
		<div class="login">
			<?php if (isset($_SESSION['ud_login'])): ?>
					<?php if($_SESSION['ud_login']['pro_id']==1){ ?>
					<span class="login-button">
						<!-- <a href="manage-faq.php">Manage FAQ</a> -->
						<a target="_blank" href="https://www.info.paypeer.io/">Manage FAQ</a>
					</span>
					<?php } ?>
					<span class="login-button">
						<a style="text-transform: capitalize;" href="<?php
						$profile_id = $_SESSION['ud_login']['pro_id'] ;
						echo 'profile.php?id='.$profile_id;
						?>"><?php echo $_SESSION['ud_login']['firstname']; ?></a>
						&nbsp;<a href="logout">Logout</a>
					</span>
			
                <?php else : ?>
                	<span class="login-button">
						<a href="login">Sign in</a>
					</span>
					<span class="or">or</span>
					<a class="sign-up" aria-current="false" href="signup">Sign up</a>

				<?php endif ?>	
			
		</div>
	</div>
	<?php
    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/',$link);
    $page = end($link_array);
   	$pro_page = explode('.',$page);
?>
	<div class="sidebar-menu" id="menu">	
			<div class="nav-icon <?php echo $page == '' ? 'active'  : '' ?>"  onclick="openCity(event)">
				<a aria-current="true" href="/" class="active"><img src="images/003-gauge.png"></a>
			</div>
			<div class="nav-icon <?php echo $page == 'exchange' ? 'active'  : '' ?>"  onclick="openCity(event)">
				<a aria-current="false" href="exchange"><img src="images/002-arrows.png"></a>
			</div>
			<div class="nav-icon  <?php echo $page == 'send' ? 'active'  : '' ?>" onclick="openCity(event)">
				<a aria-current="false" href="send"><img src="images/001-right-arrow.png"></a>
			</div>
			<div class="nav-icon  <?php echo $pro_page[0] == 'profile' ? 'active'  : '' ?>" onclick="openCity(event)">
				<a aria-current="false" href="<?php
						$profile_id = $_SESSION['ud_login']['pro_id'] ;
						echo 'profile.php?id='.$profile_id;
						?>"><img src="images/account.png"></a>
			</div>
			<!-- <div class="nav-icon  <?php echo $page == 'support' ? 'active'  : '' ?>" onclick="openCity(event)">
				<a aria-current="false" href="support"><img src="images/help.png"></a>
			</div> -->
			<div class="nav-icon  <?php echo $page == 'support' ? 'active'  : '' ?>">
				<a aria-current="false" target="_blank" href="https://www.info.paypeer.io/"><img src="images/help.png"></a>
			</div>
	</div>
</header>
<main class="main-content">
