<?php

include_once('./components/getTgBotInfo.php');

function checkTelegramAuthorization($auth_data) {
  $check_hash = $auth_data['hash'];
  unset($auth_data['hash']);
  $data_check_arr = [];
  foreach ($auth_data as $key => $value) {
    $data_check_arr[] = $key . '=' . $value;
  }
  sort($data_check_arr);
  $data_check_string = implode("\n", $data_check_arr);
  $secret_key = hash('sha256', TG_BOT_TOKEN, true);
  $hash = hash_hmac('sha256', $data_check_string, $secret_key);
  if (strcmp($hash, $check_hash) !== 0) {
    throw new Exception('Data is NOT from Telegram');
  }
  if ((time() - $auth_data['auth_date']) > 86400) {
    throw new Exception('Data is outdated');
  }
  return $auth_data;
}

include_once('components/loginToDb.php');
include_once('components/pushToDb.php');

function saveTelegramUserDataCookie($auth_data) {
  $auth_data_json = json_encode($auth_data);
  // set cookie for 3 months
  setcookie('tg_user', $auth_data_json, time() + 7776000, '/');
}

try {
  $auth_data = checkTelegramAuthorization($_GET);
  saveTelegramUserDataCookie($auth_data);
  addUpdateUserInDb($conn, $auth_data);
} catch (Exception $e) {
  die ($e->getMessage());
}

header('Location:../index.php');

?>