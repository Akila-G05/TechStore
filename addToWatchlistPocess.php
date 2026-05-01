<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    if($_GET["id"]){

        $umail = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
        $product_data = $product_rs->fetch_assoc();
        $p_qty = $product_data["qty"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."' AND `user_email`='".$umail."'");
        $cart_num = $cart_rs->num_rows;

        if($cart_num == 1){

            $cart_data = $cart_rs->fetch_assoc();
            $current_qty = $cart_data["qty"];
            $new_qty = (int)$current_qty + 1;

            if($p_qty >= $new_qty){

                Database::iud("UPDATE `cart` SET `qty`='".$new_qty."' WHERE `product_id`='".$pid."' AND `user_email`='".$umail."'");
                echo("Product Updated");

            }else{
                echo("Invalid Qunatity");
            }

        }else{

            Database::iud("INSERT INTO `cart` (`product_id`,`user_email`,`qty`) VALUES ('".$pid."','".$umail."','1')");
            echo("Product added");

        }

    }else{
        echo("Something went wrong");
    }
    
}else{
    echo("Please Signin Frist");
}

?>