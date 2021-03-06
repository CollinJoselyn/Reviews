<?php
/*
This page displays the search results to the user. After the user types something in the search
field on the movies.php, tv.php, index.php and videoGame.php pages, it will direct them
to this page which displays the results.
*/

session_start();
require_once 'dbconnection.php';
include 'imbdAPI.php';
include 'gamesApi.php';
include 'inputFilters.php';
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
          <?php 
          if(isset($_GET['searchBtn'])){
            echo '<li class="nav-item active">';
          }else{
            echo '<li class="nav-item">';
          }
          ?>
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php 
          if(isset($_GET['searchMoviesBtn'])){
            echo '<li class="nav-item active">';
          }else{
            echo '<li class="nav-item">';
          }
          ?>
            <a class="nav-link" href="movies.php">Movies</a>
          </li>
          <?php 
          if(isset($_GET['gSearchBtn'])){
            echo '<li class="nav-item active">';
          }else{
            echo '<li class="nav-item">';
          }
          ?>
            <a class="nav-link" href="videoGames.php">Video Games</a>
          </li>
          <?php 
          if(isset($_GET['tvSearchBtn'])){
            echo '<li class="nav-item active">';
          }else{
            echo '<li class="nav-item">';
          }
          ?>
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

<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <br><h1>Results</h1></div>
    	<div class="resultSection">
    	
    	<ul>
      <?php
      


        if(isset($_GET['searchBtn'])){ //checks if the search button from index.php was clicked
          if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(empty($_GET['search'])){
              //error message back to original page
              $_SESSION['blank'] = "Please enter a title"; //session variable for error message if user enters nothing
              header('location: index.php'); //send user back to index.php
            }else{ //if user types something into the search bar in index.php
              unset($_SESSION['blank']);  //unsets the session variable for blank error msg
              $indexSearch = test_input($_GET['search']); //filters the string 
              $mvtString = addPlus($indexSearch);  //replace white space with +
              $data = getImdbRecord2($mvtString, $ApiKey);  //uses the give search title and searchs for movies and tv shows. will contain multiple results
              $gameResult = findGames($indexSearch); //uses the given search title to search for games. Will contain multiple results
              $results = $data['Search'];  //contains the results for the movie/tv shows
              $gameResult = findGames($indexSearch); //contains the results for the video game search
              $length = count($results);  //number of results for movies/tv 
              $glength = count($gameResult); //number of results for video games
              echo '<form action="searchAll.php" method="get">';  //form that contains the results of the search. When user clicks on one it will be processed by searchAll.php
              echo '<br>' .'<h2>' .'Movies and TV' .'</h2>' .'<br>';
              if($length < 1){ //if there are zero results for the movie/tv search
                //error message displayed to the user
                echo '<span style="color:red;">' .'0 results for ' .'<em>' .$indexSearch .'</em>' .' in movies and tv. ' .'Please verify the title name and the spelling.' .'</span>' .'<br>';
              }else{ //if there are results for the movie/tv title
              for($i = 0; $i < $length; $i++){ //loop used to display the results
                $titles = $results[$i]['Title'];
                $poster = $results[$i]['Poster'];
                echo '<img src=' .$poster .'>';
                echo "<li>" .'<input type = "submit" name = "rButtons" class = "resultButtons" value="' .$titles. '"/>';
                echo '</li>' .'<br>';
              }
            }
              echo '<br>' .'<h2>' .'Video Games' .'</h2>' .'<br>';
              if($glength < 1){  //if there are zero results for the given video title
                //displays error message to the user
                echo '<span style="color:red;">' .'0 results for ' .'<em>' .$indexSearch .'</em>' .' in video games. ' .'Please verify the title name and the spelling.' .'</span>';
                echo '<br>' .'<br>';
                echo '<a href="index.php" class="backButton">' .'<img src="arrow.jpg">' .'Back' .'</a>'; //back button that sends user to index.php
              }else{
              for($i = 0; $i < $glength; $i++){ //loop used to display the video game results
                $gResult = $gameResult[$i]->name;
                $poster = $gameResult[$i]->background_image;
                echo '<img src=' .$poster .'>';
                echo "<li>" .'<input type = "submit" name = "cButtons" class = "resultButtons" value="' .$gResult. '"/>';
                echo '</li>' .'<br>';
              }
            }
              echo '</ul>';
              echo '</form>';
            }
          }
        }

        if(isset($_GET['searchMoviesBtn'])){ //If the user clicks the search button on movies.php page
          if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(empty($_GET['movieTitle'])){
              //error message back to original page
              $_SESSION['blank'] = "Please enter a title"; //session variable with blank search entry error msg
              header('location: movies.php'); //send user to movies.php
            }else{
              unset($_SESSION['blank']);
              $indexSearch = test_input($_GET['movieTitle']); //filters the search entry
              $mvtString = addPlus($indexSearch); //replace whitespace with +
              $data = getImdbRecord2($mvtString, $ApiKey); //variable that contains the results (multiple) for the search entry. 
              $results = $data['Search']; 
              $length = count($results); //number of results
              echo '<form action="searchMovies.php" method="get">';  //When user clicks on a title it will be processed by searchMovies.php
              echo '<br>' .'<h2>' .'Movies' .'</h2>' .'<br>';
              if($length < 1){ //if there are zero results
                //Error message given to the user
                echo '<span style="color:red;">' .'0 results for ' .'<em>' .$indexSearch .'</em>' .' in movies. ' .'Please verify the title name and the spelling.' .'</span>' .'<br>'; 
                echo '<br>' .'<br>';
                echo '<a href="movies.php" class="backButton">' .'<img src="arrow.jpg">' .'Back' .'</a>'; //back button will send user to movies.php
              }else{
              for($i = 0; $i < $length; $i++){ //this loop will display the results to the user
              $titles = $results[$i]['Title'];
              $poster = $results[$i]['Poster'];
              echo '<img src=' .$poster .'>';
              echo "<li>" .'<input type = "submit" name = "sButtons" class = "resultButtons" value="' .$titles. '"/>';
              echo '</li>' .'<br>';
              }
            }
              echo '</ul>';
              echo '</form>';
            }
          }
        }

        if(isset($_GET['tvSearchBtn'])){ //if user clicks the search button on tv.php page
          if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(empty($_GET['tvTitle'])){
              //error message back to original page
              $_SESSION['blank'] = "Please enter a title";
              header('location: tv.php'); //send user back to tv.php
            }else{
              unset($_SESSION['blank']);
              $indexSearch = test_input($_GET['tvTitle']); //filters the search entry
              $mvtString = addPlus($indexSearch); //replaces the whitespace with a +
              $data = getImdbRecord2($mvtString, $ApiKey); //searches the api for the title
              $results = $data['Search']; //results of the search
              $length = count($results); //number of results
              echo '<form action="tvSearch.php" method="get">';  //form will send to tvSearch.php to process 
              echo '<br>' .'<h2>' .'TV Shows' .'</h2>' .'<br>';
              if($length < 1){ //if there are no results
                //display error message to the user
                echo '<span style="color:red;">' .'0 results for ' .'<em>' .$indexSearch .'</em>' .' in tv shows. ' .'Please verify the title name and the spelling.' .'</span>' .'<br>';
                echo '<br>' .'<br>';
                echo '<a href="tv.php" class="backButton">' .'<img src="arrow.jpg">' .'Back' .'</a>';  //back button sends user to tv.php
              }else{
              for($i = 0; $i < $length; $i++){ //loop will display results to the user
              $titles = $results[$i]['Title'];
              $poster = $results[$i]['Poster'];
              echo '<img src=' .$poster .'>';
              echo "<li>" .'<input type = "submit" name = "tButtons" class = "resultButtons" value="' .$titles. '"/>';
              echo '</li>' .'<br>';
              }
            }
              echo '</ul>';
              echo '</form>';
            }
          }
        }

        if(isset($_GET['gSearchBtn'])){ //if the user clicks the search button on the videoGames.php page
          if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(empty($_GET['gameTitle'])){
              //error message back to original page
              $_SESSION['blank'] = "Please enter a title";
              header('location: videoGames.php');
            }else{
              unset($_SESSION['blank']);
              $indexSearch = test_input($_GET['gameTitle']); //filters the search entry
              $gameResult = findGames($indexSearch);  //searches api for games with that title
              $glength = count($gameResult); //number of results
              echo '<form action="gameSearch.php" method="get">';  //form will send to gameSearch.php to process
              echo '<br>' .'<h2>' .'Video Games' .'</h2>' .'<br>';
              if($glength < 1){ //if there are no results
                //display the error to the user
                echo '<span style="color:red;">' .'0 results for ' .'<em>' .$indexSearch .'</em>' .' in video games. ' .'Please verify the title name and the spelling.' .'</span>' .'<br>';
                echo '<br>' .'<br>';
                echo '<a href="videoGames.php" class="backButton">' .'<img src="arrow.jpg">' .'Back' .'</a>';
              }else{
              for($i = 0; $i < $glength; $i++){  //loop that displays the results to the user
                $gResult = $gameResult[$i]->name;
                $poster = $gameResult[$i]->background_image;
                echo '<img src=' .$poster .'>';
                echo "<li>" .'<input type = "submit" name = "vgButtons" class = "resultButtons" value="' .$gResult. '"/>';
                echo '</li>' .'<br>';
              }
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

