<!doctype hmtl>

<html>

<head>
	<title>tcktr</title>
	<link rel="stylesheet" type="text/css" href="../resources/style.css"/>
  <link rel="shortcut icon" href="../resources/favicon.ico" type="png"/>
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="stylesheet" href="./resources/login-signup-modal-window/css/style.css"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div id="title"><h2>Find Shows</h2></div>
	<div id="mainContainer">
    <p id="catchLine">your box office on-the-go</p>
        <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed pure-menu-scrollable">
            <a class="pure-menu-heading" href="../index.html">tcktr</a>
            <ul class="pure-menu-list">
                <li class="pure-menu-item"><a href="./findshows.html" class="pure-menu-link">Shows</a></li>
                <li class="pure-menu-item"><a href="./findtheaters.html" class="pure-menu-link">Theatres</a></li>
                <li class="pure-menu-item"><a href="./about.html" class="pure-menu-link">About Us</a></li>
                <li class="pure-menu-item"><i class="fa fa-shopping-cart fa-2x"></i></li>
            </ul>
        </div>
        
        <div ul>
          <?php
          $db = new PDO("mysql:host=localhost;dbname=tcktr","root","hardlyapassword1!");

          $sql = $db->prepare("SELECT * FROM show");
          $sql->execute();

          $i = 0;

          foreach($sql as $row) {

            echo "<li class='slide'><a href='show.php?showID=".$row['ID']."'>".$row['title']."</a></li>";

          }
        ?>
        </ul>
        <div id="map"></div>
        <div id="alerts"></div>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../resources/get_loc.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="../resources/jquery.bxslider/jquery.bxslider.min.js"></script>
    <link href="../resources/jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
    <script src="http://maps.google.com/maps/api/js?sensor=false" ></script>
    <script type="text/javascript" src="http://api.wxtiles.com/wxtiles.v2.min.js"></script>

    <script>
    $(document).ready(function(){
      $('.slider3').bxSlider({
        slideWidth: 5000,
        minSlides: 3,
        maxSlides: 3,
        slideMargin: 10
      });
    });
    </script>
        
    </div>

</body>

</html>