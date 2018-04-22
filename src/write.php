<?php
$json = file_get_contents( $file );

// $json is now a string 

$data = json_decode($json);

// $data is a PHP object
// So lets call the second array $data->someArray
// since I do not know what it is called looking at your file

// convert form data to PHP array format
    $postArray = array(
      "name" => $_POST['name'],
      "lng" => $_POST['lng'],
      "lat" => $_POST['lat']
    ); //you might need to process any other post fields you have..

// $postArray is a PHP object

// $json = json_encode( $postArray ); // do NOT convert here

array_push($data->someArray, $postArray);
$json = json_encode($data);
// write to file
file_put_contents( $file, $json, FILE_APPEND);
?>