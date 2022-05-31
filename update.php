<?php
require_once "connection.php";

$title = $_POST['input_title'];
$date = $_POST['input_date'];
$adress = $_POST['input_adress'];
$country = $_POST['country_select'];
$id = $_POST['input_id'];

if(isset($_POST['input_latitude'])){
    $latitude = $_POST['input_latitude'];
}
else{
    $latitude = 0;
}

if(isset($_POST['input_longitude'])){
    $longitude = $_POST['input_longitude'];
}
else{
    $longitude = 0;
}

//заменить на команду из sql_commands
$query = $conn->prepare("UPDATE `conferense` 
SET `title` = '$title', `conf_date_start` = '$date', `adress` = '$adress', `latitude` = $latitude, `longitude` = $longitude, `country` = '$country' WHERE id = '$id'");
$query->execute();

header("Location: index.php");

?>
