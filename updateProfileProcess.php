<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["m"];
    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $province = $_POST["p"];
    $district = $_POST["d"];
    $city = $_POST["c"];
    $pcode = $_POST["pc"];
    $desc = $_POST["desc"];

    if(isset($_FILES["image"])){

        $image = $_FILES["image"];

        $allowed_image_extention = array("image/jpg" , "image/jpeg" , "image/png" , "image/svg+xml" , "image/jfif");
        $file_type = $image["type"];

        if(in_array($file_type,$allowed_image_extention)){

            $new_file_extention;

            if($file_type == "image/jpg"){
                $new_file_extension = ".jpg";
            }else if($file_type == "image/jpeg"){
                $new_file_extension = ".jpeg";
            }else if($file_type == "image/png"){
                $new_file_extension = ".png";
            }else if($file_type == "image/svg+xml"){
                $new_file_extension = ".svg";
            }else if($file_type == "image/jfif"){
                $new_file_extension = ".jfif";
            }

            $file_name = "resource//Profile_images//" .$_SESSION["u"]["fname"]."_".uniqid().$new_file_extension;

            move_uploaded_file($image["tmp_name"],$file_name);

            $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '".$_SESSION["u"]["email"]."'");
            $image_num = $image_rs->num_rows;

            if($image_num == 1){

                Database::iud("UPDATE `profile_image` SET `path`='".$file_name."' 
                WHERE `user_email` = '".$_SESSION["u"]["email"]."'");

            }else{

                Database::iud("INSERT INTO `profile_image` (`path`,`user_email`) 
                VALUES ('".$file_name."','".$_SESSION["u"]["email"]."')");

            }

        }else{
            echo("Please select avalid image");
        }

    }

    Database::iud("UPDATE `user` SET `fname`='".$fname."', `lname`='".$lname."', `mobile`='".$mobile."' WHERE `email`='".$_SESSION["u"]["email"]."'");

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$_SESSION["u"]["email"]."'");

    $address_num = $address_rs->num_rows;

    if($address_num == 1){

        Database::iud("UPDATE `user_has_address` SET `line_1`='".$line1."', `line_2`='".$line2."', `city_id`='".$city."', 
        `postal_code`='".$pcode."' WHERE `user_email`='".$_SESSION["u"]["email"]."'");
        
    }else{

        Database::iud("INSERT INTO `user_has_address` 
        (`line_1`, `line_2`, `user_email`, `city_id`, `postal_code`) 
        VALUES ('".$line1."', '".$line2."', '".$_SESSION["u"]["email"]."', '".$city."', '".$pcode."')");

    }

    echo("Success");

}else{
    echo("Please login frist");
}

?>