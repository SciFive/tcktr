<!DOCTYPE HTML> 
<html>
<head>
</head>
<body> 

<?php

$sid = $_GET['show'];

$action = "../send.php?show=" . $sid; 

?>

<h2>PHP Form Validation Example</h2>

<form method="post" action=<?php echo $action?>> 

Performance Time: <select name="showtime">
<?php

  //echo $_GET['show'];

  $db = new PDO("mysql:host=localhost;dbname=tcktr","root","root");

  $sql = $db->prepare("SELECT date FROM perform WHERE showID = :show");

  $sql->bindValue(":show", $sid);

  $sql->execute();

  $i = 0;

  foreach($sql as $row) {
    
    //$dates[$i] = date('M jS g:ia',strtotime($row["date"]));
    //echo $dates[$i];

    echo "<option value='". $row["date"] . "'>" . date('M jS g:ia',strtotime($row["date"])) . "</option>";
    
  }
?>
  </select>
  <br><br>
  First Name: <input type="text" name="fname" required>
   <br><br>
  Last Name: <input type="text" name="lname" required>
   <br><br>
  Email: <input type="text" name="email" required>
   <br><br>
  Number of Tickets: <input type="number" min="1" max="10" name="numTicket" required>
   <br><br>
  Mailing list:
   <input type="radio" name="list"> Yes
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>


</body>
</html>
