<?php
session_start();
require "connection.php";

if(isset($_GET["id"])){

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.price,product.qty,product.category_id,product.model_has_brand_id,product.colour_id,product.discount,
    product.status_id,product.condition_id,product.description,product.title,product.user_email,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    model.name AS mname,brand.name AS bname FROM `product` INNER JOIN `model_has_brand` ON model_has_brand.id=product.model_has_brand_id
    INNER JOIN `brand` ON brand.id=model_has_brand.brand_id INNER JOIN `model` ON model.id=model_has_brand.model_id WHERE product.id='".$pid."'");


    $product_num = $product_rs->num_rows;

    if($product_num == 1){

        $product_data = $product_rs->fetch_assoc();




?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $product_data["title"]; ?> | Tech Store</title>

        <link rel="icon" href="resource/logor.png"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body>
        
        <div class="container-fluid">
            <div class="row">

                <div id="cssLoader17" class="main-wrap main-wrap--white">
                    <div class="cssLoader17"></div>
                </div>
            
                <?php include "header.php"?>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12" style="background-color:#E9EBEE">
                            <div class="row">
                                <nav aria-label="breadcrumb" class="mt-3 ">
                                    <ol class="breadcrumb offset-lg-1">
                                        <li class="breadcrumb-item" style="font-size: 18px;"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page" style="font-size: 18px;">Single Product View</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 col-lg-6 my-3">
                            <div class="row">

                            <div class="col-10 offset-lg-2 order-2 order-lg-1 d-lg-block mb-1">
                                <div class="row">
                                    <div class="col-12 align-items-center">
                                        <?php
                                        if($product_data["discount"]){

                                            ?>
                                            <div class="row">
                                                <div class="col-2 bg-primary offset-9 text-center mt-2">
                                                    <div class="row">
                                                        <div class="col-12 bg-primary text-center mt-2 mb-2">
                                                            <span class="fw-bold text-white mt-3">-<?php echo $product_data["discount"]; ?>%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php

                                        }
                                        ?>

                                        <?php
                                        $img_rs2 = Database::search("SELECT * FROM `images` WHERE `product_id`='".$pid."'");
                                        $img_data2 = $img_rs2->fetch_assoc();;
                                        ?>

                                        <img src="<?php echo $img_data2["code"]; ?>" class=" mt-1 mb-1" style="height: 400px; width: 500px;" id="main_img">
                                    
                                    </div>
                                </div>
                            </div>

                            <div class="col-10 offset-1 order-2 order-lg-1 d-none d-lg-block">
                                <ul class="list-inline d-inline-flex">

                                    <?php
                                    
                                    $img_rs1 = Database::search("SELECT * FROM `images` WHERE `product_id`='".$pid."'");
                                    $img_num1 = $img_rs1->num_rows;
                                    $img = array();

                                    if($img_num1 != 0){

                                        for($y = 0; $y < $img_num1; $y++){

                                            $img_data1 = $img_rs1->fetch_assoc();
                                            $img[$y] = $img_data1["code"];

                                        ?>

                                            <li class="d-flex flex-column justify-content-center align-items-center mb-1">
                                                <img src="<?php echo ($img["$y"]) ?>" class="mt-1 mb-1" style="height: 150px; width:190px;" id="productImg<?php echo ($y); ?>" onclick="loadMainImg(<?php echo ($y); ?>);"/>
                                            </li>

                                        <?php

                                        }

                                    }else{

                                    ?>

                                        <li class="d-flex flex-column justify-content-center align-items-center mb-1">
                                            <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1"/>
                                        </li>
                                        <li class="d-flex flex-column justify-content-center align-items-center mb-1">
                                            <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1"/>
                                        </li>
                                        <li class="d-flex flex-column justify-content-center align-items-center mb-1">
                                            <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1"/>
                                        </li>
                                        
                                    <?php

                                    }

                                    ?>

                                    
                                </ul>
                            </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-6 my-3 text-center text-lg-start">
                            <div class="row">

                                <div class="col-12 mt-4">
                                    <div class="row">
                                        <h3><?php echo $product_data["title"]; ?></h3>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <span>
                                            <i class="bi bi-star-fill text-warning fs-6"></i>
                                            <i class="bi bi-star-fill text-warning fs-6"></i>
                                            <i class="bi bi-star-fill text-warning fs-6"></i>
                                            <i class="bi bi-star-fill text-warning fs-6"></i>
                                            <i class="bi bi-star-fill text-warning fs-6"></i>

                                            &nbsp;|&nbsp;

                                            <label class="fs-6 text-primary">4.5 Stars | 39 Reviews & Ratings</label>

                                        </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="text-secondary">Brand : </span>
                                            <span class="text-primary"><?php echo $product_data["bname"]; ?></span>
                                            <span class="text-secondary"> | Model : </span>
                                            <span class="text-primary"><?php echo $product_data["mname"]; ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php

                                $discount = $product_data["discount"];

                                $price = $product_data["price"];
                                $adding_price = ($price / 100) * $discount;
                                $new_price = $price + $adding_price;
                                
                                ?>

                                <div class="col-12 g-lg-4 mb-3">
                                    <div class="row">
                                        <span class="fs-1 fw-bold text-danger">Rs.<?php echo $price ?>.00</span>

                                        <?php
                                        
                                        if($discount){
                                            ?>
                                            <div class="col-12">
                                                <span class="text-success">Save Rs. <?php echo $adding_price; ?>.00</span>
                                                <span class="text-secondary text-decoration-line-through"> | Rs. <?php echo $new_price ?></span>
                                                <span class="text-black"> | <?php echo $discount; ?>%</span>
                                            </div>
                                            <?php
                                        }

                                        ?>

                                        
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 my-3">
                                            <span class="fs-6 text-primary"><b>Warrenty : </b>6 Months Warrenty</span><br/>
                                            <span class="fs-6 text-primary"><b>Return Policy : </b>1 Month Return Policy</span><br/>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="row border-bottom border-0 border-secondary">
                                        <div class="col-12 my-3 ">
                                            <div class="row g-2">
                                                <?php
                                                
                                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$product_data["user_email"]."'");
                                                $seller_data = $seller_rs->fetch_assoc();

                                                ?>
                                                <div class="col-12 col-lg-6 border border-1 border-bottom-0 border-top-0 border-start-0 border-dark text-center">
                                                    <span class="fs-5 text-dark"><?php echo $seller_data["fname"] ." ". $seller_data["lname"]; ?></span>
                                                </div>
                                                <div class="col-12 col-lg-6 border border-1 border-bottom-0 border-top-0 border-end-0 border-dark text-center">
                                                    <span class="fs-5 text-dark"><b>In Stock : </b><?php echo $product_data["qty"]; ?> Items</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row ">
                                        <div class="col-12 my-5 ">
                                            <div class="row g-2">

                                                <div class="col-12">
                                                    <span class="fw-bold text-black-50 fs-6">Quantity :</span>&nbsp;
                                                    <input type="number" class="mt-3 border border-2 border-secondary fs-6 fw-bold px-3 cardqtytext sp1" value="1" id="qty_input">
                                                </div>

                                                <br><br><br>
                                                
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 my-4">
                                                            <div class="row">
                                                                <div class="col-6 d-grid">
                                                                    <button class="btn btn-success" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                                                </div>
                                                                <div class="col-6 d-grid">
                                                                    <button class="btn btn-primary" onclick='addToCart(<?php echo ($pid) ?>);'>Add To Cart</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>   

                        <div class="col-12">
                            <div class="row">

                                <div class="modal" tabindex="-1" id="buyNowModal<?php echo $pid; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body" id="result">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <?php
                        
                        $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='".$pid."'");
                        $feedback_num = $feedback_rs->num_rows;   
                        
                        ?>
                        
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label fs-4 fw-bold">Product Description :</label>
                                    <textarea cols="60" rows="8" class="form-control" readonly><?php echo $product_data["description"]; ?></textarea>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fs-4 fw-bold">Feedbacks :</label>

                                    <div class="col-12">
                                        <div class="row border border-1 border-dark rounded me-0 scroll" style="height: 300px;">

                                            <?php
                                                                
                                            for($x = 0; $x < $feedback_num; $x++){

                                            $feedback_data = $feedback_rs->fetch_assoc();

                                            $user_rs2 = Database::search("SELECT * FROM `user` WHERE `email`='".$feedback_data["user_email"]."'");
                                            $user_data2 = $user_rs2->fetch_assoc();

                                            $type = $feedback_data["type"];

                                            ?>

                                            <div class="col-12 mt-1 mb-1 mx-1">
                                                <div class="row border border-1 border-dark rounded me-0">
                                                    <div class="col-9 mt-2 ms-0">
                                                        <span class="fw-bold text-primary fs-5"><?php echo($user_data2["fname"]) ." ". $user_data2["lname"];; ?></span>
                                                    </div>

                                                    <?php
                                                    
                                                    if($type == 1){
                                                        ?>
                                                        <div class="col-3 mt-2 me-0 text-end">

                                                           <span class="text-warning fs-5">
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                            </span>

                                                        </div>
                                                        <?php
                                                    }else if($type == 2){
                                                        ?>
                                                        <div class="col-3 mt-2 me-0 text-end">

                                                            <span class="text-warning fs-5">
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                            </span>

                                                        </div>
                                                        <?php
                                                    }else if($type == 3){
                                                        ?>
                                                        <div class="col-3 mt-2 me-0 text-end">

                                                            <span class="text-warning fs-5">
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>  
                                                            </span>

                                                        </div>
                                                        <?php
                                                    }else if($type == 4){
                                                        ?>
                                                        <div class="col-3 mt-2 me-0 text-end">

                                                            <span class="text-warning fs-5">
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                            </span>

                                                        </div>
                                                        <?php
                                                    }else if($type == 5){
                                                        ?>
                                                        <div class="col-3 mt-2 me-0 text-end">

                                                            <span class="text-warning fs-5">
                                                                <i class="bi bi-star-fill"></i>
                                                            </span>

                                                        </div>
                                                        <?php
                                                    }
                                                    
                                                    ?>
                                                    <div class="col-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-12">
                                                        <p class="fw-bold text-center text-black"><?php echo($feedback_data["feedback"]); ?></p>
                                                    </div>
                                                    <div class="col-6 offset-6 text-end">
                                                        <label class="form-label fs-6 text-secondary"><?php echo($feedback_data["date"]); ?></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-5 mb-3 border border-2 border-dark border-end-0 border-top-0 border-start-0">
                            <a href="#" class="text-decoration-none link-dark fs-3 fw-bold">Related Items</a> &nbsp; &nbsp;
                            <a href="#" class="text-decoration-none link-dark fs-6">See All &nbsp; &rarr;</a> 
                        </div>

                        <!-- related items -->

                        <div class="col-12 mb-3">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row justify-content-center gap-3">

                                        <?php

                                        $c_rs = Database::search("SELECT * FROM `category` WHERE `id`='".$product_data["category_id"]."'");
                                        $cdata = $c_rs->fetch_assoc();
                                        
                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='".$cdata["id"]."' AND 
                                        `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 5 OFFSET 0");
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
                                                    <a href="<?php echo "singleProductView.php?id=".$product_data["id"]; ?>">
                                                        <img src="<?php echo $img_data["code"]; ?>" class="card-img-top mt-2" style = "height:170px;">
                                                    </a>
                                                </span>
                                                
                                                <div class="card-body text-center">

                                                    <h6 class="card-title "><?php echo $product_data["title"]; ?></h6>
                                                    <span class="card-text text-primary">Rs. <?php echo $product_data["price"]; ?>.00</span><br>
                                                    <?php
                                                    if($product_data["qty"] > 0){

                                                        ?>
                                                        <span class="text-warning fw-bold">In Stock</span><br>

                                                        <button class="col-5 btn btn-light" onclick='addToCart(<?php echo ($product_data["id"]) ?>);'><i class="bi bi-cart-plus-fill fs-3 text-success"></i></button>
                                                        <button class="col-5 btn btn-light" onclick="window.location='#'"><i class="bi bi-heart-fill fs-3 text-danger"></i></button>
                                                        <?php

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

                        <!-- related items -->

                    </div>
                </div>        
                   
                <?php include "footer.php"?>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script>
        
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

</html>

<?php

    }else{
        echo("Sorry for the inconvenience");
    }

}else{
    echo("Something Went Wrong");
}

?>

