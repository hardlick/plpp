<?php

require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
include_once './config/config.php';
$environment = db_config::$db_conection_config['baul']['environment'];
$url = 'url_' . $environment;
$urlBase = db_config::$db_conection_config['baul'][$url];

$fb = new \Facebook\Facebook([
    'app_id' => '1448141528671219',
    'app_secret' => '89a44d740dd1d24f038edf629d0d1dd1',
    'default_graph_version' => 'v3.3'
        ]);
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$url = $helper->getLoginUrl("$urlBase/fb-callback.php", $permissions);

header( "Location: $url" );