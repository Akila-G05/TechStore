<?php
session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $email = $_SESSION["u"]["email"];
    $pageno;

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Product | Tech Store</title>

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

                <div class="col-12 col-lg-12">
                    
                    <div class="row bg-dark">
                        <div class="col-10 col-lg-10 mt-2 my-lg-4">
                            <h1 class="offset-4 offset-lg-6 text-white fw-bold">My Products</h1>
                        </div>
                        <div class="col-11 col-lg-2 mb-2 my-lg-4 mx-2 mx-lg-0 d-grid align-text-bottom">
                            <button class="btn btn-outline-primary btn-light rounded-pill fw-bold mt-2" onclick="window.location='addProduct.php'">Add Product</button>
                        </div>
                    </div>

                    <hr class="mb-0 mt-0"/>

                    <br>
                    <?php include "header.php"; ?>

                </div>
                
                
                <div class="col-12" style="background-color:#E9EBEE">
                    <div class="row">

                        <div class="col-lg-12 bg-white mt-3">
                            <div class="row">
                                
                                <div class="col-lg-3 col-12 my-3">
                                    <div class="row">
                                        <div class="col-8 mx-5">
                                            <select class="form-select bg-white rounded rounded-5 border border-1 border-dark" id="mp_search_select">
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
                                            <input type="text" class="form-control border-secondary" placeholder="Type keyword to search..." id="mp_search_txt">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-2 my-3 text-end">
                                    <div class="row">
                                        <div class="col-12 ">
                                            <a href="#" class="fs-4 text-dark fw-bold" onclick="search_myproduct(0);"><i class="bi bi-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>

                        <!-- product -->
                        <div class="col-10 offset-1 mt-3 mb-3 bg-white">
                            <div class="row" id="search">
                                <div class="col-12 text-center" >
                                    <div class="row justify-content-center gap-3 mt-5">

                                        <?php
                                        
                                            if(isset($_GET["page"])){
                                                $pageno = $_GET["page"];
                                            }else{
                                                $pageno = 1;
                                            }

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$email."'");
                                            $product_num = $product_rs->num_rows;

                                            $results_per_page = 6;
                                            $number_of_page = ceil($product_num/$results_per_page);

                                            $page_results = ($pageno - 1) * $results_per_page;

                                            $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$email."' 
                                            ORDER BY `datetime_added` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");

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
                                        <div class="modal" tabindex="-1" id="<?php echo $selected_data["id"]; ?>">
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

                                <!-- pagination -->
                                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb3">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination pagination-lg justify-content-center">
                                                <li class="page-item">

                                                    <a class="page-link" href="<?php if($pageno <= 1){
                                                                                        echo("#");
                                                                                    }else{
                                                                                        echo("?page=" . ($pageno - 1));
                                                                                    }  
                                                                                    ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>

                                                    <?php
                                                    
                                                    for ($x = 1; $x <= $number_of_page; $x++) {
                                                        if ($x == $pageno) {
        
                                                    ?>
                                                            <li class="page-item active">
                                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                            </li>
                                                        <?php
        
                                                        } else {
                                                        ?>
                                                            <li class="page-item">
                                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                            </li>
                                                    <?php
                                                        }
                                                    }
        
                                                    ?>


                                                    <a class="page-link" href="<?php if($pageno >= $number_of_page){
                                                                                        echo("#");
                                                                                    }else{
                                                                                        echo("?page=" . ($pageno + 1));
                                                                                    }  
                                                                                    ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                <!-- pagination -->

                            </div>
                        </div>
                        <!-- product -->

                        
                    </div>
                </div>

                <?php include "footer.php"?>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

</html>

<?php
}else{

    header("location:home.php");

}
?>


