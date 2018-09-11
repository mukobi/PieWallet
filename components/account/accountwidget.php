<div id="account-widget" class="dashbox">
    <link rel="stylesheet" href="../../css/widgets/accountwidget.css" />
    <div class="picture" <?php echo ($tg_photo_url ? "style=\" background-image: url(" . $tg_photo_url . ");\"" : "") ?>>
    </div>
    <div class="profile-info">
        <h3><?php echo ($tg_first_name . ($tg_last_name ? " " . $tg_last_name : "")) ?></h3>
        <?php echo ($tg_username ? "<h4>@" . $tg_username ."</h4>" : "") ?>
        <p>Followers: 536</p>
        <p>Following: 75</p>
    </div>
    <div class="buttons">
        <div class="settings">
            <a href="#" class="button">Settings</a>
        </div>
        <div class="logout">
            <a href="?logout=1" class="button">Logout</a>
        </div>
    </div>
    <div class="search">
    </div>
    <div class="notifications">
    </div>
</div>