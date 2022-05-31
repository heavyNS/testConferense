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
    <link rel="stylesheet" type="text/css" href="css/content.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Создание конференции</title>
</head>
<body>
 
<div>
<?php
    include 'html\header.html';
?>
</div>

<div class="content">
<?php

$countries_sql_ar = $conn->query(SQL_GET_ALL_COUNTRIES);

$country_array = array();

foreach($countries_sql_ar as $country){
  $country_array[] = $country['country'];
}

$json_countries_array = json_encode($country_array);

?>
<div id='edit_content'>
<form action="create_new.php" method="POST">
  <div class="input-group mb-3" id = 'title_input'>
    <input type="text" class="form-control" required  name='input_title' placeholder="Title" minlength="2" maxlength="255">
  </div>

  <div class="input-group mb-3">
    <input type="date" class="form-control" required  name='input_date' placeholder="date">
  </div>

  <div class="input-group mb-3">
    <input type="text" class="form-control" required name='input_adress' placeholder="adress">
  </div>

  <div class="input-group mb-3">
    <input type="text" class="form-control" pattern="-?\d{1,3}\.\d+" name='input_latitude' id = 'input_latitude'   placeholder="latitude" >
  </div>

  <div class="input-group mb-3">
    <input type="text" class="form-control" pattern="-?\d{1,3}\.\d+" name='input_longitude' id = 'input_longitude' placeholder="longitude">
  </div>

  <div class="nput-group mb-3">

  <label for="country_select">Country:</label>

  <select class="form-control" id="country_select" require name="country_select"></select>

  </div>  

  <div id="map"></div> 
    
  <div id='details_buttons'>

    <button type="button" class="btn btn-secondary" onclick="return location.href = 'index.php'" id='back_button'>Back</button>
    <input type="submit" class="btn btn-success" id='save_button' value="SAVE"/>

  </div>
</form>

<div
  class='hidden'
  data-lat='<?=$chernobaivka_lat ?>'
  data-lng='<?= $chernobaivka_lng ?>'
>
</div>
<script type="text/javascript">
  //создание гуг карты
 function initMap() {
  var mylat = $('div.hidden').data('lat');
  var mylong = $('div.hidden').data('lng');       
  var myOptions = {
    zoom: 15,
    center: new google.maps.LatLng(mylat, mylong),
    disableDefaultUI: true,
    zoomControl: true,
    zoomControlOptions: {
      style: google.maps.ZoomControlStyle.SMALL
    },
  draggingCursor: 'move'
}
var map = new google.maps.Map(document.getElementById("map"), myOptions);

var marker;

//создание маркера
function placeMarker(location) {
  if (marker) {
    marker.setPosition(location);
  } else {
    marker = new google.maps.Marker({
      position: location,
      map: map
    });
  }
 
//передача параметров маркера в инпуты
document.getElementById('input_latitude').value=location.lat();
document.getElementById('input_longitude').value=location.lng();
}

//создание события по клику
google.maps.event.addListener(map, 'click', function(event) {
  placeMarker(event.latLng);
});
}
</script> 

<script type="text/javascript">
//передаем массив в выбор стран
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
  //ссылка на апи гугл карт с ключем после = и до &
</script>

<div>
<?php
    include 'html\footer.html';
?>
 </div>  
</body>
</html>