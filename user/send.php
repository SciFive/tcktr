<!DOCTYPE HTML> 
<html>
<head>
    <title>tcktr</title>
</head>
<body>
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

		$sql = $db->prepare("SELECT numTickets, reserved FROM `perform` WHERE date = '$_POST[showtime]' AND showID = '$_GET[show]'");

		$sql->execute();


			$result = 0;

			foreach($sql as $row) {

				if(($row["numTickets"] - $row["reserved"]) > $_POST['numTicket']){

					$result = $row["reserved"] + $_POST['numTicket'];

					$sql = $db->prepare("UPDATE `perform` SET `reserved` = $result WHERE `date` = '$_POST[showtime]' AND `showID` = '$_GET[show]'");

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

					/* THIS IS SUPPOSED TO SEND RESERVATION EMAIL
					WE GET AN SMTP INVALID ERROR!

					require_once "Mail.php";

					$from = '<tcktr.customer.relations@gmail.com>';
					$to = '<' . $_POST['email'] . '>';
					$subject = 'Thank you for reserving tickets!';
					$body = "You Reserved " . $_POST['numTicket'] . " Tickets!" ;

					$headers = array(
					    'From' => $from,
					    'To' => $to,
					    'Subject' => $subject
					);

					$smtp = Mail::factory('smtp', array(
					        'host' => 'ssl://smtp.gmail.com',
					        'port' => '465',
					        'auth' => true,
					        'username' => 'tcktr.customer.relations@gmail.com',
					        'password' => 'bunny5lea'
					    ));

					$mail = $smtp->send($to, $headers, $body);

					if (PEAR::isError($mail)) {
					    echo('<p>' . $mail->getMessage() . '</p>');
					} else {
					    echo('<p>Message successfully sent!</p>');
					}
					*/
				}
				else{
					echo "You tried to reserve too many tickets! There are only " . $row["numTickets"] - $row["reserved"] . " Tickets left!";
					echo "<a href='http://websci/tcktr/user/reservation.php/?show=" . $_GET['show']. "> Go Back </a>";
				}
			}

        	//header("Location: http://websci/tcktr/user/reservation.php/?show=" . $_GET['show']); 
		}

?>
    </body>
</html>