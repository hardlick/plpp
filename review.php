<?php

require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
include_once './config/config.php';
$environment = db_config::$db_conection_config['baul']['environment'];
$url = 'url_' . $environment;
$urlBase = db_config::$db_conection_config['baul'][$url];

$fb = new \Facebook\Facebook([
    'app_id' => '670426636716311',
    'app_secret' => 'a40d3c4225b9603e3c092dea0807bd11',
    'default_graph_version' => 'v2.10',
    'default_access_token' => 'd946ad17b9d97586c5e0801cfed35817', // optional
        ]);
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$url = $helper->getLoginUrl("$urlBase/fb-callback.php", $permissions);

header( "Location: $url" );