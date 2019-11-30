<?php
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
include 'gamesApi.php';

function addPlus($string){
	return str_replace(" ", "+", $string);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$title = "";
$titleErr = "";
$api = "";
$_SESSION['searchResults'];
$_SESSION['error'];

if(isset($_GET['searchBtn'])){
	if(empty($_GET['search'])){
		$titleErr = "Please enter a title";
	}else{
		$title = $_GET['search'];
		$mtTitle = addPlus($_GET['search']);
		$vTitle = $title;
		$mtApi = getImdb($mtTitle, $ApiKey);
		$vgApi = findGame($vTitle);
		if($title != $api['Title'] && $title != $vgApi->name){
			$titleErr = "Please enter a valid Movie, Tv or video game title";
			$_SESSION['error'] = $titleErr;
			header('location: index.php');
		}else{
			if($title == $mtApi['Title']){
				$sql = "SELECT title FROM moviestv WHERE title = '$title'";
				if($db->query($sql) === TRUE){
					$_SESSION['searchResults'] = $mtApi;
					header('location: searchAllResults.php');
				}else{
					$imdbID = $data2['imdbID'];
					$year = $data2['Year'];
					$mtTitle = $data2['Title'];
					$type = $data2['Type'];
					$sql2 = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$imdbID', '$year', '$mtTitle', '$type')";
					$db->query($sql2);
					header('location: searchAllResults.php');
				}
			}else($title == $vgApi->name){
				$sql3 = "SELECT title FROM videogames WHERE title = '$title'";
				if($db->query($sql3)){
					$_SESSION['searchResults'] = $vgApi;
					header('location: searchAllResults.php');
				}else{
					$gameID = $gameResults->id;
					$gTitle = $gameResults->name;
					$releaseDate = $gameResults->released;
					$sql4 = "INSERT INTO videogames (gameID, title, releaseDate) VALUES ('$gameID', '$gTitle', '$releaseDate')";
					$_SESSION['searchResults'] = $vgApi;
					header('location: searchAllResults.php');
				}
			}
		}
	}
}
?>