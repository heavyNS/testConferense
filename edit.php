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

    <link rel="stylesheet" type="text/css" href="css/content.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Редактирование конференции</title>
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
$conf_title = $conference->get_title();
$conf_country = $conference->get_country();
$conf_date = $conference->get_date_start();
$conf_adress = $conference->get_adress();
$conf_id = $conference->get_id();



$countries_sql_ar = $conn->query(SQL_GET_ALL_COUNTRIES);

$country_array = array();

foreach($countries_sql_ar as $country){
  $country_array[] = $country['country'];
}

$json_countries_array = json_encode($country_array);

?>

<div id='edit_content'>
<form action="update.php" method="POST">
  <div class="input-group mb-3">
        <input type="text" class="form-control" name='input_id' id="id_input" readonly value="<?php echo $conf_id?>">
  </div>

  <div class="input-group mb-3" id = 'title_input'>
    <input type="text" class="form-control" name='input_title' id = 'input_title' required value="<?php echo $conf_title?>">
  </div>

  <div class="input-group mb-3">
    <input type="date" class="form-control" name='input_date' required value="<?php echo $conf_date?>">
  </div>

  <div class="input-group mb-3">
    <input type="text" class="form-control" name='input_adress' required value="<?php echo $conf_adress?>">
  </div>

  <div class="input-group mb-3">
    <input type="text" class="form-control" name='input_latitude' id='input_latitude'  pattern="-?\d{1,3}\.\d+" value="<?php if($conf_lt != 0){ echo $conf_lt;}else{echo '0.00';}?>">
  </div>

  <div class="input-group mb-3">
    <input type="text" class="form-control" name='input_longitude' id='input_longitude' pattern="-?\d{1,3}\.\d+" value="<?php if($conf_ln != 0){ echo $conf_ln;}else{echo '0.00';}?>">
  </div>

  <div class="nput-group mb-3">
  <label for="country_select">Country:</label>
    <select class="form-control" name = "country_select" id="country_select">
    </select>
  </div>  

  <div id="map"></div>  

  <div id='details_buttons'>
    <button type="button" class="btn btn-secondary" onclick="return location.href = 'index.php'" id='back_button'>Back</button>
    <input type="submit" class="btn btn-success" id='save_button' value="SAVE"/>
  </div>
</form>
  
<div
  class='hidden'
  data-lat='<?= $conf_lt ?>'
  data-lng='<?= $conf_ln ?>'
>
</div>

<script type="text/javascript">
  function initMap() {
    var mylat = $('div.hidden').data('lat');
    var mylong = $('div.hidden').data('lng');
    var element = document.getElementById('map');
    var uluru = {lat: Number(mylat), lng: Number(mylong)};
    var options = {
      zoom: 15,
      center: uluru
    };
    var myMap = new google.maps.Map(element, options);
    var marker = new google.maps.Marker({
      position: uluru,
      map: myMap

    });
    marker.setDraggable(true);
    
    myMap.addListener("center_changed", () => {
        });
        marker.addListener("mouseup", () => {
          myMap.setCenter(marker.getPosition());
          var pos = marker.getPosition();
    var marker_lat = pos.lat();
    var marker_lng = pos.lng();

    document.getElementById('input_latitude').value=marker_lat;
    document.getElementById('input_longitude').value=marker_lng;
 
        });
    }
</script> 

<script type="text/javascript">
  var c_array = JSON.parse('<?php echo $json_countries_array; ?>'); 
  var select = document.getElementById("country_select");
  for(var i=0; i<c_array.length; i++){
    var opt = c_array[i];
    var el = document.createElement("option");
    el.textContent = opt;
    el.value = opt;
    select.appendChild(el);
}
</script>

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