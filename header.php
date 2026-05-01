<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="style.css"/>

    </head>

    <body>
        
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 navbar overflow-hidden" style="background-color: white; box-shadow: 0 0 17px rgb(25, 24, 24);">
                         
                    <div class="col-12 text-dark my-2 ms-2 ">
                        <div class="row">

                            <div class="col-lg-8 col-12 mt-2">
                                <button class="navbar-toggler border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" >
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <?php
                                
                                if(isset($_SESSION["u"])){

                                    ?>
                                    <span class="text-lg-start"><b>Welcome </b><?php echo $_SESSION["u"]["fname"]; ?></span> |
                                    <?php

                                }else{

                                    ?>
                                    <a href="index.php" class="text-lg-start">Register or Signin</a> |
                                    <?php

                                }

                                ?>
 
                                <span class="text-lg-start fw-bold">Help & Contact</span>
                            </div>

                            <div class="col-lg-1 col-3 offset-1 offset-lg-0 mt-lg-2 mt-3">
                                <a href="productListing.php"  class="text-decoration-none text-start text-dark fw-bold fs-5">Store</a>                          
                            </div>
                            <div class="col-lg-2 col-4 offset-lg-0 mt-lg-0 text-center">
                                <a class="fs-3" href="cart.php"><i class="bi bi-cart3 text-black"></i></a>
                                <a class="fs-3" href="watchlist.php"><i class="bi bi-heart-fill text-danger text-start mx-lg-5 mx-3"></i></a>
                            </div>   
                            
                            <?php
                                
                                if(isset($_SESSION["u"])){

                                    $pimg_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$_SESSION["u"]["email"]."'");
                                    $pimg_data = $pimg_rs->fetch_assoc();
                            
                                    ?>

                                    <div class="col-lg-1 col-4 mt-lg-0 mt-2 ">

                                        <?php
                                        if(isset($pimg_data["path"])){

                                            ?>
                                            <a href="userProfile.php" ><img src="<?php echo $pimg_data["path"]; ?>" class="rounded rounded-5" style="height: 50px;"></a>
                                            <?php

                                        }else{

                                            ?>
                                            <a href="userProfile.php" ><img src="resource/user.svg" style="height: 50px;"></a>
                                            <?php

                                        } 
                                        ?>  

                                    </div> 

                                <?php
                                }else{

                                    ?>
                                    <div class="col-lg-1 col-4 mt-lg-0 mt-2 ">
                                        <a href="userProfile.php" ><img src="resource/user.svg" style="height: 50px;"></a>
                                    </div>
                                    <?php

                                }
                                ?>

                           
                            
                            

                        </div>
                    </div>

                    <div class="offcanvas offcanvas-start text-white" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel" 
                    style="background-color: #11101d; box-shadow: 0 0 17px rgb(25, 24, 24); width: 330px;">
                        
                        <div class="offcanvas-header" >

                            <div class="col-12 offset-1 header_title">
                                <span class="text-start text-primary fs-1 fw-bold">Tech</span>
                                <span class="text-start text-warning fs-1 fw-bold">Store</span> 
                            </div>

                        </div>      
                        
                        <div class="col-11 align-self-center">
                            <hr class="border-white border border-2 rounded-2">
                        </div>

                        <div class="offcanvas-body" style="overflow-y: hidden;">
                            <div class="col-8 offset-1 list1">

                                <ul class="navbar-nav  justify-content-end fw-bold" style="font-family: 'Quicksand';">

                                    <li class="nav-item mb-3">
                                        <a class="nav-link text-white ms-3" aria-current="page" href="home.php"><i class="bi bi-house"></i> Home</a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="nav-link text-white ms-3" href="userProfile.php"><i class="bi bi-person-circle"></i> My Profile</a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="nav-link text-white ms-3" href="trackPackage.php"><i class="bi bi-coin"></i> Track Your Package</a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="nav-link text-white ms-3" href="myProduct.php"><i class="bi bi-inboxes"></i> My Products</a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="nav-link text-white ms-3" href="watchlist.php"><i class="bi bi-balloon-heart"></i> My Watchlist</a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="nav-link text-white ms-3" href="purchasingHistoryPage.php"><i class="bi bi-clock-history"></i> Purchase History</a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="nav-link text-white ms-3" href="chat.php"><i class="bi bi-chat-text"></i> Massage</a>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <a class="nav-link text-white ms-3" href="#"><i class="bi bi-save"></i> Saved</a>
                                    </li>

                                </ul>
                        
                            </div>

                            <div class="col-12 align-self-center">
                                <hr class="border-white border border-2 rounded-2">
                            </div>

                            <div class="col-12 text-center" >

                                <?php
                                if(isset($_SESSION["u"])){

                                    ?><a class="nav-link" href="#" onclick="signout();"><i class="bi bi-box-arrow-left"></i> SignOut</a><?php

                                }else{

                                    ?><a class="nav-link fw-bold text-info text-decoration-underline" href="index.php">Signin here</a><?php

                                }
                                ?>

                                
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-12 align-self-center">
                    <hr class="border-white border border-2 rounded-2">
                </div>

            </div>
        </div>   


        <script src="script.js"></script>

    </body>

</html>