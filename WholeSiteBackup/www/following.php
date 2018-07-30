<?php 
	include('header.php'); 
	$cur_path = dirname(__FILE__);
	//require_once "$cur_path/block_io.php";
	//require_once 'block_io_creds.php'; 
?>
<section class="dashboard-wrapper wrapit">	
	<div class="">
		<div class="container">
			
			<?php 
			$session_user = $_SESSION['ud_login']['pro_id'];

			if($session_user == NULL || $session_user != $_GET['id']){
			?>
				<div class="row showfollowing">
					<div class="col-lg-12">
						<h3>You are not logged to your profile...</h3>
					</div>
				</div>
			<?php
			}
			else{
			?>
				<div class="row showfollowing" style="margin-bottom: 50px;">
					<div class="col-lg-12">
						<h1 style="border-bottom:1px solid #fff;">Following</h1>
					</div>
					<?php 
						$followTo = $_GET['id'];
						$followBy = $_SESSION['ud_login']['pro_id'] ;
						
						$following = "SELECT * FROM `ls_followers` WHERE (followBy = '".$followBy."')";
						$result = $conn->query($following);
						//$row = $result->fetch_object();
						while( $row = $result->fetch_assoc() ){
							$following_id = $row['followTo'];
							$following_info = "SELECT * FROM `ls_users` WHERE (id = '".$following_id."')";
							$following_result = $conn->query($following_info);
							$following_row = $following_result->fetch_object();
							//print_r($following_row);
							$id 		= $following_row->id;
						    $firstname 	= $following_row->firstname;
						    $lastname 	= $following_row->lastname;
						    $fullname	= $firstname." ".$lastname;
						    $nickname 	= $following_row->nickname;
						    $email 		= $following_row->email;
						    $user_img  	= $following_row->user_img;
						    echo "<div class='col-lg-3 text-center' style='padding:30px 0'><a class='foll_profile' href='profile.php?id=".$id."'><img style='padding:15px;width:100px;height:100px;margin:0 auto;border-radius:50%' src='images/users/".$user_img."' /><h5 style='text-transform: capitalize;' >".$fullname." ( ".$nickname." )</h5></a></div>";
							
						}

					?>
				</div>
			<?php 
			}
			?>

		</div>
	</div>

</section>

<?php include('footer.php'); ?>