<?php
 require_once 'connection.php';

 $id = $_GET['key_id'];
 
 //заменить на команду из sql_commands
 $query = $conn->prepare("DELETE FROM `conferense` WHERE id=$id");
 $query->execute();

 header("Location: index.php");
?>