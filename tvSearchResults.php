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
$poster = $_SESSION['tTitle']['Poster'];
$tvInfo = $_SESSION['tTitle'];
$poster2 = $_SESSION['tPageButton']['Poster'];
$tvInfo2 = $_SESSION['tPageButton'];
$_SESSION['type'] = "movieTV";
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
        <h1>Search Results</h1>
        </div>
    </div>
  </div>
  <br>
  <div class="container">
    <div class="row">
      <div class="moviePoster">
         <?php
        $rating;
        $rating2;
        $noReview = "";
        $id = $tvInfo['imdbID'];
        $id2 = $tvInfo2['imdbID'];
        $sqlRating = "SELECT AVG(rating) avg FROM review WHERE titleID = '$id'";
        $results = $db->query($sqlRating);
        $sqlRating2 = "SELECT AVG(rating) avg FROM review WHERE titleID = '$id2'";
        $results2 = $db->query($sqlRating2);
        $sql3 = "SELECT rating FROM review WHERE titleID = '$id'";
        $results3 = $db->query($sql3);
        $sql4 = "SELECT rating FROM review WHERE titleID = '$id2'";
        $results4 = $db->query($sql4);

        if($results3->num_rows > 0){
        if($results->num_rows > 0){
          while($row = $results->fetch_assoc()){
            if(is_null($row['avg'])){
              $rating = "No reviews yet";
            }else{
              $rating = $row['avg'];
            }
          }
        }
      }else{
        //$rating = "No reviews yet";
        $noReview = " People have reviewed this title";
      }

        if($results4->num_rows > 0){
        if($results2->num_rows > 0){
          while($row = $results2->fetch_assoc()){
            if(is_null($row['avg'])){
              $rating2 = " People have reviewed the title";
            }else{
              $rating2 = $row['avg'];
            }
          }
        }
      }else{
        //$rating2 = "No reviews yet";
        $noReview = " People have reviewed this title";
      }

        if($tvInfo && $_SESSION['mediaName'] == $tvInfo['Title']){
         echo '<img src="' .$poster .'" alt="Movie Poster">';
         echo  '<ul class="movieInfo">';
         echo '<li>' .'<span> ' .'Title:  ' .'</span>' .' ' .$tvInfo['Title'] . '</li>';
         echo '<li>' .'<span> ' .'Year:  ' .'</span>' .' ' .$tvInfo['Year'] .'</li>';
         echo '<li>' .'<span> ' .'Rated:  ' .'</span>' .' ' .$tvInfo['Rated'] .'</li>';
         echo '<li>' .'<span> ' .'Runtime:  ' .'</span>' .' ' .$tvInfo['Runtime'] .'</li>';
         echo '<li>' .'<span> ' .'Genre:  ' .'</span>'  .' ' .$tvInfo['Genre'] .'</li>';
         echo '<li>' .'<span> ' .'Director:  ' .'</span>' .' ' .$tvInfo['Director'] .'</li>';
         echo '<li>' .'<span> ' .'Writor:  ' .'</span>' .' ' .$tvInfo['Writer'] .'</li>';
         echo '<li>' .'<span> ' .'Actors:  ' .'</span>' .' ' .$tvInfo['Actors'] .'</li>';
         echo '<li>' .'<span> ' .'Plot:  ' .'</span>'  .' ' .$tvInfo['Plot']  .'</li>';
         echo '<li>' .'<span> ' .'User Rating:  ' .'</span>' .' ' .round($rating, 1) .$noReview .'</li>';
         echo '</ul>';
       }else{
        echo '<img src="' .$poster2 .'" alt="Movie Poster">';
         echo  '<ul class="movieInfo">';
         echo '<li>' .'<span> ' .'Title:  ' .'</span>' .' ' .$tvInfo2['Title'] . '</li>';
         echo '<li>' .'<span> ' .'Year:  ' .'</span>' .' ' .$tvInfo2['Year'] .'</li>';
         echo '<li>' .'<span> ' .'Rated:  ' .'</span>' .' ' .$tvInfo2['Rated'] .'</li>';
         echo '<li>' .'<span> ' .'Runtime:  ' .'</span>' .' ' .$tvInfo2['Runtime'] .'</li>';
         echo '<li>' .'<span> ' .'Genre:  ' .'</span>'  .' ' .$tvInfo2['Genre'] .'</li>';
         echo '<li>' .'<span> ' .'Director:  ' .'</span>' .' ' .$tvInfo2['Director'] .'</li>';
         echo '<li>' .'<span> ' .'Writor:  ' .'</span>' .' ' .$tvInfo2['Writer'] .'</li>';
         echo '<li>' .'<span> ' .'Actors:  ' .'</span>' .' ' .$tvInfo2['Actors'] .'</li>';
         echo '<li>' .'<span> ' .'Plot:  ' .'</span>'  .' ' .$tvInfo2['Plot']  .'</li>';
         echo '<li>' .'<span> ' .'User Rating:  ' .'</span>' .' ' .round($rating2, 1) .$noReview .'</li>';
         echo '</ul>';
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
      <form action="addReview.php" method="POST">
      <ul class="ratingScale">
        <li>Lowest</li>
        <li><input type="radio" name="number" value="1">1</li>
        <li><input type="radio" name="number" value="2">2</li>
        <li><input type="radio" name="number" value="3">3</li>
        <li><input type="radio" name="number" value="4">4</li>
        <li><input type="radio" name="number" value="5">5</li>
        <li><input type="radio" name="number" value="6">6</li>
        <li><input type="radio" name="number" value="7">7</li>
        <li><input type="radio" name="number" value="8">8</li>
        <li><input type="radio" name="number" value="9">9</li>
        <li><input type="radio" name="number" value="10">10</li>
        <li>Highest</li>
      </ul>
      <br>
      <textarea rows="10" cols="105" name="writtenReview"></textarea><br><br>
      <input type="hidden" name="prevPage" value="tvSearchResults.php">
      <input type="submit" name="reviewBtn" value="submit">
    </form>
    </div>
  </div>

  <?php
  include 'displayReviews.php';
    ?>

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