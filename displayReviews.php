<?php
session_start();
require_once 'dbconnection.php';
?>

<?php
$moviePage = $_SESSION['mTitle'];
$tvPage = $_SESSION['tTitle'];
$indexMT = $_SESSION['mtSearchResults'];
$indexVG = $_SESSION['vgSearchResults'];
$vgPage = $_SESSION['gameInfo'];


//if($results->num_rows > 0){
  //while($row = $results->fetch_assoc()){
    //echo $row['username'] .$row['rating'] .$row['writtenReview'];
  //}
//}
?>

<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <?php
        if(isset($moviePage)){
          $title = $moviePage['Title'];
          echo '<h1 class="mt-5">' .'Reviews for' .' ' .$title .'</h1>';
          echo '</div>';
          $sql = "SELECT review.rating, review.writtenReview, review.titleOfMedia, user.username FROM review 
          LEFT JOIN user ON review.userID = user.userID WHERE review.titleOfMedia = '$title'";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
              echo '<ul class="reviewDisplay">';
              echo '<li>' .$row['username'] .'</li>';
              echo '<li>' .$row['rating'] .'</li>';
              echo '</ul>';
              echo '</div>';
              echo '<p>' .$row['writtenReview'] .'</p>';
              echo '</div>'; 
            }
          }
        }
        
        ?>