<?php
function getTravelTime($destination){
    $destination = $_POST['Destination'];
    $latitude = $_POST['lat'];
    $longitude = $_POST['lng'];
    $waittime = $_POST['waittime'];
    $emergencycontact = $_POST['emergencycontact'];
    $emergencycontact = '+1'{$emergencycontact};
    $destination = str_replace(' ', '+', $destination);

    // google map geocode api url
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?&origins={$latitude},{$longitude}&destinations={$destination}&key=AIzaSyAkVuMibPs5J812amtJ5IJ9Vn9ja13N0GI";
    // get the json response
    $resp_json = file_get_contents($url);

    // decode the json
    $resp = json_decode($resp_json, true);

    // response status will be 'OK', if able to geocode given address
    if($resp['status']=='OK'){
        $traveltime = isset($resp['rows'][0]['elements'][0]['duration']['value']);
        echo $traveltime;
    }

    else{
        echo "<strong>ERROR: {$resp['status']}</strong>";
        return false;
    }
}
include './vendor/autoload.php';
use Twilio\Rest\Client;

 if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$account_sid = 'ACc939ba2749875081b8731e92d592de1e';
$auth_token = '13aa043a976486fb857a627b985a245f';

$twilio_number = "+17706298244";
$emergencycontact = $_POST['emergencycontact'];
$emergencycontact = "+1{$emergencycontact}";

$client = new Client($account_sid, $auth_token);
$message = $client->messages->create(
    $emergencycontact,
    array(
        'from' => $twilio_number,
        'body' => 'This is (name), I didn\'t get home on time. I may be in trouble. Contact me immediately or seek for help!  Here is where I\'m located right now.',
        //'mediaurl' => "https://www.google.com/maps"
    )
);
print($messag->$account_sid);
}
?>
<?php  ?>
<html>
<head>
    <title>Login Form Design</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      #map {
        height: 40%;
        width : 30%;
        position: center;
        }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    </head>
<body>
       <div class="loginbox">
        <h1>GetHomeSafe</h1>
        <form>
        <p>Destination</p>
        <input type="text" name="Destination" placeholder="Enter your destination">
        <p>Wait time</p>
        <input type="number" name="waittime" placeholder="Notify after...">
        <p>Emergency Contact number</p>
        <input type="text" name="emergencycontact" placeholder="Enter Contact Number">
        <input type="submit" name="" value="Starts">  
        </form>
         </div>
    <div id="map"></div>
    <script>
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7Svzj9DqIbGi6cUuwNgCWLpzPiobnj_8&callback=initMap">
    </script>
</body>  
</html>