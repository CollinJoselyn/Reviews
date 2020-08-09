<?php
/*
This page is for account creation.
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

$usernameEr = $emailEr = $passwordEr = $emailEr2 = $passwordEr2 = $passwordEr3 = $usernameEr3 = $failed = ""; //error message variables
$username = $email = $password = $pwd = "";
$pw = $_POST['conPassword'];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) == true){ //checks to see if POST is being used and it the user clicked the submit button
  if(empty($_POST["username"])){ //if the username field is empty
    $usernameEr = "Please enter a username";
  }else{
    $username = test_input($_POST["username"]); //filter the input
  }

  if(empty($_POST["email"])){ //if the email field is empty
    $emailEr = "Please enter an email";
  }else{
    $email = test_input($_POST["email"]); //filter the input
  }

  if(empty($_POST["password"])){ //if the password field is empty
    $passwordEr = "Please enter a password";
  }else{
    $password = test_input($_POST["password"]); //filter the input
  }

  if($password != $pw){ //if passwords don't match
    $passwordEr2 = "Passwords do not match";
  }else{ //if they do, then translate it to its hash value
    $pwd = filterPassword($password, $pw, $hashAlgo, $beginSalt, $endSalt); 
  }

  //code to check if username already exits
  $sqlUN = "SELECT username FROM user WHERE username = '$username'";
  $result = $db->query($sqlUN);
  $unCheck = "";
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $unCheck = $row['username'];
    }
  }
  //end of code to check if usename already exits
if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //checks to see if email is valid
    
if($username != "" && $pwd != "" && $email != ""){ //checks to see if all fields are filled out
  if($username != $unCheck){//check to see if the username they type already exits
    
  if(strlen($password) >= 8 && preg_match("#[0-9]+#", $password) && preg_match("#[A-Z]+#", $password) && preg_match("#\W+#", $password)){ //checks password complexity
$sql = "INSERT INTO user (username, password, email) VALUES ('$username', '$pwd', '$email')";
if($db->query($sql) === TRUE){ //if the sql statement above executes succussfully
  $_SESSION['username'] = $username;
  header('location: userHomePage.php'); //send user to the user home page
}else{
  echo "Error: " .$sql . "<br>" . $db->error;
}
}else{ //if password doesn't meet complexity requirements
  $passwordEr3 = "Password doesn't meet complexity requirements";
}
}else{ //if username already exits
  $usernameEr3 = "That usename already exits. Please choose another username";
}
}else{ //if not all fields are filled out
  $failed = "Account creation failed. Please make sure your password meets the complexity requirements 
  and make sure you choose a username that is not already taken.";
}
}else{ //if email is not valid
  $emailEr2 = "Please enter a valid email";
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
          <li class="nav-item">
            <a class="nav-link" href="signIn.php">Sign In</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="createAccount.php">Create Account</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Create Account</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="createAccount">
          Username<br>
          <input type="text" name="username" value="<?php echo $username; ?>">
          <span  style="color:red;"><?php echo  $usernameEr .$usernameEr3?></span><br><br>
          Email<br>
          <input type="text" name="email" value="<?php echo $email; ?>">
          <span style="color:red;"><?php echo  $emailEr2?></span><br><br>
          Password<br>
          <input type="password" name="password" value="<?php echo $password; ?>">
          <span style="color:red;"><?php echo  $passwordEr .$passwordEr3?></span>
          <span style="color:red;"><?php echo  $usernameEr2?></span><span></span>
          <p>Must be at least 8 characters in length.</p></p> Must contain a number, special character and a capital letter</p>
          Confirm Password<br>
          <input type="password" name="conPassword" value="<?php echo $pwd; ?>"><br><br>
          <input type="submit" name="submit" value="Create Account"><span style="color:red;"><?php echo $failed; ?></span>
          </div>
      </div>
    </div>
  </div>

  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 

</body>

</html>