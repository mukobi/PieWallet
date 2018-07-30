<?php 
session_start();
// Signup process
if (isset($_POST['resetPassword'])) 
{
	$isValidData = check_valid_data($_POST);	
	$conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "paypeer1_litespeed");
	if (mysqli_connect_errno()){
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	else{
		find_user($conn);
	}	
}

if (isset($_POST['setNewPassword'])) 
{
	$isValidData = check_valid_data_newPassword($_POST);
	$conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "paypeer1_litespeed");
	if (mysqli_connect_errno()){
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	else{
		$stmt = $conn->prepare("UPDATE ls_users SET password = ? , password_reset_token = ?  WHERE email = ? AND password_reset_token = ?");
		$stmt->bind_param("ssss", $password, $password_reset_token_new, $email, $password_reset_token);
		$password_reset_token = htmlspecialchars(trim($_POST['token'])); 
		$password_reset_token_new = NULL; 
		$email = htmlspecialchars(trim($_POST['email'])); 
		$password = password_hash(htmlspecialchars(trim($_POST['newPassword'])), PASSWORD_DEFAULT);
		if ($stmt->execute()) {
			$stmt->close();
			$conn->close();
			send_password_change_mail($email);
			$_SESSION['msg-success'] = "Your account password is successfully changed.";
			header('location:login');
			exit();
		}else{
			$stmt->close();
			$conn->close();
			$_SESSION['msg']='Sorry, something went wrong while resetting your password. Please try again...';
			header('location:login');
		}
	}	
}


function generateRandomString($length = 60) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function check_valid_data($d){
	if ( empty(trim($d['email'])) || !filter_var(trim($d['email']), FILTER_VALIDATE_EMAIL)) {
		$_SESSION['msg']="Invalid input";
		header('location:forgotPassword');
		exit();
	}else{
		return true;
	}
}
function check_valid_data_newPassword($d){

	if ( empty(trim($d['newPassword']))) {
		$_SESSION['msg']="Invalid input";
		header("Refresh:0");
		exit();
	}else{
		return true;
	}
}

function find_user($conn){
	$email = htmlspecialchars(trim($_POST['email']));
	if ($stmt = $conn->prepare("SELECT id, firstname FROM ls_users WHERE email=?")){
	    $stmt->bind_param("s", $email);
	    $stmt->execute();
	    $stmt->bind_result($id, $firstname);
	    $stmt->fetch();
	    if (NULL==$id){
	    	$stmt->close();
	    	$_SESSION['msg-success']="If we find an account associated with the email you provided, instructions for resetting your password have been sent to that address. If you don't receive this email, check your junk mail folder or contact us in customer support for further assistance.";
			header('location:login');
	    }else{
				$stmt->close();
				reset_password($conn, $firstname);
	    }
	}
}

function reset_password($conn, $firstname){
	$stmt = $conn->prepare("UPDATE ls_users SET password_reset_token = ? WHERE email = ?");
	$stmt->bind_param("ss", $password_reset_token, $email);
	$password_reset_token = generateRandomString();
	$email = htmlspecialchars(trim($_POST['email'])); 
	if ($stmt->execute()) {
		$stmt->close();
		$conn->close();
		send_password_reset_mail($email, $firstname, $password_reset_token);
		$_SESSION['msg-success'] = "If we find an account associated with the email you provided, instructions for resetting your password have been sent to that address. If you don't receive this email, check your junk mail folder or contact us in customer support for further assistance.";
		header('location:login');
		exit();
	}else{
		$stmt->close();
		$conn->close();
		$_SESSION['msg']='Sorry, something went wrong while resetting your password. Please try again...';
		header('location:login');
	}
}

function send_password_reset_mail($email, $firstname, $token){
	$to      = $email; // Send email to our user
	$subject = 'Password Reset Request'; // Give the email a subject 
	include 'email/forget_password.php';
	$headers = 'From:PayPeer <support@paypeer.io>' . "\r\n"; // Set from headers
	$emailStatus = mail($to, $subject, $message, $headers); // Send our email	
	// var_dump($emailStatus);
	// die;
	return;
}
function send_password_change_mail($email){
	$to      = $email; // Send email to our user
	$subject = 'LiteSpeed | Password Changed'; // Give the email a subject 
	$message = 'Your LiteSpeed Account password is successfully changed

Thanks and Regards
LiteSpeed Team';	

	$headers = 'From:LiteSpeed <info@uniquecoders.in>' . "\r\n"; // Set from headers
	$emailStatus = mail($to, $subject, $message, $headers); // Send our email
	return;
}


