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
$mtPoster = $_SESSION['searchResults']['Poster'];
$vgPoster = $_SESSION['searchResults']->background_image;
$mtInfo = $_SESSION['searchResults'];
$vgInfo = $_SESSION['searchResults'];
$mediaName = $_SESSION['mediaName'];

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
        <h1>Search Results</h1>
        </div>
    </div>
  </div>
  <br>
  <div class="container">
    <div class="row">
      <div class="moviePoster">
        <?php
        if($mediaName == $mtInfo['Title']){
          echo '<img style=" " src="'$mtPoster'" alt="Movie Poster">';
          echo  '<ul class="movieInfo">';
         echo '<li>' .'Title:' . $movieInfo['Title'] . '</li>';
         echo '<li>' .'Year:' .$movieInfo['Year'] .'</li>';
         echo '<li>' .'Rated:' .$movieInfo['Rated'] .'</li>';
         echo '<li>' .'Runtime:' .$movieInfo['Runtime'] .'</li>';
         echo '<li>' .'Genre:'  .$movieInfo['Genre'] .'</li>';
         echo '<li>' .'Director:' .$movieInfo['Director'] .'</li>';
         echo '<li>' .'Writer:' .$movieInfo['Writer'] .'</li>';
         echo '<li>' .'Actors:' .$movieInfo['Actors'] .'</li>';
         echo '<li>' .'Plot:'  .$movieInfo['Plot']  .'</li>';
         echo '<li>' .'User Rating:' .'</li>';
         echo '</ul>';
        }else{
          echo '<img style=" " src="'$vgPoster'" alt="Movie Poster">';
          echo '<li>' .'Title:' .$gameInfo->name .'</li>';
         echo '<li>' .'Release Date:' .$gameInfo->released .'</li>';
         echo '<li>' .'Description:' .$gameInfo->description_raw .'</li>;';
         echo '<li>' .'Publisher:' .$gameInfo->publishers{'0'}->{'name'} .'</li>';
         echo '<li>' .'ESRB Rating:' .$gameInfo->esrb_rating->name .'</li>';
         echo '<li>' .'User Rating:' .'</li>';
        }
         ?>
        
         
       </div>
    </div>
  </div>
<br> 
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
      <h3>Leave a Rating</h3>
    </div>
      <ul class="ratingScale">
        <li>Lowest 1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li>6</li>
        <li>7</li>
        <li>8</li>
        <li>9</li>
        <li>Highest 10</li>
      </ul>
    </div>
  </div>

  <!--<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">A Bootstrap 4 Starter Template</h1>
        <p class="lead">Complete with pre-defined file paths and responsive navigation!</p>
        <ul class="list-unstyled">
          <li>Bootstrap 4.3.1</li>
          <li>jQuery 3.4.1</li>
        </ul>
      </div>
    </div>
  </div>-->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>