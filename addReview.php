<?php
/*
This script is for adding a review to the database.
*/
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
include 'gamesApi.php';
include 'inputFilters.php';
?>


<?php
$prev = $_POST['prevPage'];
$rating = "";
$review = "";
$error = "";
$tID = "";
$title = "";
$user = "";
$moviePage = $_SESSION['mPageResults']; //contains movie data from the title the user searched for on movies.php; Movies.php -> results.php -> searchMovies.php
$tvPage = $_SESSION['tTitle']; //contains tv show data from the title the user clicked on in tv.php page
$indexMT = $_SESSION['mtSearchResults']; //contains movie/tv show data from the title the user searched for on index.php
$indexVG = $_SESSION['vgSearchResults']; //contains video game data from the title the user searched for on index.php
$vgPage = $_SESSION['gameInfo']; //contains video game data from the title the user clicked on in the videoGame.php page 
$contentType = $_SESSION['type'];
$mPageButtons = $_SESSION['mPageButton']; //contains movie data from the title the user clicked on in the movies.php page
$tPageButtons = $_SESSION['tPageButton']; //session variable that contains data for the tv show that the user searched for on tv.php
$gamesSearchResults = $_SESSION['gamesSearchResults']; //session variable that contains game data for the game the user searched for on videoGames.php

if(isset($_POST['reviewBtn'])){ //checks to see if the review button was pressed
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(empty($_POST['writtenReview']) || empty($_POST['number'])){ //checks to make sure the user left both a rating and a written review
			$_SESSION['noRatingReview'] = true; //sesson variable for error if user doens't leave both rating and written review
			$back = $_SESSION['previousPage']; //contains the last page the user was on
			header('location:' .$back); //sends user back to the last page they were on 
		}else{
			if(isset($_SESSION['username'])){ //checks to see if the user is sign in
				if($contentType == "movieTV"){ //if the content is a movie or tv show 
					if(isset($moviePage) && $moviePage['Title'] == $_SESSION['mediaName']){ //for the title the user searched for on movies.php
						$rvw = $_POST['writtenReview'];
						$review = test_Input($rvw);
			            $title = $moviePage['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $moviePage['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            header('location: movieSearchResults.php');
			            unset($moviePage);
					}elseif(isset($tvPage) && $tvPage['Title'] == $_SESSION['mediaName']){ //for the title the user clicked on in tv.php page
						$rvw = $_POST['writtenReview'];
						$review = test_Input($rvw);
			            $title = $tvPage['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $tvPage['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            header('location: tvSearchResults.php');
			            unset($tvPage);
					}elseif(isset($indexMT) && $indexMT['Title'] == $_SESSION['mediaName']){ //the movie/tv title the user searched for on index.php
						$rvw = $_POST['writtenReview'];
						$review = test_Input($rvw);
			            $title = $indexMT['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $indexMT['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            header('location: searchAllResults.php');
			            unset($indexMT);
					}elseif(isset($mPageButtons) && $mPageButtons['Title'] == $_SESSION['mediaName']){ //the title the user clicked on in the movies.php page
						$rvw = $_POST['writtenReview'];
						$review = test_Input($rvw);
			            $title = $mPageButtons['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $mPageButtons['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            header('location: movieSearchResults.php');
			            unset($mPageButtons);
					}elseif(isset($tPageButtons) && $tPageButtons['Title'] == $_SESSION['mediaName']){  //the tv show that the user searched for on tv.php
						$rvw = $_POST['writtenReview'];
						$review = test_Input($rvw);
			            $title = $tPageButtons['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $tPageButtons['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            header('location: tvSearchResults.php');
			            unset($tPageButtons);
					}
				}elseif($contentType == "videoGame"){ //if the content type is video game
					if(isset($indexVG) && $indexVG->name == $_SESSION['mediaName']){ //the video game title the user searched for on index.php
						$rvw = $_POST['writtenReview'];
						$review = test_Input($rvw);
			            $title = $indexVG->name;
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $indexVG->id;
			            $sql2 = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, gameID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql2);
			            header('location: searchAllResults.php');
			            unset($indexVG);
					}elseif(isset($vgPage) && $vgPage->name == $_SESSION['mediaName']){ //the title the user clicked on in the videoGame.php page
						$rvw = $_POST['writtenReview'];
						$review = test_Input($rvw);
			            $title = $vgPage->name;
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $vgPage->id;
			            $sql2 = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, gameID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql2);
			            header('location: gamesSearchResults.php');
			            unset($vgPage);
					}elseif(isset($gamesSearchResults) && $gamesSearchResults->name == $_SESSION['mediaName']){ //game the user searched for on videoGames.php
						$rvw = $_POST['writtenReview'];
						$review = test_Input($rvw);
			            $title = $gamesSearchResults->name;
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $gamesSearchResults->id;
			            $sql2 = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, gameID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql2);
			            header('location: gamesSearchResults.php');
			            unset($gamesSearchResults);
					}
				}
			}else{
				//send error message if user isn't signed in
				$_SESSION['isSignedIn'] = 'no';
				$previousPage = $_SESSION['previousPage'];
				header('location:' .$previousPage);
			}
		}
	}
}

?>