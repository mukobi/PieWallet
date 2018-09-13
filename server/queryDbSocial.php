<?php

function getFollowersIDs($conn, $user_id) {
    $query = "SELECT u.*
    FROM users u INNER JOIN follows
    ON follows.follower_id=u.id
    WHERE follows.following_id=$user_id";
    $output = array();
    $result = $conn->query($query);
    if($result != false) {
        while( $row = $result->fetch_assoc() ){
            array_push($output, $row['id']);
        }
    }
    return $output;
}

function getFollowingIDs($conn, $user_id) {
    $query = "SELECT u.*
    FROM users u INNER JOIN follows
    ON follows.following=u.id
    WHERE follows.follower=$user_id";
    $output = array();
    $result = $conn->query($query);
    if($result != false) {
        while( $row = $result->fetch_assoc() ){
            array_push($output, $row['id']);
        }
    }
    return $output;
}

$myFollowers = getFollowersIDs($conn, $tg_id);
$myFollowing = getFollowingIDs($conn, $tg_id);

?>