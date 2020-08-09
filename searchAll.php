<?php
/*
This script is used to search from the index page. When the user types into the search bar and hits 
search on the index page, it sends that search to this page.THis searches for both movies/tv and video games.
After it searches for the movie/tv and/or video game, it will send the user to the 
searchAllResults.php page.
*/
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
include 'gamesApi.php';
include 'inputFilters.php';

error_reporting(E_ALL);
ini_set('display_errors', 'On');



$movieTitle = "";
$movieTitleErr = "";
$mTitle = "";
$data2 = getImdbRecord($mTitle, $ApiKey);
$poster = getPoster($mTitle, $ApiKey);
$_SESSION['mTitle'] = "";
$_SESSION['titleErr'] = "";
$sql = "SELECT title FROM moviestv WHERE title = '$movieTitle'";
$gameTitle = "";
$gameTitleErr = "";
$_SESSION['gameInfo'] = "";
$_SESSION['gameErr'] = "";
$sql2 = "SELECT title FROM videogames WHERE title = '$gameTitle'";
$_SESSION['mediaName'] = $_GET['search'];  // session variable that contains the name of the game/tv/movie



if(isset($_GET['rButtons'])){ //if user clicks on one of the movie/tv results from results.php
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$_SESSION['mediaName'] = $_GET['rButtons'];  //session variable that contains the name of the title the user click on
		$mtTitle = addPlus($_GET['rButtons']);  //replaces whitespace with +
		$mtInfo = getImdbRecord($mtTitle, $ApiKey); //gets data on the movie/tv title
		$sqlS = "SELECT title FROM moviestv WHERE title = '$mtTitle'";
		$_SESSION['mtSearchResults'] = $mtInfo;  //sesson variable that contains the data on the movie/tv title
		if($db->query($sqlS) === TRUE){  //check if the title is in the database
			header('location: searchAllResults.php'); //sends the user to searchAllResults.php which they view the data for the given title
		}else{ //if the title is not in the database then it adds it
			$imdbID = $mtInfo['imdbID'];
			$year = $mtInfo['Year'];
			$title = $mtInfo['Title'];
			$type = $mtInfo['Type'];
			$sqlS = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$imdbID', '$year', '$title','$type')";
			$db->query($sqlS);
			header('location: searchAllResults.php'); //sends the user to searchAllResults.php which they view the data for the given title
		}
	}
}

if(isset($_GET['cButtons'])){  //if user clicks on one of the video game results from results.php
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['cButtons']; //session variable that contains the name of the title the user click on
		$gameTitle = $_GET['cButtons']; //name of the game title
			$gameResults = findGame($gameTitle);  //contains the data for the given game title
				$_SESSION['vgSearchResults'] = $gameResults; //session variable that contains the data for the given game title
				$sql = "SELECT title FROM videogames WHERE title = '$gameTitle'";
				if($db->query($sql) === TRUE){  //check if the title is in the database
					header('location: searchAllResults.php');  //sends the user to searchAllResults.php which they view the data for the given title
				}else{  //if the title is not in the database then it adds it
					$gameID = $gameResults->id;
					$gTitle = $gameResults->name;
					$releaseDate = $gameResults->released;
					$sql2 = "INSERT INTO videogames (gameID, title, releaseDate) VALUES ('$gameID', '$gTitle', '$releaseDate')";
					$db->query($sql2);
					header('location: searchAllResults.php');  //sends the user to searchAllResults.php which they view the data for the given title
				}
				
			}
	}

?>