<?php
  include_once 'database.php';
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Mapping Project</title>
      <link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
      <script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>

   <body>

   <form method="POST" id="insert">
  <label for="address">Address:</label><br>
  <input type="text" id="name" name="name"><br><br>
  <label for="latitude">Latitude:</label><br>
  <input type="text" id="latitude" name="latitude"><br><br>
  <label for="longitude">Longitude:</label><br>
  <input type="text" id="longitude" name="longitude"><br><br>
  <input type="submit" value="Submit" id="submit">
</form> 
      <div id = "map" style = "width: 900px; height: 580px"></div>
    
<?php

$sql = "SELECT * FROM coordinates;";
$result = mysqli_query($conn, $sql);
$datas = array();
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_assoc($result)){
    $datas[] = $row;
}
}
print_r($datas);

?>
  <script>
var locations = <?php echo json_encode($datas); ?>;

// var locations = [{"id":"1","name":"Bacolod City","latitude":"10.66778","longitude":"122.94962"},{"id":"2","name":"University of Negros Occidental-Recoletos","latitude":"10.6573","longitude":"122.9483"},{"id":"3","name":"SM Bacolod","latitude":"10.6708","longitude":"122.9427"},{"id":"4","name":"University of St. Lasalle","latitude":"10.6789","longitude":"122.9622"},{"id":"5","name":"Bacolod Puplic Plaza","latitude":"10.6692","longitude":"122.9464"}];

var map = L.map('map').setView([11.206051, 122.447886], 8);
mapLink =
  '<a href="http://openstreetmap.org">OpenStreetMap</a>';
L.tileLayer(
  'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; ' + mapLink + ' Contributors',
    maxZoom: 18,
  }).addTo(map);

for (var i = 0; i < locations.length; i++) {
  marker = new L.marker([locations[i]['latitude'], locations[i]['longitude']])
    .bindPopup(locations[i]['name'])
    .addTo(map);
}

// prevent form from refresh and incomplete submit
var form = document.getElementById("insert");
function handleForm(event){event.preventDefault();}
form.addEventListener('submit', handleForm);
//insert function

$(document).ready(function() {
$('#submit').on('click', function() {
var name = $('#name').val();
var latitude = $('#latitude').val();
var longitude = $('#longitude').val();
if(name!="" && latitude!="" && longitude!=""){
	$.ajax({
		url: "editDb.php",
		type: "POST",
		data: {
			name: name,
			latitude: latitude,
			longitude: longitude
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			if(dataResult.statusCode==200){
				$("#submit").removeAttr("disabled");
				$('#insert').find('input:text').val('');
				$("#success").show();
				$('#success').html('Data added successfully !'); 						
			}
			else if(dataResult.statusCode==201){
				alert("Error occured !");
			}
			
		}
	});
	}
	else{
		alert('Please fill all the field !');
	}
});
});

      </script>
   </body>
   
</html>
