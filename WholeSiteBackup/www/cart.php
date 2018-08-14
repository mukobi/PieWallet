<?php session_start(); ?>
<?php include('header.php'); ?>
<section class="dashboard-wrapper">	
	<div class="currency-listing">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart">
						<?php if (isset($_SESSION['exchange_data'])): ?>
						<h3>Your Cart</h3>
						<hr>
							
					<p class="cart data">
						Exchanging&nbsp;<span class="exchangedFrom"><?php  
						echo $_SESSION['exchange_data']['exchangedFromAmount']."&nbsp;". $_SESSION['exchange_data']['exchangedFrom']; ?></span> 
						to <span class="exchangedTo"><?php 
						echo $_SESSION['exchange_data']['exchangedTo']; ?></span> 
						you will get <span class="exchangedToAmount"><?php echo $_SESSION['exchange_data']['exchangedToAmount']."&nbsp;".$_SESSION['exchange_data']['exchangedTo']; ?></span>  </p>	
					<a href="#" class="btn btn-success">Proceed to Pay</a>
						<?php else: ?>
					<p class="cart data"> Your Cart is empty.</p>	

						<?php endif ?>
					</div>
					
				</div>
			</div>
		</div>
	</div>

</section>

<?php include('footer.php'); ?>