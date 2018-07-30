<?php 
session_start();
$email = htmlspecialchars(trim($_GET['email']));
$token = htmlspecialchars(trim($_GET['t']));
if (isset($email) && isset($token) && !empty($email) && !empty($token) && strlen($token) == 50) {
	$conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "paypeer1_litespeed");
	if (mysqli_connect_errno()){
		echo "Error";;
		exit();
	}
	else{
			if ($stmt = $conn->prepare("SELECT status FROM ls_users WHERE email=? and account_verify_token =?")){
			    $stmt->bind_param("ss", $email, $token);
			    $stmt->execute();
			    $stmt->bind_result($status);
			    $stmt->fetch();
			    if (NULL==$status){
					$stmt->close();
					$_SESSION['msg']="Invalid account verification link please double check your account verification link.";
					header('location:login');					
			    }elseif($status =="active"){
					$_SESSION['msg-success']="Your account is already activated, you can now login";
					header('location:login');
			    }else{
			    	$stmt->close();
					$stmt = $conn->prepare("UPDATE ls_users SET status=?, account_verify_token=? WHERE email=? and account_verify_token=?");	
					$stmt->bind_param('ssss', $status, $account_verify_token_new, $email, $account_verify_token );
					$status = "active";
					$account_verify_token_new = NULL;					
					$account_verify_token = $token;					
					$status = $stmt->execute();
					if ($status === false) {
						trigger_error($stmt->error, E_USER_ERROR);
					}else{
						$_SESSION['msg-success']="Your account has been activated successfully, and you can now login.";
						header('location:login');
					}
		    	}
			}else{
					echo("Error...");
			}
		}	
}else{
	$_SESSION['msg']="Invalid account verification link please double check your account verification link.";
	header('location:http:login');
}



	
	

