<div class="searchwidget">
    <form action="?go" method="post">
        <h3>Find Users</h3>
        <input type="text" name="nickname" class="form-control" placeholder="Search Users by Telegram Name">
        <input type="submit" class="button" name="search" value="Search">
    </form>
    <div class="results">
        <?php
        if(isset($_POST['search'])){
            if(isset($_GET['go'])){
                if(preg_match("/^[  a-zA-Z]+/", $_POST['nickname'])) {
                $name = $_POST['nickname'];

                $stmt = " SELECT  * FROM ls_users WHERE nickname LIKE '%" . $name .  "%'; ";
                $result = $conn->query($stmt);
                while( $row = $result->fetch_assoc() ){
                    $id = $row['id'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $name = $firstname . " " . $lastname;
                    $nickname = $row['nickname'];
                    $email = $row['email'];
                    $label = $row['label'];
                    $address = $row['address'];

                    echo "<ul class='search_results' >";
                    echo "<li>
                    <a class='search_result' href='profile.php?id=$id'>" . $nickname . "</a>
                    </li>";
                    echo "</ul>";
                    }
                }
                else{
                    echo  "<p>Please enter a search query</p>";
                }
            }
        }

        ?>		
    </div>	
</div>