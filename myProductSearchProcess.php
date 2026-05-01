<?php

session_start();
require "connection.php";

$user = $_SESSION["u"];
$txt = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `product` WHERE `user_email`='".$user["email"]."'";

if(!empty($txt) && $select == 0){

    $query .= " AND `title` LIKE '%".$txt."%'";

}else if(empty($txt) && $select != 0){

    $query .= " AND `category_id` = '".$select."'";

}else if(!empty($txt) && $select != 0){

    $query .= " AND `title` LIKE '%".$txt."%' AND `category_id`='".$select."'";
    
}


?>

<div class="col-12 text-center" >
    <div class="row justify-content-center gap-3 mt-5">

        <?php
        
            if("0" != ($_POST["page"])){
                $pageno = $_POST["page"];
            }else{
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 6;
            $number_of_page = ceil($product_num/$results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;

            $selected_rs = Database::search($query. " LIMIT ".$results_per_page." OFFSET ".$page_results."");

            $selected_num = $selected_rs->num_rows;

            for($x = 0; $x < $selected_num; $x++){
                $selected_data = $selected_rs->fetch_assoc();

            ?>
            
            <!-- card -->
            <div class="card mb-3 mt-1 col-12 col-lg-5">
                <div class="row">
                    <div class="col-md-4 mt-4">

                        <?php          
                        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$selected_data["id"]."'");
                        $product_img_data = $product_img_rs->fetch_assoc();
                        ?>

                        <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start" >
                    </div>
                    <div class="col-md-8">
                        <div class="card-body ">
                            <h5 class="card-title fw-bold "><?php echo $selected_data["title"]; ?></h5>
                            <span class="card-text fw-bold text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span> </br>
                            <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Item Left</span>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo($selected_data["id"]); ?>" 
                                    <?php if($selected_data["status_id"] == 1) { ?>checked<?php } ?> 
                                    onclick="changeStatus(<?php echo($selected_data['id']); ?>)" />
                                    
                                    <label class="form-check-label fw-bold text-info" for="fd<?php echo($selected_data["id"]); ?>">
                                        <?php if($selected_data["status_id"] == 2) { ?>
                                            Make Your Product Active
                                        <?php }else{ ?>
                                            Make Your Product Deactive
                                        <?php } ?>
                                    </label>
                                </div>                    

                            <div class="row">
                                <div class="col-12">
                                    <div class="row g-1">
                                        <div class="col-12 col-lg-6 d-grid">
                                            <button class="btn btn-success fw-bold" onclick="sendId('<?php echo $selected_data['id'] ?>')">Update</button>
                                        </div>
                                        <div class="col-12 col-lg-6 d-grid">
                                            <button class="btn btn-danger fw-bold" onclick="deleteFromMyProduct('<?php echo $selected_data['id']; ?>')">Delete</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>      
            <!-- card -->

            <!-- modal -->
            <div class="modal" tabindex="-1" id="deleteMyProductModal<?php echo $selected_data["id"]; ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-title mt-3">
                            <span class="form-label fs-5 text-danger fw-bold"><i class="bi bi-exclamation-circle-fill text-danger"></i> Attention</span>
                        </div>

                        <div class="modal-body">    
                            <div class="row g-3">   
                                <span class="text-black fw-bold fs-6">Are You sure want to delete this Product?</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger rounded rounded-5" onclick="deleteFromMyProduct2('<?php echo $selected_data['id']; ?>')">Yes</button>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-secondary rounded rounded-5">Cancel</button>                                               
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
            
            <?php
            }

        ?>

        

    </div>
</div>
<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">

                <a class="page-link" <?php if($pageno <= 1){
                                                    echo("#");
                                                }else{
                                                   ?>
                                                   onclick="search_myproduct('<?php echo($pageno - 1); ?>');"
                                                   <?php
                                                }  
                                                ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>

                <?php
                
                for ($x = 1; $x <= $number_of_page; $x++) {
                    if ($x == $pageno) {

                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="search_myproduct('<?php echo($x); ?>')"><?php echo $x; ?></a>
                        </li>
                    <?php

                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="search_myproduct('<?php echo($x); ?>')"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>


                <a class="page-link" <?php if($pageno >= $number_of_page){
                                                    echo("#");
                                                }else{
                                                    ?>
                                                    onclick="search_myproduct('<?php echo($pageno + 1); ?>')"
                                                   <?php
                                                }  
                                                ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>