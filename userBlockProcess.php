<?php

require "connection.php";

$email = $_GET["email"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
$user_num = $user_rs->num_rows;

if($user_num == 1){

    $user_data = $user_rs->fetch_assoc();

    if($user_data["status"] == 1){
        Database::iud("UPDATE `user` SET `status`='0' WHERE `email`='".$email."'");
        echo("blocked");
    }else if($user_data["status"] == 0){
        Database::iud("UPDATE `user` SET `status`='1' WHERE `email`='".$email."'");
        echo("unblocked");
    }

}else{
    echo ("Cannot find the user.Please try again later.");
}



?>