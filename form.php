<?php

$to = 'bogus824@gmail.com';
$name = $_POST['name'];
$email = $_POST['mail'];
$surename = $_POST["surename"];
$subject = "Nowy email od " . $name .  " " . $surename . "" . $email;
$message = "hello";
$headers = "From: mail.php"."\r\n";

mail($to,$subject,$message,$headers);

?>