<?php

require "connection.php";

if(isset($_GET["id"])){

    $pid = $_GET["id"];

    Database::iud("DELETE FROM `images` WHERE `product_id`='".$pid."'");
    Database::iud("DELETE FROM `product` WHERE `id`='".$pid."'");
    
    echo("Success");

}else{
    echo("Something went wrong");
}

?>