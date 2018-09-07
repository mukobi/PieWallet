<div id="profilewidget" class="dashbox">
    <link rel="stylesheet" href="../../css/profilewidget.css" />
    <div class="picture" <?php echo ($tg_photo_url ? "style=\"background-image: url(" . $tg_photo_url . ");\"" : "") ?>>
    </div>
    <div class="info">
        <h3><?php echo ($tg_first_name . ($tg_last_name ? " " . mb_substr($tg_last_name, 0, 1, 'utf-8') . ".": "")) ?></h3>
        <p>Followers: 536</p>
        <p>Following: 75</p>
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
</div>