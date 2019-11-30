<?php
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';

function addPlus($string){
	return str_replace(" ", "+", $string);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$tvTitle = "";
$tvTitleErr = "";
$tvResults = getImdbRecord($tvTitle, $ApiKey);
$poster = getPoster($tvTitle, $ApiKey);
$_SESSION['tTitle'] = "";
$_SESSION['tTitleErr'] = "";


if(isset($_GET['tvSearchBtn'])){
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		if(empty($_GET['tvTitle'])){
			$tvTitleErr = "Please enter a TV title";
		}else{
			//$tvTitleCheck = test_input($_GET['tvTitle']);
			$tvTitleCheck = $_GET['tvTitle'];
			$tvTitle = addPlus($tvTitleCheck);
			$tvResults = getImdbRecord($tvTitle, $ApiKey);
			if($tvTitleCheck != $tvResults['Title'] || $tvResults['Type'] != "series"){
				$tvTitleErr = "Please enter a valid TV show title";
				$_SESSION['tTitleErr'] = $tvTitleErr;
				header('location: tv.php');
			}else{
				$tt = $_GET['tvTitle'];
				$sql = "SELECT title FROM moviestv WHERE title = '$tt'";
				if($db->query($sql) === TRUE){
					$_SESSION['tTitle'] = $tvResults;
					header('location: tvSearchResults.php');
				}else{
					$titleID = $tvResults['imdbID'];
					$year = $tvResults['Year'];
					$title = $tvResults['Title'];
					$type = $tvResults['Type'];
					$sql2 = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$titleID', '$year', '$title','$type')";
					$db->query($sql2);
					$_SESSION['tTitle'] = $tvResults;
					header('location: tvSearchResults.php');
				}
			}
		}
	}
}


?>