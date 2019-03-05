<?php
function getSingleResult($user, $myFollowing) {
    $photoUrl = ($user['photo_url'] ? $user['photo_url'] : "../../images/users/genericprofile.png");
    return 
    "<div class='single-result'>"
        . "<a class='to-profile link-element' href='profile.php?id=".$user['id']."'>"
            . "<img src='" . $photoUrl . "' />"
            . "<h4>" . $user['name'] . "</h4>"
        . "</a>"
        . "<p class='username'><a href='https://t.me/" . $user['username'] . "'>@" . $user['username'] . "</a></p>"
        . (in_array($user['id'], $myFollowing) 
            ? "<a class='button unfollow' onclick=toggleFollow(this,".$user['id'].")>Unfollow</a>" 
            : "<a class='button follow' onclick=toggleFollow(this,".$user['id'].")>Follow</a>") 
    . "</div>";
}
?>