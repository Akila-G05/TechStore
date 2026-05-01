<?php

require "connection.php";

$status = $_POST["s"];
$id = $_POST["id"];

Database::iud("UPDATE `invoice` SET `status`='".$status."' WHERE `id`='".$id."'");
echo("Success");

?>