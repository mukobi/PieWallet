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
    ON follows.following_id=u.id
    WHERE follows.follower_id=$user_id";
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

function getUsersObjectsById($conn, $user_id_array) {
    $output = array();
    foreach ($user_id_array as $user_id) {
        settype($user_id, 'integer');
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result != false) {
            while( $row = $result->fetch_assoc() ){
                array_push($output, $row);
            }
        }
    }
    return $output;
}

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