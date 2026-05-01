<?php

require "connection.php";

if(!empty($_POST["name"])){

    $cname = $_POST["name"];
    $cid = $_POST["id"];
    
    $category_rs = Database::search("SELECT * FROM `category` WHERE `name`='".$cname."'");
    $category_num = $category_rs->num_rows;

    if(($category_num == 0)){

        Database::iud("UPDATE `category` SET `name`='".$cname."' WHERE `id`='".$cid."'");
        echo("success");

    }else{
        echo("This Category Name Already Exists");
    }

}else{
    echo("Please Insert Category Name");
}

?>