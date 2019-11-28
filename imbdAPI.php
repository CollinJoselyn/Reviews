<?php
//require_once 'C:\xampp\php\unirest-php-master\unirest-php-master\src\Unirest.php';

/*$response = Unirest\Request::get("https://movie-database-imdb-alternative.p.rapidapi.com/?i=tt4154796&r=json",
  array(
    "X-RapidAPI-Host" => "movie-database-imdb-alternative.p.rapidapi.com",
    "X-RapidAPI-Key" => "cb3217cdeamsh7371e98afe4a7c8p1468c6jsn4d9a01a9a82f"  )
);
*/

?>

<?php

//$title = "The Big Lebowski";
//$path = "http://www.omdbapi.com/?t=$title&apikey=99000d3e";
//$json = file_get_contents($path);
//$result = json_decode($json, TRUE);

//echo $result;
//$ApiKey = "99000d3e";
function getImdbRecord($ImdbId, $ApiKey)
{
    $path = "http://www.omdbapi.com/?t=$ImdbId&apikey=$ApiKey";
    $json = file_get_contents($path);
    return json_decode($json, TRUE);
}

function getPoster($title, $ApiKey){
	$path = "http://img.omdbapi.com/?apikey=$ApiKey&t=$title";
	$json = file_get_contents($path);
	return json_decode($json, TRUE);
}

$data = getImdbRecord("The+Big+Lebowski+", "99000d3e");

//echo "<pre>";
//print_r($data);
//echo "</pre>";
//echo $data['Title'];

?>