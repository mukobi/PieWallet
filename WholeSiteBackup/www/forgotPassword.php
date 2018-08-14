<?php session_start(); ?>
<?php include('header.php'); ?>

<section class="about-us-wrapper">
	<div class="container" id="login-block">
		
		<h1>Reset your password</h1>
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
					<input id="fpEmail" type="text" name="email" placeholder="Email">
				</div>
							
				<div class="col-sm-12 submit-btn">
					<input id="resetPassword" type="submit" name="resetPassword" value="Reset Password">
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
<?php include('footer.php'); ?>