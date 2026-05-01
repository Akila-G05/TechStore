<?php

require "connection.php";

if(!empty($_POST["bname"])){

    $bname = $_POST["bname"];
    $bid = $_POST["id"];
    
    $brand_rs = Database::search("SELECT * FROM `brand` WHERE `name`='".$bname."'");
    $brand_num = $brand_rs->num_rows;

    if(($brand_num == 0)){

        Database::iud("UPDATE `brand` SET `name`='".$bname."' WHERE `id`='".$bid."'");
        echo("success");

    }else{
        echo("This Brand Name Already Exists");
    }

}else{
    echo("Please Insert Brand Name");
}

?>