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

	<div id="mainContainer">
		<p id="catchLine">Your box office on-the-go</p>
        <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed pure-menu-scrollable">
            <a class="pure-menu-heading" href="../index.html">tcktr</a>
            <ul class="pure-menu-list">
                <li class="pure-menu-item"><a href="./findshows.php" class="pure-menu-link">Shows</a></li>
                <li class="pure-menu-item"><a href="./findtheaters.html" class="pure-menu-link">Theatres</a></li>
                <li class="pure-menu-item"><a href="./about.html" class="pure-menu-link">About Us</a></li>
                <li class="pure-menu-item"><i class="fa fa-shopping-cart fa-2x"></i></li>
            </ul>
        </div>

        <?php
        	$db = new PDO("mysql:host=localhost;dbname=tcktr","root","hardlyapassword1!");
 		?>

        <div id="show">
        	<p>

        	<?php

			    $sql = $db->prepare("SELECT * FROM `show` WHERE ID = '$_GET[showID]'");

			    $sql->execute();

			    foreach($sql as $row) {
				    echo $row['title'];
				}

	 		?>

        	</p>
        	<div id="showimg">
        		<img src="http://www.freedesign4.me/wp-content/gallery/posters/free-movie-film-poster-the_dark_knight_movie_poster.jpg">
        	</div>
        	<div id="showinfo">
	        	<ul>

	        	<?php

				    $sql = $db->prepare("SELECT * FROM `show` WHERE ID = '$_GET[showID]'");

				    $sql->execute();

				    foreach($sql as $row) {
					    echo "<li>Location: ". $row['location']."</li>";
	        			echo "<li>Length: " . $row['length'] . "</li>";
	        			echo "<li>Genre(s): " . $row['genre'] . "</li>";
	        			echo "<li>". $row['description'] . "</li>";
					}

		 		?>

	        		<li>Pick a time and find a seat for this show</li>
	        		<ul>
	        			<?php 
	        				$sql = $db->prepare("SELECT date FROM perform WHERE showID = '$_GET[showID]'");

							$sql->execute();

					        foreach($sql as $row) {

								echo "<li><a href='reservation.php/?show=" . $_GET['showID'] . "'>" . date('M jS g:ia',strtotime($row["date"])) . "</a></li>";
								    
							}
	        			?>
		        	</ul>
		     	</div>
                <?php 
                    echo '<button onclick="revervation.php/?show=' . $_GET['showID'] .'">Reserve Now</button>'
                ?>
        </div>

        <div id="seats">
			<table id="seats">
				<tr>
					<td>1A</td>
					<td>1B</td>
					<td>1C</td>
					<td>1D</td>
					<td>1E</td>
					<td>1F</td>
				</tr>
				<tr>
					<td>2A</td>
					<td>2B</td>
					<td>2C</td>
					<td>2D</td>
					<td>2E</td>
					<td>2F</td>
				</tr>
				<tr>
					<td>3A</td>
					<td>3B</td>
					<td>3C</td>
					<td>3D</td>
					<td>3E</td>
					<td>3F</td>
				</tr>
				<tr>
					<td>4A</td>
					<td>4B</td>
					<td>4C</td>
					<td>4D</td>
					<td>4E</td>
					<td>4F</td>
				</tr>
				<tr>
					<td>5A</td>
					<td>5B</td>
					<td>5C</td>
					<td>5D</td>
					<td>5E</td>
					<td>5F</td>
				</tr>
				<tr>
					<td>6A</td>
					<td>6B</td>
					<td>6C</td>
					<td>6D</td>
					<td>6E</td>
					<td>6F</td>
				</tr>
			</table>
		</div>
		
	</div>

</body>

</html>