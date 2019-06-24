<?php
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' => '1448141528671219',
  'app_secret' => '89a44d740dd1d24f038edf629d0d1dd1',
  'default_graph_version' => 'v3.3',
  'default_access_token' => 'abaf7536a812fca085d340112c0fbd38', // optional
]);

/* PHP SDK v5.0.0 */
/* make the API call */
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get(
    '/2924503311108158/visitor_posts',
    'EAAUlE7lmoZCMBAKdtuKEbNGQfbBJTceSL6yxNfmBMSWW2MtYl28IZC3V0Q1aHDqbTBYBl7cNnYCzZBMlH26vAS0bADZA2w8mZB59kwxkRd9lTyENuBMjMCwZByadZBrJCrTrZA2ZCcZAUkgCCKfOE3iOv5Q5e88kO9tbPo0iprQXuHEA4dyAeOsfkC'
  );
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
// If you have an old dev version of the official SDK
$graphEdge = $response->getGraphList();
// Or if you have the latest dev version of the official SDK
$graphEdge = $response->getGraphEdge();
var_dump($graphEdge);
die();
/* handle the result */