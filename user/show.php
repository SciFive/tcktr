<!doctype hmtl>

<html>

<head>
	<title>tcktr</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
	<link rel="stylesheet" type="text/css" href="../resources/style.css"/>
    <link rel="shortcut icon" href="../resources/favicon.ico" type="png" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body>

	<div id="title"><h2>Show title</h2></div>
	<div id="mainContainer">
    <p id="catchLine">your box office on-the-go</p>
        <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed pure-menu-scrollable">
            <a class="pure-menu-heading" href="../index.html">tcktr</a>
            <ul class="pure-menu-list">
                <li class="pure-menu-item"><a href="./findshows.php" class="pure-menu-link">Shows</a></li>
                <li class="pure-menu-item"><a href="./findtheaters.html" class="pure-menu-link">Theatres</a></li>
                <li class="pure-menu-item"><a href="./about.html" class="pure-menu-link">About Us</a></li>
                <li class="pure-menu-item"><i class="fa fa-shopping-cart fa-2x"></i></li>
            </ul>
        </div>

        <?php // Connect to the DB
        	$db = new PDO("mysql:host=localhost;dbname=tcktr","root","hardlyapassword1!");
 		?>

        <div id="show">
<<<<<<< HEAD:user/show.html
=======
        	<p>

        	<?php // Pull the show information from the Database

			    $sql = $db->prepare("SELECT * FROM `show` WHERE ID = '$_GET[showID]'");

			    $sql->execute();

			    foreach($sql as $row) { // Get the Title of the Show
				    echo $row['title'];
				}

	 		?>

        	</p>
>>>>>>> origin/master:user/show.php
        	<div id="showimg">
        		<img src="http://www.freedesign4.me/wp-content/gallery/posters/free-movie-film-poster-the_dark_knight_movie_poster.jpg">
        	</div>
        	<div id="showinfo">
	        	<ul>

	        	<?php

				    $sql = $db->prepare("SELECT * FROM `show` WHERE ID = '$_GET[showID]'");

				    $sql->execute();

				    foreach($sql as $row) { // Print out all of the values stored in the Database into HTML for the user
					    echo "<li>Location: ". $row['location']."</li>";
	        			echo "<li>Length: " . $row['length'] . "</li>";
	        			echo "<li>Genre(s): " . $row['genre'] . "</li>";
	        			echo "<li>". $row['description'] . "</li>";
					}

		 		?>

	        		<li>Pick a time and find a seat for this show</li>
	        		<ul>
	        			<?php // Link all potential performance dates and times
	        				$sql = $db->prepare("SELECT date FROM perform WHERE showID = '$_GET[showID]'");

							$sql->execute();

					        foreach($sql as $row) {

								echo "<li><a href='reservation.php/?show=" . $_GET['showID'] . "'>" . date('M jS g:ia',strtotime($row["date"])) . "</a></li>";
								    
							}
	        			?>
		        	</ul>
		     	</div>
                <?php 
                ?>
        </div>
		
	</div>

</body>

</html>