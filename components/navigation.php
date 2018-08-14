<div id="navigation-menu" class="genbox">
    <div class="navicon active dashboard">
        <a href="/">
            <img class="imgleft" src="/images/navigation/dashboard.png" />
            <p>DASHBOARD</p>
        </a>
    </div>
    <div class="navicon exchange">
        <a href="/exchange.php">
            <img class="imgleft" src="/images/navigation/exchange.png" />
            <p>EXCHANGE</p>
        </a>
    </div>
    <div class="navicon chat">
        <a href="/send.php">
            <img class="imgleft" src="/images/navigation/chat.png" />
            <p>CHAT</p>
        </a>
    </div>
    <div class="navicon account">
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