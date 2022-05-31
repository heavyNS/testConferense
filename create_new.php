<?php
require_once "connection.php";

$title = $_POST['input_title'];
$date = $_POST['input_date'];
$adress = $_POST['input_adress'];
if((isset($_POST['input_latitude']))){
    $latitude = $_POST['input_latitude'];
}else{
    $latitude = 0;
}
if(isset($_POST['input_longitude'])){
    $longitude = $_POST['input_longitude'];
}else{
    $longitude = 0;
}
$country = $_POST['country_select'];

 //заменить на команду из sql_commands
$query = $conn->prepare("INSERT INTO `conferense`(`title`, `conf_date_start`, `adress`, `latitude`, `longitude`, `country`) 
VALUES ('$title', '$date', '$adress', $latitude, $longitude ,'$country')");
$query->execute();

header("Location: index.php");
?>
