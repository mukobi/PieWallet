<?php
	if(!empty($_POST) && $_POST['action']=="save_transaction_data"){
		$conn = new mysqli("localhost", "paypeer1_lite1", "wwOpF+T3bDl&", "paypeer1_litespeed");
		$stmt = $conn->prepare("INSERT INTO ls_transactions (type, sender_id, receiver_id, amount, transaction_id, created) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssss", $type, $sender_id, $receiver_id, $amount, $transaction_id, $created);
		$type           = $_POST['type'];
		$sender_id      = $_POST['sender_id'];
		$receiver_id    = $_POST['receiver_id'];
		$amount         = $_POST['amount'];
		$transaction_id = $_POST['transaction_id'];
		$created        = date('Y-m-d H:i:s');
		if ($stmt->execute()) {
			$stmt->close();
			$conn->close();
			echo 1;die;
		}else{
			$stmt->close();
			$conn->close();
			echo 0;die;
		}
	}
?>