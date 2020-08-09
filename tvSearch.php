<?php
/*
This script searches the omdb api for the tv show the user typed into the search field on tv.php or
the title they clicked on in tv.php. After it searches it then sends the user to tvSearchResults.php.
*/
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
include 'inputFilters.php';

$tTitle = "";
if(isset($_GET['tButtons'])){ //if user clicks on one of the tv show titles from results.php page. tv.php -> results.php -> this page
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['tButtons']; //session variable that contains the tv show title 
		$tTitle = addPlus($_GET['tButtons']); //replaces whitespace with a +
		$tvInfo = getImdbRecord($tTitle, $ApiKey); //searches api for tv show title
		$sqlS = "SELECT title FROM moviestv WHERE title = '$tTitle'";
		$_SESSION['tPageButton'] = $tvInfo; //session variable that contains data for the tv show that the user searched for on tv.php
		if($db->query($sqlS) === TRUE){ //checks the database to see if the tv show is in it
			header('location: tvSearchResults.php'); //sends user to tvSearchResults.php page
		}else{ //if tv show isn't in the database then add it to it
			$imdbID = $tvInfo['imdbID'];
			$year = $tvInfo['Year'];
			$title = $tvInfo['Title'];
			$type = $tvInfo['Type'];
			$sqlS = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$imdbID', '$year', '$title','$type')";
			$db->query($sqlS);
			header('location: tvSearchResults.php'); //sends user to tvSearchResults.php page
		}
	}
}

if(isset($_GET['tvPage'])){ //if the user clicks on one of the tv title on the tv.php page. 
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['tvPage']; //session variable that contains the tv show title 
		$tTitle = addPlus($_GET['tvPage']); //replaces whitespace with a +
		$tvInfo = getImdbRecord($tTitle, $ApiKey); //searches api for tv show title
		$sqlS = "SELECT title FROM moviestv WHERE title = '$tTitle'";
		$_SESSION['tTitle'] = $tvInfo; //session variable that contains tv show data from the show the user clicked on in tv.php page
		if($db->query($sqlS) === TRUE){ //checks the database to see if the tv show is in it
			header('location: tvSearchResults.php'); //sends user to tvSearchResults.php page 
		}else{  //if tv show isn't in the database then add it to it
			$imdbID = $tvInfo['imdbID'];
			$year = $tvInfo['Year'];
			$title = $tvInfo['Title'];
			$type = $tvInfo['Type'];
			$sqlS = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$imdbID', '$year', '$title','$type')";
			$db->query($sqlS);
			header('location: tvSearchResults.php'); //sends user to tvSearchResults.php page 
		}
	}
}


?>