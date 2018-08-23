<div id="header-mobile" class="header-mobile genbox">
    <div class="headlogodiv">
        <a href="/">
            <img class="headlogo mobile" src="/images/piewallet-long-logo.png" />
        </a>
    </div>
    <div class="login">
        <?php if (isset($_SESSION['ud_login'])): ?>
        <?php if($_SESSION['ud_login']['pro_id']==1){ ?>
        <span class="login-button">
            <!-- <a href="manage-faq.php">Manage FAQ</a> -->
            <a target="_blank" href="https://info.paypeer.io/">Manage FAQ</a>
        </span>
        <?php } ?>
        <span class="login-button">
            <a style="text-transform: capitalize;" href="<?php
            $profile_id = $_SESSION['ud_login']['pro_id'] ;
            echo 'profile.php?id='.$profile_id;
            ?>">
                <?php echo $_SESSION['ud_login']['firstname']; ?>
            </a>
            &nbsp;
            <a href="/logout.php">Logout</a>
        </span>

        <?php else : ?>
        <?php endif ?>

    </div>
</div>