<?php

session_start();
require "connection.php";

$reciver = $_SESSION["u"]["email"];
$sender = $_GET["e"];

$msg_rs = Database::search("SELECT * FROM `chat` WHERE `from`='".$sender."' OR `to`='".$sender."'");
$msg_num = $msg_rs->num_rows;

for($x = 0; $x < $msg_num; $x++){

    $msg_data = $msg_rs->fetch_assoc();

    if($msg_data["from"] == $reciver && $msg_data["to"] == $sender){

        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["from"] . "'");
        $user_data = $user_rs->fetch_assoc();

        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $msg_data["from"] . "'");
        $img_data = $img_rs->fetch_assoc();

        ?>
        <!-- Sender -->
        <li class="col-12 me">
            <div class="entete">
                <h3><?php echo $msg_data["date_time"]; ?></h3>
                <h2><?php echo $user_data["fname"] ." ". $user_data["lname"]; ?></h2>
                <span class="status blue"></span>
            </div>
            <div class="triangle"></div>
            <div class="message"><?php echo $msg_data["content"]; ?></div>
            <p class="invisible" id="rmail"><?php echo $msg_data["to"]; ?></p>
        </li>
        <!-- Sender -->
    <?php

    }else if($msg_data["to"] == $reciver && $msg_data["from"] == $sender){

        $user_rs1 = Database::search("SELECT * FROM `user` WHERE `email`='" . $sender . "'");
        $user_data1 = $user_rs1->fetch_assoc();

        ?>
        <!-- Reciver -->
        <li class="col-12 mt-3 you">
            <div class="entete">
                <span class="status green"></span>
                <h2><?php echo $user_data1["fname"] ." ". $user_data1["lname"]; ?></h2>
                <h3><?php echo $msg_data["date_time"]; ?></h3>
            </div>
            <div class="triangle"></div>
            <div class="message"><?php echo $msg_data["content"]; ?></div>
            <p class="invisible" id="smail"><?php echo $msg_data["from"]; ?></p>
        </li>
        <!-- Reciver -->
        <?php
        
    }

    ?>
        

        <?php

    }

    

?>
