<!DOCTYPE HTML> 
<html>
<head>
    <title>tcktr</title>
    <link rel="stylesheet" type="text/css" href="../resources/style.css"/>
</head>

<body>

<?php

    $sid = $_GET['show'];
    $action = "./send.php?show=" . $sid; 

?>

<form method="post" action=<?php echo $action?>> 
    <div id="reservation"><h1>Reserve Show<span>Please fill out the following form fields.</span></h1>
        <div id="perform"><span>Performance Time: </span><select name="showtime" id="picktime">
<?php
  //echo $_GET['show'];

  $db = new PDO("mysql:host=localhost;dbname=tcktr","root","hardlyapassword1!");

  $sql = $db->prepare("SELECT date FROM perform WHERE showID = :show");

  $sql->bindValue(":show", $sid);

  $sql->execute();

  $i = 0;

  foreach($sql as $row) {

    echo "<option value='". $row["date"] . "'>" . date('M jS g:ia',strtotime($row["date"])) . "</option>";
    
  }
?>
            </select></div>
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
   
        <button type="submit" name="submit" value="Submit">Submit</button> 
    </div>
</form>


</body>
</html>
