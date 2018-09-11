<?php 
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
$cur_path = dirname(__FILE__);
//require_once "$cur_path/block_io.php";
function generateRandomString($length = 50) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// Signup process
if (isset($_POST['create_user'])) 
{
	//echo "<pre>"; print_r($_POST);die;
	$isValidData = check_valid_data($_POST);
	if (!$isValidData) {
		$_SESSION['msg']="all fields required/invalid input";
		header("Location:http://www.paypeer.io/");
	}
	else{
		$conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "paypeer1_litespeed");
		if (mysqli_connect_errno()){
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else{
			$isUserExist = check_user($conn);
			if ($isUserExist) {
				$_SESSION['msg']="The email address you have entered is already registered.";
				header('location:signup');
			}
		}
	}
}
function check_valid_data($d){
	if ( empty(trim($d['firstname'])) || 
		 empty(trim($d['lastname'])) || 
		 empty(trim($d['nickname'])) || 
		 empty(trim($d['signupEmail'])) || 
		 empty(trim($d['signupPassword'])) ||
		!filter_var(trim($d['signupEmail']), FILTER_VALIDATE_EMAIL)) {
		return false;
	}else{
		return true;
	}
}
function check_user($conn){
	$email = htmlspecialchars(trim($_POST['signupEmail']));
	if ($stmt = $conn->prepare("SELECT id FROM ls_users WHERE email=?")){
	    $stmt->bind_param("s", $email);
	    $stmt->execute();
	    $stmt->bind_result($id);
	    $stmt->fetch();
	    if (NULL==$id){
			$stmt->close();
			create_user($conn);
	    }else{
	    	$stmt->close();
	    	return true;
	    }
	}
}
function create_user($conn){
	$stmt = $conn->prepare("INSERT INTO ls_users (firstname, lastname, nickname, email, password, status, account_verify_token, user_img,bitcoin_private_key,bitcoin_address,litecoin_private_key, litecoin_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssssssssss", $firstname, $lastname, $nickname, $email, $password, $status, $account_verify_token, $user_img ,$bitcoin_private_key,$bitcoin_address,$litecoin_private_key,$litecoin_address );
	$firstname = htmlspecialchars(trim($_POST['firstname'])); 
	$lastname = htmlspecialchars(trim($_POST['lastname']));
	$nickname = htmlspecialchars(trim($_POST['nickname']));
	$email = htmlspecialchars(trim($_POST['signupEmail'])); 
	$status = "inactive";
	$password = password_hash(htmlspecialchars(trim($_POST['signupPassword'])), PASSWORD_DEFAULT);
	$account_verify_token = generateRandomString();
	$user_img = 'demo_user.jpg';
	$bitcoin_private_key = htmlspecialchars(trim($_POST['bitcoin_private_key']));
	$bitcoin_address = htmlspecialchars(trim($_POST['bitcoin_address']));
	$litecoin_private_key =htmlspecialchars(trim($_POST['litecoin_private_key']));
	$litecoin_address =htmlspecialchars(trim($_POST['litecoin_address']));
	get_QR_and_save($bitcoin_address, "b");
	get_QR_and_save($litecoin_address, "l");
	if ($stmt->execute()) {
		$stmt->close();
		$conn->close();
		send_account_verification($email, $account_verify_token,$firstname);
		$_SESSION['msg-success'] = 'Your account is Successfully created. Before you can login, you must active your account go to your email and activate your account';
		header('location:login');
	}else{
		$stmt->close();
		$conn->close();
		$_SESSION['msg']='Sorry, something went wrong creating your account. Please try again soon.';
		header('location:login');
	}
}
function send_account_verification($email, $token,$firstname){
	$to      = $email; // Send email to our user
	$subject = 'Welcome to PayPeer.io!'; // Give the email a subject 
	
	include 'email/signup.php';
	// Our message above including the link        
	$headers = 'From:PayPeer <support@paypeer.io>' . "\r\n"; // Set from headers
	mail($to, $subject, $message, $headers); // Send our email
	return;
}
function get_QR_and_save($address, $coin){
	if ($coin =="l") {
		$saveto = "address-qr-codes/litecoin/".$address.".png";
	}else{
		$saveto = "address-qr-codes/bitcoin/".$address.".png";
	}
	$url = "https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=".$address;
	$ch = curl_init ($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	$raw = curl_exec($ch);
	curl_close ($ch);
	if(file_exists($saveto)){
	    unlink($saveto);
	}
	$fp = fopen($saveto,'x');
	fwrite($fp, $raw);
	fclose($fp);
}