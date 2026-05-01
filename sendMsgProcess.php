<?php

session_start();
require "connection.php";

$sender = $_SESSION["u"]["email"];
$recever = $_POST["e"];
$msg = $_POST["msg"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimeZone($tz);
$date = $d->format("y-m-d H:i:s");

Database::iud("INSERT INTO `chat` (`content`,`date_time`,`status`,`from`,`to`) VALUES 
('".$msg."','".$date."','0','".$sender."','".$recever."')");

echo ("Success");

?>