<?php
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
include 'gamesApi.php';

error_reporting(E_ALL);
ini_set('display_errors', 'On');

function addPlus($string){
	return str_replace(" ", "+", $string);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/*$title = "";
$titleErr = "";
$api = "";
$_SESSION['searchResults'] = "";
$_SESSION['error'] = "";
$mtApi = getImdb($title, $ApiKey);
$vgApi = findGame($title);*/
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
$_SESSION['mediaName'] = $_GET['search'];
if(isset($_GET['searchBtn'])){
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		if(empty($_GET['search'])){

		}else{
			$mTitle = addPlus($_GET['search']);
			$data2 = getImdbRecord($mTitle, $ApiKey);
			$poster = getPoster($mTitle, $ApiKey);
			if($data2['Title'] != $_GET['search']){
				//$movieTitleErr = "Please enter a valid title";
				//$_SESSION['titleErr'] = $movieTitleErr;
				//header('location: index.php');
				$gameTitle = $_GET['search'];
			$gameResults = findGame($gameTitle);
			if($gameTitle != $gameResults->name){
				$gameTitleErr = 'Please enter a valid game title';
				$_SESSION['gameErr'] = $gameTitleErr;
				header('location: index.php');
			}else{
				$_SESSION['vgSearchResults'] = $gameResults;
				if($db->query($sql2) === TRUE){
					header('location: searchAllResults.php');
				}else{
					$gameID = $gameResults->id;
					$gTitle = $gameResults->name;
					$releaseDate = $gameResults->released;
					$sql3 = "INSERT INTO videogames (gameID, title, releaseDate) VALUES ('$gameID', '$gTitle', '$releaseDate')";
					$db->query($sql3);
					header('location: searchAllResults.php');
				}
				
			}
			}else{
				$_SESSION['mtSearchResults'] = $data2;
				if($db->query($sql) === TRUE){
					header('location: searchAllResults.php');
				}else{
					$imdbID = $data2['imdbID'];
					$year = $data2['Year'];
					$title = $data2['Title'];
					$type = $data2['Type'];
					$sql2 = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$imdbID', '$year', '$title','$type')";
					$db->query($sql2);
					header('location: searchAllResults.php');

				}		
				
			}
		}
	}
}

?>