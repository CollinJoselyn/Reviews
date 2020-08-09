<?php
/*
This page pulls reviews from the database and displays it to the user
*/
session_start();
require_once 'dbconnection.php';
?>

<?php
$moviePage = $_SESSION['mPageResults']; //contains movie data from the title the user searched for on movies.php; Movies.php -> results.php -> searchMovies.php
$tvPage = $_SESSION['tTitle']; //contains tv show data from the title the user clicked on in tv.php page
$indexMT = $_SESSION['mtSearchResults']; //contains movie/tv show data from the title the user searched for on index.php
$indexVG = $_SESSION['vgSearchResults']; //contains video game data from the title the user searched for on index.php
$vgPage = $_SESSION['gameInfo']; //contains video game data from the title the user clicked on in the videoGame.php page 
$mPageButtons = $_SESSION['mPageButton']; //contains movie data from the title the user clicked on in the movies.php page
$tPageButtons = $_SESSION['tPageButton']; //session variable that contains data for the tv show that the user searched for on tv.php
$gamePageResults = $_SESSION['gamesSearchResults']; //session variable that contains game data for the game the user searched for on videoGames.php

?>


        <?php
        
        echo '<div class="col-lg-12 text-center">';
        if(isset($moviePage) && $moviePage['Title'] === $_SESSION['mediaName']){ //checks to see if mPageResults session variable is active and if the title matches the mediaName session variable
          $title1 = $moviePage['Title'];
          echo '<h1 class="mt-5">' .'Reviews for' .' ' .$title1 .'</h1>';
          echo '<br>';
          echo '</div>';
          $sql = "SELECT review.rating, review.writtenReview, review.titleOfMedia, user.username FROM review 
          LEFT JOIN user ON review.userID = user.userID WHERE review.titleOfMedia = '$title1'";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
              echo '<div class="reviewDisplay">';
              echo '<ul>';
              echo '<li>' .'<span style="font-family:Arial Rounded MT Bold;">' .$row['username'] .'</span>' .'</li>';
              echo '<li>' .$row['rating'] .'/10' .'</li>';
              echo '<p>' .'<span style="font-family:lucida sans typewriter;">' .$row['writtenReview'] .'</span>' .'</p>';
              echo '</ul>';
              echo '<hr>';
              echo '</div>';
            }
          }
        }elseif(isset($tvPage) && $tvPage['Title'] === $_SESSION['mediaName']){ //check to see if tTitle session variable is active and if the title matches the mediaName session variable
          $title2 = $tvPage['Title'];
          echo '<h1 class="mt-5">' .'Reviews for' .' ' .$title2 .'</h1>';
          echo '</div>';
          $sql = "SELECT review.rating, review.writtenReview, review.titleOfMedia, user.username FROM review 
          LEFT JOIN user ON review.userID = user.userID WHERE review.titleOfMedia = '$title2'";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
              echo '<div class="reviewDisplay">';
              echo '<ul>';
              echo '<li>' .'<span style="font-family:Arial Rounded MT Bold;">' .$row['username'] .'</span>' .'</li>';
              echo '<li>' .$row['rating'] .'/10' .'</li>';
              echo '<p>' .'<span style="font-family:lucida sans typewriter;">' .$row['writtenReview'] .'</span>' .'</p>';
              echo '</ul>';
              echo '<hr>';
              echo '</div>';
              //unset($tvPage);
              //unset($_SESSION['mediaName']);
            }
          }
        }elseif(isset($indexMT) && $indexMT['Title'] === $_SESSION['mediaName']){ //checks to see if the mtSearchResults session variable is active and if the title matches the mediaName variable
          $title3 = $indexMT['Title'];
          echo '<h1 class="mt-5">' .'Reviews for' .' ' .$title3 .'</h1>';
          echo '</div>';
          $sql = "SELECT review.rating, review.writtenReview, review.titleOfMedia, user.username FROM review 
          LEFT JOIN user ON review.userID = user.userID WHERE review.titleOfMedia = '$title3'";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
              echo '<div class="reviewDisplay">';
              echo '<ul>';
              echo '<li>' .'<span style="font-family:Arial Rounded MT Bold;">' .$row['username'] .'</span>' .'</li>';
              echo '<li>' .$row['rating'] .'/10' .'</li>';
              echo '<p>' .'<span style="font-family:lucida sans typewriter;">' .$row['writtenReview'] .'</span>' .'</p>';
              echo '</ul>';
              echo '<hr>';
              echo '</div>';
              //unset($indexMT);
              //unset($_SESSION['mediaName']);
            }
          }
        }elseif(isset($indexVG) && $indexVG->name === $_SESSION['mediaName']){  //checks to see if vgSearchResults session variable is active and if the title matches the mediaName session variable
          $title4 = $indexVG->name;
          echo '<h1 class="mt-5">' .'Reviews for' .' ' .$title4 .'</h1>';
          echo '</div>';
          $sql = "SELECT review.rating, review.writtenReview, review.titleOfMedia, user.username FROM review 
          LEFT JOIN user ON review.userID = user.userID WHERE review.titleOfMedia = '$title4'";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
              echo '<div class="reviewDisplay">';
              echo '<ul>';
              echo '<li>' .'<span style="font-family:Arial Rounded MT Bold;">' .$row['username'] .'</span>' .'</li>';
              echo '<li>' .$row['rating'] .'/10' .'</li>';
              echo '<p>' .'<span style="font-family:lucida sans typewriter;">' .$row['writtenReview'] .'</span>' .'</p>';
              echo '</ul>';
              echo '<hr>';
              echo '</div>';
              //unset($indexVG);
              //unset($_SESSION['mediaName']);
            }
          }
        }elseif(isset($vgPage) && $vgPage->name === $_SESSION['mediaName']){ //checks to see if gameInfo session variable is active and if the title matches the mediaName session variable
          $title5 = $vgPage->name;
          echo '<h1 class="mt-5">' .'Reviews for' .' ' .$title5 .'</h1>';
          echo '</div>';
          $sql = "SELECT review.rating, review.writtenReview, review.titleOfMedia, user.username FROM review 
          LEFT JOIN user ON review.userID = user.userID WHERE review.titleOfMedia = '$title5'";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
              echo '<div class="reviewDisplay">';
              echo '<ul>';
              echo '<li>' .'<span style="font-family:Arial Rounded MT Bold;">' .$row['username'] .'</span>' .'</li>';
              echo '<li>' .$row['rating'] .'/10' .'</li>';
              echo '<p>' .'<span style="font-family:lucida sans typewriter;">' .$row['writtenReview'] .'</span>' .'</p>';
              echo '</ul>';
              echo '<hr>';
              echo '</div>';
              //unset($vgPage);
              //unset($_SESSION['mediaName']);
            }
          }
        }elseif(isset($mPageButtons) && $mPageButtons['Title'] === $_SESSION['mediaName']){ //checks to see if mPageButton session variable is active and if the title matches the mediaName session variable
          $title2 = $mPageButtons['Title'];
          echo '<h1 class="mt-5">' .'Reviews for' .' ' .$title2 .'</h1>';
          echo '</div>';
          $sql = "SELECT review.rating, review.writtenReview, review.titleOfMedia, user.username FROM review 
          LEFT JOIN user ON review.userID = user.userID WHERE review.titleOfMedia = '$title2'";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
              echo '<div class="reviewDisplay">';
              echo '<ul>';
              echo '<li>' .'<span style="font-family:Arial Rounded MT Bold;">' .$row['username'] .'</span>' .'</li>';
              echo '<li>' .$row['rating'] .'/10' .'</li>';
              echo '<p>' .'<span style="font-family:lucida sans typewriter;">' .$row['writtenReview'] .'</span>' .'</p>';
              echo '</ul>';
              echo '<hr>';
              echo '</div>';
              //unset($mPageButtons);
              //unset($_SESSION['mediaName']);
            }
          }
        }elseif(isset($tPageButtons) && $tPageButtons['Title'] === $_SESSION['mediaName']){ //checks to see if tPageButton session variable is active and if the title matches the mediaName session variable
          $title2 = $tPageButtons['Title'];
          echo '<h1 class="mt-5">' .'Reviews for' .' ' .$title2 .'</h1>';
          echo '</div>';
          $sql = "SELECT review.rating, review.writtenReview, review.titleOfMedia, user.username FROM review 
          LEFT JOIN user ON review.userID = user.userID WHERE review.titleOfMedia = '$title2'";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
              echo '<div class="reviewDisplay">';
              echo '<ul>';
              echo '<li>' .'<span style="font-family:Arial Rounded MT Bold;">' .$row['username'] .'</span>' .'</li>';
              echo '<li>' .$row['rating'] .'/10' .'</li>';
              echo '<p>' .'<span style="font-family:lucida sans typewriter;">' .$row['writtenReview'] .'</span>' .'</p>';
              echo '</ul>';
              echo '<hr>';
              echo '</div>';
              //unset($tPageButtons);
              //unset($_SESSION['mediaName']);
            }
          }
        }elseif(isset($gamePageResults) && $gamePageResults->name == $_SESSION['mediaName']){ //checks to see if gamesSearchResults session variable is active and if the title matches the mediaName session variable
          $title5 = $gamePageResults->name;
          echo '<h1 class="mt-5">' .'Reviews for' .' ' .$title5 .'</h1>';
          echo '</div>';
          $sql = "SELECT review.rating, review.writtenReview, review.titleOfMedia, user.username FROM review 
          LEFT JOIN user ON review.userID = user.userID WHERE review.titleOfMedia = '$title5'";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
              echo '<div class="reviewDisplay">';
              echo '<ul>';
              echo '<li>' .'<span style="font-family:Arial Rounded MT Bold;">' .$row['username'] .'</span>' .'</li>';
              echo '<li>' .$row['rating'] .'/10' .'</li>';
              echo '<p>' .'<span style="font-family:lucida sans typewriter;">' .$row['writtenReview'] .'</span>' .'</p>';
              echo '</ul>';
              echo '<hr>';
              echo '</div>';
            }
          }
        }
        
        ?>