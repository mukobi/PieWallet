<?php

if(!isset($_COOKIE['tg_user'])) {
	header('Location:login.php');
}

// if ($_GET['logout']) {
//   setcookie('tg_user', '');
//   header('Location:login.php');
// }

function getTelegramUserData() {
    if (isset($_COOKIE['tg_user'])) {
        $auth_data_json = urldecode($_COOKIE['tg_user']);
        $auth_data = json_decode($auth_data_json, true);
        return $auth_data;
    }
        return false;
}

$tg_user = getTelegramUserData();
if ($tg_user !== false) {
    $id = (isset($tg_user['id']) ? htmlspecialchars($tg_user['id']) : false);
    $first_name = (isset($tg_user['id']) ? htmlspecialchars($tg_user['first_name']) : false);
    $last_name = (isset($tg_user['last_name']) ? htmlspecialchars($tg_user['last_name']) : false);
    $username = (isset($tg_user['username']) ? htmlspecialchars($tg_user['username']) : false);
    $photo_url = (isset($tg_user['photo_url']) ? htmlspecialchars($tg_user['photo_url']) : false);
    $auth_date = (isset($tg_user['auth_date']) ? htmlspecialchars($tg_user['auth_date']) : false);
} else {
    // no login cookie found
    header('Location: login.php');
}

?>