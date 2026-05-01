<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $email = $_SESSION["u"]["email"];
    $pid = $_POST["id"];
    $feed = $_POST["t"];
    $status = $_POST["s"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::search("INSERT INTO `feedback` (`type`,`feedback`,`date`,`product_id`,`user_email`) VALUES 
    ('".$status."','".$feed."','".$date."','".$pid."','".$email."')");
    echo("1");

}else{
    echo("Please Signin and Tray Again");
}

?>