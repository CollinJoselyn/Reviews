<?php
session_start();
require_once 'dbconnection.php';
$id = $_SESSION['deleteReviewID'];
$delsql = "DELETE FROM review WHERE reviewID = '$id'";
$delresults = $db->query($delsql);
header('location: myReviews.php');
?>