<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){
 
        $code = uniqid();
        Database::iud("UPDATE `user` SET `varification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gimhanaakilatmd@gmail.com';
            $mail->Password = 'rfhwdgbctusyhyjg';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('gimhanaakilatmd@gmail.com', 'Reset Password');
            $mail->addReplyTo('gimhanaakilatmd@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eShop Forgot Password Verification Code';
            $bodyContent = '<h1 style="color:green">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo("Verification code sending Faild");
        }else{
            echo("Success");
        }

    }else{
        echo("Invalid Email address");
    }

}else{
    echo("HI");
}

?>