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
$moviePage = $_SESSION['mTitle'];
$tvPage = $_SESSION['tTitle'];
$indexMT = $_SESSION['mtSearchResults'];
$indexVG = $_SESSION['vgSearchResults'];
$vgPage = $_SESSION['gameInfo'];
$contentType = $_SESSION['type'];

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
			            unset($moviePage);
					}elseif(isset($tvPage)){
						$review = $_POST['writtenReview'];
			            $title = $tvPage['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $tvPage['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            unset($tvPage);
					}elseif(isset($indexMT)){
						$review = $_POST['writtenReview'];
			            $title = $indexMT['Title'];
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $indexMT['imdbID'];
			            $sql = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, titleID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql);
			            unset($indexMT);
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
					}elseif(isset($vgPage)){
						$review = $_POST['writtenReview'];
			            $title = $vgPage->name;
			            $user = $_SESSION['userID'];
			            $rating = $_POST['number'];
			            $tID = $vgPage->id;
			            $sql2 = "INSERT INTO review (writtenReview, titleOfMedia, userID, rating, gameID) VALUES ('$review', '$title', '$user', '$rating', '$tID')";
			            $db->query($sql2);
			            header('location: gamesSearchResults.php');
			            unset($vgPage);
					}
				}
			}else{
				echo "sign in please";
			}
		}
	}
}

?>