<?php

require "connection.php";

$cid = $_GET["id"];

$brand_rs = Database::search("SELECT * FROM `brand` WHERE `category_id`='".$cid."'");
$brand_num = $brand_rs->num_rows;

if($brand_num == 0){

    Database::iud("DELETE FROM `category` WHERE `id`='".$cid."'");
    echo("Success");

}else{
    echo ("Delete all data related to category");
}



?>