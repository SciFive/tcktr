<?php

	$db = new PDO("mysql:host=localhost;dbname=tcktr","root","hardlyapassword1!");

	$sql = $db->prepare("INSERT INTO admins (username, password, email)
		VALUES ('$_POST[user]', '$_POST[password]','$_POST[email]')");

	$sql->execute();

	header("../index.html");

?>