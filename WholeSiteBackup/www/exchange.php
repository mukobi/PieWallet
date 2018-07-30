<?php session_start(); ?>
<?php include('header.php'); ?>
<section class="banner">
	<div class="container">
		<h1 class="mb-5">Exchange</h1>
		
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
<!-- <section class="exchange-sec-2">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="es2-item">
					<span class="es2-item-img"><i class="fa fa-user-secret" aria-hidden="true"></i></span>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="es2-item">
					<span class="es2-item-img"><i class="fa fa-rocket" aria-hidden="true"></i></span>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="es2-item">
					<span class="es2-item-img"><i class="fa fa-refresh" aria-hidden="true"></i></span>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="exchange-sec-3">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="testimonials-wrap">
					<h3>Testimonials</h3>
					<div class="owl-carousel owl-theme">
					    <div class="item">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</div>
					    <div class="item">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</div>
					    <div class="item">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="accepted-coins">
					<h2>Accepted Coins</h2>
					<p><img class="fifteen-right" src="images/opengraph.png" alt="" width="90" height="90"><img class="fifteen-right" src="images/dogecoin-300.png" alt="" width="95" height="95"><img src="images/Ripple_logo.svg_.png" alt="" width="82" height="88"></p>
					<p><img class="fifteen-right" src="images/site-banner1.png" alt="" width="75" height="76"><img class="fifteen-right" src="images/ip.bitcointalk.png" alt="" width="80" height="94"><img src="images/omisego.png" alt="" width="80" height="80"></p>
					<h2>+ more…</h2>
				</div>
			</div>
		</div>
	</div>
</section>
 -->
 <style type="text/css">
 	.modal.fade .modal-dialog {
 		transform: translate(0);
 	}
 	button.close {	   
	    color: #fff;
	    opacity: 1;
	}
	button.close:hover  {
		opacity: .75
	}
	
 </style>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">ShapeShift</h4>
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
        	</div>
        	<div class="modal-body">
          		<iframe src="" width="100%" height="400"></iframe>
        	</div>
        	<div class="modal-footer">
          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	</div>
      	</div>
    </div>
</div>

 







<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
<script type="text/javascript">
	jQuery(function(){ 
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:false,
	    pagination:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	})
	})
</script>
<?php include('footer.php'); ?>
