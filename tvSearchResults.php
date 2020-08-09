<?php
/*
This page displays the data for the tv show the user searched for on tv.php or the title they clicked on in tv.php.
The user can leave a review for the tv show displayed. 
*/
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
//This checks to see if the noRatingReview session variable is true. If user doesn't write both a review and leave a rating
if($_SESSION['noRatingReview'] == true){
  //pop up to inform user they must write a review and leave a rating.
echo '<script type="text/javascript">alert("Please write a review and leave a rating!");</script>';
$_SESSION['noRatingReview'] = false; //set the variable back to false
}

//Checks isSignedIn session variable to see if it equals 'no'.
if($_SESSION['isSignedIn'] === 'no'){
//pop up error message telling user they have to be signed in to leave a review
echo '<script type="text/javascript">alert("You must be signed in to leave a review!");</script>';
$_SESSION['isSignedIn'] = 'yes';
}

$poster = $_SESSION['tTitle']['Poster']; //contains the poster
$tvInfo = $_SESSION['tTitle']; //contains tv show data from the title the user clicked on in tv.php page
$poster2 = $_SESSION['tPageButton']['Poster']; //constains the poster
$tvInfo2 = $_SESSION['tPageButton']; //session variable that contains data for the tv show that the user searched for on tv.php
$_SESSION['type'] = "movieTV"; //determines the type

unset($_SESSION['previousPage']);  //unsets the previousPage session variable
$_SESSION['previousPage'] = $_SERVER['PHP_SELF']; //sets the previousPage session variable to this page
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
        $id = $tvInfo['imdbID']; //selects the imdbID from the title the user clicked on in tv.php page
        $id2 = $tvInfo2['imdbID']; //selects the imdbID from the tv show that the user searched for on tv.php
        $sqlRating = "SELECT AVG(rating) avg FROM review WHERE titleID = '$id'"; //gets the average rating 
        $results = $db->query($sqlRating);
        $sqlRating2 = "SELECT AVG(rating) avg FROM review WHERE titleID = '$id2'"; //gets the average rating
        $results2 = $db->query($sqlRating2);
        $sql3 = "SELECT rating FROM review WHERE titleID = '$id'"; //gets the rating
        $results3 = $db->query($sql3);
        $sql4 = "SELECT rating FROM review WHERE titleID = '$id2'"; //gets the rating
        $results4 = $db->query($sql4);

        //Gets the average rating for the title user clicked on in tv.php
        if($results3->num_rows > 0){ 
        if($results->num_rows > 0){
          while($row = $results->fetch_assoc()){
            if(is_null($row['avg'])){ //checks if the result is null
              $rating = "No reviews yet"; //if null, then rating will say no reviews yet
            }else{
              $rating = $row['avg']; //if not null, then rating will contain the rating for that title
            }
          }
        }
      }else{
        $noReview = " People have reviewed this title"; //no review message will be set
      }

        //get the average rating for the title the user searched for on tv.php
        if($results4->num_rows > 0){
        if($results2->num_rows > 0){
          while($row = $results2->fetch_assoc()){
            if(is_null($row['avg'])){ //checks if the result is null
              $rating2 = " People have reviewed the title"; 
            }else{
              $rating2 = $row['avg']; //if not null, then rating will contain the rating for that title
            }
          }
        }
      }else{
        $noReview = " People have reviewed this title"; //no review message will be set
      }

        if($tvInfo && $_SESSION['mediaName'] == $tvInfo['Title']){ //displays the tv show data from the title the user clicked on in tv.php page
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
       }else{ //displays the data for the tv show that the user searched for on tv.php
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

  <br>
  <a href="<?php echo $_SESSION['previousPage2']; ?>" class="backButton"><img src="arrow.jpg">Back</a>

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