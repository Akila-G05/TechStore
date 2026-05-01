<?php

session_start();
require "connection.php";

if(isset($_SESSION["p"])){

    $pid = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $cost = $_POST["c"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["d"];
    $discount = $_POST["dis"];



    Database::iud("UPDATE `product` SET `title`='".$title."', `price`='".$cost."', `qty`='".$qty."', `delivery_fee_colombo`='".$dwc."',
    `delivery_fee_other`='".$doc."', `description`='".$description."', `discount`='".$discount."' WHERE `id`='".$pid."'");

    echo("Product has been Updated! ");

    $length = sizeof($_FILES);
    $allowed_img_extentions = array ("image/jpg","image/jpeg","image/png","image/svg+xml","image/jfif");

    Database::iud("DELETE FROM `images` WHERE `product_id`='".$pid."' ");

    if($length <= 3 && $length > 0){

        for($x=0; $x < $length; $x++){
            if(isset($_FILES["i".$x])){

                $img_file = $_FILES["i".$x];
                $file_type = $img_file["type"];

                if(in_array($file_type,$allowed_img_extentions)){

                    $new_img_exetetion;

                    if($file_type == "image/jpg"){
                        $new_img_exetetion = ".jpg";
                    }else if($file_type == "image/jpeg"){
                        $new_img_exetetion = ".jpeg";
                    }else if($file_type == "image/png"){
                        $new_img_exetetion = ".png";
                    }else if($file_type == "image/svg+xml"){
                        $new_img_exetetion = ".svg";
                    }else if($file_type == "image/jfif"){
                        $new_img_exetetion = ".jfif";
                    }

                    $file_name = "resource//images//".$title."_".$x."_".uniqid().$new_img_exetetion;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('".$file_name."','".$pid."')");

                }

            }
        }

    }else{
        echo("Invalid image count!");
    }

}

?>