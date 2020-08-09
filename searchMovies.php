<?php
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
include 'inputFilters.php';
?>

<?php

$bTitle = "";
if(isset($_GET['sButtons'])){ //if user clicks on one of the movie titles from results.php . Movies.php -> results.php -> searchMovies.php
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['sButtons']; // session variable with the movie title
		$bTitle = addPlus($_GET['sButtons']); //replaces the whitespace with a +
		$data3 = getImdbRecord($bTitle, $ApiKey);  //search the api for the given title
		$sqlS = "SELECT title FROM moviestv WHERE title = '$bTitle'";
		$_SESSION['mPageResults'] = $data3; //session variable that contains data for the given movie title the user searched for on movies.php
		if($db->query($sqlS) === TRUE){ //check to see if the movie is in the database
			header('location movieSearchResults.php'); //sends user to movieSearchResults.php page 
		}else{ //if not in database, then add to it
			$imdbID = $data3['imdbID'];
			$year = $data3['Year'];
			$title = $data3['Title'];
			$type = $data3['Type'];
			$sql2 = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$imdbID', '$year', '$title','$type')";
			$db->query($sql2);
			header('location: movieSearchResults.php'); //sends user to movieSearchResults.php page 
		}
	}
}

$bTitle = "";
if(isset($_GET['mPage'])){ //if user clicks on one of the titles on the movies.php page
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['mPage']; //session variable that contains the movie title
		$bTitle = addPlus($_GET['mPage']); //replaces whitespace with a +
		$data3 = getImdbRecord($bTitle, $ApiKey); //searches the api for the given title
		$sqlS = "SELECT title FROM moviestv WHERE title = '$bTitle'";
		$_SESSION['mPageButton'] = $data3; //session variable that contains data on the title clicked on from the movies.php page
		unset($_SESSION['mPageResults']); //unset mPageResults session variable
		if($db->query($sqlS) === TRUE){ //check database to see if it is in there
			header('location movieSearchResults.php'); //send user to movieSearchResults.php
		}else{ //if not in database then add to it
			$imdbID = $data3['imdbID'];
			$year = $data3['Year'];
			$title = $data3['Title'];
			$type = $data3['Type'];
			$sql2 = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$imdbID', '$year', '$title','$type')";
			$db->query($sql2);
			header('location: movieSearchResults.php'); //send user to movieSearchResults.php
		}
	}
}


?>