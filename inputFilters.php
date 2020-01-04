<?php

//this function is used to filter a string input. Removing slashes and specail characters.
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function filterPassword($password, $passwordConfirm, $hashAlgo, $beginSalt, $endSalt){
	if($password != $passwordConfirm){
		return false;
	}else{
		$password = hash($hashAlgo, $beginSalt, $password, $endSalt);
	}
}

?>