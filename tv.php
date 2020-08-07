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

unset($_SESSION['notSignIn']);
unset($_SESSION['previousPage2']);
$_SESSION['previousPage2'] = $_SERVER['PHP_SELF'];
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
          <li class="nav-item active">
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

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <p style="font-family: mv boli;font-size:60px;">Reviews</p><br>
        <h1 class="mt-5">TV</h1><br>
        <form action="results.php" method="get">
          Search By Title <input type="text" name="tvTitle"><input type="submit" value="Search" name="tvSearchBtn">
          <span style="color:red;position:absolute;"><?php echo $_SESSION['blank']; ?></span>
        </form>
      </div>
    </div>
  </div>

  <?php
  unset($_SESSION['blank']);
  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
      <br><br><h1>Popular TV Shows</h1><br>
    </div>
    <div class="recentReleases">
      <form action="tvSearch.php" method="get">
    <ul>
      <img src="<?php echo $popular['Poster']; ?>">
      <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $popular['Title']; ?>"></li><br>
      <img src="<?php echo $popular2['Poster']; ?>">
      <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $popular2['Title']; ?>"></li><br>
      <img src="<?php echo $popular3['Poster']; ?>">
      <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $popular3['Title']; ?>"></li><br>
    </ul>
    <ul>
      <img src="<?php echo $popular4['Poster']; ?>">
      <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $popular4['Title']; ?>"></li><br>
      <img src="<?php echo $popular5['Poster']; ?>">
      <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $popular5['Title']; ?>"></li><br>
      <img src="<?php echo $popular6['Poster']; ?>">
      <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $popular6['Title']; ?>"></li><br>
    </ul>
    <ul>
      <img src="<?php echo $popular7['Poster']; ?>">
      <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $popular7['Title']; ?>"></li><br>
      <img src="<?php echo $popular8['Poster']; ?>">
      <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $popular8['Title']; ?>"></li><br>
      <img src="<?php echo $popular9['Poster']; ?>">
      <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $popular9['Title']; ?>"></li><br>
    </ul>
  </form>
  </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="hlRatedMovies">
        <h1>Highest Rated</h1><br>
        <form action="tvSearch.php" method="get">
        <ol>
          <img src="<?php echo $highest['Poster']; ?>">
          <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $highest['Title']; ?>"></li><br>
          <img src="<?php echo $highest2['Poster']; ?>">
          <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $highest2['Title']; ?>"></li><br>
          <img src="<?php echo $highest3['Poster']; ?>">
          <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $highest3['Title']; ?>"></li>
        </ol>
        <h1>Lowest Rated</h1><br>
        <ol>
          <img src="<?php echo $lowest['Poster']; ?>">
          <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $lowest['Title']; ?>"></li><br>
          <img src="<?php echo $lowest2['Poster']; ?>">
          <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $lowest2['Title']; ?>"></li><br>
          <img src="<?php echo $lowest3['Poster']; ?>">
          <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $lowest3['Title']; ?>"></li><br>
        </ol>
      </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>