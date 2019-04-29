<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fight Forge Rooms</title>
<link href="css/room.css" rel="stylesheet" type="text/css">

<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/source-sans-pro:n2:default.js" type="text/javascript"></script>
<style>
      #map {
        height: 400px;
        width: 100%;
       }
    </style>
</head>
<body>
<!-- Main Container -->
<div class="container"> 
  <!-- Header -->
  <header> <a href="index.html"> 
    <h4 class="logo">DragonHouse</h4>
   
    <nav>
      <ul>
        <li><a href="index.html">HOME</a></li>
        <li><a href="rooms.php">ROOMS</a></li>
        <li> <a href="adminindex.php">LOGIN Admin</a></li>
		<li> <a href="custindex.php">LOGIN Customer</a></li>
        <li> <a href="registration.php">REGISTER</a></li>
      </ul>
	  </a>
	  </nav>
  </header>
  <!-- Hero Section -->
  <section class="intro">
    <div class="column">
      <h3>Dragon House Hotel</h3>
      <img src="file:///C|/Users/Adamm/AppData/Roaming/Adobe/Dreamweaver CC 2017/en_US/Configuration/Temp/Assets/eamC15C.tmp/images/profile.png" alt="" class="profile"> </div>
    <div class="column">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla </p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla</p>
    </div>
  </section>
  <!-- Stats Gallery Section -->
  <div class="gallery">
    <div class="thumbnail"> <a href="#"><img src="file:///C|/Users/Adamm/AppData/Roaming/Adobe/Dreamweaver CC 2017/en_US/Configuration/Temp/Assets/eamC15C.tmp/images/bkg_06.jpg" alt="" width="2000" class="cards"/></a>
      <h4>Balcony View</h4>
      <p class="tag">Large rooms like ocean view</p>
      <p class="text_column">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div class="thumbnail"> <a href="#"><img src="file:///C|/Users/Adamm/AppData/Roaming/Adobe/Dreamweaver CC 2017/en_US/Configuration/Temp/Assets/eamC15C.tmp/images/bkg_06.jpg" alt="" width="2000" class="cards"/></a>
      <h4>TITLE</h4>
      <p class="tag">Large ballroom for rental can be used for wedings</p>
      <p class="text_column">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div class="thumbnail"> <a href="#"><img src="file:///C|/Users/Adamm/AppData/Roaming/Adobe/Dreamweaver CC 2017/en_US/Configuration/Temp/Assets/eamC15C.tmp/images/bkg_06.jpg" alt="" width="2000" class="cards"/></a>
      <h4>TITLE</h4>
      <p class="tag">Lots of good food</p>
      <p class="text_column">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div class="thumbnail"> <a href="#"><img src="file:///C|/Users/Adamm/AppData/Roaming/Adobe/Dreamweaver CC 2017/en_US/Configuration/Temp/Assets/eamC15C.tmp/images/bkg_06.jpg" alt="" width="2000" class="cards"/></a>
      <h4>TITLE</h4>
      <p class="tag">child friendly haven for all</p>
      <p class="text_column">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
  </div>
  
  <h3>Google Maps for Dragon House Hotel</h3>
    <div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: 51.5826, lng: -4.1179};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdYvhwHQRHLtePtqf3R4kNgXUe3isMMLM&callback=initMap">
    </script>
  <!-- Footer Section -->
  <footer id="contact">
    <div class="button">Register Now</div>
  </footer>
  <!-- Copyrights Section -->
  <div class="copyright">&copy;2017 - <strong>Dragon House</strong></div>
</div>
<!-- Main Container Ends -->
</body>
</html>