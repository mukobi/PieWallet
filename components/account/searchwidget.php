<div class="searchwidget">
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
                foreach($searchResults as $result) {
                    echo "<div>" . $result['username'] . ' - ' . $result['name'] . "</div>";
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
    </div>	
</div>