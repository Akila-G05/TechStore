<?php

require "connection.php";

if(isset($_GET["id"])){

    $cid = $_GET["id"];

    Database::iud("DELETE FROM `cart` WHERE `id`='".$cid."'");
    echo("Success");

}else{
    echo("Something went wrong");
}

?>