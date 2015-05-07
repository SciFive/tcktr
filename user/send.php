<?php
	
	$filled = true;
    $required = array("fname", "lname", "email", "numTicket"); //all the required fields

    //Cycle through each field and make sure its filled

    foreach ($required as $value) {

        if($_POST[$value]==""){
            $filled = false;
        }
    }

    //If there are any fields not filled out, send the user back to the form
    if (!$filled){
        header("Location: http://websci/tcktr/user/reservation.php/?show=" . $_GET['show']); 
    }

    else {
    
		//Connecting to sql db.
		$db = new PDO("mysql:host=localhost;dbname=tcktr","root","hardlyapassword1!");

		$sql = $db->prepare("SELECT numTickets, reserved FROM perform WHERE date = '$_POST[showtime]' AND showID = '$_GET[show]'");

		$sql->execute();


			$result = 0;

			foreach($sql as $row) {

				if(($row["numTickets"] - $row["reserved"]) > $_POST['numTicket']){

					$result = $row["reserved"] + $_POST['numTicket'];

					$sql = $db->prepare("UPDATE perform SET `reserved` = $result WHERE `date` = '$_POST[showtime]' AND `showID` = '$_GET[show]'");

					$sql->execute();

					if(isset($_POST['list'])){
						$sql = $db->prepare("INSERT INTO reservations (fname, lname, email, numTicket, list, performID)
						VALUES ('$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$_POST[numTicket]', 'Yes', '1')");

						$sql->execute();
					}

					else{
						$sql = $db->prepare("INSERT INTO reservations (fname, lname, email, numTicket, list, performID)
						VALUES ('$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$_POST[numTicket]', 'No', '1')");

						$sql->execute();
					}

					echo "You reserved " . $_POST['numTicket'] . " Tickets!";
					echo "<a href='http://websci/tcktr/user/reservation.php/?show=" . $_GET['show']. "'> Go Back </a>";

					$message = "Thank you for reserving " . $_POST['numTicket'] . " Tickets for the show!";
					$headers = array("From: tcktr.customer.relations@gmail.com",
								    "Reply-To: tcktr.customer.relations@gmail.com",
								    "X-Mailer: PHP/" . PHP_VERSION
								);
					$headers = implode("\r\n", $headers);
					mail('dibol13@gmail.com', 'Ticket Reservation', $message, $headers);
				}
				else{
					echo "You tried to reserve too many tickets! There are only " . $row["numTickets"] - $row["reserved"] . " Tickets left!";
					echo "<a href='http://websci/tcktr/user/reservation.php/?show=" . $_GET['show']. "> Go Back </a>";
				}
			}

        	//header("Location: http://websci/tcktr/user/reservation.php/?show=" . $_GET['show']); 
		}

?>