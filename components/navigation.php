<div id="navigation-menu" class="genbox">
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/TweenMax-latest-beta.js"></script>
    <script>
        var colorsArray = ["#005ba1" ,"#704ac7", "#0e770a", "#7249c9", "#4286f4", "#c35bff", "#005972","#350072", "#0c58a5", "#d9a0ff", "#ce1257", "#67d4fc", "#4f0749", "#d4baff", "#00305e"];
        var gradientIndex = 1;
        function changeGradient() {
            var color1 = colorsArray[gradientIndex];
            var color2 = colorsArray[(gradientIndex + 1) % colorsArray.length];
            console.log(`${gradientIndex}:: 1: ${color1}, 2: ${color2}`);
            TweenMax.to("html", 5, {"--color1": color1, "--color2": color2});
            gradientIndex++;
            gradientIndex %= colorsArray.length;
        }
        setTimeout(changeGradient, 10);
        setInterval(changeGradient, 5000);
    </script>
    <div class="navicon headlogodiv">
        <a href="/">
            <img class="headlogo desktop" src="/images/header-logo2.png" />
        </a>
    </div>
    <div class="navicon empty"></div>
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
    <div class="navicon empty"></div>
    <div class="navicon login-logout">
        <a href="#">
            <img class="imgleft" src="/images/navigation/logout.png" />
            <p>LOGOUT</p>
        </a>
    </div>
</div>