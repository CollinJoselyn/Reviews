<?php

$hashAlgo = "sha256";
$beginSalt= "i9_VE~xd!6G%:m%zDJ-MuWk)T&5={8<#>3p$}g.h";
$endSalt = "z)^|u|lJPJ!(NwgE{bb#>fp>r@7HAFH#,#MWl0(f";

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
		$password = hash($hashAlgo, $beginSalt . $password . $endSalt);
	}
	return $password;
}

?>