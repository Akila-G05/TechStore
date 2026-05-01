<?php

require "connection.php";
session_start();

if(isset($_SESSION["u"])){

    $user = $_SESSION["u"]["email"];
    $order_id = $_GET["Oid"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$user."'");
    $cart_num = $cart_rs->num_rows;

    if($cart_num != 0){

        $array;

        for($x = 0; $x < $cart_num; $x++){

            $cart_data = $cart_rs->fetch_assoc();

            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$cart_data["product_id"]."'");
            $product_data = $product_rs->fetch_assoc();

            $cur_qty = $product_data["qty"];
            $qty = $cart_data["qty"];
            
            $new_qty = (int)$cur_qty - (int)$qty;
  
            Database::iud("UPDATE `product` SET `qty`='".$new_qty."' WHERE `id`='".$cart_data["product_id"]."'");

            $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN 
            `city` ON user_has_address.city_id=city.id INNER JOIN `district` ON city.district_id=district.id WHERE 
            `user_email`='".$user."'");
            $address_data = $address_rs->fetch_assoc();

            $shipping = 0;

            if($address_data["did"] == 2){
                $shipping = $shipping + $product_data["delivery_fee_colombo"];
            }else{
                $shipping = $shipping + $product_data["delivery_fee_other"];
            }

            $total = $shipping + ((int)$product_data["price"] * (int)$qty);

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            $i_qty = $cart_data["qty"];

            Database::iud("INSERT INTO `invoice` (`order_id`,`date`,`total`,`qty`,`status`,`user_email`,`product_id`) 
            VALUES ('".$order_id."','".$date."','".$total."','".$i_qty."','0','".$user."','".$cart_data["product_id"]."')");

            Database::iud("DELETE FROM `cart` WHERE `user_email`='".$user."'");

        }

        echo("Success");

    }

}



?>