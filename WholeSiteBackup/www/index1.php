<?php session_start(); ?>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('header.php');
require_once 'block_io.php'; 

$apiKey = "76ac-1f64-4284-9dd4";
$version = 2; // API version
$pin = "00000000";
$block_io = new BlockIo($apiKey, $pin, $version);

// $getbalance = $block_io->get_balance();
// print_r($getbalance);

// $getinfo = $block_io->get_my_addresses();
// print_r($getinfo);

?>
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
<section class="exchange-sec-2 ">	
	<div class="currency-listing">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<div class="image" data-toggle="tab" href="#litecoin-bal">
						<a href="#">
							<img src="images/litecoin.png">
						</a>
					</div>
				</div>
				<div class="col-4">
					<div class="image" data-toggle="tab" href="#bittcoin-bal">
						<a href="#">
							<img src="images/bittcoin-thumb.png">
						</a>
					</div>
				</div>
				<div class="col-4">
					<div class="image" data-toggle="tab" href="#etherumcoin-bal">
						<a href="#">
							<img src="images/etherumcoin.png">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	
<section class="dashboard-wrapper exchange-sec-2 ">		


	<div class="currency-details">
		<div class="container">
			<div class="balance ">
				
				<div class="tab-content">
				    <div id="litecoin-bal" class="tab-pane fade in active">				      
				      	<span class="title">balance</span><br>
						<span class="amount"><img src="images/litecoin.svg"> 
							<?php 
								
								if ( mysqli_connect_errno() ){
									printf("Connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else{

									$email = $_SESSION['ud_login']['email'] ;
									//print_r($email);
									 $stmt = " SELECT label from ls_users where email LIKE '".$email."'; " ;
									 // echo $stmt;
									 // die();
									 $result = $conn->query($stmt);
									 //print_r($result);

									//echo"<br/>";
									 if ( $result->num_rows > 0 ) {
									    $row = $result->fetch_assoc();
									    //echo "label: " . $row["label"] ."<br/>";
									    $balance = $block_io->get_address_balance(array('labels'=>$row["label"])) ;
										print_r($balance->data->balances[0]->available_balance);
									   
									} else {
									    echo "Please login to see your balance";
									}
									
									
									//echo "<script> alert('wow'); </script>";
								}


								
							?>
						</span>

						<div class="graph">
							
							<script type="text/javascript">
								new TradingView.widget({
									"autosize": true,
									"symbol": "COINBASE:LTCUSD",
									"interval": "D",
									"timezone": "Etc/UTC",
									"theme": "Light",
									"style": "2",
									"locale": "en",
									"toolbar_bg": "#f1f3f6",
									"enable_publishing": false,
									"hide_top_toolbar": false,
									"allow_symbol_change": true,
									"hideideas": true
								});
							</script>



						</div>
						 
						<div class="currency-circulation">				
							<ul class="nav nav-tabs">
							    <li class="active"><a data-toggle="tab" href="#litecoin_deposit">deposit</a></li>
							    <li><a data-toggle="tab" href="#litecoin_withdraw">withdraw</a></li>
							    <li><a data-toggle="tab" href="#litecoin_send">send</a></li>				     
							</ul>
							<div class="tab-content">
							    <div id="litecoin_deposit" class="tab-pane fade in active">				      
							      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
							      </p>
							      <div class="transaction">
								  	<h3>transaction</h3>
								  	<p class="transaction-detail"></p>
							  	</div>
							    </div>
							    <div id="litecoin_withdraw" class="tab-pane fade">				    
							      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							      <div class="transaction">
								  	<h3>transaction</h3>
								  	<p class="transaction-detail"></p>
							  	</div>
							    </div>
							    <div id="litecoin_send" class="tab-pane fade">				      
							      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
							      <div class="transaction">
								  	<h3>transaction</h3>
								  	<p class="transaction-detail"></p>
							  	</div>
							    </div>				    
						  	</div>
						  	
						</div>
				    </div>
				    <div id="bittcoin-bal" class="tab-pane fade">				    
				     <span class="title">balance</span><br>
						<span class="amount"> <img src="images/bitcoin-logo.png"> 10000</span>
						<div class="graph">
							
							<script type="text/javascript">
								new TradingView.widget({
									"autosize": true,
									"symbol": "COINBASE:BTCUSD",
									"interval": "D",
									"timezone": "Etc/UTC",
									"theme": "Light",
									"style": "2",
									"locale": "en",
									"toolbar_bg": "#f1f3f6",
									"enable_publishing": false,
									"hide_top_toolbar": false,
									"allow_symbol_change": true,
									"hideideas": true
								});
							</script>

						</div>
						<div class="currency-circulation">				
							<ul class="nav nav-tabs">
							    <li class="active"><a data-toggle="tab" href="#bittcoin_deposit">deposit</a></li>
							    <li><a data-toggle="tab" href="#bittcoin_withdraw">withdraw</a></li>
							    <li><a data-toggle="tab" href="#bittcoin_send">send</a></li>				     
							</ul>
							<div class="tab-content">
							    <div id="bittcoin_deposit" class="tab-pane fade in active">				      
							      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							      <div class="transaction">
								  	<h3>transaction</h3>
								  	<p class="transaction-detail"></p>
							  	</div>
							    </div>
							    <div id="bittcoin_withdraw" class="tab-pane fade">				    
							      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							      <div class="transaction">
								  	<h3>transaction</h3>
								  	<p class="transaction-detail"></p>
							  	</div>
							    </div>
							    <div id="bittcoin_send" class="tab-pane fade">				      
							      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
							      <div class="transaction">
								  	<h3>transaction</h3>
								  	<p class="transaction-detail"></p>
							  	</div>
							    </div>				    
						  	</div>
						  	
						</div>
				    </div>
				    <div id="etherumcoin-bal" class="tab-pane fade">				      
				     <span class="title">balance</span><br>
						<span class="amount"> <img src="images/ethereum-small.png"> 20000</span>
						<div class="graph">
							
							<script type="text/javascript">
								new TradingView.widget({
									"autosize": true,
									"symbol": "COINBASE:ETHUSD",
									"interval": "D",
									"timezone": "Etc/UTC",
									"theme": "Light",
									"style": "2",
									"locale": "en",
									"toolbar_bg": "#f1f3f6",
									"enable_publishing": false,
									"hide_top_toolbar": false,
									"allow_symbol_change": true,
									"hideideas": true
								});
							</script>
						</div>
						<div class="currency-circulation">				
							<ul class="nav nav-tabs">
							    <li class="active"><a data-toggle="tab" data-href="#etherumcoin_deposit">deposit</a></li>
							    <li><a data-toggle="tab" data-href="#etherumcoin_withdraw">withdraw</a></li>
							    <li><a data-toggle="tab" data-href="#etherumcoin_send">send</a></li>				     
							</ul>
							<div class="tab-content">
							    <div id="etherumcoin_deposit" class="tab-pane fade in active">				      
							      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							      <div class="transaction">
									  	<h3>transaction</h3>
									  	<p class="transaction-detail"></p>
						  			</div>
							    </div>
							    <div id="etherumcoin_withdraw" class="tab-pane fade">				    
							      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							      <div class="transaction">
								  	<h3>transaction</h3>
								  	<p class="transaction-detail"></p>
							  	</div>
							    </div>
							    <div id="etherumcoin_send" class="tab-pane fade">				      
							      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
							      <div class="transaction">
								  	<h3>transaction</h3>
								  	<p class="transaction-detail"></p>
							  	</div>
							    </div>				    
						  	</div>
						  	
						</div>
				    </div>				    
			  	</div>
			</div>

			
			
		</div>
	</div>
</section>
<?php include('footer.php'); ?>
