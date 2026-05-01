<?php

session_start();
require "connection.php";

$user = $_SESSION["u"];
$txt = $_POST["txt"];
$select = $_POST["select"];

$w_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$user["email"]."'");
$w_data = $w_rs->fetch_assoc();

$query = "SELECT * FROM `product` WHERE `user_email`='".$user["email"]."' AND `id`='".$w_data["product_id"]."'";

if(!empty($txt) && $select == 0){

    $query .= " AND `title` LIKE '%".$txt."%'";

}else if(empty($txt) && $select != 0){

    $query .= " AND `category_id` = '".$select."'";

}else if(!empty($txt) && $select != 0){

    $query .= " AND `title` LIKE '%".$txt."%' AND `category_id`='".$select."'";
    
}


?>

<div class="col-12 mb-3">
    <div class="row">

        <?php

        $product_rs = Database::search($query);
        $product_num = $product_rs->num_rows;

        for($x = 0; $x < $product_num; $x++){

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
                            <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start mt-3 offset-3 offset-lg-0" style = "height:160px;">
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