<?php

require "connection.php";
session_start();

if(isset($_GET["v"])){

    $vcode = $_GET["v"];
    
    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `verification_code`='".$vcode."'");
    $admin_num = $admin_rs->num_rows;

    if($admin_num == 1){

        $admin_data = $admin_rs->fetch_assoc();
        $_SESSION["au"] = $admin_data;
        echo("Success");

    }else{
        echo("Invalid Verification Code");
    }

}else{
    echo("Please enter your verificaion");
}

?>