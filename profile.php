<?php 
	include('header.php'); 
	$cur_path = dirname(__FILE__);
	//require_once "$cur_path/block_io.php";
	//require_once 'block_io_creds.php'; 
?>
<style>
.radio-btns-type span{
	padding:8px;
}
</style>
<section class="dashboard-wrapper wrapit">	
	<div class="">
		<div class="container">
			<?php 
			echo "<h1>Account</h1>";
			$session_user = $_SESSION['ud_login']['pro_id'];
			if(!empty($session_user)){
				$stmt1= "SELECT id,bitcoin_address,bitcoin_private_key,litecoin_private_key, litecoin_address FROM `ls_users` WHERE id=".$session_user."; ";
				$result1 = $conn->query($stmt1);
				$from_result = $result1->fetch_object();
				$from_bitcoin = $from_result->bitcoin_address;
				$from_litecoin = $from_result->litecoin_address;
			}
			if($session_user == NULL || $session_user != $_GET['id']){
				$profile_id = $_GET['id'];
				$stmt= "SELECT user_img, bitcoin_address, litecoin_address FROM `ls_users` WHERE id='".$profile_id."'; ";
				$result = $conn->query($stmt);
				$row= $result->fetch_object();
				$user_img = $row->user_img;
				$litecoin_qr = isset($row->litecoin_address)&& !empty($row->litecoin_address)?$row->litecoin_address.".png":"blank-qr.png";
				$bitcoin_qr = isset($row->bitcoin_address)&& !empty($row->bitcoin_address)?$row->bitcoin_address.".png":"blank-qr.png";
				$user_img1 = json_encode($user_img);
				if(!empty($profile_id)){
				?>
				<div class="row" id="sendAmthere" >
					<div class="col-lg-4 text-center">
						<h3>Litecoin QR code</h3>
						<img src="address-qr-codes/litecoin/<?php echo $litecoin_qr; ?>">
					</div>
					<div class="col-lg-4 text-center">
						<img class="rv_user_img" id="user_img" src="images/users/<?php echo $user_img; ?>">
					</div>	
					<div class="col-lg-4 text-center">
						<h3>Bitcoin QR code</h3>
						<img src="address-qr-codes/bitcoin/<?php echo $bitcoin_qr; ?>">
					</div>
					<div class="col-lg-12 text-center">
						<?php 
						$session_user = $_SESSION['ud_login']['pro_id'];
						if($session_user != NULL){
							$profile_id = $_GET['id'];
							$stmt= "SELECT id,bitcoin_address, litecoin_address FROM `ls_users` WHERE id='".$profile_id."'; ";
							$result = $conn->query($stmt);
							$to_result = $result->fetch_object();
							$to_bitcoin = $to_result->bitcoin_address;
							$to_litecoin = $to_result->litecoin_address;
						}
						?>
					</div>	
					<div class="col-lg-3 text-center" style="margin: 30px auto 0;" >
						<?php 
						if(isset($_GET['id'])){
							$profile_id = $_GET['id'];
							$stmt = " SELECT  * FROM ls_users WHERE id = '".$profile_id."'; ";
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
								echo "<h2 class=\"user_name\">" . $name .  "</h2>";
								/*follow / unfollow start*/
								$followTo = $_GET['id'];
								$followBy = $_SESSION['ud_login']['pro_id'] ;
								$current_timestamp = date("Y-m-d H:i:s");
								//echo $current_timestamp;
								$already_followBy = "SELECT * FROM `ls_followers` WHERE (followBy = '".$followBy."' AND followTo = '".$followTo."')";
								$result = $conn->query($already_followBy);
								$row = $result->fetch_object();
								if($row ){
									echo '<form style="width: 100px; float: left;" action="" method="post">
								  	<input type="hidden" name="action" value="unfollowed" />';
									echo '<input id="unfollowed" type="submit" class="btn btn-primary space" name="unfollowed" value="UnFollow">';
									echo '</form>';
								}else{
									echo '<form style="width: 100px; float: left;" action="" method="post">
								  	<input type="hidden" name="action" value="followed" />';
									echo '<input id="followed" type="submit" class="btn btn-primary space" name="followed" value="Follow">';
									echo '</form>';
								} ?>
								<!-- follow / unfollow close -->
								<a class='btn btn-primary' style='float: right;' <?php if(!empty($session_user)){ ?> id='sendAmt' <?php } ?>> Send Coin </a>
							<?php }
						}
						?>
					</div>	
				</div>
			<?php
				}
			}
			else{
			?>
			<div class="row">
				<div class="col-lg-3 user-image">
					<?php 
						$profile_id = $_GET['id'];
						$stmt= "SELECT user_img FROM `ls_users` WHERE id='".$profile_id."'; ";
						$result = $conn->query($stmt);
						$row= $result->fetch_object();
						$user_img = $row->user_img;
					?>
					<img class="rv_user_img" id="user_img" src="images/users/<?php echo $user_img; ?>">
					<div id="filelist"></div>
					<br/>
					<div id="container" class="pic_upld">
					    <a id="pickfiles" href="javascript:;"><i class="fa fa-camera" aria-hidden="true"></i></a>
					</div>
					<br />
					<pre id="console"></pre>
				</div>	
				<div class="col-lg-3 user-content" style="border-right:1px solid #007bff">
					<?php 
						$profile_id = $_SESSION['ud_login']['pro_id'] ;
						$email = $_SESSION['ud_login']['email'] ;
						$firstname = $_SESSION['ud_login']['firstname'] ;
						$lastname = $_SESSION['ud_login']['lastname'] ;
						echo "<h2 class='user_name'>". $firstname ." ". $lastname ."</h2>";
						echo "<a class='btn btn-primary following-btn' href='following.php?id=".$profile_id."' id='following' >Following</a><br/><br/>";
					?>
					<button type="button" class='btn btn-primary get-keys' data-toggle="modal" data-target="#show-keys-modal">Get Keys</button><br>
					<span class="title">Balance: </span><br>
					<span class="amount">
						<ul class="amount-container">
							<li>
								<img src="images/litecoin.svg">
								<span id="amount-lite-coin">0 LTC</span>
							</li>
							<li>
								<img src="images/bitcoin.png">
								<span id="amount-bit-coin">0 BTC</span>
							</li>
						</ul>						
					</span>
				</div>	
				<div class="col-lg-6">
				    <div class="proTab btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="..."> 
				        <div class="btn-group" role="group">
				            <button type="button" id="account" class="btn btn-primary" href="#tab1" data-toggle="tab">
				                <div class="hidden-xs">Account Settings</div>
				            </button>
				        </div>
				        <div class="btn-group" role="group">
				            <button type="button" id="password" class="btn btn-default" href="#tab2" data-toggle="tab">
				                <div class="hidden-xs">Change Password</div>
				            </button>
				        </div>
				        <div class="btn-group" role="group">
				            <button type="button" id="privacy" class="btn btn-default" href="#tab3" data-toggle="tab">
				                <div class="hidden-xs">Privacy Settings</div>
				            </button>
				        </div>
				        <div class="btn-group" role="group">
				            <button type="button" id="delete" class="btn btn-default" href="#tab4" data-toggle="tab">
				                <div class="hidden-xs">Delete Account</div>
				            </button>
				        </div>
				    </div>
				    <div class="well">
				      	<div class="tab-content">
				        	<div class="tab-pane fade in active" id="tab1">
				          		<h3 class="rV_title">Account Settings</h3>
			          			<form id="account_form" action="" method="post">
			          				<input type="hidden" name="action" value="acc_frm" />
									<div class="row">
										<div class="col-sm-6 mb-12 form-group">
											<input type="text" name="user" class="form-control" placeholder="Nickname" required>
										</div>
										<div class="col-sm-6 mb-12 form-group">
											<input type="text" name="email" class="form-control" placeholder="Email" required>
										</div>
										<div class="col-sm-6 mb-12 form-group">
											<input type="text" name="firstname" class="form-control" placeholder="First name" required>
										</div>
										<div class="col-sm-6 mb-12 form-group">
											<input type="text" name="lastname" class="form-control" placeholder="Last name" required>
										</div>
										<div class="col-sm-12 submit-btn">
											<button id="update1" type="submit" class="btn btn-primary" name="update" value="Update"> Update </button>
										</div>
									</div>
								</form>
				        	</div>
				        	<div class="tab-pane fade in" id="tab2">
				          		<h3 class="rV_title">Change Password</h3>
				          		<form action="" method="post">
				          			<input type="hidden" name="action" value="pass_updt" />
									<div class="row">
										<div class="col-sm-12 mb-12 form-group">
											<input type="password" name="current_pass" class="form-control" placeholder="Current Password" required>
										</div>
										<div class="col-sm-6 mb-12 form-group">
											<input type="password" name="new_pass" class="form-control" placeholder="New Password" required>
										</div>
										<div class="col-sm-6 mb-12 form-group">
											<input type="password" name="confirm_pass" class="form-control" placeholder="Confirm Password" required>
										</div>
										<div class="col-sm-12 submit-btn">
											<input id="update2" type="submit" class="btn btn-primary" name="update" value="Change password">
										</div>
									</div>
						 		</form>
				        	</div>
				        	<div class="tab-pane fade in" id="tab3">
				          		<h3 class="rV_title">Privacy Settings</h3>
				          		<form action="" method="post">
									<div class="row">
										<input type="hidden" name="action" value="privacy" />
										<div class="col-sm-6 mb-12 form-group">
											<label>Hide my profile from directory</label>
										</div>
										<?php 
										$profile_id = $_GET['id'];
										$stmt = " SELECT  hide_profile FROM ls_users WHERE id = ".$profile_id."; ";
										$result = $conn->query($stmt);
										while( $row = $result->fetch_assoc() ){
										?>
											<div class="col-sm-3 mb-12 form-group">
												<input type="radio" name="hide" class="form-control" value="0" <?php if($row['hide_profile'] == "0") echo "checked";?> ><h4 class="text-center">No</h4>
											</div>
											<div class="col-sm-3 mb-12 form-group">
												<input type="radio" name="hide" class="form-control" value="1" <?php if($row['hide_profile'] == "1") echo "checked";?> ><h4 class="text-center">Yes</h4>
											</div>								
										<?php 
										} ?>
										<div class="col-sm-12 submit-btn">
											<input id="update3" type="submit" class="btn btn-primary" name="update" value="Update">
										</div>
									</div>
						   		</form>
				        	</div>
				        	<div class="tab-pane fade in" id="tab4">
				          		<h3 class="rV_title">Delete Account</h3>
				          		<form action="" method="post">
				          			<input type="hidden" name="action" value="dlt_acc" />
									<div class="row">
										<div class="col-sm-6 mb-12 form-group">
											<label>Are you sure you want to delete your account? This will erase all of your data</label>
										</div>
										<div class="col-sm-6 mb-12 form-group">
											<input type="password" name="enter_pass" class="form-control" placeholder="Enter Your Password" required>
										</div>
										<div class="col-sm-12 submit-btn">
											<input id="update4" type="submit" class="btn btn-primary" name="dlt" value="Delete my account">
										</div>
									</div>
						   		</form>
				        	</div>
				      	</div>
				    </div>
					<!--vertical tabs panel close-->
				</div>			
			</div>
			<div class="row transaction-wrap">
				<div class="col-lg-12">
					<style>
						#paging a,#paging span {
						    font-size: 34px !important;
						}
						ul{margin: 0; padding: 0}
						li{list-style: none;}
						.nav ul {
						    text-align: center;
						    margin: auto;
						    padding-top: 17px;
						}
						.nav ul li{display: inline-block;margin:0px 5px; }
						.nav ul li a{ font-size: 14px; text-decoration: none; padding: 9px 15px; display:inline-block;color:black; font-weight: 600; background-color: #fff;border-radius:4px;}
						.nav ul li a:hover{ background-color:#007bff;color: white;transition:0.3s; }
						.nav li.current a {
						    background: #007bff;
						    color:#fff;
						}
					</style>
					<h3>Latest transactions</h3>
					<div class="table-responsive" style="overflow-x: scroll;">
						<table class="table">
							<thead>
								<tr>
									<th class="type">Coin</th>
									<th class="type">Type</th>
									<th class="time">Time</th>
									<th class="amount">Amount (+fee)</th>
									<th class="from user">From</th>
									<th class="to user">To</th>
									<th class="txid">Tx ID</th>
									<!-- <th class="confirmations">Confirmations</th> -->
								</tr>
							</thead>
							<?php
								$profile_id = $_SESSION['ud_login']['pro_id'] ;


								$page = isset($_GET["page"]) ? $_GET['page'] : 1;
      							$page = $page-1;
						       	$post_per_page   = 20;
						       	$offset = $page * $post_per_page;
						       	$total = "SELECT count(*) as count
									FROM ls_transactions tr
									left join ls_users sender
										on sender.id = tr.sender_id
									left join ls_users receiver
										on receiver.id = tr.receiver_id
									where tr.sender_id = ".$profile_id." or tr.receiver_id = ".$profile_id ;
								$result = $conn->query($total);
								$row_cnt = $result->fetch_assoc();
								$count = $row_cnt['count'];
						       	$required_pages  = ceil($count/$post_per_page);
								$stmt = "SELECT tr.type,tr.sender_id,tr.receiver_id,tr.amount,tr.transaction_id,tr.created, sender.email as sender_email, receiver.email as receiver_email,
									CASE 
										WHEN tr.sender_id = ".$profile_id." THEN 'Sent' 
										WHEN tr.receiver_id = ".$profile_id." THEN 'Received' 
									END  as status, 
									CASE 
										WHEN tr.type =1
										THEN  'Bitcoin'
										WHEN tr.type =2
										THEN  'Litecoin'
									END AS coin_type
									FROM ls_transactions tr
									left join ls_users sender
										on sender.id = tr.sender_id
									left join ls_users receiver
										on receiver.id = tr.receiver_id
									where tr.sender_id = ".$profile_id." or tr.receiver_id = ".$profile_id." LIMIT ".$offset." , ".$post_per_page;
								$result = $conn->query($stmt);
							?>
							<tbody data-bind="">
								<?php
								if ( $result->num_rows > 0 ) {
									while($row = $result->fetch_assoc()){ ?>
									<tr>
										<td><?php echo $row['coin_type']; ?></td>
										<td><?php echo $row['status']; ?></td>
										<td><?php echo date('d F Y H:i:s',strtotime($row['created'])); ?></td>
										<td>
											<?php 
											if($row['coin_type']=='Bitcoin'){
												echo $row['amount'] + 10000;
											}
											else{
												echo $row['amount'] + 100000;
											} ?>
										</td>
										<td><?php echo $row['sender_email']; ?></td>
										<td><?php echo $row['receiver_email']; ?></td>
										<td><?php echo $row['transaction_id']; ?></td>
									</tr>
								<?php
									}
								}
								else { ?>
								<tr>
									<td colspan="10">
								    	<?php echo "No transactions yet..."; ?>
								    </td>
								</tr>
								<?php }
								?>
							</tbody>
						</table>
					</div>
					<?php
						echo "<div class='nav'><ul>";
    					for ($i=1; $i <= $required_pages; $i++){ 
							$isActive = ( isset($_GET["page"])  &&  $_GET['page'] == $i) || ($page == $i-1 )   ? 'current': '';
							echo "<li class='".$isActive."'><a href='?id=".$_GET['id']."&page=".$i."' >".$i."</a></li>";
						}
      					echo "</ul></div>";
						?>
				</div>
			</div>
			<?php 
			}
			?>
		</div>
	</div>
</section>
<div class="modal fade" id="show-keys-modal" role="dialog">
    <div class="modal-dialog modal-lg">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Private Key Details</h4>
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
        	</div>
        	<div class="modal-body">
          		<div class="Show-address">
          			Bitcoin: <strong><?php echo $from_result->bitcoin_private_key; ?></strong>
          		</div>
          		<div class="Show-address">
          			Litecoin: <strong><?php echo $from_result->litecoin_private_key; ?></strong>
          		</div>
        	</div>
        	<div class="modal-footer">
          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	</div>
      	</div>
    </div>
</div>
<script  type="text/javascript">
	function save_ajax_call(options){
		var deferred = $.Deferred();
		$.ajax({
			type:'POST',
			data:options,
			url:'save_transaction.php',
			success:function(resp){
				if(resp==1){
					return deferred.resolve(true);
				}
				else{
					return deferred.resolve(false);
				}
			},
			error:function(){
				return deferred.resolve(false);
			}
		})
		return deferred.promise();
	}
	function get_balance_of_coins(){
		var bitcoin_address = '<?php echo $from_result->bitcoin_address; ?>';
		var litecoin_address = '<?php echo $from_result->litecoin_address; ?>';
		var getData_bitcoin = obj.get_total_balance_bitcoin(bitcoin_address);
		var getData_litecoin = obj.get_total_balance_litecoin(litecoin_address);
		getData_bitcoin.done(function(balance){
			$('#amount-bit-coin').html(balance+' BTC');
		});
		getData_litecoin.done(function(balance){
			$('#amount-lite-coin').html(balance+ ' LTC');
		});
	}
	$(document).ready(function() {
		get_balance_of_coins();
		$(".btn-pref .btn").click(function () {
			$(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
			$(this).removeClass("btn-default").addClass("btn-primary");   
		});
		$(document).on('click','#send-transaction',function(){
			var radioValue = $("input[name='amount_type']:checked").val();
			var amount = $('#btc_amount').val();
			if(amount==''){
				$('#transaction-error').html('Please enter amount..');
				return false;
			}
			else{
				$('#send-transaction').attr("disabled", "disabled");
				if(amount!='' && radioValue=='btc'){
					if (!isNaN(amount) && amount.toString().indexOf('.') != -1)
					{
						amount = convertOBJ.convert_bitcoins(amount,'btc','satoshi');
					}
					console.log(amount);
					$('#transaction-error').html('');
					var from_address = '<?php echo $from_result->bitcoin_address; ?>';
					var to_address = '<?php echo $to_result->bitcoin_address; ?>';
					var from_private_key = '<?php echo $from_result->bitcoin_private_key; ?>';
					var result = obj.bitcoin_transaction(from_address,from_private_key,to_address,amount);
					result.done(function(txnid){
			  			var saveData = {
			  				'action'         : 'save_transaction_data',
			  				'type'           : 1,
			  				'sender_id'      : '<?php echo $from_result->id; ?>',
			  				'receiver_id'    : '<?php echo $to_result->id; ?>',
			  				'amount'         : amount,
			  				'transaction_id' : txnid
			  			};
			  			var resultData = save_ajax_call(saveData);
			  			resultData.done(function(resp){
			  				$('#btc_amount').val('');
			  				$('#send-transaction').removeAttr("disabled");
			  				alert("Bitcoins Sent successfully. Transaction id: "+txnid);
			  			})
			  			.fail(function(error) {
					    	$('#transaction-error').html(error);
					    	setTimeout(function(){
					    		$('#transaction-error').html('');
					    	},5000);
					    	$('#btc_amount').val('');
				  			$('#send-transaction').removeAttr("disabled");
					  	});
					})
					.fail(function(error) {
				    	//alert(error);
				    	$('#transaction-error').html(error);
				    	$('#btc_amount').val('');
			  			$('#send-transaction').removeAttr("disabled");
				  	});
				}
				if(amount!='' && radioValue=='ltc'){
					if (!isNaN(amount) && amount.toString().indexOf('.') != -1)
					{
						amount = convertOBJ.convert_litecoins(amount,'ltc','litoshi');
					}
					console.log(amount);
					$('#transaction-error').html('');
					if(amount >= 100000){
						var litecoin_from_address = '<?php echo $from_result->litecoin_address; ?>';
						var litecoin_to_address = '<?php echo $to_result->litecoin_address; ?>';
						var litecoin_from_private_key = '<?php echo $from_result->litecoin_private_key; ?>';
						var result1 = obj.litecoin_transaction(litecoin_from_address,litecoin_from_private_key,litecoin_to_address,amount);
						result1.done(function(data){
							var saveData = {
								'action'         : 'save_transaction_data',
				  				'type'           : 2,
				  				'sender_id'      : '<?php echo $from_result->id; ?>',
				  				'receiver_id'    : '<?php echo $to_result->id; ?>',
				  				'amount'         : amount,
				  				'transaction_id' : data
				  			};
				  			var resultData = save_ajax_call(saveData);
				  			resultData.done(function(resp){
				  				$('#btc_amount').val('');
				  				$('#send-transaction').removeAttr("disabled");
				  				alert("Litcoins Sent successfully. Transaction id: "+data);
				  			})
				  			.fail(function(error) {
						    	$('#transaction-error').html(error);
						    	setTimeout(function(){
						    		$('#transaction-error').html('');
						    	},5000);
						    	$('#btc_amount').val('');
					  			$('#send-transaction').removeAttr("disabled");
						  	});
						})
						.fail(function(error) {
					    	//alert(error);
					    	$('#transaction-error').html(error);
					    	setTimeout(function(){
					    		$('#transaction-error').html('');
					    	},5000);
		    				$('#btc_amount').val('');
		    	  			$('#send-transaction').removeAttr("disabled");
					  	});
					}
					else{
						$('#transaction-error').html("LTC amount should be greator than or equals to 0.001");
				    	setTimeout(function(){
				    		$('#transaction-error').html('');
				    	},5000);
	    				$('#btc_amount').val('');
	    	  			$('#send-transaction').removeAttr("disabled");
					}
				}
			}
		});
	});
	$("#sendAmt").one('click', function () { 
		$("#sendAmthere").append('<div class="col-lg-12 text-center" style="margin: .5rem;"><form name="form" action="javascript:;" method="get"><input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/><input type="hidden" name="to" value="<?php echo $to ?>"/><input type="hidden" name="from" value="<?php echo $from ?>"/><div class="radio-btns-type"><input type="radio" name="amount_type" class="amount-type" value="btc" checked><span>Bitcoin</span><input type="radio" name="amount_type" class="amount-type" value="ltc"><span>Litecoin</span></div><input type="text" style="padding: 4px 10px;" id="btc_amount" name="coin_amount_BTC" placeholder="Enter  amount..."/><button id="send-transaction" type="button" class="btn btn-primary space" name="confirm" value="Confirm"> Confirm </button></form><div id="transaction-error" style="color:red;"></div>');  
	});
</script>
<script type="text/javascript" src="js/plupload.full.min.js"></script>
<script type="text/javascript">
var uploader = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
    browse_button : 'pickfiles', // you can pass in id...
    container: document.getElementById('container'), // ... or DOM Element itself
    url : "upload.php?id=<?php echo $_GET['id'] ?>",
    filters : {
        max_file_size : '10mb',
        mime_types: [
            {title : "Image files", extensions : "jpg,gif,png"},
            {title : "Zip files", extensions : "zip"}
        ]
    },
	 resize: {
	  width: 215,
	  height: 215,
	  crop: true
	},
    // Flash settings
    flash_swf_url : '/plupload/js/Moxie.swf',
    // Silverlight settings
    silverlight_xap_url : '/plupload/js/Moxie.xap',
    init: {
        PostInit: function() {
            document.getElementById('filelist').innerHTML = '';
        },
 
        FilesAdded: function(up, files) {
            plupload.each(files, function(file) {
                document.getElementById('filelist').innerHTML += '<div style="display:none" id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				uploader.start();
            });
        },
        FileUploaded: function(up, file, info) {
				$response_data = info.response;
				$someArray = JSON.parse($response_data);
 			 	$val = $someArray.file;
 			 	console.log($val);
				document.getElementById("user_img").src="images/users/"+$val;
                alert('Your profile pic has been uploaded successfully');
        },
        UploadProgress: function(up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
        },
        Error: function(up, err) {
            document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
        }
    }
});
uploader.init();
</script>
<?php include('footer.php'); ?>