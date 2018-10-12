<?php

include_once("server/components/handleTgLogin.php");
include_once("server/components/loginToDb.php");
include_once("server/queryDbSocial.php");

$target_user = null;
if(!isset($_GET['id'])) {
    header('Location:account.php');
}
else {
    $target_id = $_GET['id'];
    settype($target_id, 'integer');
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param('i', $target_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result != false && $result->num_rows === 1) {
        $target_user = $result->fetch_assoc();
    }
    else {
        echo "<script type='text/javascript'>
            alert('Invalid user id, search for users from the account page.');
            window.location.href='account.php';
            </script>";
    }
}
if($target_user === null) {
    header('Location:account.php');
}

$target_user['followers'] = getFollowersIDs($conn, $target_user['id']);
$target_user['following'] = getFollowingIDs($conn, $target_user['id']);

echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
    "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

	<head>
		<title>Profile - PayPeer.io</title>
		<link rel="stylesheet" href="/css/style11.css">
		<link rel="stylesheet" href="/css/profile.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>
		<div id="main-container" class="content-main profile">
			<?php include_once("components/navigation.php"); ?>
			<?php include_once("components/account/singleprofilewidget.php"); ?>
		</div>
	</body>
</html>