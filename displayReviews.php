<?php
session_start();
require_once 'dbconnection.php';
?>

<?php
$moviePage = $_SESSION['mPageResults'];
$tvPage = $_SESSION['tTitle'];
$indexMT = $_SESSION['mtSearchResults'];
$indexVG = $_SESSION['vgSearchResults'];
$vgPage = $_SESSION['gameInfo'];
$mPageButtons = $_SESSION['mPageButton'];
$tPageButtons = $_SESSION['tPageButton'];
$gamePageResults = $_SESSION['gamesSearchResults'];


//if($results->num_rows > 0){
  //while($row = $results->fetch_assoc()){
    //echo $row['username'] .$row['rating'] .$row['writtenReview'];
  //}
//}
?>


        <?php
        
        echo '<div class="col-lg-12 text-center">';
        if(isset($moviePage) && $moviePage['Title'] === $_SESSION['mediaName']){
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
              //unset($moviePage);
              //unset($_SESSION['mediaName']);
            }
          }
        }elseif(isset($tvPage) && $tvPage['Title'] === $_SESSION['mediaName']){
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
        }elseif(isset($indexMT) && $indexMT['Title'] === $_SESSION['mediaName']){
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
        }elseif(isset($indexVG) && $indexVG->name === $_SESSION['mediaName']){
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
        }elseif(isset($vgPage) && $vgPage->name === $_SESSION['mediaName']){
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
        }elseif(isset($mPageButtons) && $mPageButtons['Title'] === $_SESSION['mediaName']){
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
        }elseif(isset($tPageButtons) && $tPageButtons['Title'] === $_SESSION['mediaName']){
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
        }elseif(isset($gamePageResults) && $gamePageResults->name == $_SESSION['mediaName']){
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
              //unset($gamePageResults);
              //unset($_SESSION['mediaName']);
            }
          }
        }
        
        ?>