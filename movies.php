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

$highest2 = getImdbRecord("The+Dark+Knight", "99000d3e");
$highest3 = getImdbRecord("American+Psycho", "99000d3e");
$lowest = getImdbRecord("Disaster+Movie", "99000d3e");
$lowest2 = getImdbRecord("Superbabies:+Baby+Geniuses+2", "99000d3e");
$lowest3 = getImdbRecord("Manos:+The+Hands+of+Fate", "99000d3e");
$recent = getImdbRecord("Midway", "99000d3e");
$recent2 = getImdbRecord("Joker", "99000d3e");
$recent3 = getImdbRecord("Harriet", "99000d3e");
$recent4 = getImdbRecord("Doctor+Sleep", "99000d3e");
$recent5 = getImdbRecord("Ford+v+Ferrari", "99000d3e");
$recent6 = getImdbRecord("Parasite", "99000d3e");
$recent7 = getImdbRecord("Terminator:+Dark+Fate", "99000d3e");
$recent8 = getImdbRecord("The+Lighthouse", "99000d3e");
$recent9 = getImdbRecord("It+Chapter+Two", "99000d3e");

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
        <h1 class="mt-5">Movies</h1>
        <form action="searchMovies.php" method="get">
          Search By Title <input type="text" name="movieTitle"><input type="submit" name="searchMoviesBtn" value="Search">
          <span><?php echo $_SESSION['titleErr'];?></span>
        </form>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
      <h1>Recent Releases</h1>
    </div>
    <div class="recentReleases">
    <ul>
      <li><?php echo $recent['Title']; ?></li>
      <li><?php echo $recent2['Title']; ?></li>
      <li><?php echo $recent3['Title']; ?></li>
    </ul>
    <ul>
      <li><?php echo $recent4['Title']; ?></li>
      <li><?php echo $recent5['Title']; ?></li>
      <li><?php echo $recent6['Title']; ?></li>
    </ul>
    <ul>
      <li><?php echo $recent7['Title']; ?></li>
      <li><?php echo $recent8['Title']; ?></li>
      <li><?php echo $recent9['Title']; ?></li>
    </ul>
  </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="hlRatedMovies">
        <h1>Highest Rated</h1>
        <ol>
          <li><?php  echo $data['Title']; ?></li>
          <li><?php  echo $highest2['Title']; ?></li>
          <li><?php echo $highest3['Title'];  ?></li>
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