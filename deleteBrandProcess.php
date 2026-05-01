<?php

require "connection.php";

$bid = $_GET["id"];

Database::iud("DELETE FROM `brand` WHERE `id`='".$bid."'");
echo("Success");

?>