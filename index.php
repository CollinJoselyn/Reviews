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
$newMovie = getImdbRecord("Bad+Boys+for+Life", $ApiKey);
$newMovie2 = getImdbRecord("Sonic+the+Hedgehog", $ApiKey);
$newMovie3 = getImdbRecord("No+Time+to+Die", $ApiKey);
$newTV = getImdbRecord("Tiger+King", $ApiKey);
$newTV2 = getImdbRecord("Money+Heist", $ApiKey);
$newTV3 = getImdbRecord("Better+Call+Saul", $ApiKey);
$newGame = findGame("The Last of Us Part II");
$newGame2 = findGame("Doom Eternal");
$newGame3 = findGame("Predator: Hunting Grounds");

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
        <br><h1>Search</h1>
        <form action="results.php" method="get">
          <input type="text" name="search" value="">
          <input type="submit" value="Search" name="searchBtn"><br>
          <span><?php echo $_SESSION['error']; ?></span>
          <span><?php echo $_SESSION['blank']; ?></span>
          <span><?php echo $_SESSION['gameErr'] ?></span>
        </form>
        </div>
    </div>
  </div>
<br><br><br>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1>Whats New</h1><br><br> </div>
        <div class="frontPage">
          <ul>
            <h2>Movies</h2><br>
            <form action="searchMovies.php" method="get">
            <img src="<?php echo $newMovie['Poster']; ?>">
            <li><input type="submit" class="pageButtons" name="mPage" value="<?php echo $newMovie['Title']; ?>"></li><br>
            <img src="<?php echo $newMovie2['Poster']; ?>">
            <li><input type="submit" class="pageButtons" name="mPage" value="<?php echo $newMovie2['Title']; ?>"></li><br>
            <img src="<?php echo $newMovie3['Poster']; ?>">
            <li><input type="submit" class="pageButtons" name="mPage" value="<?php echo $newMovie3['Title']; ?>"></li><br>
          </form>
          </ul>
          <ul>
            <h2>TV</h2><br>
            <form action="tvSearch.php" method="get">
            <img src="<?php echo $newTV['Poster']; ?>">
            <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $newTV['Title']; ?>"></li><br>
            <img src="<?php echo $newTV2['Poster']; ?>">
            <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $newTV2['Title']; ?>"></li><br>
            <img src="<?php echo $newTV3['Poster']; ?>">
            <li><input type="submit" class="pageButtons" name="tvPage" value="<?php echo $newTV3['Title']; ?>"></li><br>
          </form>
          </ul>
          <ul>
            <h2>Video Games</h2><br>
            <form action="gameSearch.php" method="get">
            <img src="<?php echo $newGame->background_image; ?>">
            <li><input type="submit" class="pageButtons" name="gamePage" value="<?php echo $newGame->name; ?>"></li><br>
            <img src="<?php echo $newGame2->background_image; ?>">
            <li><input type="submit" class="pageButtons" name="gamePage" value="<?php echo $newGame2->name; ?>"></li><br>
            <img src="<?php echo $newGame3->background_image; ?>">
            <li><input type="submit" class="pageButtons" name="gamePage" value="<?php echo $newGame3->name; ?>"></li><br>
          </form>
          </ul>
        </div>
    </div>
  </div>
<br><br><br>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1>Trending Reviews</h1></div>
          <?php
          $sql = "SELECT review.reviewID, review.titleOfMedia, review.writtenReview, review.rating, user.username 
          FROM review INNER JOIN user ON review.userID = user.userID WHERE reviewID = 19 OR reviewID = 26 OR reviewID = 27 OR reviewID = 33";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            echo '<div class = "trending">';
          while($row = $results->fetch_assoc()){
                echo '<ul>' .'<br>';
                echo '<li>' .$row["username"] .'</li>';
                echo '<li>' .$row["titleOfMedia"] .'<span class="tab"' .'</span>' .$row["rating"] .'/10' .'</li>';
                echo '<li>' .$row["writtenReview"] .'</li>';
                echo '</ul>';
            }
            echo '</div>';
          }
          ?>
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
