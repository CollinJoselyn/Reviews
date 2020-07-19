<?php
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';

?>

<?php

function addPlus($string){
	return str_replace(" ", "+", $string);
}

function parseTitle($data){
	$titleArr = explode(" ", $data);
	$length = count($titleArr);
	$newArray = array();
	for($i = 0; $i < $length; $i++){
		$newArray[$i] = $titleArr[$i] .'+';
	}
	return array_values($newArray);
	//$nLength = count($newArray);
	//for($i = 0; $i < $nLength; $i++){
	//	echo $newArray[$i] .'+';
	//}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
/*
$movieTitle = "";
$movieTitleErr = "";
$mTitle = "";
$data2 = getImdbRecord($mTitle, $ApiKey);
$poster = getPoster($mTitle, $ApiKey);
$_SESSION['mTitle'] = "";
$_SESSION['titleErr'] = "";
$sql = "SELECT title FROM moviestv WHERE title = '$movieTitle'";
$_SESSION['mediaName'] = $_GET['movieTitle'];
if(isset($_GET['sButtons'])){
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		if(empty($_GET['movieTitle'])){

		}else{
			$mTitle = addPlus($_GET['movieTitle']);
			$data2 = getImdbRecord($mTitle, "99000d3e");
			$poster = getPoster($mTitle, "99000d3e");
			if($data2['Title'] != $_GET['movieTitle'] || $data2['Type'] != "movie"){
				$movieTitleErr = "Please enter a valid title";
				$_SESSION['titleErr'] = $movieTitleErr;
				header('location: movies.php');
			}else{
				$_SESSION['mTitle'] = $data2;
				if($db->query($sql) === TRUE){
					header('location: movieSearchResults.php');
				}else{
					$imdbID = $data2['imdbID'];
					$year = $data2['Year'];
					$title = $data2['Title'];
					$type = $data2['Type'];
					$sql2 = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$imdbID', '$year', '$title','$type')";
					$db->query($sql2);
					header('location: movieSearchResults.php');

				}		
				
			}
		}
	}
}*/

$bTitle = "";
if(isset($_GET['sButtons'])){
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['sButtons'];
		$bTitle = addPlus($_GET['sButtons']);
		$data3 = getImdbRecord($bTitle, $ApiKey);
		$sqlS = "SELECT title FROM moviestv WHERE title = '$bTitle'";
		$_SESSION['mPageResults'] = $data3;
		if($db->query($sqlS) === TRUE){
			header('location movieSearchResults.php');
		}else{
			$imdbID = $data3['imdbID'];
			$year = $data3['Year'];
			$title = $data3['Title'];
			$type = $data3['Type'];
			$sql2 = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$imdbID', '$year', '$title','$type')";
			$db->query($sql2);
			header('location: movieSearchResults.php');
		}
	}
}

$bTitle = "";
if(isset($_GET['mPage'])){
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$_SESSION['mediaName'] = $_GET['mPage'];
		$bTitle = addPlus($_GET['mPage']);
		$data3 = getImdbRecord($bTitle, $ApiKey);
		$sqlS = "SELECT title FROM moviestv WHERE title = '$bTitle'";
		$_SESSION['mPageButton'] = $data3;
		unset($_SESSION['mPageResults']);
		if($db->query($sqlS) === TRUE){
			header('location movieSearchResults.php');
		}else{
			$imdbID = $data3['imdbID'];
			$year = $data3['Year'];
			$title = $data3['Title'];
			$type = $data3['Type'];
			$sql2 = "INSERT INTO moviestv (titleID, year, title, type) VALUES ('$imdbID', '$year', '$title','$type')";
			$db->query($sql2);
			header('location: movieSearchResults.php');
		}
	}
}


?>