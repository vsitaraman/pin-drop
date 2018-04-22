<!DOCTYPE html>
<html>
  <head>
<!-- 
 ██▒   ██ ██░ ██▓███      █     █░  ▄▄        ██████     ██░ ██ ▓█████  ██▀███  ▓█████ 
▓██░   █▒░██▒▒██░  ██▒   ▓█░ █ ░█░▒ ███▄    ▒██    ▒     ██░ ██▒▓█   ▀ ▓██   ██▒▓█   ▀ 
 ▓██  ██░▒██▒▒██░ ██▓▒   ▒█░ █ ░█ ▒██  ▀█▄  ░ ▓██▄      ▒██▀▀██░▒███   ▓██ ░▄█ ▒▒███   
  ▒██ █░░░██░░██▄█▓▒ ▒   ░█░ █ ░█ ░██▄▄▄▄██   ▒   ██▒   ░▓█ ░██ ▒▓█  ▄ ▒██▀▀█▄  ▒▓█  ▄ 
   ▒▀██  ░██░▒██▒ ░  ░   ░░██▒██▓  ▓█   ▓██▒▒██████▒▒   ░▓█▒░██▓░▒████▒░██▓ ▒██▒░▒████▒
   ░ ▐░  ░▓  ▒▓▒░ ░  ░   ░ ▓░▒ ▒   ▒▒   ▓▒█░▒ ▒▓▒ ▒ ░    ▒ ░░▒░▒░░ ▒░ ░░ ▒▓ ░▒▓░░░ ▒░ ░
   ░ ░░   ▒ ░░▒ ░          ▒ ░ ░    ▒   ▒▒ ░░ ░▒  ░ ░    ▒ ░▒░ ░ ░ ░  ░  ░▒ ░ ▒░ ░ ░  ░
     ░░   ▒ ░░░            ░   ░    ░   ▒   ░  ░  ░      ░  ░░ ░   ░     ░░   ░    ░   
      ░   ░                  ░          ░  ░      ░      ░  ░  ░   ░  ░   ░        ░  ░ 
—————░———————————————————————————————————————————
Designed & developed by Viputheshwar Sitaraman. 
All rights reserved. (C) Copyright 2018. 
No re-use or modification without permission.
—————————————————————————————————————————————————
   ✎ @viputheshwar
   🍻 from Los Angeles, CA
   ✉ http://sitaraman.vip
 -->
  <head>
      <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>PinDrop &ndash; Create your custom map.</title>
    <meta name="description" content="Create a custom map that you can embed anywhere. Designed by Viputheshwar Sitaraman; &copy; Copyright 2018, All Rights Reserved.">
    <meta name="author" content="Viputheshwar Sitaraman">

    <!-- Favicon -->
    <link rel="icon"
      type="image/png"
      href="./favicon.png">

    <!-- Core Dependencies -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/3/cyborg/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- FontAwesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    <?php 
      $str = file_get_contents('./data.json');
      $json = json_decode($str, true); 
    ?>
    <style>
  .pac-container {
     z-index: 999999; 
}
       #map {
        height: 400px;
        width: 100%;
        margin: 20px 0;
       }
    </style>
  </head>
  <body style="padding-top: 70px;">
    <!-- Page Content -->
    <div class="container">
        <header class="jumbotron my-4">
            <h1 class="display-3">Drop a pin.</h1>
            <p class="lead"><strong>PinDrop</strong>: a utility to create an embeddable map with markers/pins. Data provided by Google Maps Javascript API. All rights reserved & copyright &copy; 2018, Viputheshwar Sitaraman</p>
            <a href="#map" class="btn btn-primary btn-lg">LET'S GO</a>
        </header>
        <section id="mapFrame">
          <div id="map"></div>
        </section>        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <th><i class="fa fa-edit"></i> Edit</th>
                <th>Title</th>
                <th>Lat</th>
                <th>Lng</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($json as &$val) {
              ?>
              <tr id="row-<?php echo $i; ?>">
                <td id="row-<?php echo $i; ?>-edit"><a onClick="editMarker(<?php echo $i. ',&#39;' .$val['name']. '&#39;,' .$val['lat']. ',' .$val['lng']; ?>)" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a></td>
                <td id="row-<?php echo $i; ?>-name"><?php echo $val['name']; ?></td>
                <td id="row-<?php echo $i; ?>-lat"><?php echo $val['lat']; ?></td>
                <td id="row-<?php echo $i; ?>-lng"><?php echo $val['lng']; ?></td>
                <td id="row-<?php echo $i; ?>-del"><a onClick="delMarker(<?php echo $i; ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a></td>
              </tr>
              <?php $i=$i+1;
              }
              $count = $i - 1; ?>
              <script>
                window.new = <?php echo $count; ?>;
                function editMarker(num,name,lat,lng) {
                  document.getElementById('lat').value = lat;
                  document.getElementById('lng').value = lng;
                  document.getElementById('num').value = num;
                  document.getElementById('nameVal').value = name;
                  myMap(lat,lng);
                  $("#editor").modal();
                }
              </script>
            </tbody>
          </table> 
        </div>
    </div> <!-- /.container -->


        <div class="pull-right">
          <button onClick = "newMarker()" class="btn btn-lg btn-danger"><i class="far fa-plus-square"></i>  New Marker</button>
          <button onClick = "saveMap()" class="btn btn-lg btn-success"><i class="far fa-save"></i>  Save / Embed</button>
            <script>

    function insertAfter(el, referenceNode) {
    referenceNode.parentNode.insertBefore(el, referenceNode.nextSibling);
}

              function delMarker(num) { 
                  var pref = 'row-'+num;
                  $( "#"+pref ).remove();
                  window.new = num - 1;
              }

              function newMarker() {
                  var num = window.new;
                  var temp = document.getElementById('row-'+num);
                  num = num + 1;
                  console.log(num);
                  var pref = 'row-'+num;
                  var newEl = document.createElement('tr');
                  newEl.setAttribute("id", pref);
                  var newHTML = `<tr id="`+pref+`">
  <td id="`+pref+`-edit"><a onclick="editMarker(`+num+`,'','','')" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a></td>
  <td id="`+pref+`-name"></td>
  <td id="`+pref+`-lat"></td>
  <td id="`+pref+`-lng"></td>
  <td id="`+pref+`-del"><a onclick="delMarker(`+num+`)" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a></td>
</tr>`;
                  newEl.innerHTML = newHTML;
                  insertAfter(newEl, temp);
                  window.new = num;
                }
            </script>
        </div>

    <!-- Save -->
    <div id="saver" class="modal modal-lg fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Save Map</h4>
          </div>
          <div class="modal-body">
            <ul class="nav nav-tabs">
              <li class="active">
                <a  href="#htmlEmbed" data-toggle="tab">HTML Embed</a>
              </li>
              <li><a href="#jsonEmbed" data-toggle="tab">JSON (data)</a>
              </li>
            </ul>
            <div class="tab-content clearfix">
              <div class="tab-pane active" id="htmlEmbed">
                <h3>Copy your code from below.</h3>
                <pre id="htmlOut"></pre>
              </div>
              <div class="tab-pane" id="jsonEmbed">
                <h3>Copy your code from below.</h3>
                <pre id="jsonOut"></pre>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Editor -->
    <div id="editor" class="modal modal-lg fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Location</h4>
          </div>
          <div class="modal-body">   
              <div class="col-xs-6">
                <label for="lat" class="control-label">Latitude</label>
                  <input type="text" class="form-control" id="lat" name="lat">
              </div> 
              <div class="col-xs-6">
                <label for="lng" class="control-label">Longtitude</label>
                  <input type="text" class="form-control" id="lng" name="lng">
              </div> 
              <div class="col-xs-12">
                <label for="name" class="control-label">Name</label>
                  <input type="text" class="form-control" id="nameVal" name="name">
              </div> 
              <input type="text" class="hidden form-control" id="num" name="num">
              <section style="margin: 20px 0;width: 100%;height: 400px;position: relative;overflow: hidden;">
                <div id="inputMap" style="overflow: hidden;position: relative;height: 100%;"></div><hr/>
              </section>
              <div class="input-group col-xs-12">
                <input type="text" id="googleSearch" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button onClick="saveMarker()" id="saveMarker" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <script>
              function saveMarker() {
                  var lat = document.getElementById('lat').value;
                  var lng = document.getElementById('lng').value;
                  var num = document.getElementById('num').value;
                  var name = document.getElementById('nameVal').value;
                  var pref = 'row-'+num+'-';
                  document.getElementById(pref+'name').innerHTML = name;
                  document.getElementById(pref+'lat').innerHTML = lat;
                  document.getElementById(pref+'lng').innerHTML = lng;
                  document.getElementById(pref+'del').innerHTML = '<a onclick="delMarker('+num+')" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>';
                  document.getElementById(pref+'edit').innerHTML = '<a onclick="editMarker('+num+',&#39;'+name+'&#39;,'+lat+','+lng+')" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>';
                  var index = num - 1;
                  if (typeof window.locations[index] == 'undefined') {
                      window.locations[index] = {};
                  }
                  window.locations[index].name = name;
                  window.locations[index].lat = lat;
                  window.locations[index].lng = lng;
                  refreshMap();
                  $("#editor").modal('hide');
              }
              function saveMap(){
                var jsonString = JSON.stringify(window.locations);
                var htmlString = `function initMap() {
          var locations = `+jsonString+`;
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            mapTypeId: 'terrain',
            center: {lat: -25.363, lng: 131.044},
            styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]

          });   
          var infowindow = new google.maps.InfoWindow();
          var bounds = new google.maps.LatLngBounds();
          for (i = 0; i < locations.length; i++) {  
            marker = new google.maps.Marker({
              position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lng']),
              map: map
            });
            //extend the bounds to include each marker's position
            bounds.extend(marker.position);

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                infowindow.setContent(locations[i]['name']);
                infowindow.open(map, marker);
              }
            })(marker, i));
          };

          //now fit the map to the newly inclusive bounds
          map.fitBounds(bounds);
          var listener = google.maps.event.addListener(map, "idle", function () {
              map.setZoom(3);
              google.maps.event.removeListener(listener);
          });
        }

        function myMap(lat,lng) {
          var map2 = new google.maps.Map(document.getElementById('inputMap'), {
            zoom: 4,
            mapTypeId: 'terrain',
            center: {lat: -25.363, lng: 131.044},
            styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]

          });   
          var infowindow = new google.maps.InfoWindow();
          var bounds = new google.maps.LatLngBounds();

          google.maps.event.addListener(map2, 'click', function(event) {
             // alert(event.latLng.lat() + ", " + event.latLng.lng());
             document.getElementById('lat').value = event.latLng.lat();
             document.getElementById('lng').value = event.latLng.lng();

            var newMarker = new google.maps.Marker({
              map: map2,
              position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
            });
          });
        // Create the search box and link it to the UI element.
        var input = document.getElementById('googleSearch');
        var searchBox = new google.maps.places.SearchBox(input);

        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          markers = [];
          if(markers){
            // Clear out the old markers.
            markers.forEach(function(marker) {
              marker.setMap(null);
            });
          }

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              alert("No results;");
              return;
            }
            var newMarker = new google.maps.Marker({
              map: map2,
              title: place.name,
              position: place.geometry.location
            });

            // Create a marker for each place.
            markers.push(newMarker);

            google.maps.event.addListener(newMarker, 'click', (function(marker) {
             document.getElementById('lat').value = marker.position.lat().toFixed(6);
             document.getElementById('lng').value = marker.position.lng().toFixed(6);
            })(newMarker));


            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map2.fitBounds(bounds);
        });
        }


        var geocoder;
        var map;
        function initialize() {
          geocoder = new google.maps.Geocoder();
          var latlng = new google.maps.LatLng(-34.397, 150.644);
          var mapOptions = {
            zoom: 8,
            center: latlng
          }
          map = new google.maps.Map(document.getElementById('map'), mapOptions);
        }

        function codeAddress() {
          var address = document.getElementById('address').value;
          geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
              map.setCenter(results[0].geometry.location);
              var marker = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
              });
            } else {
              alert('Geocode was not successful for the following reason: ' + status);
            }
          });
        }`;
                  document.getElementById('htmlOut').innerHTML = htmlString;
                  document.getElementById('jsonOut').innerHTML = jsonString;
                  $("#saver").modal();
              }
            </script>
          </div>
        </div>

      </div>
    </div>
    <script>
    </script>

    <script>
        window.locations = <?php echo $str; ?>;
        function refreshMap() {
          var locations = window.locations;
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            mapTypeId: 'terrain',
            center: {lat: -25.363, lng: 131.044},
            styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]

          });   
          var infowindow = new google.maps.InfoWindow();
          var bounds = new google.maps.LatLngBounds();
          for (i = 0; i < locations.length; i++) {  
            marker = new google.maps.Marker({
              position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lng']),
              map: map
            });
            //extend the bounds to include each marker's position
            bounds.extend(marker.position);

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                infowindow.setContent(locations[i]['name']);
                infowindow.open(map, marker);
              }
            })(marker, i));
          };

          //now fit the map to the newly inclusive bounds
          map.fitBounds(bounds);
          var listener = google.maps.event.addListener(map, "idle", function () {
              map.setZoom(3);
              google.maps.event.removeListener(listener);
          });
        };
        function initMap() {
          var locations = <?php echo $str; ?>;
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            mapTypeId: 'terrain',
            center: {lat: -25.363, lng: 131.044},
            styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]

          });   
          var infowindow = new google.maps.InfoWindow();
          var bounds = new google.maps.LatLngBounds();
          for (i = 0; i < locations.length; i++) {  
            marker = new google.maps.Marker({
              position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lng']),
              map: map
            });
            //extend the bounds to include each marker's position
            bounds.extend(marker.position);

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                infowindow.setContent(locations[i]['name']);
                infowindow.open(map, marker);
              }
            })(marker, i));
          };

          //now fit the map to the newly inclusive bounds
          map.fitBounds(bounds);
          var listener = google.maps.event.addListener(map, "idle", function () {
              map.setZoom(3);
              google.maps.event.removeListener(listener);
          });
        }

        function myMap(lat,lng) {
          var map2 = new google.maps.Map(document.getElementById('inputMap'), {
            zoom: 4,
            mapTypeId: 'terrain',
            center: {lat: -25.363, lng: 131.044},
            styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]

          });   
          var infowindow = new google.maps.InfoWindow();
          var bounds = new google.maps.LatLngBounds();

          google.maps.event.addListener(map2, 'click', function(event) {
             // alert(event.latLng.lat() + ", " + event.latLng.lng());
             document.getElementById('lat').value = event.latLng.lat();
             document.getElementById('lng').value = event.latLng.lng();

            var newMarker = new google.maps.Marker({
              map: map2,
              position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
            });
          });
        // Create the search box and link it to the UI element.
        var input = document.getElementById('googleSearch');
        var searchBox = new google.maps.places.SearchBox(input);

        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          markers = [];
          if(markers){
            // Clear out the old markers.
            markers.forEach(function(marker) {
              marker.setMap(null);
            });
          }

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              alert("No results;");
              return;
            }
            var newMarker = new google.maps.Marker({
              map: map2,
              title: place.name,
              position: place.geometry.location
            });

            // Create a marker for each place.
            markers.push(newMarker);

            google.maps.event.addListener(newMarker, 'click', (function(marker) {
             document.getElementById('lat').value = marker.position.lat().toFixed(6);
             document.getElementById('lng').value = marker.position.lng().toFixed(6);
            })(newMarker));


            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map2.fitBounds(bounds);
        });
        }


        var geocoder;
        var map;
        function initialize() {
          geocoder = new google.maps.Geocoder();
          var latlng = new google.maps.LatLng(-34.397, 150.644);
          var mapOptions = {
            zoom: 8,
            center: latlng
          }
          map = new google.maps.Map(document.getElementById('map'), mapOptions);
        }

        function codeAddress() {
          var address = document.getElementById('address').value;
          geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
              map.setCenter(results[0].geometry.location);
              var marker = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
              });
            } else {
              alert('Geocode was not successful for the following reason: ' + status);
            }
          });
        }
      </script>
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADvV8Bjf8FUsP3qMOjH8lygg_TB1ZC7ow&callback=initMap&libraries=places">
      </script>
  </body>
</html>