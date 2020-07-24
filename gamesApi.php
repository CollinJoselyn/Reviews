<?php

require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;
set_time_limit(0);
function loadGameData($game) {
  $curl = new Curl();
  $curl->get("https://rawg.io/api/games/{$game->slug}");
  return $curl->response;
}

function findGame($name) {
  $curl = new Curl();
  $curl->get("https://rawg.io/api/games", [
    'search' => $name,
  ]);
  
  if ($curl->response->count > 0) {
    $firstGame = $curl->response->results[0];
   
    return loadGameData($firstGame);
  }
  
  return null;
}

function findGames($name) {
  $curl = new Curl();
  $curl->get("https://rawg.io/api/games", [
    'search' => $name,
    'page_size' => 15,
  ]);
  
  $games = [];
  
  foreach($curl->response->results as $game) {
    $games[] = loadGameData($game);
  }
  
  return $games;
}

curl_setopt($curl, CURLOPT_TIMEOUT_MS, 2000);
/*
for($i = 0; $i < $length; $i++){
  echo $result[$i]->name;
  echo '<br>';
}*/
/*
$result = findGame("The Last of Us Part II");
echo '<pre>';
print_r($result);
echo '</pre>'; 
if($result){
  echo 'It is true';
}else{
  echo 'it is false';
} */
//echo $result->name;
//echo $result->background_image;
?>