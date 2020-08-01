<?php
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


$usernameEr = $passwordEr = $unpwER = "";
$username = $password = "";

$_SESSION['username'] = $_POST["username"];

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty($_POST["username"])){
    $usernameEr = "Please enter username";
  }else{
    $username = test_input($_POST["username"]);
  }

  if(empty($_POST["password"])){
    $passwordEr = "Please enter password";
  }else{
    $pw = test_input($_POST["password"]);
    $password = filterPassword($pw, $pw, $hashAlgo, $beginSalt, $endSalt);
  }
}

$sql = "SELECT username, password, userID FROM user WHERE username = '$username' AND password = '$password'";
if(isset($_POST['signinbtn'])){
$result = $db->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $inputUser = $row["username"];
        $inputPass = $row["password"];
        $userID = $row['userID'];
        if($inputUser == $username && $inputPass == $password){
          $_SESSION['username'] = $username;
          $_SESSION['userID'] = $userID;
          header('location: userHomePage.php');
        }else{
          $unpwER = "Username or Password is incorrect";
        }
    }
} else {
    $unpwER = "Username or Password is incorrect";
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
            <a class="nav-link" href="#">About</a>
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
          Username <input type="text" name="username"><span style="color:red;"><?php echo $usernameEr;?></span><br><br>
          Password <input type="password" name="password"><span style="color:red;"><?php echo $passwordEr; ?></span><br><br>
          <input type="submit" name="signinbtn" value="Sign In"><span style="color:red;position: absolute;"><?php echo $unpwER; ?></span>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>