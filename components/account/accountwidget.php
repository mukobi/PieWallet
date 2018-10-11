<div id="account-widget" class="dashbox">
    <link rel="stylesheet" href="../../css/widgets/accountwidget.css" />
    <div class="profile-info">
        <div class="picture">
            <img src='<?php echo ($tg_photo_url ? $tg_photo_url . "';" : "../images/users/genericprofile.png") ?>' />
        </div>
        <div id="account-info">
            <h4><?php echo ($tg_first_name . ($tg_last_name ? " " . $tg_last_name : "")) ?></h4>
            <div class="follow-count-section">
                <p class="link-element follow-count" onClick="popUpFollows('followers', <?php echo $tg_id ?>)"><?php echo count($myFollowers) ?><br>followers</p>
                <p class="link-element follow-count" onClick="popUpFollows('following', <?php echo $tg_id ?>)"><span id="follow-count"><?php echo count($myFollowing) ?></span><br>following</p>
                <script>
                function popUpFollows(type, id) {
                    changePopupWindowContents("");
                    getFollowsHTML(type, id, changePopupWindowContents);
                    showPopupWindow();
                }
                </script>
            </div>
        </div>
        <div id="balance">
            Balance:<br>
            $864.253
        </div>
        <div id="telegram">
            Telegram:<br>
            <?php echo ($tg_username ? "<a href='https://t.me/" . $tg_username . "' class='link-element username'>@" . $tg_username ."</a>" : "") ?>
        </div>
    </div>
    <div class="buttons">
        <a href="#" class="button">Wallets</a>
        <a href="#" class="button">Settings</a>
        <a href="#" class="button">Friends</a>
    </div>
    <?php include("components/popup-window.php"); ?>
</div>