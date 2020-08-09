

<?php
/*
This script is for signing the user out. After it signs them out it will send them
back to index.php
*/
session_start();
session_destroy();
header('location: index.php');

?>