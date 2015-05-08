<!DOCTYPE HTML> 
<html>
<head>

    <title>tcktr</title>
    <link rel="stylesheet" type="text/css" href="../../resources/style.css"/>
</head>

<body>

<?php

  // Get the show ID from the URL
    $sid = $_GET['show'];
    $action = "../send.php?show=" . $sid; // Set action for form submit

?>

<form method="post" action=<?php echo $action?>> // Create the form for reservations
    <div id="reservation"><h1>Reserve Show<span>Please fill out the following form fields.</span></h1>
        <div id="perform"><span>Performance Time: </span><select name="showtime" id="picktime">
<?php
  // Pull the performance date and times from the SQL database

  $db = new PDO("mysql:host=localhost;dbname=tcktr","root","hardlyapassword1!");

  $sql = $db->prepare("SELECT date FROM perform WHERE showID = :show");

  $sql->bindValue(":show", $sid); // Bind the Show ID

  $sql->execute();

  $i = 0;

  foreach($sql as $row) { // Loop through all productions and make them available in the dropdown menu

    echo "<option value='". $row["date"] . "'>" . date('M jS g:ia',strtotime($row["date"])) . "</option>";
    
  }
?>
            </select></div>
  <!-- List all other form fields -->
  <label>
      <span>First Name:</span> <input type="text" name="fname" required></label>
   
    <label>
        <span>Last Name: </span><input type="text" name="lname" required></label>
  
    <label>
        <span>Email:</span> <input type="text" name="email" required></label>
  
    <label>
        <span>Number of Tickets: </span> <input type="number" min="1" max="10" name="numTicket" required></label>
  
    <label>
    <span>Mailing list:</span>
    <input type="checkbox" name="list"></label>
   
        <button type="submit" name="submit" value="Submit">Submit</button> // Button to submit the form
    </div>
</form>


</body>
</html>
