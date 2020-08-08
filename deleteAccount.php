<?php
session_start();
require_once 'dbconnection.php';
require_once 'inputFilters.php';
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
function checkForm(e) { 
   if (!(window.confirm("Are you sure you want to delete your account?"))) 
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
  
  
<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <br><h2>Delete Account</h2><br>
        <p>We are sad to see you go.
      Are you sure you want to delete your account?</p>
      
      <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onSubmit = "return checkForm(event)">
        <br><input type="submit" value="Yes Delete My Account" name="deleteAccount">
      </form>
      </div>
    </div>
  </div>

  <?php
  $uid = $_SESSION['userID'];

  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['deleteAccount'])){
      $sql = "DELETE FROM review WHERE userID = '$uid'";
      $db->query($sql);
      $sql2 = "DELETE FROM user WHERE userID = '$uid';";
      $db->query($sql2);
      session_destroy();
      session_start();
      $_SESSION['delAccount'] = true;
      header('location: index.php');
    }
  }
  ?>

  <a href="userHomePage.php" class="backButton"><img src="arrow.jpg">Back</a>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>

</html>