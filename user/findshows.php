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
                <li class="pure-menu-item"><a href="./findshows.php" class="pure-menu-link">Shows</a></li>
                <li class="pure-menu-item"><a href="./about.html" class="pure-menu-link">About Us</a></li>
                <li class="pure-menu-item"><i class="fa fa-shopping-cart fa-2x"></i></li>
            </ul>
        </div>
        
        <ul class="slider3">
            <?php
              $db = new PDO("mysql:host=localhost;dbname=tcktr","root","hardlyapassword1!");

              $sql = $db->prepare("SELECT * FROM `show`"); // Find all the shows in the Database
              $sql->execute();
                
              //$input = array("fa fa-youtube-play fa-3x", "fa fa-camera-retro fa-3x", "fa fa-caret-square-o-right fa-3x", "fa fa-film fa-3x");
              $input = array("#DC3411","#821C0A","#A1DCD3","#48A7A4","#112425");
              $count=0;
              foreach($sql as $row) { // Loop through all shows available and print out the information to the screen
                echo "<li class='slider' style='background-color:".$input[4%$count].";'><a href='./show.php?showID=".$row['ID']."'><h2 style='color:white'>".$row['title']."</h2></a></li>";
                $count+=1;
              }
              
            ?>
          </ul>
        <!--<div id="map"></div>-->
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
        slideWidth: 360,
        maxSlides: 3,
        slideMargin: 10
      });
    });
    </script>
        
    </div>

</body>

</html>