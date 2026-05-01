<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $umail = $_SESSION["u"]["email"];
    $pid = $_GET["id"];
    $qty = $_GET["qty"];
   
    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."'");
    $city_num = $city_rs->num_rows;

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    $array;
    $order_id = uniqid();

    if($city_num == 1){

        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_id"];
        $address = $city_data["line_1"].", ".$city_data["line_2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$city_id."'");
        $district_data = $district_rs->fetch_assoc();

        $district_id = $district_data["district_id"];
        $delivery = "0";

        if($district_id == 4){
            $delivery = $product_data["delivery_fee_colombo"];
        }else{
            $delivery = $product_data["delivery_fee_other"];
        }

        $item = $product_data["title"];
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $user_address = $address;
        $city = $district_data["name"];

        $array["Oid"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $address;
        $array["city"] = $city;
        $array["mail"] = $umail; 
        $array["qty"] = $qty;
        $array["pid"] = $pid;

        $phpObj = new stdClass();
        $phpObj->type = "ONE_TIME";
        $phpObj->orderId = $order_id;
        $phpObj->trnId = 935;
        $phpObj->status = "SUCCESS";
        $phpObj->desc = "Approved";
        $phpObj->signature = "nOaZaqtRdvozz6bcDkw4brFVb8gQ2TPxXDGA1FEboX5shYNTJgMVfsK0icGgmixJO7YpWDOls8aLwlP7V6XsmhHd3ISEbPXB8oySq";

        $array["result"] = $phpObj;
    
        echo json_encode($array);
        
    }else{
        echo("2");
    }

}else{
    echo("1");
}

?>