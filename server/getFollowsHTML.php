<?php
include_once('components/loginToDb.php');
include_once('components/handleTgLogin.php');
include_once('queryDbSocial.php');
include_once('../components/account/getSingleResult.php');

if(isset($_GET['type']) && isset($_GET['id'])) { 
	if($_GET['type'] == 'followers') {
        $myFollowers = getFollowersIDs($conn, $_GET['id']);
        $myFollowing = getFollowingIDs($conn, $_GET['id']);
        $myFollowersObjects = getUsersObjectsById($conn, $myFollowers);
        foreach($myFollowersObjects as $user) {
            echo getSingleResult($user, $myFollowing);
        }
    }
    elseif($_GET['type'] == 'following') {
        $myFollowing = getFollowingIDs($conn, $_GET['id']);
        $myFollowingObjects = getUsersObjectsById($conn, $myFollowing);
        foreach($myFollowingObjects as $user) {
            echo getSingleResult($user, $myFollowing);
        }
    }
    else {
        echo "No results found";
    }
}
else {
	echo "No results found";
}

?>