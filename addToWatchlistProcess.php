<?php

session_start();
require  "connection.php";

if(isset($_SESSION["u"])){

    if(isset($_GET["id"])){

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$email."' AND `product_id`='".$pid."'");
        $watchlist_num = $watchlist_rs->num_rows;

        if($watchlist_num == 1){
            
            $watchlist_data = $watchlist_rs->fetch_assoc();
            $wid = $watchlist_data["id"];

            Database::iud("DELETE FROM `watchlist` WHERE `id`='".$wid."'");
            echo("Removed");

        }else{

            Database::iud("INSERT INTO `watchlist` (`product_id`,`user_email`) VALUES ('".$pid."','".$email."')");
            echo("added");

        }

    }else{
        echo("Something went Wrong.");
    }

}else{
    echo("Please Signin and Try again");
}

?>