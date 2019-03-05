<div class="searchwidget">
    <?php include_once('components/account/getSingleResult.php'); ?>
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
                    echo getSingleResult($result, $myFollowing);
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