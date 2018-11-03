<?php

include_once('components/loginToDb.php');
include_once('components/handleTgLogin.php');

if(isset($_GET['action'])) { 

	if($_POST['action'] == 'unfollow'){
		$target_id = $_POST['id'];
		settype($target_id, 'integer');
		settype($tg_id, 'integer');

		$checkFollowStmt = "SELECT * FROM `follows` WHERE (follower_id = '".$tg_id."' AND following_id = '".$target_id."')";
		$result = $conn->query($checkFollowStmt);
		$row = $result->fetch_object();
		
		if($row){
			$stmt = " DELETE FROM `follows` WHERE (follower_id = '".$tg_id."' AND following_id = '".$target_id."')";
			$result = $conn->query($stmt);
			if(!$result) {
			 echo "<script> alert('Some error occured while unfollowing'); </script>" ;
			}else{
			 echo "<script> alert('Account has been unfollowed'); </script>";
			}
		}			
	}

	if($_POST['action'] == 'follow'){
		$target_id = $_POST['id'];
		settype($target_id, 'integer');
		settype($tg_id, 'integer');

		$current_timestamp = date("Y-m-d H:i:s");

		$checkFollowStmt = "SELECT * FROM `follows` WHERE (follower_id = '".$tg_id."' AND following_id = '".$target_id."')";
		$result = $conn->query($checkFollowStmt);
		$row = $result->fetch_object();

		if(!$row){
			$stmt = " INSERT into follows (follower_id, following_id, follow_date) VALUES ($tg_id ,$target_id, ' ".$current_timestamp." '); ";
			$result = $conn->query($stmt);
			if(!$result) {
			 echo "<script> alert('Some error occured while following'); </script>" ;
			}else{
			 echo "<script> alert('Account has been followed'); </script>";
			}
		}	
	}
}
else {
	header('Location:../index.php');
}

?>