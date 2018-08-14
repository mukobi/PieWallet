<div id="navigation-menu" class="genbox">
    <div class="navicon dashboard 
        <?php if(basename($_SERVER['PHP_SELF']) == "index.php") {
            echo "active";
        } ?>">
        <a href="/">
            <img class="imgleft" src="/images/navigation/dashboard.png" />
            <p>DASHBOARD</p>
            
        </a>
    </div>
    <div class="navicon exchange 
        <?php if(basename($_SERVER['PHP_SELF']) == "exchange.php") {
            echo "active";
        } ?>">
        <a href="/exchange.php">
            <img class="imgleft" src="/images/navigation/exchange.png" />
            <p>EXCHANGE</p>
        </a>
    </div>
    <div class="navicon chat 
        <?php if(basename($_SERVER['PHP_SELF']) == "chat.php") {
            echo "active";
        } ?>">
        <a href="/send.php 
        <?php if(basename($_SERVER['PHP_SELF']) == "send.php") {
            echo "active";
        } ?>">
            <img class="imgleft" src="/images/navigation/chat.png" />
            <p>CHAT</p>
        </a>
    </div>
    <div class="navicon account 
        <?php if(basename($_SERVER['PHP_SELF']) == "account.php") {
            echo "active";
        } ?>">
        <?php
            if ( !mysqli_connect_errno()  && isset($_SESSION['ud_login'])){
                $email = $_SESSION['ud_login']['email'] ;
                $stmt = " SELECT label from ls_users where email LIKE '".$email."'; " ;
                $result = $conn->query($stmt);
                if ( $result->num_rows > 0 ) {
                    echo '<a href="/account.php">' ;
                } else {
                    echo '<a href="/login.php">' ;
                }
            } else {
                echo '<a href="/login.php">' ;
            }
        ?>
        <img class="imgleft" src="/images/navigation/account.png" />
        <p>ACCOUNT</p>
        </a>
    </div>
    <div class="navicon login-logout">
        <a href="#">
            <img class="imgleft" src="/images/navigation/logout.png" />
            <p>LOGOUT</p>
        </a>
    </div>
</div>