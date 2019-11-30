<?php

require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

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

$result = findGame("Pulp Fiction");
/*
echo '<pre>';
print_r($result);
echo '</pre>';
if($result){
  echo 'It is true';
}else{
  echo 'it is false';
}*/
//echo $result->name;
//echo $result->background_image;
?>