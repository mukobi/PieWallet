<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="wrapper">
	<div class="top-bar">
		<div class="logo">			
			<img src="images/header-logo.png">
		</div>
		<div class="login">
			<a class="sign-in" aria-current="false" href="/sign-in">Sign in</a>
			<span class="or">or</span>
			<a class="sign-up" aria-current="false" href="/sign-up">Sign up</a>
		</div>
	</div>
	<div class="sidebar-menu">		 
			<div class="nav-icon active" onclick="openCity(event, 'dashboard')">
				<a aria-current="true" href="#" class="active"><img src="images/dashboard.png"></a>
			</div>
			<div class="nav-icon" onclick="openCity(event, 'exchange')">
				<a aria-current="false" href="#"><img src="images/exchange.png"></a>
			</div>
			<div class="nav-icon" onclick="openCity(event, 'send')">
				<a aria-current="false" href="#"><img src="images/send.png"></a>
			</div>
			<div class="nav-icon" onclick="openCity(event, 'account')">
				<a aria-current="false" href="#"><img src="images/account.png"></a>
			</div>
			<div class="nav-icon" onclick="openCity(event, 'info')">
				<a aria-current="false" href="#"><img src="images/help.png"></a>
			</div>
	</div>

	<main class="main-content">
		<div id="dashboard" class="b-content">
			<div class="title"><h1>Dashboard</h1></div>
			<div class="balance">
				<h2>Balance</h2>
				<p>Please login to see your balance</p>
			</div>			
		</div>
		<div id="exchange" class="b-content">
			<div class="title"><h1>Exchange</h1></div>
			<form class="conversion-rates" method="post" action="exchangeProcess.php">
				<div class="rates-fields">
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
					<div class="switch-icon">
						<img src="images/SwitchWhite.png">
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
				</div>
				<div class="form-field exchange-btn">
					<button id="exchange" type="button" class="btn btn-info btn-lg" >EXCHANGE</button>
					<!-- <input data-toggle="modal" data-target="#myModal" type="button" name="exchange" id="exchange" value="exchange"> -->
				</div>
			</form>			
		</div>
		<div id="send" class="b-content">
			<div class="title"><h1>Send</h1></div>		 
				<h2>Find users</h2>
				<div class="currency-listing">		 
			 		<form action="send.php?go" method="post">
						<div class="input">								
							<input type="text" name="nick" class="form-control" placeholder="Search by nickname...">			
							<input type="submit" class="btn send_button btn-default" name="search" value="Search">			
						</div>						 
					</form>
			 
				<div class="row">
				
					<?php

					if(isset($_POST['search'])){

					  if(isset($_GET['go'])){

						  if(preg_match("/^[  a-zA-Z]+/", $_POST['nick'])){
							$name = $_POST['nick'];

							$stmt = " SELECT  * FROM ls_users WHERE nickname LIKE '%" . $name .  "%'; ";
							$result = $conn->query($stmt);
							while( $row = $result->fetch_assoc() ){

							$id = $row['id'];
							$firstname = $row['firstname'];
							$lastname = $row['lastname'];
							$name = $firstname . " " . $lastname;
							$nickname = $row['nickname'];
							$email = $row['email'];
							$label = $row['label'];
							$address = $row['address'];


							echo "<ul class='search_results' >";
							echo "<li>
							<a class='search_result' href='profile.php?id=$id'>"   .$nickname. " - " . $name .  "</a>
							</li>";
							// echo "<li>
							// <a class='search_result' href='profile.php?id=$id'>"   .$nickname. " - " . $name .  "</a>
							// <a class='pull-right' href='send.php?id=$id'>Send</a>
							// </li>";
							echo "</ul>";
							}
						}
						else{
							echo  "<p>Please enter a search query</p>";
						}
					  }
					}

					?>

				</div>			
			 
		 
		</div>
				 		
		</div>
		<div id="account" class="b-content">
			<div class="title"><h1>Account</h1></div>
			<div class="balance">				 
				<p>This is your account page.</p>
			</div>			
		</div>
		<div id="info" class="b-content">
			<div class="title"><h1>Info</h1></div>
			<div class="toggle">
	<div class="toggle-title ">
		<h3>
		<i></i>
		<span class="title-name">What is Litecoin?</span>
		</h3>
	</div>
	<div class="toggle-inner">
		<p>Litecoin, or LTC, is a peer-to-peer open source cryptocurrency that was developed by Charlie Lee, former Director of Engineering at Coinbase, in 2011. Litecoin is very similar to Bitcoin, but offers fastest transaction times at lower fees. Some have referred to LTC as the “Silver to BTCs Gold”.</p>
	</div>
	</div><!-- END OF TOGGLE -->
	
	
	<div class="toggle">
		<div class="toggle-title ">
			<h3>
			<i></i>
			<span class="title-name">What is Litespeed?</span>
			</h3>
		</div>
		
		<div class="toggle-inner">
			<p>Litespeed is a platform that allows users to Buy and Sell Litecoin, as well as allow users to send Litecoin to each other!</p>
		</div>
		</div><!-- END OF TOGGLE -->
		
		<div class="toggle">
			<div class="toggle-title  ">
				<h3>
				<i></i>
				<span class="title-name"> How Do I buy Litecoin from Litespeed?</span>
				</h3>
			</div>
			
			<div class="toggle-inner">
				<p>Buying Litecoin on Litespeed is easy! Just navigate to the “Buy” Page, enter the ammount of Litecoin you want to buy, or USD you would like to spend, and click exchange! Its that easy!</p>
			</div>
			
			</div><!-- END OF TOGGLE -->
			
  
  
		<div class="toggle">
			<div class="toggle-title  ">
				<h3>
				<i></i>
				<span class="title-name"> How Do I Sell Litecoin on Litespeed?</span>
				</h3>
			</div>
			
			<div class="toggle-inner">
				<p>Selling Litecoin on Litespeed is simple! Just Navigate to the “Sell” Page, enter the ammount of Litecoin you would like to sell and press “Exchange”. Once you have followed all the steps, you will recieve a notification and payment will be sent to the Payout Method you selected.</p>
			</div>
			
			</div><!-- END OF TOGGLE -->
			
  
  
		<div class="toggle">
			<div class="toggle-title ">
				<h3>
				<i></i>
				<span class="title-name">  How Do I send Litecoin to another user?</span>
				</h3>
			</div>
			
			<div class="toggle-inner">
				<p>You can send Litecoin to another user by navigating to the “Wallet” Page and finding the form labeled “Send Litecoin”. Select the user you would like to send Litecoin to and press send!</p>
			</div>
			
			</div><!-- END OF TOGGLE -->
			
  
  
  
		<div class="toggle">
			<div class="toggle-title ">
				<h3>
				<i></i>
				<span class="title-name">Can I Deposit or Withdraw Litecoin to and from Litespeed's intergrated Wallet?</span>
				</h3>
			</div>
			
			<div class="toggle-inner">
				<p>Yes! You can deposit Litecoin from an existing wallet to Litespeed’s entergrated Wallet and use that Litecoin to send to another user, or simply sell! You also have the option to Withdraw your Litecoin to an external Wallet.</p>
			</div>
			
			</div><!-- END OF TOGGLE -->
			
			
  
  		<div class="toggle">
			<div class="toggle-title ">
				<h3>
				<i></i>
				<span class="title-name">Why choose Litespeed?</span>
				</h3>
			</div>
			
			<div class="toggle-inner">
				<p>Litespeed offers competive pricing and rates, entergrated wallet, secure transactions, user friendly UI, and the ability to Buy and Sell Litecoin without revealing personal information like SSN, I.D., Etc.. Litespeed’s focus is to deliever a user friendly experience, with low fees and rates, and with Payout and Purchasing Methods most exchanges do NOT accept.</p>
			</div>
			
			</div><!-- END OF TOGGLE -->

			<div class="toggle">
			<div class="toggle-title ">
				<h3>
				<i></i>
				<span class="title-name">Is Litespeed Secure?</span>
				</h3>
			</div>
			
			<div class="toggle-inner">
				<p>Yes, Litespeed has done everything in its power to provide a safe and user friendly experience when using our services. However, We take security very seriously, and urge all users to take all steps needed to keep thier accounts and wallets safe, including a strong password, Two-Step Authenticator, and keeping all login information private. Litespeed can not be held responsible for any hacked or stolen accounts and urge users to keep your accounts and personal information safe.</p>
			</div>
			
			</div><!-- END OF TOGGLE -->

			<div class="toggle">
			<div class="toggle-title ">
				<h3>
				<i></i>
				<span class="title-name">Can my Sell order be denied?</span>
				</h3>
			</div>
			
			<div class="toggle-inner">
				<p>Although it is rare that we would deny a users request to sell, Litespeed reserves the right to hold or cancel a sell we find to be suspicious. If your Sell Order has not been completed, and your payment has not been recieved, do not panic! If there is any delay in your order you can always contact support to check the status of your sell order in the instance where it is put on hold. If the Sell Order IS CANCELED, all funds will be sent back to your Litespeed Intergrated Wallet. If you feel like your sell order is wrongfuly denied, Please contact us.</p>
			</div>
			
			</div>		
		</div>
	</main>
</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("b-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("nav-icon");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}



jQuery(document).ready(function($){
	$('.toggle-title').click(function(){
	  //alert('dsfdsfds')
	     var current_wrapper= $(this).parents(".toggle");
		       $("#info").find(".toggle-inner").slideUp();
		       if(! current_wrapper.hasClass("active")){
                       $(this).next('.toggle-inner').slideDown();
		       } 
		      
		     current_wrapper.siblings().removeClass("active").end().addClass("active");

		/*$(this).parents('.toggle').siblings().removeClass('active');		
		if (!$('.toggle').hasClass('active')){
				$('.toggle-inner').slideUp();
		}
		$(this).parent('.toggle').addClass('active');
		$(this).children('.toggle-inner').slideDown();*/
		
	});	
	
});



</script>

</body>
</html>