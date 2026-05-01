<?php

require "connection.php";

if(!empty($_POST["brand"])){

    if(!empty($_POST["mname"])){

        $b = $_POST["brand"];
        $m = $_POST["mname"];

        $model_rs = Database::search("SELECT * FROM `model` WHERE `name`='".$m."' AND `brand_id`='".$b."'");
        $model_num = $model_rs->num_rows;

        if($model_num == 0){

            $model_data = $model_rs->fetch_assoc();

            Database::iud("INSERT INTO `model` (`name`,`brand_id`) VALUES ('".$m."','".$b."')");
            
            $m_rs = Database::search("SELECT * FROM `model` WHERE `name`='".$m."'");
            $m_data = $m_rs->fetch_assoc();

            Database::iud("INSERT INTO `model_has_brand` (`brand_id`,`model_id`) VALUES ('".$b."','".$m_data["id"]."')");

            echo("Success");

        }else{
            echo("This Model Already Exists");
        }

    }else{
        echo("Please Insert Model Name");
    }

}else{
    echo("Please Select Brand");
}

?>