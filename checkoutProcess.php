<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $umail = $_SESSION["u"]["email"];
    $subTotal = $_GET["total"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$umail."'");
    $cart_num = $cart_rs->num_rows;

    $array;

    if($cart_num != 0){
        $order_id = uniqid();
        
        $array["mail"] = $umail;
        $array["subTotal"] = $subTotal;
        $array["o_id"] = $order_id;

        $phpObj = new stdClass();
        $phpObj->type = "ONE_TIME";
        $phpObj->orderId = $order_id;
        $phpObj->trnId = 935;
        $phpObj->status = "SUCCESS";
        $phpObj->desc = "Approved";
        $phpObj->signature = "nOaZaqtRdvozz6bcDkw4brFVb8gQ2TPxXDGA1FEboX5shYNTJgMVfsK0icGgmixJO7YpWDOls8aLwlP7V6XsmhHd3ISEbPXB8oySq";

        $array["result"] = $phpObj;

        echo json_encode($array);
        
    }
    
}else{
    echo("1");
}

?>