<?php
 require_once 'connection.php';
 require_once 'conf_class.php';
 include 'sql_commands.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/content.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Побдробно</title>
</head>
<body>
<div>
<?php
    include 'html\header.html';
?>
</div>
<div class="content">
<?php
$get_id;
if (isset($_GET['key_id'])){
  $get_id = ($_GET['key_id']);
}
else{
  header("Location: conferense\index.php");
}

 //заменить на команду из sql_commands
$conference = $conn->query("SELECT * FROM conferense WHERE id='$get_id'")->fetchObject('Conf');
$conf_lt = $conference->get_latitude();
$conf_ln = $conference->get_longitude();
?>
<div id='obj_conf'>
  <div>
  <?php
     echo $conference->get_title();
  ?>
  </div>
  <div>
  <?php
    echo date($conference->get_date_start());
  ?>
  </div>
  <div>
  <?php
    echo $conference->get_adress();
  ?>
  </div>
  <div>
  <?php
    echo $conference->get_country();
  ?>
  </div>
  <div
  class='hidden'
  data-lat='<?= $conf_lt ?>'
  data-lng='<?= $conf_ln ?>'
>
</div>
  <div id="map">
  </div>     
  <script type="text/javascript">
       function initMap() {
        var mylat = $('div.hidden').data('lat');
        var mylong = $('div.hidden').data('lng');
        if(mylat !== 0 && mylong !== 0){
          var uluru = {lat: Number(mylat), lng: Number(mylong)};
          var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
          });
          var marker = new google.maps.Marker({
          position: uluru,
          map: map
          });
        }else{
          var divMap = document.getElementById('map');
          divMap.style.height = 0;
          divMap.style.width = 0;

        }  
      }
  </script>     
  </div>
<div id='details_buttons'>
<button type="button" class="btn btn-secondary" onclick="return location.href = 'index.php'" id='back_button'>Back</button>
<button type="button" class="btn btn-warning" onclick="return location.href = 'edit.php?key_id=<?php echo$get_id ?>'" id='edit_button'>Edit</button>
<button type="button" class="btn btn-danger" onclick="return location.href = 'delete.php?key_id=<?php echo$get_id ?>'" id='delete_button'>Delete</button>
</div>
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCt9HVzm0S__ZInnRPsSoWiieDgKcJDdr4&callback=initMap">;
</script>
<div>
<?php
    include 'html\footer.html';
?>
</div>   
</body>
</html>