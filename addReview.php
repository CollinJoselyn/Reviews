<?php
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
include 'gamesApi.php';
?>


<?php

$rating = "";
$review = "";
$error = "";
$tID = "";
$title = "";
$user = "";
$sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
$sql2 = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, gameID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
if(isset($_POST['reviewBtn'])){
	if(isset($_SESSION['username'])){
	if(empty($_POST['writtenReview']) || empty($_POST['number'])){
		$error = "Please choose a rating and type a review";
		$_SESSION['reviewError'] = $error;
	}else{
		$rating = $_POST['number'];
		$review = $_POST['writtenReview'];
		$user = $_SESSION['userID'];
		if($_SESSION['type'] === "movieTV"){
			if($_SESSION['mTitle']){
				$tID = $_SESSION['mTitle']['imdbID'];
				$title = $_SESSION['mTitle']['Title'];
				$db->query($sql);
			}elseif($_SESSION['tTitle']){
				$tID = $_SESSION['tTitle']['imdbID'];
				$title = $_SESSION['tTitle']['Title'];
				$db->query($sql);
			}elseif($_SESSION['mtSearchResults']){
				$tID = $_SESSION['mtSearchResults']['imdbID'];
				$title = $_SESSION['mtSearchResults']['Title'];
				$db->query($sql);
			}	
		
	}else($_SESSION['type'] === "videoGame"){
		if($_SESSION['vgSearchResults']){
			$tID = $_SESSION['vgSearchResults']->id;
			$title = $_SESSION['vgSearchResults']->name;
			$db->query($sql2);
		}else($_SESSION['gameInfo']){
			$tID = $_SESSION['gameInfo']->id;
			$title = $_SESSION['gameInfo']->name;
			$db->query($sql2);
		}
	}
	}
  }else{
  	$_SESSION['reviewError'] = "You must login to leave a review";
  	echo 'Sign in Please';
  }
}

?>