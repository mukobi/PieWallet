<div id="account-widget" class="dashbox">
    <link rel="stylesheet" href="../../css/widgets/accountwidget.css" />
    <div class="picture" <?php echo ($tg_photo_url ? "style=\" background-image: url(" . $tg_photo_url . ");\"" : "") ?>>
    </div>
    <div class="profile-info">
        <h3><?php echo ($tg_first_name . ($tg_last_name ? " " . $tg_last_name : "")) ?></h3>
        <?php echo ($tg_username ? "<a href='https://t.me/" . $tg_username . "' class='link-element username'>@" . $tg_username ."</a>" : "") ?>
        <br>
        <p class="link-element follow-count" onClick="popUpFollows('followers', <?php echo $tg_id ?>)">Followers: <?php echo count($myFollowers) ?></p>
        <br>
        <p class="link-element follow-count">Following: <span id="follow-count"><?php echo count($myFollowing) ?></span></p>
        <script>
        function popUpFollows(type, id) {
            getFollowsHTML(type, id, changePopupWindowContents);
            showPopupWindow();
        }
        </script>
    </div>
    <div class="buttons">
        <div>
            <a href="#" class="button">Wallets</a>
            <a href="#" class="button">Settings</a>
        </div>
        <div>
            <a href="?logout=1" class="button">Logout</a>
        </div>
    </div>
    <div class="search dashbox">
        <?php include('searchwidget.php'); ?>
    </div>
    <div class="notifications dashbox">
        <?php include('notificationswidget.php'); ?>
    </div>
    <?php include('components/popup-window.php') ?>
</div>