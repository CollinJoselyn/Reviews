<?php
/*
This page displays the reviews left by the user. The user can view them and delete them.
*/
session_start();
require_once 'dbconnection.php';
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

<script type="text/javascript">
//confirmation message for deleting a review
function checkForm(e) { 
   if (!(window.confirm("Are you sure you want to delete this review?"))) 
     e.returnValue = false; 
 }
</script>


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
  <?php if(!isset($_SESSION['username'])): header("location: signOut.php");?>
<?php else: ?>
<?php endif ?>
  
  

      <div class="col-lg-12 text-center">
        <?php echo "<h1> Reviews From " .$_SESSION['username']. "</h1>"; ?>
        </div>

        <?php
          $_SESSION['did'] = 0;
          $uid = $_SESSION['userID'];
          $sql = "SELECT writtenReview, date, titleOfMedia, reviewID FROM review WHERE userID = '$uid'";
          $results = $db->query($sql);
          if($results->num_rows > 0){
            echo '<form action="deleteReview.php" method = "GET" id="myCoolForm" onSubmit = "return checkForm(event)">';
            while($row = $results->fetch_assoc()){
              echo '<div class="reviewDisplay">';
              echo '<ul>';
              $rID = $row['reviewID'];
              echo '<li>' .$row['date'] .'</li>';
              echo '<li>' .'<em>' .$row['titleOfMedia'] .'</em>' .'  <button type="submit" value=' .$rID .' name = myR>' .'Delete'.'</button>' .'</li>';
              echo '<p>' .$row['writtenReview'] .'</p>';
              echo '<hr>';
              echo '</ul>';
              echo '</div>';
            }
            echo '</form>';
          }else{
            echo '<div class="col-lg-12 text-center">';
            echo '<br>' .'<br>';
            echo '<h2>' .'No reviews yet.' .'</h2>';
            echo '</div>';
          }
        ?>

        <a href="userHomePage.php" class="backButton"><img src="arrow.jpg">Back</a>
        

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>

</html>