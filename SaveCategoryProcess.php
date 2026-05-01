<?php

require "connection.php";

if(!empty($_GET["txt"])){

    $cname = $_GET["txt"];

    $category_rs = Database::search("SELECT * FROM `category` WHERE `name` LIKE '%".$cname."%'");
    $category_num = $category_rs->num_rows;

    if(($category_num == 0)){

        Database::iud("INSERT INTO `category`(`name`)VALUES ('".$cname."')");
        echo("success");

    }else{
        echo("This Category Already Exists");
    }

}else{
    echo("Please Insert Category Name");
}

?>