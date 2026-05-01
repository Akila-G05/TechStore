<?php

require "connection.php";

if(!empty($_POST["category"])){

    if(!empty($_POST["bname"])){

        $c = $_POST["category"];
        $bname = $_POST["bname"];

        $brand_rs = Database::search("SELECT * FROM `brand` WHERE `name` LIKE '%".$bname."%' AND `category_id`='".$c."' ");
        $brand_num = $brand_rs->num_rows;

        if($brand_num == 0){

            Database::iud("INSERT INTO `brand`(`name`,`category_id`) VALUES ('".$bname."','".$c."') ");
            echo("Success");

        }else{
            echo("This Brand Already Exists");
        }

    }else{
        echo("Please Insert Brand Name");
    }

}else{
    echo("Please Select Category");
}

?>