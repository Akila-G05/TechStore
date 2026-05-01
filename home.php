<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home | Tech Store</title>

        <link rel="icon" href="resource/logor.png"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body>

        <div class="container-fluid" style="background-color:white;">
            <div class="row">

                <div id="cssLoader17" class="main-wrap main-wrap--white">
                    <div class="cssLoader17"></div>
                </div>

                <?php include "header.php"; ?>

                <div class="col-12 justify-content-center ">
                    <div class="row mb-3">

                        <div class="offset-0 offset-lg-1 col-lg-1 logo" style="height:60px"></div>

                        <div class="col-12 col-lg-8">
                            <div class="input-group mt-3 mb-3">
                                <div class="">
                                    <select class="form-select bg-white rounded rounded-5 rounded-end border border-1 border-dark" id="select">
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

                                <input type="text" class="form-control border-secondary" placeholder="Type keyword to search..." id="txt">

                                <button class="col-lg-2 btn btn-primary rounded rounded-5 rounded-start" onclick="basicSearch(0);"><i class="bi bi-search"></i> Search</button>
                            </div>  
                        </div>

                    </div>
               </div>

               <hr/>
            </div>
        </div>

        <div class="col-12" id="result">
           

            <div class="col-12 overflow-hidden d-lg-block d-none align-items-start">
                <div class="row">

                    <div class="col-lg-4 col-12 poster">                 
                        <img src="resource/C_IMG/mobiles & tablets.jpg" class="poster">
                        <div class="poster-caption">
                            <span class="fs-4 fw-bold text-white">Mobiles & Tablets</span>
                            <button class="btn btn-outline-light offset-2" onclick="window.location.href='mobile&tablets.php'">Shop now</button>
                        </div>           
                    </div>
                    <div class="col-lg-4 col-12 poster">
                        <img src="resource/C_IMG/Computer & Hardware1.jpeg" class="poster">
                        <div class="poster-caption">
                            <span class="fs-4 fw-bold text-white">Computers & Laptops</span>
                            <button class="btn btn-outline-light offset-3" onclick="window.location.href='computer&laptops.php'">Shop now</button>
                        </div>  
                    </div>
                    <div class="col-lg-4 col-12 poster">
                        <img src="resource/C_IMG/electronic.jpg" class="poster">
                        <div class="poster-caption">
                            <span class="fs-4 fw-bold text-white">Peripherals & spares</span>
                            <button class="btn btn-outline-light offset-3" onclick="window.location.href='peripherals&spares.php'">Shop now</button>
                        </div>  
                    </div>

                </div>
            </div>

            <div class="container-fluid" style="background-color:white;">
                <div class="row"> 

                    <!-- Just For You -->

                    <div class="col-12 mt-3 mb-3">
                        <a href="#" class="text-decoration-none link-dark fs-3 fw-bold">Just For You</a> &nbsp; &nbsp;
                        <a href="productListing.php" class="text-decoration-none link-dark fs-6">See All &nbsp; &rarr;</a> 
                    </div>

                    <!-- products -->

                    <div class="col-12 mb-3">
                        <div class="row">

                            <div class="col-12">
                                <div class="row justify-content-center gap-3">

                                    <?php
                                    
                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 5 OFFSET 0");
                                    $product_num = $product_rs->num_rows;

                                    for($x = 0; $x < $product_num; $x++){
                                        $product_data = $product_rs->fetch_assoc();

                                        ?>
                                        <div class="card col-5 col-lg-1 mt-2 mb-2" style="width: 14rem;">

                                            <?php
                                            if($product_data["discount"]){
                                                ?>
                                                <div class="row">
                                                    <div class="col-4 bg-primary offset-8 text-center">
                                                        <div class="row">
                                                            <div class="col-12 bg-primary my-2">
                                                                <span class="text-white fw-bold">-<?php echo $product_data["discount"] ?>%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }else if($product_data["discount"] == 0){
                                                ?>
                                                <div class="row">
                                                    <div class="col-4 bg-white offset-8 text-center">
                                                        <div class="row">
                                                            <div class="col-12 bg-white my-2">
                                                                <span class="text-white fw-bold">-10%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$product_data["id"]."'");
                                            $img_data = $img_rs->fetch_assoc();
                                            ?>

                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Details">
                                            <a href="<?php echo "singleProductView.php?id=".$product_data["id"]; ?>"><img src="<?php echo $img_data["code"]; ?>" class="card-img-top mt-2" style = "height:170px;"></a>
                                            </span>
                                            
                                            <div class="card-body text-center">

                                                <h6 class="card-title "><?php echo $product_data["title"]; ?></h6>
                                                <span class="card-text text-primary">Rs. <?php echo $product_data["price"]; ?>.00</span><br>
                                                <?php
                                                if($product_data["qty"] > 0){

                                                    ?>
                                                    <span class="text-warning fw-bold">In Stock</span><br>
                                                    
                                                    <button class="col-5 btn btn-light" onclick='addToCart(<?php echo ($product_data["id"]) ?>);'><i class="bi bi-cart-plus-fill fs-3 text-success"></i></button>

                                                    <?php

                                                    if(isset($_SESSION["u"])){
                                                    
                                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$product_data["id"]."' AND `user_email`='".$_SESSION["u"]["email"]."'");
                                                        $watchlist_num = $watchlist_rs->num_rows;

                                                        if($watchlist_num == 1){

                                                            ?>
                                                            <button class="col-5 btn btn-light" onclick="addToWatchlist('<?php echo $product_data['id']; ?>');"><i class="bi bi-heart-fill fs-3 text-danger" id='heart<?php echo ($product_data["id"]) ?>'></i></button>
                                                            <?php

                                                        }else{

                                                            ?>
                                                            <button class="col-5 btn btn-light" onclick="addToWatchlist('<?php echo $product_data['id']; ?>');"><i class="bi bi-heart-fill fs-3 text-dark" id='heart<?php echo ($product_data["id"]) ?>'></i></button>
                                                            <?php

                                                        }
        
                                                    }  

                                                }else{

                                                    ?>
                                                    <span class="text-warning fw-bold">Out of Stock</span><br>

                                                    <button class="col-5 btn btn-light disabled"><i class="bi bi-cart-plus-fill fs-3 text-success"></i></button>
                                                    <button class="col-5 btn btn-light disabled"><i class="bi bi-heart-fill fs-3 text-danger"></i></button>
                                                    <?php

                                                }
                                                ?>

                                                
                                                
                                            </div>
                                        </div>
                                        <?php

                                    }
                                    
                                    ?>

                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- products -->

                    <!-- Just For You -->


                    <?php include "footer.php"; ?>
                    
                </div>
            </div>   

        </div>
        
        <script src="bootstrap.bundle.js"></script>

        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

</html>