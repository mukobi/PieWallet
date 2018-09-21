<?php
include_once('components/loginToDb.php');
include_once('components/handleTgLogin.php');
include_once('queryDbSocial.php');

if(isset($_GET['type']) && isset($_GET['id'])) { 
	if($_GET['type'] == 'followers'){
        $myFollowers = getFollowersIDs($conn, $_GET['id']);
        $myFollowersObjects = getUsersObjectsById($conn, $myFollowers);
        foreach($myFollowersObjects as $user) {
            $photoUrl = ($user['photo_url'] ? $user['photo_url'] : "/images/users/genericprofile.png");
            echo 
            "<div class='single-result'>"
                . "<a class='to-profile link-element' href='profile.php?id=".$user['id']."'>"
                    . "<img src='" . $photoUrl . "' />"
                    . "<h4>" . $user['name'] . "</h4>"
                . "</a>"
                . "<p>@<a href='https://t.me/" . $user['username'] . "'>" . $user['username'] . "</a></p>"
                . (in_array($user['id'], $myFollowing) 
                    ? "<a class='button unfollow' onclick=toggleFollow(this,".$user['id'].")>Unfollow</a>" 
                    : "<a class='button' onclick=toggleFollow(this,".$user['id'].")>Follow</a>") 
            . "</div>";
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