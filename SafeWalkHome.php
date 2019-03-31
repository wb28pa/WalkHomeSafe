<?php


include './vendor/autoload.php';
use Twilio\Rest\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST' ){

$emergencycontact = $_POST['emergencycontact'];
$emergencycontact = "+1{$emergencycontact}";
$username = $_POST['username'];
$waittime = $_POST['waittime'];
$destination = $_POST['destination'];


$account_sid = 'ACc939ba2749875081b8731e92d592de1e';
$auth_token = '13aa043a976486fb857a627b985a245f';
$twilio_number = "+17706298244";


sleep($waittime*60);

$client = new Client($account_sid, $auth_token);
$message = $client->messages->create(
    $emergencycontact,
    array(
        'from' => $twilio_number,
        'body' => "This is {$username}.  I haven't been active for {$waittime} minutes since I left to {$destination}. I may be in trouble. Contact me immediately or seek for help!",

        //'mediaurl' => "https://www.google.com/maps/";
    )

);


print($messag->$account_sid);
}
?>

<html>
<head>
<title>Safe Walk Home</title>

  <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <div class="loginbox">
        <h1>Safe Walk Home</h1>
        <form action="" method="POST">
          <p>Name</p>
          <input type="text" name="username" placeholder="Your name" required>
        <p>Wait time</p>
        <input type="text" name="waittime" placeholder="Set minutes" required>
        <p>Contact number</p>
        <input type="text" name="emergencycontact" placeholder="Enter Emergency Contact Number" required>
        <p>Denstination</p>
        <input type="text" id="pac-input" name = "destination" required>
        <input type ="submit" name= "submit" >
      </form>




      </div>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">

    <style>

      html{
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 9px;
        margin-right: 9px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }



      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 3px 10px;
      }
    </style>

  <body>
    <div class="pac-card" id="pac-card">
      <div>



      </div>
    </div>
    <div id="map"></div>
    <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>

    <script>

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);


        autocomplete.bindTo('bounds', map);

        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {

            window.alert("No details available for input: '" + place.name + "'");
            return;
          }


          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkVuMibPs5J812amtJ5IJ9Vn9ja13N0GI&libraries=places&callback=initMap"
        async defer></script>
  </body>
</html>
