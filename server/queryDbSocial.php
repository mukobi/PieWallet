<?php

function getFollowersIDs($conn, $user_id) {
    settype($user_id, 'integer');
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
    settype($user_id, 'integer');
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


function searchForUsers($conn, $searchName) {
    $searchName = "%" . $searchName . "%";
    $stmt = $conn->prepare("SELECT * FROM users WHERE username LIKE ? OR name LIKE ?");
    $stmt->bind_param('ss', $searchName, $searchName);
    $output = array();
    $stmt->execute();
    $result = $stmt->get_result();
    if($result != false) {
        while( $row = $result->fetch_assoc() ){
            array_push($output, $row);
        }
    }
    return $output;
}

?>