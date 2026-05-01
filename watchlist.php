<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $email = $_SESSION["u"]["email"];

}

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>watchlist | Tech Store</title>

        <link rel="icon" href="resource/logor.png"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body>
        
        <div class="container-fluid d-block">
            <div class="row">

                <div id="cssLoader17" class="main-wrap main-wrap--white">
                    <div class="cssLoader17"></div>
                </div>

                <?php include "header.php"?>
              
                <div class="col-12 mt-3" style="background-color:#E9EBEE">
                    <div class="row">

                        <div class="col-12 bg-white mt-3">
                            <div class="row">

                                <nav aria-label="breadcrumb" class="mt-3 ">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item" style="font-size: 18px;"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page" style="font-size: 18px;">watchlist</li>
                                    </ol>
                                </nav>  
                                
                            </div>
                        </div>

                        <div class="col-12 bg-white">
                            <div class="row">

                                <span class="form-label fs-1 fw-bolder" style="font-family: 'Quicksand';">Watchlist <i class="bi bi-balloon-heart text-primary"></i></span>
                            
                            </div>
                        </div>
                        

                        <?php
                        
                        $watch_rs2 = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$email."'");
                        $watch_num2 = $watch_rs2->num_rows;
                        $watch_data2 = $watch_rs2->fetch_assoc();

                        if($watch_num2 == 0){

                            ?>
                            <!-- empty view -->
                            <div class="col-12 col-lg-10 offset-1 bg-white mt-3 mb-3">
                                <div class="row">
                                    <a href="home.php">
                                        <div class="col-12 emptywatchlist"></div> 
                                    </a>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-5 fw-bold">Click here to start shopping <i class="bi bi-arrow-up-circle"></i></label><br>
                                        <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                                    </div>
                                </div>
                            </div>
                            <!-- empty view -->
                            <?php

                        }else{

                            ?>
                            <div class="col-lg-12 bg-white mt-3">
                                <div class="row">
                                    
                                    <div class="col-lg-3 col-12 my-3">
                                        <div class="row">
                                            <div class="col-8 mx-5">
                                                <select class="form-select bg-white rounded rounded-5 border border-1 border-dark" id="watchlist_select">
                                                    <option value="0" class="my-2">Select Category</option>

                                                    <?php

                                                    $category_rs = Database::search("SELECT * FROM `category`");
                                                    $category_num = $category_rs->num_rows;

                                                    for ($x = 0; $x < $category_num; $x++) {
                                                        $category_data = $category_rs->fetch_assoc();
                                                    ?>

                                                    <option value="<?php echo $category_data["id"]; ?>" class="my-2"><?php echo $category_data["name"]; ?></option>

                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 my-3 mx-4">
                                        <div class="row">
                                            <div class="col-12 mx-3">
                                                <input type="text" class="form-control border-secondary" placeholder="Type keyword to search..." id="watchlist_txt">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2 my-3 text-end">
                                        <div class="row">
                                            <div class="col-12 ">
                                                <a href="#" class="fs-4 text-dark fw-bold" onclick="search_watchlist('<?php echo $watch_data2['id']; ?>');"><i class="bi bi-search"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>

                            <div class="col-10 offset-1 mt-3 mb-3 bg-white">
                                <div class="row" id="result">
                                    <div class="col-12 mb-3">
                                        <div class="row">
       
                                            <?php

                                            $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$email."'");
                                            $watch_num = $watch_rs->num_rows;

                                            for($x = 0; $x < $watch_num; $x++){

                                                $watch_data = $watch_rs->fetch_assoc();

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$watch_data["product_id"]."'");
                                                $product_data = $product_rs->fetch_assoc();

                                                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$product_data["id"]."'");
                                                $image_data = $image_rs->fetch_assoc();

                                                $clr_rs = Database::search("SELECT * FROM `colour` WHERE `id`='".$product_data["colour_id"]."'");
                                                $clr_data = $clr_rs->fetch_assoc();

                                                $con_rs = Database::search("SELECT * FROM `condition` WHERE `id`='".$product_data["condition_id"]."'");
                                                $con_data = $con_rs->fetch_assoc();


                                            ?>
                                                <!-- card -->
                                                <div class="card col-10 mt-4 offset-1">
                                                    <div class="row g-0">
                                                        <div class="col-lg-3 col-12">

                                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Details">
                                                                <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start mt-3 offset-2 offset-lg-0" style = "height:160px;">
                                                            </span>
                                                            
                                                        </div>
                                                        <div class="col-lg-5 col-12">
                                                            <div class="card-body mx-2 text-center text-lg-start">
                                                                <h5 class="card-title fs-2 fw-bold text-primary"><?php echo($product_data["title"]); ?></h5>
                                                                <span class="fs-6 fw-bold text-black-50">Colour : <?php echo($clr_data["name"]); ?></span>
                                                                &nbsp;&nbsp; | &nbsp;&nbsp;
                                                                <span class="fs-6 fw-bold text-black-50">Condition : <?php echo($con_data["name"]); ?></span><br/>
                                                                <span class="fs-6 fw-bold text-black">Price : </span>
                                                                <span class="fs-6 fw-bold text-danger">Rs: <?php echo($product_data["price"]); ?> :00</span><br/>
                                                                <span class="fs-6 fw-bold text-black">Quantity :</span>
                                                                <span class="fs-6 text-black"><?php echo($product_data["qty"]); ?> Items Availabale</span><br/>
                                                                <span class="fs-6 fw-bold text-black">Seller :</span>
                                                                <span class="fs-6 text-black"><?php echo($_SESSION["u"]["fname"]); ?></span><br/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-12 mt-2">
                                                            <div class="card-body d-grid">
                                                                <a href="<?php echo "singleProductView.php?id=".$product_data["id"]; ?>" class="btn btn-outline-success mb-2 rounded-5">Buy Now</a>
                                                                <a href="#" class="btn btn-outline-warning mb-2 rounded-5" onclick='addToCart(<?php echo ($product_data["id"]) ?>);'>Add to Cart</a>
                                                                <a href="#" class="btn btn-outline-danger rounded-5" onclick='RemoveFromWatchlist(<?php echo $watch_data["id"] ?>);'>Remove</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 mt-2">
                                                            
                                                                <?php
                                                                
                                                                if($product_data["discount"] != 0){

                                                                    ?>
                                                                    <div class="card-body d-grid bg-primary">
                                                                        <span class="text-white fs-5 fw-bold mt-lg-5 mb-lg-5 text-center">-<?php echo $product_data["discount"]; ?>%</span>
                                                                    </div>
                                                                    <?php

                                                                }else{

                                                                    ?>
                                                                    <div class="card-body d-grid">
                                                                        <span class="text-white fs-5 fw-bold"></span>
                                                                    </div>
                                                                    <?php

                                                                }
                                                                
                                                                ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card -->
                                            <?php

                                            }     

                                            ?>    
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php

                        }

                        ?>

                    </div>
                </div>

                <?php include "footer.php"; ?>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

</html>
