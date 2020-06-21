<?php
session_start();
require_once 'dbconnection.php';
if(isset($_GET['myR'])){
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$RID = $_GET['myR'];
		$delsql = "DELETE FROM review WHERE reviewID = '$RID'";
		$db->query($delsql);
		header('location: myReviews.php');
	}
}

?>