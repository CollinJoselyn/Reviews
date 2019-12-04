<?php
session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
include 'gamesApi.php';
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
$mtPoster = $_SESSION['mtSearchResults']['Poster'];
$vgPoster = $_SESSION['vgSearchResults']->background_image;
$mtInfo = $_SESSION['mtSearchResults'];
$vgInfo = $_SESSION['vgSearchResults'];
$mediaName = $_SESSION['mediaName'];
$_SESSION['type'] = "";

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
        if($mediaName === $mtInfo['Title']){
         $_SESSION['type'] = "movieTV"
         echo '<img src="' .$mtPoster .'" alt="Movie Poster">';
         echo  '<ul class="movieInfo">';
         echo '<li>' .'Title:' . $mtInfo['Title'] . '</li>';
         echo '<li>' .'Year:' .$mtInfo['Year'] .'</li>';
         echo '<li>' .'Rated:' .$mtInfo['Rated'] .'</li>';
         echo '<li>' .'Runtime:' .$mtInfo['Runtime'] .'</li>';
         echo '<li>' .'Genre:'  .$mtInfo['Genre'] .'</li>';
         echo '<li>' .'Director:' .$mtInfo['Director'] .'</li>';
         echo '<li>' .'Writer:' .$mtInfo['Writer'] .'</li>';
         echo '<li>' .'Actors:' .$mtInfo['Actors'] .'</li>';
         echo '<li>' .'Plot:'  .$mtInfo['Plot']  .'</li>';
         echo '<li>' .'User Rating:' .'</li>';
         echo '</ul>';
        }else{
          $_SESSION['type'] = "videoGame";
         echo '<img style="height: 500px; width: 400px;" src="' .$vgPoster .'" alt="Movie Poster">';
         echo '<li>' .'Title:' .$vgInfo->name .'</li>';
         echo '<li>' .'Release Date:' .$vgInfo->released .'</li>';
         echo '<li>' .'Description:' .$vgInfo->description_raw .'</li>;';
         echo '<li>' .'Publisher:' .$vgInfo->publishers{'0'}->{'name'} .'</li>';
         echo '<li>' .'ESRB Rating:' .$vgInfo->esrb_rating->name .'</li>';
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
      <form>
      <ul class="ratingScale">
        <li>Lowest</li>
        <li><button name="one" value="1">1</button></li>
        <li><button name="two" value="2">2</button></li>
        <li><button name="three" value="3">3</button></li>
        <li><button name="four" value="4">4</button></li>
        <li><button name="five" value="5">5</button></li>
        <li><button name="six" value="6">6</button></li>
        <li><button name="seven" value="7">7</button></li>
        <li><button name="eight" value="8">8</button></li>
        <li><button name="nine" value="9">9</button></li>
        <li><button name="ten" value="10">10</button></li>
        <li>Highest</li>
      </ul>
      <br>
      <textarea rows="10" cols="105" name="writtenReview"></textarea><br><br>
      <input type="submit" name="reviewBtn" value="submit">
    </form>
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