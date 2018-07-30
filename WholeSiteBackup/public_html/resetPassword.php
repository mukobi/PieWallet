<?php 
session_start();
$email = htmlspecialchars(trim($_GET['email']));
$token = htmlspecialchars(trim($_GET['t']));

if (isset($email) && isset($token) && !empty($email) && !empty($token) && strlen($token) == 60) {
	$conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "paypeer1_litespeed"); 
	if (mysqli_connect_errno()){
		echo "Error";;
		exit();
	}
	else{
			if ($stmt = $conn->prepare("SELECT id FROM ls_users WHERE email=? and password_reset_token =?")){
			    $stmt->bind_param("ss", $email, $token);
			    $stmt->execute();
			    $stmt->bind_result($id);
			    $stmt->fetch();

			    if (NULL==$id){
					$stmt->close();
					$_SESSION['msg']="Invalid password reset link please double check your password reset link...";
					header('location:login');
					
			    }else{
			    	$stmt->close();
			    	show_new_password_form();
		    	}
			}else{
					echo("Error...");
			}
		}	
}else{
	$_SESSION['msg']="Invalid account verification link please double check your account verification link...";
	header('location:login');
}

function show_new_password_form(){
	?>
	<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>lite speed exchange</title>
	<link rel="stylesheet" type="text/css" href="fonts/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php session_destroy(); ?>

<?php include('header.php'); ?>
<section class="about-us-wrapper">
	<div class="container" id="login-block">
		
		<h1>Set new account password</h1>
		<p class="error-msg"><?php if (isset($_SESSION['msg'])) {
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
		} ?></p>
		<p class="success-msg"><?php if (isset($_SESSION['msg-success'])) {
		echo $_SESSION['msg-success'];
		unset($_SESSION['msg-success']);

		} ?></p>	

		<form action="forgotPasswordProcess.php" method="post">
			<div class="row">
			<div class="col-sm-12 mb-12">

				<input id="newpwdemail" type="hidden" name="email" value="<?php echo  isset($_GET['email']) ? $_GET['email'] : "";   ?>">
				<input id="newpwdtoken" type="hidden" name="token"" value="<?php echo  isset($_GET['t']) ? $_GET['t'] : "";   ?>">
				<input id="newPassword" type="password" name="newPassword" placeholder="Enter your new password">
			</div>
						
			<div class="col-sm-12 submit-btn">
				<input id="setNewPassword" type="submit" name="setNewPassword" value="Reset Password">
			</div>
				</div>
			 
		</form>
		<ul class="social-share">
			<li><a href="#"><img src="images/web-design_11.png"></a></li>
			<li><a href="#"><img src="images/web-design_13.png"></a></li>
			<li><a href="#"><img src="images/web-design_03.png"></a></li>
			<li><a href="#"><img src="images/web-design_08.png"></a></li>
			<li><a href="#"><img src="images/web-design_05.png"></a></li>
		</ul>
	</div>
</section>

<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-sm-6">
				<div class="footer-sec-one">
					<img src="images/footer-logo.png">
					<ul class="footer-nav mt-1">
						<li><a href="">about us</a></li>
						<li><a href="">contact us</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 mr-auto text-center">
				<ul class="footer-socials mb-3">
					<li><a href=""><img src="images/footer-icon-facebook.png"></a></li>
					<li><a href=""><img src="images/footer-icon-googleplus.png"></a></li>
					<li><a href=""><img src="images/footer-icon-insta.png"></a></li>
				</ul>
				<small>&copy; Copyright 2017 LITESPEED. All Rights Reserved</small>
			</div>
		</div>
	</div>
</footer>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>


</body>
</html>
	<?php
}