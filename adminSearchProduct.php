<?php

session_start();
require "connection.php";

$text = $_POST["text"];

$query = "SELECT * FROM `product`";

if(!empty($text)){
    $query .= " WHERE `title` LIKE '%" . $text . "%' ";
}

?>

<div class="row">

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
    $selected_rs =  Database::search($query . " ORDER BY `datetime_added` DESC LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

    $selected_num = $selected_rs->num_rows;

    for ($x = 0; $x < $selected_num; $x++) {
        $selected_data = $selected_rs->fetch_assoc();

        $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$selected_data["id"]."'");
        $img_data = $img_rs->fetch_assoc();

        $d = $selected_data["datetime_added"];
        $splitDate = explode(" ",$d);
        $date = $splitDate[0];

    ?>
        <!-- Large Screen -->
        <div class="col-lg-10 col-12 mt-lg-1 mt-5 offset-lg-1 border border-secondary rounded-5 rounded-start border-1 d-lg-block d-none" style="height:70px">                                        
            <div class="row">

                <div class="col-lg-1 col-5 col-3 offset-lg-0 offset-1 mt-3 mb-1" onclick="productDetails('<?php echo $selected_data['id']; ?>');">
                    <a href="#"><img src="<?php echo $img_data["code"]; ?>" class="mx-1 img-fluid" style="width:100px"/></a>    
                </div>
                <div class="col-lg-3 col-6 mt-4 text-center">
                    <span class="form-label fw-bold text-black"><?php echo $selected_data["title"]; ?></span><br>
                </div>

                <div class="col-lg-2 offset-lg-0 offset-1 col-4 mt-4">
                    <span class="form-label fw-bold text-danger ">Rs. <?php echo $selected_data["price"]; ?>.00</span><br>
                </div>

                <div class="col-lg-1 col-3 mt-4">
                    <span class="form-label fw-bold text-secondary"><?php echo $selected_data["qty"]; ?></span>
                </div>

                <div class="col-lg-2 col-3 mt-4">
                    <span class="form-label fw-bold text-secondary"><?php echo $date ?></span>
                </div>

                <div class="col-lg-2 col-1 text-lg-end mt-3 rounded-5">
                    <?php

                    if($selected_data["status_id"] == 1) {

                        ?>
                        <button class="btn btn-danger rounded-5" id="pb<?php echo ($selected_data['id']); ?>" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Block</button>
                        <?php

                    }else{

                        ?>
                        <button class="btn btn-success rounded-5" id="pb<?php echo ($selected_data['id']); ?>" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Unblock</button>
                        <?php

                    }

                    ?>
                </div>

            </div>
        </div>
        <!-- Large Screen -->

        <!-- Small Screen -->
        <div class="col-10 mt-lg-1 mt-5 offset-1 border border-secondary rounded-5 rounded-start border-1 d-block d-lg-none">                                        
            <div class="row">

                <div class="col-10 offset-1">
                    <div class="row">

                        <div class="col-12 offset-1 mb-1" onclick="productDetails('<?php echo $selected_data['id']; ?>');">
                            <img src="<?php echo $img_data["code"]; ?>" class="mx-1 img-fluid" style="width:220px"/>    
                        </div>
                        <div class="col-12">
                            <span class="form-label fw-bold text-black "><?php echo $selected_data["title"]; ?></span><br>
                        </div>

                        <div class="col-12">
                            <span class="form-label fw-bold text-danger ">Rs. <?php echo $selected_data["price"]; ?>.00</span><br>
                        </div>

                        <div class="col-12">
                            <span class="form-label fw-bold text-secondary"><?php echo $selected_data["qty"]; ?> Items</span>
                        </div>

                        <div class="col-12">
                            <span class="form-label fw-bold text-secondary"><?php echo $date ?></span>
                        </div>

                        <div class="col-12 mb-3 text-lg-end mt-3 rounded-5 d-grid">
                        <?php

                        if($selected_data["status_id"] == 1) {

                            ?>
                            <button class="btn btn-danger rounded-5" id="pb<?php echo ($selected_data['id']); ?>" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Block</button>
                            <?php

                        }else{

                            ?>
                            <button class="btn btn-success rounded-5" id="pb<?php echo ($selected_data['id']); ?>" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Unblock</button>
                            <?php

                        }

                        ?>
                    </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- Small Screen -->
    <?php

    }
    
    ?>

    <!--  -->
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="findProduct(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="findProduct(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="findProduct(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="findProduct(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--  -->

    </div>
</div>

</div>