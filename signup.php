<?php session_start(); ?>
<?php include('header.php'); ?>
<style>
	.checkbox-terms{
		float: left;
	}
	.span-terms{
		color: #000;
		display:inherit;
	    font-size: 12px;
	    text-align: left !important;
	    padding: 0 0 9px 20px;
	}
</style>
<section class="about-us-wrapper">
	<div class="container" id="signup-block">
		<h1>Signup</h1>
			<p class="error-msg"><?php if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			} ?></p>		
		<form action="signupProcess.php" method="post" autocomplete="off">
			<div class="row">
				<div class="col-sm-6 mb-3 form-group">
					<input id="firstname" class="form-control" type="text" name="firstname" placeholder="First Name" value="">
				</div>
				<div class="col-sm-6 mb-3 form-group">
					<input id="lastname" class="form-control" type="text" name="lastname" placeholder="Last Name" value="">
				</div>
				<div class="col-sm-12 form-group">
					<input id="nickname" class="form-control" type="text" name="nickname" placeholder="Nickname" value="">
				</div>
				
				<div class="col-sm-12 form-group">
					<input id="signupEmail" class="form-control" type="text" name="signupEmail" value="" placeholder="Email" value="">
				</div>
				<div class="col-sm-12 form-group">
					<input id="signupPassword" class="form-control" type="password" name="signupPassword" value="" placeholder="Password" value="">
				</div>
				<div class="col-sm-12">
    				<input id="terms" class="checkbox-terms" type="checkbox" name="terms" value="">
    				<span class="span-terms">
						By signing up you agree and accept the <a target="_blank" href="https://www.info.paypeer.io/terms">Terms of Service</a> and <a target="_blank" href="https://www.info.paypeer.io/privacy">Privacy Policy</a>
					</span>
				</div>
				<div class="col-sm-12 submit-btn">
					<input id="signup" type="submit" name="create_user" value="Signup">
				</div>
				<input type="hidden" name="bitcoin_private_key" id="bitcoin_private_key">
				<input type="hidden" name="bitcoin_address" id="bitcoin_address">
				<input type="hidden" name="litecoin_private_key" id="litecoin_private_key">
				<input type="hidden" name="litecoin_address" id="litecoin_address">
			</div>
		</form>
		<p>Already have an account ? <a href="login">Login</a></p>
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