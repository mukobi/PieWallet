<div id="single-profile-widget" class="dashbox">
    <link rel="stylesheet" href="../../css/widgets/singleprofilewidget.css" />
    <div class="picture-and-info">
        <div class="picture" <?php echo ($target_user['photo_url'] ? "style=\" background-image: url(" . $target_user['photo_url'] . ");\"" : "") ?>>
        </div>
        <div class="profile-info">
            <h2><?php echo $target_user['name'] ?></h2>
            <?php echo ($target_user['username'] ? "<h3><a class='username' href='https://t.me/" . $target_user['username'] . "'>@" . $target_user['username'] . "</a></h3>" : "") ?>
            <h4>Followers: <span id="follow-count"><?php echo count($target_user['followers']) ?></span></h4>
            <h4>Following: <?php echo count($target_user['following']) ?></h4>
        </div>
    </div>
    <div class="follow-button">
        <?php echo 
        (in_array($target_user['id'], $myFollowing) 
        ? "<a class='button unfollow' onclick=toggleFollow(this,".$target_user['id'].")>Unfollow</a>" 
        : "<a class='button follow' onclick=toggleFollow(this,".$target_user['id'].")>Follow</a>") 
        .
        (in_array($target_user['id'], $myFollowers)
        ? "<h4>".$target_user['name']." follows you</h4>"
        : "");
        ?>
        <script src="../../js/followFunctions.js"></script>
    </div>
    <div class="coin-addresses">
        <h3>Public Addresses:</h3>
        <div class="btc">
            <h4>BTC: <?php echo $target_user['btc_address'] != "" ? $target_user['btc_address'] : "no wallet created" ?></h4>
        </div>
        <div class="ltc">
            <h4>LTC: <?php echo $target_user['ltc_address'] != "" ? $target_user['ltc_address'] : "no wallet created" ?></h4>
        </div>
        <div class="eth">
            <h4>ETH: <?php echo $target_user['eth_address'] != "" ? $target_user['eth_address'] : "no wallet created" ?></h4>
        </div>
    </div>  
</div>