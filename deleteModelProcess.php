<?php

require "connection.php";

$mid = $_GET["id"];

Database::iud("DELETE FROM `model_has_brand` WHERE `model_id`='".$mid."'");
Database::iud("DELETE FROM `model` WHERE `id`='".$mid."'");

echo("Success");

?>