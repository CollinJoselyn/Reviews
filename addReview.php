<?php
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
include 'gamesApi.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
?>


<?php
$prev = $_POST['prevPage'];
$rating = "";
$review = "";
$error = "";
$tID = "";
$title = "";
$user = "";
//$moviePage = $_SESSION['mTitle'];
$moviePage = $_SESSION['mPageResults'];
$tvPage = $_SESSION['tTitle'];
$indexMT = $_SESSION['mtSearchResults'];
$indexVG = $_SESSION['vgSearchResults'];
$vgPage = $_SESSION['gameInfo'];
$contentType = $_SESSION['type'];
$mPageButtons = $_SESSION['mPageButton'];
$tPageButtons = $_SESSION['tPageButton'];
$gamesSearchResults = $_SESSION['gamesSearchResults'];
print_r($tvPage);

if(isset($_POST['reviewBtn'])){
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(empty($_POST['writtenReview'])){
			echo "Write something";
		}else{
			if(isset($_SESSION['username'])){
				if($contentType == "movieTV"){
					if(isset($moviePage) && $moviePage['Title'] == $_SESSION['mediaName']){
						$review = $_POST['writtenReview'];
			            $title = $moviePage['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $moviePage['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            header('location: movieSearchResults.php');
			            unset($moviePage);
					}elseif(isset($tvPage) && $tvPage['Title'] == $_SESSION['mediaName']){
						$review = $_POST['writtenReview'];
			            $title = $tvPage['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $tvPage['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            header('location: tvSearchResults.php');
			            unset($tvPage);
					}elseif(isset($indexMT) && $indexMT['Title'] == $_SESSION['mediaName']){
						$review = $_POST['writtenReview'];
			            $title = $indexMT['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $indexMT['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            header('location: searchAllResults.php');
			            unset($indexMT);
					}elseif(isset($mPageButtons) && $mPageButtons['Title'] == $_SESSION['mediaName']){
						$review = $_POST['writtenReview'];
			            $title = $mPageButtons['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $mPageButtons['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            header('location: movieSearchResults.php');
			            unset($mPageButtons);
					}elseif(isset($tPageButtons) && $tPageButtons['Title'] == $_SESSION['mediaName']){
						$review = $_POST['writtenReview'];
			            $title = $tPageButtons['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $tPageButtons['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            header('location: tvSearchResults.php');
			            unset($tPageButtons);
					}
				}elseif($contentType == "videoGame"){
					if(isset($indexVG) && $indexVG->name == $_SESSION['mediaName']){
						$review = $_POST['writtenReview'];
			            $title = $indexVG->name;
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $indexVG->id;
			            $sql2 = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, gameID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql2);
			            header('location: searchAllResults.php');
			            unset($indexVG);
					}elseif(isset($vgPage) && $vgPage->name == $_SESSION['mediaName']){
						$review = $_POST['writtenReview'];
			            $title = $vgPage->name;
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $vgPage->id;
			            $sql2 = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, gameID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql2);
			            header('location: gamesSearchResults.php');
			            unset($vgPage);
					}elseif(isset($gamesSearchResults) && $gamesSearchResults->name == $_SESSION['mediaName']){
						$review = $_POST['writtenReview'];
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
				$_SESSION['notSignIn'] = "You must be signed in to leave a review";
				$previousPage = $_SESSION['previousPage'];
				header('location:' .$previousPage);
			}
		}
	}
}

?>