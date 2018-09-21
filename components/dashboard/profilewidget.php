<div id="profilewidget" class="dashbox">
    <link rel="stylesheet" href="../../css/profilewidget.css" />
    <div class="picture" <?php echo ($tg_photo_url ? "style=\"background-image: url(" . $tg_photo_url . ");\"" : "") ?>>
    </div>
    <div class="info">
        <h3><?php echo ($tg_first_name . ($tg_last_name ? " " . mb_substr($tg_last_name, 0, 1, 'utf-8') . ".": "")) ?></h3>
        <p class="link-element follow-count" onClick="popUpFollows('followers', <?php echo $tg_id ?>)">Followers: <?php echo count($myFollowers) ?></p>
        <p class="link-element follow-count" onClick="popUpFollows('following', <?php echo $tg_id ?>)">Following: <span id="follow-count"><?php echo count($myFollowing) ?></span></p>
        <script src="../../js/followFunctions.js"></script>	
        <script>
        function popUpFollows(type, id) {
            changePopupWindowContents("");
            getFollowsHTML(type, id, changePopupWindowContents);
            showPopupWindow();
        }
        </script>
    </div>
    <div class="portfolio">
        <p>Portfolio: $6379.42</p>
    </div>
    <div class="profile">
        <a href="#" class="button">Profile</a>
    </div>
    <div class="settings">
        <a href="#" class="button">Settings</a>
    </div>
    <div class="add-friends">
        <a href="#" class="button">+Add Friends</a>
    </div>
    <div class="logout">
        <a href="?logout=1" class="button">Logout</a>
    </div>
    <?php include('components/popup-window.php') ?>
</div>