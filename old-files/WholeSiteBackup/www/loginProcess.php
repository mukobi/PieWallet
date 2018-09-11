<?php 
session_start();

if (isset($_POST['login'])) 
{
	$isValidData = check_valid_data($_POST);
	if (!$isValidData) {
		$_SESSION['msg']="Invalid input";
		header('location:login.php');
	}
	else{
		$conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "paypeer1_litespeed"); 
		if (mysqli_connect_errno()){
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else{
				$isUserExist = check_user_and_login($conn);
		}
	}
}

function check_valid_data($d){
	if ( empty(trim($d['password'])) ||	!filter_var(trim($d['email']), FILTER_VALIDATE_EMAIL)) {
		return false;
	}else{
		return true;
	}
}

function check_user_and_login($conn){
	$email = htmlspecialchars(trim($_POST['email']));
	if ($stmt = $conn->prepare("SELECT id, email, firstname, lastname, password, status FROM ls_users WHERE email=?")){
	    $stmt->bind_param("s", $email);
	    $stmt->execute();
	    $stmt->bind_result($id, $email, $firstname, $lastname, $password, $status);
	    $stmt->fetch();
	    if (NULL==$id){
			$stmt->close();
			$_SESSION['msg']="Invalid Email Or Password";
			header('location:login');
	    }
	    else{
	    	$stmt->close();
	    	if (password_verify(trim($_POST['password']), $password)) {
	    		if ($status=="inactive") {
	    			$_SESSION['msg']="Your account has not been activated yet, please verify your email first.";
					header('location:login');
	    		}else{
	    			if (isset($_SESSION['exchange_data'])) {
	    				$_SESSION['ud_login']['email']		= $email;
						$_SESSION['ud_login']['firstname']  = $firstname;
						$_SESSION['ud_login']['lastname']	= $lastname;
						$_SESSION['ud_login']['pro_id']	= $id;
						header('location:cart');	
	    			}else{
						$_SESSION['ud_login']['email']		= $email;
						$_SESSION['ud_login']['firstname']  = $firstname;
						$_SESSION['ud_login']['lastname']	= $lastname;
						$_SESSION['ud_login']['pro_id']	= $id;
						header("Location:http://paypeer.io/");
	    			}
	    		}
	    	}
	    	else{
	    		$_SESSION['msg']="Invalid Email Or Password";
				header('location:login');
	    	}
	    }
	}
}

