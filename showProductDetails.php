<?php

session_start();
require "connection.php";

$pid = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
$product_data = $product_rs->fetch_assoc();

$img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$product_data["id"]."'");
$img_data = $img_rs->fetch_assoc();

$category_rs = Database::search("SELECT * FROM `category` WHERE `id`='".$product_data["category_id"]."'");
$category_data = $category_rs->fetch_assoc();

$brand_rs = Database::search("SELECT * FROM `brand` WHERE `category_id`='".$category_data["id"]."'");
$brand_data = $brand_rs->fetch_assoc();

$seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$product_data["user_email"]."'");
$seller_data = $seller_rs->fetch_assoc();

?>

<div class="row">

    <div class="col-lg-10 col-12 offset-1 offset-lg-1 border border-5 border-secondary mt-5">
        <div class="row">

            <div class="col-lg-4 col-12 border border-1 border-secondary border-start-0 border-bottom-0 border-top-0 mt-lg-3 mb-lg-3 mb-1">
                <div class="row">

                    <div class="col-12 offset-1 offset-lg-0" style="height: 240px">
                        <img src="<?php echo $img_data["code"]; ?>" class="rounded mx-3 mt-lg-3" style="width:230px"/>
                    </div>

                </div>
                
                
            </div>

            <div class="col-lg-8 col-12 border border-1 border-secondary border-end-0 border-bottom-0 border-top-0 mt-lg-3 mb-lg-3">
                
                <div class="row">
                    <div class="col-12 mt-1"> 
                        <p class="fw-bold fs-3 text-success mx-2"><?php echo $product_data["title"]; ?></p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        &nbsp;&nbsp;
                        <span class="form-label fw-bold text-secondary fs-5" style="font-size:16px;">Category : </span>
                        <span class="form-label fw-bold text-dark fs-5" style="font-size:16px;"><?php echo $category_data["name"]; ?></span>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-12">
                        &nbsp;&nbsp;
                        <span class="form-label fw-bold text-secondary fs-5" style="font-size:16px;">Brand : </span>
                        <span class="form-label fw-bold text-dark fs-5" style="font-size:16px;"><?php echo $brand_data["name"]; ?></span>
                    </div>
                </div>
                
                <div class="row mt-3"> 
                    <span>
                        &nbsp;&nbsp;
                        <i class="bi bi-star-fill text-warning fs-6"></i>
                        <i class="bi bi-star-fill text-warning fs-6"></i>
                        <i class="bi bi-star-fill text-warning fs-6"></i>
                        <i class="bi bi-star-fill text-warning fs-6"></i>
                        <i class="bi bi-star text-secondary fs-6"></i>

                        &nbsp;|&nbsp;

                        <label class="fs-6 text-primary">4 Stars | 21 Reviews & Ratings</label>

                    </span>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        &nbsp;&nbsp;
                        <label class="form-label fs-3 text-danger fw-bold">Rs. <?php echo $product_data["price"]; ?>.00</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 border border-1 border-primary border-start-0 border-bottom-0 border-top-0">
                        &nbsp;&nbsp;
                        <span class="form-label fw-bold text-dark fs-5" style="font-size:16px;">Sold : </span>
                        <span class="form-label text-dark fs-5" style="font-size:16px;"><?php echo $product_data["qty"]; ?> Items</span>
                    </div>
                    <div class="col-6 border border-1 border-primary border-end-0  border-bottom-0 border-top-0 mb-lg-0 mb-2">
                        &nbsp;&nbsp;
                        <span class="form-label fw-bold text-dark fs-5" style="font-size:16px;"><?php echo $seller_data["fname"] ." ". $seller_data["lname"]; ?></span>
                    </div>
                </div>

                
                
            </div>

        </div>
    </div>

</div>

