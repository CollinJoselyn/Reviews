<?php
//these variables are for hashing the password
$hashAlgo = "sha256";
$beginSalt= "i9_VE~xd!6G%:m%zDJ-MuWk)T&5={8<#>3p$}g.h";
$endSalt = "z)^|u|lJPJ!(NwgE{bb#>fp>r@7HAFH#,#MWl0(f";

//this function is used to filter a string input. Removing slashes and special characters.
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = str_replace("&amp;", "&", $data);
  return $data;
}

//This function replaces whitespace with a +
function addPlus($string){
    return str_replace(" ", "+", $string);
}

//This password translates the string to the hash 
function filterPassword($password, $passwordConfirm, $hashAlgo, $beginSalt, $endSalt){
	if($password != $passwordConfirm){
		return false;
	}else{
		$password = hash($hashAlgo, $beginSalt . $password . $endSalt);
	}
	return $password;
}

?>