<?php
function addUpdateUserInDb($conn, $user) {
    settype($user['id'], 'integer');
    mysqli_report(MYSQLI_REPORT_ALL);
    $stmt = $conn->prepare("
    INSERT INTO `users` (`id`, `username`, `name`, `photo_url`, `btc_address`, `ltc_address`, `eth_address`) VALUES (?, ?, ?, ?, '', '', '')
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
        $name, 
        $user['photo_url']);
    $output = array();
    $stmt->execute();
}

function updateAddressesInDb($conn, $user, $btc, $eth, $ltc) {
    settype($user['id'], 'integer');
    mysqli_report(MYSQLI_REPORT_ALL);
    $stmt = $conn->prepare("
    UPDATE `users` SET `btc_address` = ?, `ltc_address` = ?, `eth_address` = ? 
        WHERE `users`.`id` = ?;
    ");
    $stmt->bind_param('sssi', 
        $btc,
        $ltc,
        $eth,
        $user['id']); 
    $output = array();
    $stmt->execute();
}
?>