<?php
    $to = $_POST['reset-email'];
    $from = "tcktr.customer.relations@gmail.com";
    $headers = "From: $from";
    $subject = "Reset Password- tcktr";
    $message = "Your new password is: [INSERT RANDOMLY GENERATED PASSWORD HERE]";
    $mailsent = mail($to, $subject, $message, $headers);

    if ($mailsent) {
        header("Location: http://www.tcktr.tk/tcktr/");
    }
    else {
        alert("There was an error sending this data. Please retry");
    }
?>