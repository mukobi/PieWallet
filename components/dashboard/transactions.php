<div id="transactions" class="dashbox genbox balancebox">
    <h3>Transaction History</h3>
    </br>
    <div id="balance-content">
        <?php
        if ( !mysqli_connect_errno() && isset($_SESSION['ud_login'])){

        $email = $_SESSION['ud_login']['email'] ;
        $stmt = " SELECT label from ls_users where email LIKE '".$email."'; " ;
        $result = $conn->query($stmt);
        if ( $result->num_rows > 0 ) {
            $row = $result->fetch_assoc();
            echo '<img src="images/litecoin.svg"> ';
            ?>
            <span id="amount-lite-coin">0 LTC</span>
            <?php	echo '  /  <img src="images/bitcoin.png"> '; ?>
                <span id="amount-bit-coin">0 BTC</span>
                <?php	
        }
            else {
                echo "Please login to see your balance";
            }
        }
        else {
            echo "Please login to see your balance";
        }
        ?>
    </div>
    <div class="placeholder-history">
        <ul class="balancetable">
            <li>
                <p>Transaction 1</p>
            </li>
            <li>
                <p>Transaction 2</p>
            </li>
            <li>
                <p>Transaction 3</p>
            </li>
            <li>
                <p>Transaction 4</p>
            </li>
            <li>
                <p>Transaction 5</p>
            </li>
            <li>
                <p>Transaction 6</p>
            </li>
            <li>
                <p>Transaction 7</p>
            </li>
            <li>
                <p>Transaction 8</p>
            </li>
            <li>
                <p>Transaction 9</p>
            </li>
            <li>
                <p>Transaction 10</p>
            </li>
            <li>
                <p>Transaction 11</p>
            </li>
            <li>
                <p>Transaction 12</p>
            </li>
            <li>
                <p>Transaction 13</p>
            </li>
            <li>
                <p>Transaction 14</p>
            </li>
            <li>
                <p>Transaction 15</p>
            </li>
            <li>
                <p>Transaction 16</p>
            </li>
            <li>
                <p>Transaction 17</p>
            </li>
            <li>
                <p>Transaction 18</p>
            </li>
            <li>
                <p>Transaction 19</p>
            </li>
            <li>
                <p>Transaction 20</p>
            </li>
            <li>
                <p>Transaction 21</p>
            </li>
            <li>
                <p>Transaction 22</p>
            </li>
            <li>
                <p>Transaction 23</p>
            </li>
            <li>
                <p>Transaction 24</p>
            </li>
            <li>
                <p>Transaction 25</p>
            </li>
            <li>
                <p>Transaction 26</p>
            </li>
            <li>
                <p>Transaction 27</p>
            </li>
            <li>
                <p>Transaction 28</p>
            </li>
            <li>
                <p>Transaction 29</p>
            </li>
            <li>
                <p>Transaction 30</p>
            </li>
        </ul>
    </div>
</div>