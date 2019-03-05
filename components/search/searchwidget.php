<div class="searchwidget">
    <link rel="stylesheet" href="css/widgets/searchwidget.css">
    <form action="?search" method="get" class="search-bar-container">
        <h3>Search</h3>
        <input type="text" name="query" class="form-control search-bar" placeholder="Search users by name">
        <input type="submit" class="btn primary search-button" value="Search">
    </form>
    <div class="results">
        <?php
        if(isset($_GET['query'])){
            if(preg_match("/^[  a-zA-Z]+/", $_GET['query'])) {
                $name = $_GET['query'];
                
                $searchResults = searchForUsers($conn, $name);
                if(count($searchResults) == 0) {
                    echo "<h3>No results for '" . $name . "'</h3>";
                }
                foreach($searchResults as $result) {
                    // TODO remove self from results
                    $photoUrl = ($result['photo_url'] ? $result['photo_url'] : "/images/users/genericprofile.png");
                    echo 
                    "<div class='single-result'>"
                        . "<a class='to-profile link-element' href='profile.php?id=".$result['id']."'>"
                            . "<img src='" . $photoUrl . "' />"
                            . "<h4>" . $result['name'] . "</h4>"
                        . "</a>"
                        . "<p>@<a href='https://t.me/" . $result['username'] . "'>" . $result['username'] . "</a></p>"
                        . (in_array($result['id'], $myFollowing) 
                            ? "<a class='button unfollow' onclick=toggleFollow(this,".$result['id'].")>Unfollow</a>" 
                            : "<a class='button follow' onclick=toggleFollow(this,".$result['id'].")>Follow</a>") 
                    . "</div>";
                }
            }
            else{
                echo  "<p>Please enter a valid search query</p>";
            }
        }
        ?>	
        <script src="../../js/followFunctions.js"></script>	
    </div>	
</div>