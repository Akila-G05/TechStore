<?php

require "connection.php";
session_start();

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Store | Tech Store</title>

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

                <div class="col-12 col-lg-12">
                    
                    <div class="row bg-dark">
                        <div class="col-10 col-lg-11 mt-2 my-lg-4">
                            <h1 class="offset-4 offset-lg-5 text-white fw-bold">Start Shopping</h1>
                        </div>
                        <div class="col-11 col-lg-1 mb-2 mt-lg-4 my-lg-4 mx-2 mx-lg-0 d-grid align-text-bottom">
                            <button class="btn fs-4 bg-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="bi bi-search text-white"></i></button>
                        </div>
                    </div>

                    <hr class="mb-0 mt-0"/>

                    <br>
                    <?php include "header.php"; ?>

                </div>
<!-- ADVANCE SEARCH -->
                <div class="col-12 ">
                    <div class="offcanvas offcanvas-top bg-dark" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel" style="height: 360px">
                        <div class="offcanvas-header offset-5">
                            <h5 class="offcanvas-title text-white fs-2" id="offcanvasTopLabel" style="font-family: 'Qiucksand'">Advance <i class="bi bi-search text-white"></i></h5>
                        </div>
                        <div class="offcanvas-body overflow-hidden">

                            <div class="col-10 col-lg-12 mb-3 bg-dark rounded">
                                <div class="row">

                                    <div class="col-12 offset-lg-1 col-lg-10">
                                        <div class="row">
                                            <div class="col-4 col-lg-2 mt-2 mb-2">
                                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-dark" id="sort">
                                                    <option value="0">SORT BY</option>
                                                    <option value="1">PRICE LOW TO HIGH</option>
                                                    <option value="2">PRICE HIGH TO LOW</option>
                                                    <option value="3">QUANTITY LOW TO HIGH</option>
                                                    <option value="4">QUANTITY HIGH TO LOW</option>
                                                    <option value="5">DISCOUNT</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-8 mt-2 mb-1">
                                                <input type="text" class="form-control" placeholder="Type keyword to search..." id="text"/>
                                            </div>
                                            <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                                                <button class="btn btn-primary" onclick="advancedSearch(0);">Search</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-10 offset-1 mt-3">
                                        <div class="row">

                                            <div class="col-12 col-lg-4 mb-3">
                                                <select class="form-select" id="category">
                                                    <option value="0">Select Category</option>
                                                    <?php

                                                    $category_rs = Database::search("SELECT * FROM `category`");
                                                    $category_num = $category_rs->num_rows;

                                                    for($x = 0;$x < $category_num;$x++){
                                                        $category_data = $category_rs->fetch_assoc();
                                                        ?>
                                                        <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                                        <?php
                                                    }
                                                    
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-4 mb-3">
                                                <select class="form-select" id="brand">
                                                    <option value="0">Select Brand</option>
                                                    <?php

                                                    $brand_rs = Database::search("SELECT * FROM `brand`");
                                                    $brand_num = $brand_rs->num_rows;

                                                    for($x = 0;$x < $brand_num;$x++){
                                                        $brand_data = $brand_rs->fetch_assoc();
                                                        ?>
                                                        <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                                        <?php
                                                    }
                                                    
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-4 mb-3">
                                                <select class="form-select" id="model">
                                                    <option value="0">Select Model</option>
                                                    <?php

                                                    $model_rs = Database::search("SELECT * FROM `model`");
                                                    $model_num = $model_rs->num_rows;

                                                    for($x = 0;$x < $model_num;$x++){
                                                        $model_data = $model_rs->fetch_assoc();
                                                        ?>
                                                        <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                                        <?php
                                                    }
                                                    
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-4 offset-lg-2 mb-3">
                                                <select class="form-select" id="condition">
                                                    <option value="0">Select Condition</option>
                                                    <?php

                                                    $condition_rs = Database::search("SELECT * FROM `condition`");
                                                    $condition_num = $condition_rs->num_rows;

                                                    for($x = 0;$x < $condition_num;$x++){
                                                        $condition_data = $condition_rs->fetch_assoc();
                                                        ?>
                                                        <option value="<?php echo $condition_data["id"]; ?>"><?php echo $condition_data["name"]; ?></option>
                                                        <?php
                                                    }
                                                    
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-4 mb-3">
                                                <select class="form-select" id="colour">
                                                    <option value="0">Select Colour</option>
                                                    <?php

                                                    $color_rs = Database::search("SELECT * FROM `colour`");
                                                    $color_num = $color_rs->num_rows;

                                                    for($x = 0;$x < $color_num;$x++){
                                                        $color_data = $color_rs->fetch_assoc();
                                                        ?>
                                                        <option value="<?php echo $color_data["id"]; ?>"><?php echo $color_data["name"]; ?></option>
                                                        <?php
                                                    }
                                                    
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-6 mb-3">
                                                <input type="text" class="form-control" placeholder="Price From..." id="pf"/>
                                            </div>

                                            <div class="col-12 col-lg-6 mb-3">
                                                <input type="text" class="form-control" placeholder="Price To..." id="pt"/>
                                            </div>

                                        </div>
                                    </div>

                                    

                                </div>
                            </div>

                          
                            
                        </div>
                    </div>
                </div>
<!-- ADVANCE SEARCH -->
                <div class="col-12" id="result">
                    <div class="row">

                        <?php
                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;

                        for ($q = 0; $q < $category_num; $q++) {
                            $category_data = $category_rs->fetch_assoc();
                        ?>

                        <div class="col-12 mt-5 mb-3">
                            <a href="#" class="text-decoration-none link-dark fs-3 fw-bold"><?php echo $category_data["name"]; ?></a> &nbsp; &nbsp;
                            <a class="text-decoration-none link-dark " data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">See All &nbsp; &rarr;</a> 
                        </div>
<!--  --> 
                        <div class="collapse" id="collapseExample">
                            <div class="col-12">
                                <div class="row justify-content-center gap-3">

                                    <?php
                                    
                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='".$category_data["id"]."' ORDER BY `datetime_added` DESC LIMIT 100 OFFSET 5");
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
<!--  -->
                        <!-- products -->

                        <div class="col-12 mb-3">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row justify-content-center gap-3">

                                        <?php
                                        
                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='".$category_data["id"]."' ORDER BY `datetime_added` DESC LIMIT 5 OFFSET 0");
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

                        <?php
                        }
                        ?>

                    </div>
                </div>

                <?php include "footer.php"; ?>
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