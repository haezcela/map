<?php
  include_once 'database.php';
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Mapping Project</title>
      <link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
      <script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
   </head>

   <body>
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

// foreach($datas[0] as $data){
//   echo $data;
// }

?>
  <script>
var locations = <?php echo json_encode($datas); ?>;

var map = L.map('map').setView([11.206051, 122.447886], 8);
mapLink =
  '<a href="http://openstreetmap.org">OpenStreetMap</a>';
L.tileLayer(
  'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; ' + mapLink + ' Contributors',
    maxZoom: 18,
  }).addTo(map);

for (var i = 0; i < locations.length; i++) {
  marker = new L.marker([locations[i][2], locations[i][3]])
    .bindPopup(locations[i][1])
    .addTo(map);
}


         // // Creating map options
         // var mapOptions = {
         //    center: [10.66778, 122.94962],
         //    zoom: 10
         // }
         
         // // Creating a map object
         // var map = new L.map('map', mapOptions);
         
         // // Creating a Layer object
         // var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
         
         // // Adding layer to the map
         // map.addLayer(layer);

         // // Creating a marker
         // var marker = L.marker([10.66778, 122.94962]);
         
         // // Adding marker to the map
         // marker.addTo(map);

         // // Adding popup to the marker
         // marker.bindPopup('Bacolod, officially known as the City of Bacolod is a 1st class highly urbanized city in the region of Western Visayas, Philippines.').openPopup();
         // marker.addTo(map); // Adding marker to the map
      </script>
   </body>
   
</html>
