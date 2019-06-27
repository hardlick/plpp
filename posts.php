<?php
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' => '1448141528671219',
  'app_secret' => '89a44d740dd1d24f038edf629d0d1dd1',
  'default_graph_version' => 'v3.3',
  'default_access_token' => 'abaf7536a812fca085d340112c0fbd38', // optional
]);
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';