<?php session_start(); ?>
<?php include('header.php'); ?>
<section class="banner">
	<div class="container">
		<h1 class="mb-5">Exchange <span>Litecoin</span> at the Best Rates!</h1>
		<h5>Just enter the amount of litecoin you wish to exchange, and press buy. It's that simple!</h5>
		<form class="conversion-rates" method="post" action="exchangeProcess.php">
			<div class="form-field pr-5">
				<div class="input-field">
					<input id="you-have" type="number" name="you have" placeholder="you have">
					<select class="currency-type" id="primary" name="exchanged_from">
						<option>ETH</option>
						<option>ZEC</option>
						<option>DASH</option>
						<option>XRP</option>
						<option>XMR</option>
						<option>LTC</option>
					</select>
				</div>
				<p id="amount-error" style="color:red"></p>
			</div>
			<div class="form-field pl-5">
				<div class="input-field">
					<input id="you-get" readonly="true" type="number" name="you get" placeholder="you Get">
					<select class="currency-type" id="secondary" name="exchanged_to">
						<option>LTC</option>
						<option>ETH</option>
						<option>ZEC</option>
						<option>DASH</option>
						<option>XRP</option>
						<option>XMR</option>
					</select>
				</div>
			</div>
			<div class="switch-icon">
				<img src="images/SwitchWhite.png">
			</div>
			<div class="form-field exchange-btn">
				<button id="exchange" type="button" class="btn btn-info btn-lg" >EXCHANGE</button>
				<!-- <input data-toggle="modal" data-target="#myModal" type="button" name="exchange" id="exchange" value="exchange"> -->
			</div>
		</form>
	</div>
</section>
<section class="dashboard-wrapper">	
	<div class="currency-listing">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					
					
				</div>
			</div>
		</div>
	</div>

</section>
<?php include('footer.php'); ?>