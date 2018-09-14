<div class="searchwidget">
    <link rel="stylesheet" href="css/widgets/searchwidget.css">
    <form action="?search" method="get">
        <h3>Find Users</h3>
        <input type="text" name="query" class="form-control" placeholder="Search Users by Telegram Name">
        <input type="submit" class="button" value="Search">
    </form>
    <div class="results">
        <?php
        if(isset($_GET['query'])){
            if(preg_match("/^[  a-zA-Z]+/", $_GET['query'])) {
                $name = $_GET['query'];
                
                $searchResults = searchForUsers($conn, $name);
                if(count($searchResults) == 0) {
                    echo "<h3>No profiles found.</h3>";
                }
                foreach($searchResults as $result) {
                    $photoUrl = ($result['photo_url'] ? $result['photo_url'] : "/images/users/genericprofile.png");
                    echo 
                    "<div class='single-result'><img src='" . $photoUrl . "' />"
                        . "<h4>" . $result['name'] . "</h4>"
                        . "<p>@<a href='https://t.me/" . $result['username'] . "'>" . $result['username'] . "</a></p>"
                        . (in_array($result['id'], $myFollowing) 
                            ? "<a class='button unfollow' onclick=toggleFollow(this,".$result['id'].")>Unfollow</a>" 
                            : "<a class='button' onclick=toggleFollow(this,".$result['id'].")>Follow</a>") 
                    . "</div>";
                }
            }
            else{
                echo  "<p>Please enter a valid search query</p>";
            }
        }
        else {
            echo "<h3>Search for Piewallet users</h3>";
        }
        ?>	
        <script src="../../js/followFunctions.js"></script>	
    </div>	
</div>