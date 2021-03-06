<?php session_start(); ?>
<?php 
ob_start();
//@session_start();
if(isset($_COOKIE['tg_user'])) {
	header("Location:index.php");
}
include_once('server/components/getTgBotInfo.php');
?>
<?php
echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
"http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <title>Login - PayPeer</title>
    <link rel="stylesheet" href="/css/style11.css">
    <link rel="stylesheet" href="/css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/TweenMax-latest-beta.js"></script>
</head>

<body>
    <div id="main-container" class="content-main login">
        <div id="moving-floor-canvas-container">
            <canvas id="moving-floor-canvas">
            </canvas>
        </div>
        <script src="js/moving-floor.js"></script>
        <div class="login-box">
            <img src="images/navigation/piewallet-long-logo.png" alt="Piewallet">
            <div>
            <script async src="https://telegram.org/js/telegram-widget.js?4" data-telegram-login="<?php echo TG_BOT_NAME ?>" data-size="large" data-auth-url="./server/processLogin.php" data-request-access="write"></script>
            </div>
        </div>
    </div>
</body>
</html>