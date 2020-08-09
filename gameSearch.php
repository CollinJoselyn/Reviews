<?php
/*
When the user clicks on one of the game titles on the videoGames.php page and the results.php page,
it will be processed by this page. This will search the games api for the given title and after 
that search it will send the user to gamesSearchResults.php page.
*/

session_start();
require 'dbconnection.php';
require 'gamesApi.php';
require 'inputFilters.php';


$gbTitle = "";
if(isset($_GET['gamePage'])){ //if the user clicks on one of the titles on the videoGames.php page
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['gamePage'];  //session variable that contains the game title
		$gameTitle = $_GET['gamePage']; //contains the game title 
			$gameResults = findGame($gameTitle); //searches the api for the game title
				$_SESSION['gameInfo'] = $gameResults; //session variable with game data
				$sql = "SELECT title FROM videogames WHERE title = '$gameTitle'";
				if($db->query($sql) === TRUE){ //check database if the game title is in it
					header('location: gamesSearchResults.php'); //sends user to gamesSearchResults.php
				}else{ //if not in database then add to it 
					$gameID = $gameResults->id;
					$gTitle = $gameResults->name;
					$releaseDate = $gameResults->released;
					$sql2 = "INSERT INTO videogames (gameID, title, releaseDate) VALUES ('$gameID', '$gTitle', '$releaseDate')";
					$db->query($sql2);
					header('location: gamesSearchResults.php'); //sends user to gamesSearchResults.php
				}
				
			}
	}

	if(isset($_GET['vgButtons'])){ //if the user clicks on one of the game titles from results.php
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['vgButtons'];  //session variable that contains the game title
		$gameTitle = $_GET['vgButtons']; //contains the game title 
			$gameResults = findGame($gameTitle); //search the api for the game title 
				$_SESSION['gamesSearchResults'] = $gameResults; //session variable that contains the data for the given game title
				unset($_SESSION['gameInfo']); //unsets the gameInfo session variable
				$sql = "SELECT title FROM videogames WHERE title = '$gameTitle'";
				if($db->query($sql) === TRUE){ //check the database to see if the game is in there
					header('location: gamesSearchResults.php'); //send user to gamesSearchResults.php
				}else{ //if not in database then add it to it 
					$gameID = $gameResults->id;
					$gTitle = $gameResults->name;
					$releaseDate = $gameResults->released;
					$sql2 = "INSERT INTO videogames (gameID, title, releaseDate) VALUES ('$gameID', '$gTitle', '$releaseDate')";
					$db->query($sql2);
					header('location: gamesSearchResults.php'); //send user to gamesSearchResults.php
				}
				
			}
	}




?>