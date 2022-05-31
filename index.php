<?php
 require_once 'connection.php';
 require_once 'conf_class.php';
 require_once 'sql_commands.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/content.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>КОНФЕРЕНЦИИ</title>
</head>
<body>
<div>
<?php
    include 'html/header.html';
?>
</div>
<div class="content">
<?php

$result =  $conn->query(SQL_GET_ALL_ELEMENTS);
$row = $result->fetchAll(PDO::FETCH_CLASS, 'Conf'); 

foreach($row as $obj){
    $id = $obj->get_id();
    $title = $obj->get_title();
    $conf_date = $obj->get_date_start();
?>

<a href="details.php?key_id=<?php echo$id ?>">
    <div id='obj_conf'>
        <div>
        <?php
            echo $title;
        ?>
        </div>
        <div>
        <?php
            echo $conf_date;
        ?>
        </div>
    </div>

<?php
}
?>
</a>
</div>

<div>
<?php
    include 'html/footer.html';
?>
</div>
  
</body>
</html>