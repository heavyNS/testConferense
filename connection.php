<?php
//api ключ для гугл карт
$googleapi = 'AIzaSyCt9HVzm0S__ZInnRPsSoWiieDgKcJDdr4';

//стандартные координаты центра при создании карты
$chernobaivka_lat = 46.694645203380944;
$chernobaivka_lng = 32.543433354424685;

// для внешней баззы данных
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$user = $cleardb_url["user"];
$pass = $cleardb_url["pass"];
$host = $cleardb_url["host"];
$dbname = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;

/*
// для внешней баззы данных freesql
$pass = 'YYv95468GI';
$user = 'sql11496179';
$host = 'sql11.freesqldatabase.com';
$dbname = 'sql11496179';

// для локалхоста
$pass = 'root';
$user = 'root';
$host = 'localhost';
$dbname = 'conferenses';
*/


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

?>