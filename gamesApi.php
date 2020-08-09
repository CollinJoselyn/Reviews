<?php
/*
This script is for pulling data from the rawg api. This api gives 
the video game data for the site.
*/


require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;
set_time_limit(0); //This disables the loading time limit.

//This function is used to load game data.
function loadGameData($game) {
  $curl = new Curl();
  $curl->get("https://rawg.io/api/games/{$game->slug}");
  return $curl->response;
}

//This function searches the rawg api for a single game by title. 
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

//This searches the rawg api for games by title. This will return multiple results.
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
?>