
<?php

include './vendor/autoload.php';
use Twilio\Rest\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST' ){


$emergencycontact = $_POST['emergencycontact'];
$emergencycontact = "+1{$emergencycontact}";
$username = $_POST['username'];
$waittime = $_POST['waittime'];
$destination = $_POST['Destination'];

function getTravelTime($destination){

   $newdest = str_replace(' ','+', $destination);
   $latitude = $_POST['pos.lat'];
   $longitude = $_POST['pos.lng'];

echo $destination;

    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?&origins={$pos}&destinations={$destinationnew}&key=AIzaSyAkVuMibPs5J812amtJ5IJ9Vn9ja13N0GI";

    $resp_json = file_get_contents($url);


    $resp = json_decode($resp_json, true);

    // response status will be 'OK', if able to geocode given address
    if($resp['status']=='OK'){
        $traveltime = isset($resp['rows'][0]['elements'][0]['duration']['value']);
    }

    else{
        echo "<strong>ERROR: {$resp['status']}</strong>";
        return false;
    }
    $ETS = $traveltime + $waittime;
}

$variable = time();

$apple = $variable + ($waittime);
while(time()!=$apple)
{
  echo "";
}

$account_sid = 'ACc939ba2749875081b8731e92d592de1e';
$auth_token = '13aa043a976486fb857a627b985a245f';
$twilio_number = "+17706298244";

$client = new Client($account_sid, $auth_token);
$message = $client->messages->create(
    $emergencycontact,
    array(
        'from' => $twilio_number,
        'body' => "This is {$username}.  I haven't been home for {$waittime} minutes since I should've arrived. I may be in trouble. Contact me immediately or seek for help!  Here is where I'm located right now.",

        //'mediaurl' => "https://maps.googleapis.com/maps/api/js?key=AIzaSyAkVuMibPs5J812amtJ5IJ9Vn9ja13N0GI&callback=initMap"
    )

);

print($messag->$account_sid);
}
?>

<html>
<head>
<title>Login Form Design</title>

  <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <div class="loginbox">
        <h1>Safe Walk Home</h1>
        <form action="" method="POST">
          <p>Name</p>
          <input type="text" name="username" placeholder="Your name" required>
        <p>Destination</p>
        <input type="text" name="Destination" placeholder="Enter destination" required>
        <p>Wait time</p>
        <input type="text" name="waittime" placeholder="Set minutes" required>
        <p>Contact number</p>
        <input type="text" name="emergencycontact" placeholder="Enter Emergency Contact Number" required>

        <button onclick="window.location.href = 'file:///Library/WebServer/Documents/GetHomeSafe/matrix.html';">Submit</button>
       </form>


      </div>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">




  </head>

    <div id="map">
    <script>


      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 0, lng: 0},
          zoom: 13
        });
        infoWindow = new google.maps.InfoWindow;

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Current Location');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {

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

    <script async defers
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkVuMibPs5J812amtJ5IJ9Vn9ja13N0GI&callback=initMap">
    </script>
  </div>
</body>
</html>
