<?php
session_start();
require_once 'dbconnection.php';
require_once 'gamesApi.php';
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

$recent = findGame("Star Wars Battlefront II");
$recent2 = findGame("Star Wars Jedi: Fallen Order");
$recent3 = findGame("Death Stranding");
$recent4 = findGame("Super Mario Maker 2");
$recent5 = findGame("Call of Duty: Modern Warfare");
$recent6 = findGame("Need For Speed Heat");
$recent7 = findGame("The Outer Worlds");
$recent8 = findGame("Overwatch");
$recent9 = findGame("FIFA 20");
$lowest = findGame("Big Rigs: Over The Road Racing");
$lowest2 = findGame("Ride to Hell: Retrobution");
$lowest3 = findGame("Yaris");
$highest = findGame("Grand Theft Auto: San Andreas");
$highest2 = findGame("MVP Baseball 2005");
$highest3 = findGame("The Last of Us");

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

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Video Games</h1>
        <form action="gameSearch.php" method="get">
          Search By Title <input type="text" name="gameTitle"><input type="submit" value="Search" name="gSearchBtn">
          <span><?php echo $_SESSION['gameErr'] ?></span>
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
      <li><?php echo $recent->name; ?></li>
      <li><?php echo $recent2->name; ?></li>
      <li><?php echo $recent3->name; ?></li>
    </ul>
    <ul>
      <li><?php echo $recent4->name; ?></li>
      <li><?php echo $recent5->name; ?></li>
      <li><?php echo $recent6->name; ?></li>
    </ul>
    <ul>
      <li><?php echo $recent7->name; ?></li>
      <li><?php echo $recent8->name; ?></li>
      <li><?php echo $recent9->name; ?></li>
    </ul>
  </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="hlRatedMovies">
        <h1>Highest Rated</h1>
        <ol>
          <li><?php echo $highest->name; ?></li>
          <li><?php echo $highest2->name; ?></li>
          <li><?php echo $highest3->name; ?></li>
        </ol>
        <h1>Lowest Rated</h1>
        <ol>
          <li><?php echo $lowest->name; ?></li>
          <li><?php echo $lowest2->name; ?></li>
          <li><?php echo $lowest3->name; ?></li>
        </ol>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>