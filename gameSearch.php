<?php
session_start();
require 'dbconnection.php';
require 'gamesApi.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$gameTitle = "";
$gameTitleErr = "";
$gameResults = findGame($gameTitle);
$_SESSION['gameInfo'] = "";
$_SESSION['gameErr'] = "";
$sql = "SELECT title FROM videogames WHERE title = '$gameTitle'";
if(isset($_GET['gSearchBtn'])){
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		if(empty($_GET['gameTitle'])){
			$gameTitleErr = "Please enter a game title";
		}else{
			$gameTitle = $_GET['gameTitle'];
			$gameResults = findGame($gameTitle);
			if($gameTitle != $gameResults->name){
				$gameTitleErr = 'Please enter a valid game title';
				$_SESSION['gameErr'] = $gameTitleErr;
				header('location: videoGames.php');
			}else{
				$_SESSION['gameInfo'] = $gameResults;
				if($db->query($sql) === TRUE){
					header('location: gamesSearchResults.php');
				}else{
					$gameID = $gameResults->id;
					$gTitle = $gameResults->name;
					$releaseDate = $gameResults->released;
					$sql2 = "INSERT INTO videogames (gameID, title, releaseDate) VALUES ('$gameID', '$gTitle', '$releaseDate')";
					$db->query($sql2);
					header('location: gamesSearchResults.php');
				}
				
			}
		}
	}
}



?>