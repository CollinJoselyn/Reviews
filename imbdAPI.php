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
/*
This script pulls data from the omdb api. THis api gives the movie and tv 
data for the site.
*/

$ApiKey = "99000d3e";

//THis function searches the omdb api for a certain movie/tv title. This only returns one result.
function getImdbRecord($ImdbId, $ApiKey)
{
    $path = "http://www.omdbapi.com/?t=$ImdbId&apikey=$ApiKey";
    $json = file_get_contents($path);
    return json_decode($json, TRUE);
}

//This function returns the poster of the movie/tv title
function getPoster($title, $ApiKey){
	$path = "http://img.omdbapi.com/?apikey=$ApiKey&t=$title";
	$json = file_get_contents($path);
	return json_decode($json, TRUE);
}

//This function searches the omdb api for a movie/tv title. This returns multiple results pertaining to the searched title.
function getImdbRecord2($ImdbId, $ApiKey)
{
    $path = "http://www.omdbapi.com/?s=$ImdbId&apikey=$ApiKey";
    $json = file_get_contents($path);
    return json_decode($json, TRUE);
}

?>