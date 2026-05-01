<?php

session_start();
require "connection.php";

$pid = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
$product_data = $product_rs->fetch_assoc();

if($product_data["status_id"] == 1){

    Database::iud("UPDATE `product` SET `status_id`= '2' WHERE `id`='".$pid."'");
    echo ("blocked");

}else if($product_data["status_id"] == 2){

    Database::iud("UPDATE `product` SET `status_id`= '1' WHERE `id`='".$pid."'");
    echo ("unblocked");
    
}

?>