<?php
session_start();
require_once 'dbconnection.php';
$id = $_SESSION['deletedReviewID'];
$delsql = "DELETE FROM review WHERE reviewID = '$id'";
echo '<p>' .$id .'</p>';
//$db->query($delsql);
//header('location: myReviews.php');
?>