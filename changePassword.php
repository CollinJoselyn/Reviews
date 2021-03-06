<?php
/*
This page is for user to change their password.
*/
session_start();
require_once 'dbconnection.php';
require_once 'inputFilters.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Reviews</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">

</head>

<?php

  $oldPassword = test_Input($_POST['oldPassword']); //filters input
  $newPassword = test_Input($_POST['newPassword']); //filters input
  $confirmPassword = test_Input($_POST['confirmPassword']); //filters input
  $username = $_SESSION['username']; //get the username from the username session variable
  $emptyErr = $matchErr = $oldPassErr = "";  //error message variables

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['submit'])){ //checks if user hits the submit button
      if(empty($oldPassword) || empty($newPassword) || empty($confirmPassword)){ //if any of the fields are empty, send error message
        $emptyErr = 'Please fill all fields';
      }else{
        //these variables translate the password to the hash
        $oldPassword2 = filterPassword($oldPassword, $oldPassword, $hashAlgo, $beginSalt, $endSalt);
        $newPassword2 = filterPassword($newPassword, $newPassword, $hashAlgo, $beginSalt, $endSalt);
        $confirmPassword2 = filterPassword($confirmPassword, $confirmPassword, $hashAlgo, $beginSalt, $endSalt);

        $sql = "SELECT password FROM user WHERE username = '$username'";
        $results = $db->query($sql);
        if($results->num_rows > 0){
          while($row = $results->fetch_assoc()){
            $passwordFromDb = $row['password'];
            if($passwordFromDb != $oldPassword2){ //if the old password is incorrect
              $oldPassErr = 'old password is incorrect';
            }elseif($newPassword2 != $confirmPassword2){ //if the new password and confirm password entries don't match
              $matchErr = 'new password and confirm password do not match';
            }else{
              $sql2 = "UPDATE user SET password = '$newPassword2' WHERE username = '$username'"; //query to update password
              $db->query($sql2);
              $_SESSION['passChange'] = true;
              header('location: userHomePage.php'); //send user back to userHomePage.php
            }
          }
        }
      }
    }
  }

  ?>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Reviews</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="movies.php">Movies</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="videoGames.php">Video Games</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tv.php">TV</a>
          </li>
          <?php if(isset($_SESSION['username'])){
           echo '<li class="nav-item">';
           echo  '<a class="nav-link" href="signOut.php">' .'Sign out' .'</a>';
           echo '</li>';}else{
           echo '<li class="nav-item">';
           echo  '<a class="nav-link" href="signIn.php">' .'Sign In' .'</a>';
           echo '</li>';
           } ?>
           <?php 
           if(isset($_SESSION['username'])){

           }else{
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="createAccount.php">' .'Create Account' .'</a>';
            echo '</li>'; }?>
          <?php if(isset($_SESSION['username'])){
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="userHomePage.php">';
            echo $_SESSION['username'] . '</a>' . '</li>'; }; ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <?php if(!isset($_SESSION['username'])): header("location: signOut.php");?>
<?php else: ?>
<?php endif ?>
  
  
<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
       <h1>Change Password</h1><br>
      
      <form method="POST" class="changePasswordForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        Old Password <input type="password" name="oldPassword"><span style="color:red;position:absolute;"><?php echo $oldPassErr; ?></span><br><br>
        New Password <input type="password" name="newPassword"><br><br>
        Confirm New Password <input type="password" name="confirmPassword"><br><br>
        <input type="submit" name="submit" value="Submit"><span style="color:red;position:absolute;"><?php echo $emptyErr .$matchErr; ?></span>
      </form></div>
    </div>
  </div>

  <a href="userHomePage.php" class="backButton"><img src="arrow.jpg">Back</a>
  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>

</html>