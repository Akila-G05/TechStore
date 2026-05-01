<?php

session_start();
require "connection.php";

?>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>messages | Tech Store</title>

        <link rel="icon" href="resource/logor.png"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body class="scroll">
        
        <div id="container-fluid">
            <div class="row">

                <div id="cssLoader17" class="main-wrap main-wrap--white">
                    <div class="cssLoader17"></div>
                </div>

                <?php

                if(isset($_SESSION["u"])){

                    $email = $_SESSION["u"]["email"];
                    $s = 1;
                ?>
                
                <div class="col-12">
                    <div class="row">

                    <div class="col-lg-4" style="background-color:#3b3e49;">
                        <div class="row">
                            <aside>

                                <?php
                                
                                $msg_rs = Database::search("SELECT DISTINCT `from`,`to` FROM `chat` WHERE `to`='" . $email . "'");
                                
                                ?>

                                <div class="col-10 offset-1 mb-2" onkeyup="keycheck(event);">
                                    <div class="row">
                                        <input type="text" placeholder="search" class="mt-4" id="search">
                                    </div>
                                </div>
                            
                                <ul>

                                    <?php
                                    
                                    $msg_num = $msg_rs->num_rows;

                                    for($x = 0; $x < $msg_num; $x++){

                                        $msg_data = $msg_rs->fetch_assoc();

                                        $user_rs = Database::search("SELECT DISTINCT `fname`,`lname` FROM `user` WHERE `email`='".$msg_data["from"]."'");
                                        $user_data = $user_rs->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $msg_data["from"] . "'");
                                        $img_data = $img_rs->fetch_assoc();

                                    ?>
                                        
                                        
                                        <div class="col-12 mx-4"  onclick="viewMsg('<?php echo $msg_data['from']; ?>');">
                                            <div class="row">
                                            <li>
                                            
                                            <?php
                                            
                                            if(isset($img_data["path"])){

                                                ?>
                                                <div class="col-2">
                                                    <img src="<?php echo $img_data["path"]; ?>" class="rounded rounded-5" style="height:50px; width: 50px;">
                                                </div>
                                                <?php

                                            }else{

                                                ?>
                                                <div class="col-2">
                                                    <img src="resource/user.svg" class="rounded rounded-5" style="height:50px; width: 50px;">
                                                </div>
                                                <?php

                                            }

                                            ?>
                                            
                                            <div class="col-8">
                                                <span class="form-label fs-5 mx-3 text-white"><?php echo $user_data["fname"]." ".$user_data["lname"]; ?></span>
                                                
                                                <?php
                                                if($s = 1){

                                                    ?>
                                                    <h3 class="form-label mx-3"><span class="status green"></span>online</h3>
                                                    <?php

                                                }else{

                                                    ?>
                                                    <h3 class="form-label mx-3"><span class="status orange"></span>offline</h3>
                                                    <?php
                                                
                                                }
                                                ?>
                                                
                                            </div>

                                            </li>
                                           
                                            </div>
                                        </div>
                                        

                                    <?php
                                    }
                                    ?>

                                    
                                </ul>

                            </aside>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="row">
                            <main>
                            <div class="col-12">
                                <div class="row">
                                
                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <div class="col-9 offset-1 offset-lg-0 mt-3">
                                                <span class="form-label fs-6">Message</span>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <span class="status green"></span>
                                        </div>
                                    </div>
                                
                                    <ul id="chat">

                                        
                                    </ul>

                                    <div class="col-12">
                                        <div class="row">
                                            <span class="status blue"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 px-2">
                                        <div class="row">
                                            <div class="input-group mb-3 ">
                                                <input type="text" id="msg_txt" class="form-control rounded border-0 py-3 bg-light" placeholder="Type a message ..." aria-describedby="send_btn">
                                                <button class="btn btn-light fs-2" id="send_btn" onclick="send_msg();"><i class="bi bi-send-fill fs-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>
                            </main>
                        </div>
                    </div>

                    </div>      
                </div>

                <?php
                }
                ?>

            </div>      
        </div>

                
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

</html>