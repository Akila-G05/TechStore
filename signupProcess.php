<?php

require "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];

if(empty($fname)){
    echo("Please enter your Frist Name !!!");
}else if(strlen($fname) > 50){
    echo("Frist Name must have less than 50 characters");
}else if(empty($lname)){
    echo("Please enter your Last Name !!!");
}else if(strlen($lname) > 50){
    echo("Last Name must have less than 50 characters");
}else if(empty($email)){
    echo("Please enter your Email !!!");
}else if(strlen($email) >= 100){
    echo("Email must have less than 100 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid email !!!");
}else if(empty($password)){
    echo("Please enter your Password !!!");
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo("Password must in between 5-20 characters");
}else if(empty($mobile)){
    echo("Please enter your Mobile !!!");
}else if(strlen($mobile) != 10){
    echo("Mobile must have 10 characters");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo ("Invalid mobile Number !!!");
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `mobile`='".$mobile."'");
    $rs_num = $rs->num_rows;

    if($rs_num > 0){

        echo("User with the same email or mobile already exists");

    }else{

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::search("INSERT INTO `user` (`email`,`fname`,`lname`,`password`,`mobile`,`joined_date`,`status`,`gender_id`) 
        VALUES ('".$email."','".$fname."','".$lname."','".$password."','".$mobile."','".$date."','1','".$gender."') ");

        echo("Success");

    }

}

?>