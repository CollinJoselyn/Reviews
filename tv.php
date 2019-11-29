<?php
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
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

$popular = getImdbRecord("The+Mandalorian", $ApiKey);
$popular2 = getImdbRecord("The+Crown", $ApiKey);
$popular3 = getImdbRecord("Rick+and+Morty", $ApiKey);
$popular4 = getImdbRecord("Watchmen", $ApiKey);
$popular5 = getImdbRecord("Game+of+Thrones", $ApiKey);
$popular6 = getImdbRecord("American+Horror+Story", $ApiKey);
$popular7 = getImdbRecord("Peaky+Blinders", $ApiKey);
$popular8 = getImdbRecord("Supernatural", $ApiKey);
$popular9 = getImdbRecord("Black+Mirror", $ApiKey);
$highest = getImdbRecord("Seinfeld", $ApiKey);
$highest2 = getImdbRecord("Breaking+Bad", $ApiKey);
$highest3 = getImdbRecord("Friends", $ApiKey);
$lowest = getImdbRecord("For+Better+or+Worse", $ApiKey);
$lowest2 = getImdbRecord("Fred:+the+Show", $ApiKey);
$lowest3 = getImdbRecord("16+and+Pregnant", $ApiKey);



?>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Reviews</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
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
          <li class="nav-item">
            <a class="nav-link" href="signIn.php">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="createAccount.php">Create Account</a>
          </li>
          <?php if(isset($_SESSION['username'])){
            echo '<li class="nav-item">';
            echo '<a class="nav-link" href="userHomePage.php">';
            echo $_SESSION['username'] . '</a>' . '</li>'; }; ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">TV</h1>
        <form>
          Search By Title <input type="text" name="tvTitle"><input type="submit" value="Search">
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
      <h1>Popular TV Shows</h1>
    </div>
    <div class="recentReleases">
    <ul>
      <li><?php echo $popular['Title']; ?></li>
      <li><?php echo $popular2['Title']; ?></li>
      <li><?php echo $popular3['Title']; ?></li>
    </ul>
    <ul>
      <li><?php echo $popular4['Title']; ?></li>
      <li><?php echo $popular5['Title']; ?></li>
      <li><?php echo $popular6['Title']; ?></li>
    </ul>
    <ul>
      <li><?php echo $popular7['Title']; ?></li>
      <li><?php echo $popular8['Title']; ?></li>
      <li><?php echo $popular9['Title']; ?></li>
    </ul>
  </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="hlRatedMovies">
        <h1>Highest Rated</h1>
        <ol>
          <li><?php echo $highest['Title']; ?></li>
          <li><?php echo $highest2['Title']; ?></li>
          <li><?php echo $highest3['Title']; ?></li>
        </ol>
        <h1>Lowest Rated</h1>
        <ol>
          <li><?php echo $lowest['Title']; ?></li>
          <li><?php echo $lowest2['Title']; ?></li>
          <li><?php echo $lowest3['Title']; ?></li>
        </ol>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>