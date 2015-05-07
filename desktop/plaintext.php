<?php
    $db = new PDO("mysql:host=localhost;dbname=tcktr","root","hardlyapassword1!");
    $sql = $db->prepare("SELECT * FROM `show`");
    $sql->execute();
    $data = "";
    foreach($sql as $row) {
        $val = $row['title'];
        $data .= "$val\n";
    }       
    file_put_contents("show_names.txt", $data);
?>