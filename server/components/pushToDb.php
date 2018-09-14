<?php
function addUpdateUserInDb($conn, $user) {
    settype($user['id'], 'integer');
    mysqli_report(MYSQLI_REPORT_ALL);
    $stmt = $conn->prepare("
    INSERT INTO `users` (`id`, `username`, `name`, `photo_url`, `btc_address`, `ltc_address`, `etc_address`) VALUES (?, ?, ?, ?, '', '', '')
    ON DUPLICATE KEY UPDATE 
        username = ?, 
        name = ?, 
        photo_url = ?
    ");
    $name = $user['first_name'] . ($user['last_name'] ? ' '.$user['last_name'] : '');
    $stmt->bind_param('issssss', 
        $user['id'], 
        $user['username'], 
        $name, 
        $user['photo_url'], 
        $user['username'], 
        $user['name'], 
        $user['photo_url']);
    $output = array();
    $stmt->execute();
}
?>