<?php

session_start();
require "connection.php";

Database::iud("DELETE FROM `invoice`");
echo("Success");

?>