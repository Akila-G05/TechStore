<?php

session_start();
require "connection.php";

if(isset($_GET["id"])){

    $invoice_id = $_GET["id"];

    Database::iud("DELETE FROM `invoice` WHERE `id`='".$invoice_id."'");
    echo("Success");

}else{
    echo("Somthing Went Wrong");
}

?>