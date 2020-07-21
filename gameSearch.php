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
/*
$gameTitle = "";
$gameTitleErr = "";
$_SESSION['gameInfo'] = "";
$_SESSION['gameErr'] = "";
$sql = "SELECT title FROM videogames WHERE title = '$gameTitle'";
$_SESSION['mediaName'] = $_GET['gameTitle'];
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
}*/
$gbTitle = "";
if(isset($_GET['gamePage'])){
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['gamePage'];
		$gameTitle = $_GET['gamePage'];
			$gameResults = findGame($gameTitle);
				$_SESSION['gameInfo'] = $gameResults;
				$sql = "SELECT title FROM videogames WHERE title = '$gameTitle'";
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

	if(isset($_GET['vgButtons'])){
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['vgButtons'];
		$gameTitle = $_GET['vgButtons'];
			$gameResults = findGame($gameTitle);
				$_SESSION['gamesSearchResults'] = $gameResults;
				unset($_SESSION['gameInfo']);
				$sql = "SELECT title FROM videogames WHERE title = '$gameTitle'";
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




?>