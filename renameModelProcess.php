<?php

require "connection.php";

if(!empty($_POST["mname"])){

    $mname = $_POST["mname"];
    $mid = $_POST["id"];
    
    $model_rs = Database::search("SELECT * FROM `model` WHERE `name`='".$mname."'");
    $model_num = $model_rs->num_rows;

    if(($model_num == 0)){

        Database::iud("UPDATE `model` SET `name`='".$mname."' WHERE `id`='".$mid."'");
        echo("success");

    }else{
        echo("This Model Name Already Exists");
    }

}else{
    echo("Please Insert Model Name");
}

?>