<?php
/*
This is the sign in page. Here the user can sign into their account.
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

</head>


<?php


$usernameEr = $passwordEr = $unpwER = ""; //error message variables
$username = $password = "";

$_SESSION['username'] = $_POST["username"];  //set the username session variable to the username

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty($_POST["username"])){
    $usernameEr = "Please enter username"; //error message if username field is empty
    unset($_SESSION['username']);
  }else{
    $username = test_input($_POST["username"]);  //filter the username input
  }

  if(empty($_POST["password"])){
    $passwordEr = "Please enter password"; //error message if password field is empty
  }else{
    $pw = test_input($_POST["password"]); //filter the password input
    $password = filterPassword($pw, $pw, $hashAlgo, $beginSalt, $endSalt); //translate the password to the hash value
  }
}

$sql = "SELECT username, password, userID FROM user WHERE username = '$username' AND password = '$password'";  //pull username, password, and id from database
if(isset($_POST['signinbtn'])){ //if user clicks the sign in button
$result = $db->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $inputUser = $row["username"];
        $inputPass = $row["password"];
        $userID = $row['userID'];
        if($inputUser == $username && $inputPass == $password){ //check if the username and password matches the one in database
          $_SESSION['username'] = $username; //session variable that contains the username
          $_SESSION['userID'] = $userID; //session variable that contains the user id
          header('location: userHomePage.php'); //send the user to the user home page
        }else{
          $unpwER = "Username or Password is incorrect"; //error message
          unset($_SESSION['username']);
        }
    }
} else {
    $unpwER = "Username or Password is incorrect"; //error message
    unset($_SESSION['username']);
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
          <li class="nav-item active">
            <a class="nav-link" href="signIn.php">Sign In</a>
          </li>
          <li class="nav-item">
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
        <h1 class="mt-5">Sign In</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          Username <input type="text" name="username"><span style="color:red;position:absolute;"><?php echo $usernameEr;?></span><br><br>
          Password <input type="password" name="password"><span style="color:red;position:absolute;"><?php echo $passwordEr; ?></span><br><br>
          <input type="submit" name="signinbtn" value="Sign In"><span style="color:red;position: absolute;"><?php echo $unpwER; ?></span>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>