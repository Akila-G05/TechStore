<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["con"];
$clr = $_POST["clr"];
$clr_input = $_POST["clr_in"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];
$discount = $_POST["dis"];


if($category == "0"){
    echo ("Please select a category");
}else if($brand == "0"){
    echo ("Please select a brand");
}else if(empty($model)){
    echo ("Please select a model");
}else if(empty($title)){
    echo ("Please enter the title");
}else if(strlen($title <= 100)){
    echo("Title should have low than 100 Characters");
}else if($clr == "0"){
        echo ("Please select a colour");
}else if(empty($qty)){
    echo ("Please enter the Quntity");
}else if($qty == "0" | $qty == "e" | $qty < 0){
    echo ("Invalid input for quantity");
}else if(empty($cost)){
    echo ("Please enter the Cost");
}elseif(!is_numeric($cost)){
    echo ("Please input for Cost");
}else if(empty($dwc)){
    echo ("Please input for Delivery fee for Colombo");
}else if(!is_numeric($dwc)){
    echo ("Please input for Delivery cost inside Colombo");
}else if(empty($doc)){
    echo ("Please input for Delivery fee for out of Colombo");
}else if(!is_numeric($doc)){
    echo ("Please input for Delivery cost out of Colombo");
}else if(empty($desc)){
    echo ("Please enter the Description");
}else if(strlen($discount) > 2){
    echo("Discount must have less than 100%");
}else{   
    
    if(empty($_POST["dis"])){
        $discount = 0;
    }
    

    $mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id`='".$brand."' AND `model_id`='".$model."'");

    $model_has_brand_id;

    if($mhb_rs->num_rows == 1){

        $mhb_data = $mhb_rs->fetch_assoc();
        $model_has_brand_id = $mhb_data["id"];

    }else{

        Database::iud("INSERT INTO `model_has_brand` (`brand_id`,`model_id`) VALUES ('".$brand."','".$model."')");

        $model_has_brand_id = Database::$connection->insert_id;

    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `product` (`category_id`,`model_has_brand_id`,`colour_id`,`status_id`,`condition_id`,`price`,`qty`,
    `description`,`title`,`user_email`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,`discount`) 
    VALUES ('".$category."','".$model_has_brand_id."','".$clr."','".$status ."','".$condition."','".$cost."','".$qty."',
    '".$desc."','".$title."','".$email."','".$date."','".$dwc."','".$doc."','".$discount."') ");

    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);
    
    if($length <= 3 && $length > 0){

        $allowed_img_extentions = array ("image/jpg","image/jpeg","image/png","image/svg+xml","image/jfif");

        for($x = 0; $x < $length; $x++){
            if(isset($_FILES["image".$x])){

                $img_file = $_FILES["image".$x];
                $file_extention = $img_file["type"];

                if(in_array($file_extention,$allowed_img_extentions)){

                    $new_img_exetetion;

                    if($file_extention == "image/jpg"){
                        $new_img_exetetion = ".jpg";
                    }else if($file_extention == "image/jpeg"){
                        $new_img_exetetion = ".jpeg";
                    }else if($file_extention == "image/png"){
                        $new_img_exetetion = ".png";
                    }else if($file_extention == "image/svg+xml"){
                        $new_img_exetetion = ".svg";
                    }else if($file_extention == "image/jfif"){
                        $new_img_exetetion = ".jfif";
                    }

                    $file_name = "resource/images/".$title."_".$x."_".uniqid().$new_img_exetetion;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('".$file_name."','".$product_id."')");

                }else{
                    echo ("Invalid image type");
                }

                echo("Product Saved Successfully");

            }
        }

    }else{

        echo("Invalid Image count");

    }
    
}

?>