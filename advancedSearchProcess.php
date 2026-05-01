<?php

require "connection.php";
session_start();

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["to"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$status = 0;

if($sort == 0){

    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%'";
        $status = 1;
    }

    if($category != 0 && $status == 0){
        $query .= " WHERE `category_id`='".$category."'";
        $status = 1;
    }else if($category != 0 && $status != 0){
        $query .= " AND `category_id`='".$category."'";
    }

    $pid = 0;
    if($brand != 0 && $model == 0){
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id`='".$brand."'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for($x = 0;$x < $model_has_brand_num;$x++){
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if($status == 0){
            $query .= "WHERE `model_has_brand_id`= '".$pid."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `model_has_brand_id`='".$pid."'";
        }
    }

    if($brand == 0 && $model != 0){
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_id`='".$model."'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for($x = 0;$x < $model_has_brand_num;$x++){
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if($status == 0){
            $query .= "WHERE `model_has_brand_id`= '".$pid."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `model_has_brand_id`='".$pid."'";
        }
    }

    if($brand != 0 && $model != 0){
        $model_has_brand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id`='".$brand."' 
        AND `model_id`='".$model."'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for($x = 0;$x < $model_has_brand_num;$x++){
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if($status == 0){
            $query .= "WHERE `model_has_brand_id`= '".$pid."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `model_has_brand_id`='".$pid."'";
        }
    }

    if($condition != 0 && $status == 0){
        $query .= "WHERE `condition_id`='".$condition."'";
        $status = 1;
    }else if($condition != 0 && $status != 0){
        $query .= "AND `condition_id`='".$condition."'";
    }

    if($color != 0 && $status == 0){
        $query .= "WHERE `colour_id`='".$color."'";
        $status = 1;
    }else if($color != 0 && $status != 0){
        $query .= "AND `colour_id`='".$color."'";
    }

    if(!empty($price_from) && empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` >= '".$price_from."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` >= '".$price_from."'";
        }
    }else if(empty($price_from) && !empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` <= '".$price_to."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` <= '".$price_to."'";
        }
    }else if(!empty($price_from) && !empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` BETWEEN '".$price_from."' AND '".$price_to."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` BETWEEN '".$price_from."' AND '".$price_to."'";
        }
    }


    
}else if($sort == 1){
    $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` ASC";
    echo("1");
}else if($sort == 2){     
    $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` DESC";
    echo("2");
}else if($sort == 3){
    $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` ASC";
    echo("3");
}else if($sort == 4){
    $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` DESC";
    echo("4");
}else if(($sort == 5)){
    $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `discount` DESC";
}

?>

<div class="row">
    <div class="col-12 col-lg-12 text-center">
        <div class="row gap-3 justify-content-center">

            <?php


            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 10;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

            ?>



            <div class="card col-5 col-lg-1 mt-2 mb-2" style="width: 14rem;">

                <?php
                if($selected_data["discount"]){
                    ?>
                    <div class="row">
                        <div class="col-4 bg-primary offset-8 text-center">
                            <div class="row">
                                <div class="col-12 bg-primary my-2">
                                    <span class="text-white fw-bold">-<?php echo $selected_data["discount"] ?>%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }else if($selected_data["discount"] == 0){
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
                $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$selected_data["id"]."'");
                $img_data = $img_rs->fetch_assoc();
                ?>

                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $selected_data["description"]; ?>" title="Product Details">
                <a href="<?php echo "singleProductView.php?id=".$selected_data["id"]; ?>"><img src="<?php echo $img_data["code"]; ?>" class="card-img-top mt-2" style = "height:170px;"></a>
                </span>

                <div class="card-body text-center">

                    <h6 class="card-title "><?php echo $selected_data["title"]; ?></h6>
                    <span class="card-text text-primary">Rs. <?php echo $selected_data["price"]; ?>.00</span><br>
                    <?php
                    if($selected_data["qty"] > 0){

                        ?>
                        <span class="text-warning fw-bold">In Stock</span><br>
                        
                        <button class="col-5 btn btn-light" onclick='addToCart(<?php echo ($selected_data["id"]) ?>);'><i class="bi bi-cart-plus-fill fs-3 text-success"></i></button>

                        <?php
                        
                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$selected_data["id"]."'");
                        $watchlist_num = $watchlist_rs->num_rows;

                        if(isset($_SESSION["u"])){
                            if($watchlist_num == 1){

                                ?>
                                <button class="col-5 btn btn-light" onclick="addToWatchlist('<?php echo $selected_data['id']; ?>');"><i class="bi bi-heart-fill fs-3 text-danger" id='heart<?php echo ($product_data["id"]) ?>'></i></button>
                                <?php

                            }else{

                                ?>
                                <button class="col-5 btn btn-light" onclick="addToWatchlist('<?php echo $selected_data['id']; ?>');"><i class="bi bi-heart-fill fs-3 text-dark" id='heart<?php echo ($product_data["id"]) ?>'></i></button>
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

    <!--  -->

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">

                <a class="page-link" <?php if($pageno <= 1){
                                                    echo("#");
                                                }else{
                                                   ?>
                                                   onclick="advancedSearch('<?php echo($pageno - 1); ?>');"
                                                   <?php
                                                }  
                                                ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>

                <?php
                
                for ($page = 1; $page <= $number_of_pages; $page++) {
                    if ($page == $pageno) {

                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="advancedSearch('<?php echo($page); ?>')"><?php echo $page; ?></a>
                        </li>
                    <?php

                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="advancedSearch('<?php echo($page); ?>')"><?php echo $page; ?></a>
                        </li>
                <?php
                    }
                }

                ?>


                <a class="page-link" <?php if($pageno >= $number_of_pages){
                                                    echo("#");
                                                }else{
                                                    ?>
                                                    onclick="advancedSearch('<?php echo($pageno + 1); ?>')"
                                                   <?php
                                                }  
                                                ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>