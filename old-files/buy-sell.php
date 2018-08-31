<?php include('header.php'); ?>
<section class="banner">
	<div class="container">
		<h1 class="mb-5">Exchange <span>Litecoin</span> at the Best Rates!</h1>
		<h5>Just enter the amount of litecoin you wish to exchange, and press buy. It's that simple!</h5>
		<form class="conversion-rates" method="post" action="exchange.php">
			<div class="form-field pr-5">
				<div class="input-field">
					<input id="you-have" type="number" name="you have" placeholder="you have">
					<select class="currency-type" id="primary">
						<option>USD</option>
						<option>ETH</option>
						<option>ZEC</option>
						<option>Dash</option>
						<option>XRP</option>
						<option>XMR</option>
					</select>
				</div>
			</div>
			<div class="form-field pl-5">
				<div class="input-field">
					<input id="you-get" disabled="disabled" readonly="true" type="number" name="you have" placeholder="you Get">
					<select class="currency-type" id="secondary">
						<option>LTC</option>
						<option>ETH</option>
						<option>ZEC</option>
						<option>Dash</option>
						<option>XRP</option>
						<option>XMR</option>
					</select>
				</div>
			</div>
			<div class="switch-icon">
				<img src="images/SwitchWhite.png">
			</div>
			<div class="form-field exchange-btn">
				<input type="submit" name="exchange" value="exchange">
			</div>
		</form>
	</div>
</section>
<section class="about-us-wrapper">
	<div class="container">
		<h1>About Us</h1>
		<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</h3>
	
	
	<form>
		<div class="row">
		<div class="col-sm-6 mb-3 form-group">
			<input type="text" name="Name" class="form-control"  placeholder="Name">
		</div>
		<div class="col-sm-6 mb-3 form-group">
			<input type="text" name="Name" class="form-control"  placeholder="E-Mail">
		</div>
		<div class="col-sm-12 mb-3 form-group">
			<textarea class="form-control"  placeholder="Send us a message..."></textarea> 
		</div>
		<div class="col-sm-12 submit-btn">
			<input type="submit" name="Send" value="Send">
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