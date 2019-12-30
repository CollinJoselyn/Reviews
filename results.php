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
function addPlus($string){
    return str_replace(" ", "+", $string);
  }
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

<div class="container">
    <div class="row">
    	<div class="resultSection">
    	
    	<ul>
      <?php
      


        if(isset($_GET['searchBtn'])){
          if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(empty($_GET['search'])){
              //error message back to original page
            }else{
              $mvtString = addPlus($_GET['search']);
              $data = getImdbRecord2($mvtString, $ApiKey);
              $gameResult = findGames($_GET['search']);
              $results = $data['Search'];
              $gameResult = findGames($_GET['search']);
              $gameResult = findGames($_GET['search']);
              $length = count($results);
              $glength = count($gameResult);
              echo '<form action="searchAll.php" method="get">';
              echo '<h2>' .'Results' .'</h2>';
              echo '<br>' .'<h2>' .'Movies and TV' .'</h2>';
              for($i = 0; $i < $length; $i++){
                $titles = $results[$i]['Title'];
                $poster = $results[$i]['Poster'];
                echo '<img src=' .$poster .'>';
                echo "<li>" .'<input type = "submit" name = "rButtons" class = "resultButtons" value="' .$titles. '"/>';
                echo '</li>';
              }
              echo '<br>' .'<h2>' .'Video Games' .'</h2>';
              for($i = 0; $i < $glength; $i++){
                $gResult = $gameResult[$i]->name;
                $poster = $gameResult[$i]->background_image;
                echo '<img src=' .$poster .'>';
                echo "<li>" .'<input type = "submit" name = "cButtons" class = "resultButtons" value="' .$gResult. '"/>';
                echo '</li>';
              }
              echo '</ul>';
              echo '</form>';
            }
          }
        }

        if(isset($_GET['searchMoviesBtn'])){
          if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(empty($_GET['movieTitle'])){
              //error message back to original page
            }else{
              $mvtString = addPlus($_GET['movieTitle']);
              $data = getImdbRecord2($mvtString, $ApiKey);
              $results = $data['Search'];
              $length = count($results);
              echo '<form action="searchMovies.php" method="get">';
              echo '<h2>' .'Results' .'</h2>';
              echo '<br>' .'<h2>' .'Movies' .'</h2>';
              for($i = 0; $i < $length; $i++){
              $titles = $results[$i]['Title'];
              $poster = $results[$i]['Poster'];
              echo '<img src=' .$poster .'>';
              echo "<li>" .'<input type = "submit" name = "sButtons" class = "resultButtons" value="' .$titles. '"/>';
              echo '</li>';
              }
              echo '</ul>';
              echo '</form>';
            }
          }
        }

        if(isset($_GET['tvSearchBtn'])){
          if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(empty($_GET['tvTitle'])){
              //error message back to original page
            }else{
              $mvtString = addPlus($_GET['tvTitle']);
              $data = getImdbRecord2($mvtString, $ApiKey);
              $results = $data['Search'];
              $length = count($results);
              echo '<form action="tvSearch.php" method="get">';
              echo '<h2>' .'Results' .'</h2>';
              echo '<br>' .'<h2>' .'TV Shows' .'</h2>';
              for($i = 0; $i < $length; $i++){
              $titles = $results[$i]['Title'];
              $poster = $results[$i]['Poster'];
              echo '<img src=' .$poster .'>';
              echo "<li>" .'<input type = "submit" name = "tButtons" class = "resultButtons" value="' .$titles. '"/>';
              echo '</li>';
              }
              echo '</ul>';
              echo '</form>';
            }
          }
        }

        if(isset($_GET['gSearchBtn'])){
          if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(empty($_GET['gameTitle'])){
              //error message back to original page
            }else{
              $gameResult = findGames($_GET['gameTitle']);
              $glength = count($gameResult);
              echo '<form action="gameSearch.php" method="get">';
              echo '<h2>' .'Results' .'</h2>';
              echo '<br>' .'<h2>' .'Video Games' .'</h2>';
              for($i = 0; $i < $glength; $i++){
                $gResult = $gameResult[$i]->name;
                $poster = $gameResult[$i]->background_image;
                echo '<img src=' .$poster .'>';
                echo "<li>" .'<input type = "submit" name = "vgButtons" class = "resultButtons" value="' .$gResult. '"/>';
                echo '</li>';
              }
              echo '</ul>';
              echo '</form>';
            }
          }
        }

      ?>

</div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

