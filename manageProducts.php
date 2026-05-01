<?php

session_start();
require "connection.php";

if (isset($_SESSION["au"])) {

    $pageno;

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Manage Products | Tech Store</title>

        <link rel="icon" href="resource/logor.png"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body>

        <div id="cssLoader17" class="main-wrap main-wrap--white">
            <div class="cssLoader17"></div>
        </div>
        
        <div class="container-fluid d-block">
            <div class="row">

                <div class="col-12 bg-dark">
                    
                    <div class="row">
                        <div class="col-12 mt-2 my-lg-4">
                            <h1 class="text-center text-white fw-bold">Manage Products <i class="bi bi-gear-wide-connected"></i></h1>
                        </div>
                    </div>
                    
                </div>

                <div class="col-12 mt-3">
                    <div class="row">

                        <div class="col-12 col-lg-3 bg-dark">
                            <div class="row my-2">

                                <div class="col-12">

                                    <?php
                                    if(isset($_SESSION["au"]["image"])){
                                    ?>
                                        <img src="<?php echo $_SESSION["au"]["image"]; ?>" class="rounded mt-6 mb-3" style="width:100px"/>
                                    <?php
                                    }
                                    ?>
                                    <span class="text-white fs-2 offset-1"><?php echo $_SESSION["au"]["fname"]; ?></span>

                                </div>

                                <div class="col-12">
                                    <hr class="border border-3 border-light rounded-2">
                                </div>

                                <div class="col-10 d-grid offset-1 my-2">
                                    <button class="btn btn-outline-danger btn-light rounded-5" onclick="window.location='adminPannel.php'"><i class="bi bi-person-circle"></i> <b>Admin</b></button>
                                </div>
                                <div class="col-10 d-grid offset-1 my-2">
                                    <button class="btn btn-outline-primary btn-light  rounded-5" onclick="window.location='manageProducts.php'"><i class="bi bi-gear-wide-connected"></i> <b>Manage Products</b></button>
                                </div>
                                <div class="col-10 d-grid offset-1 my-2">
                                    <button class="btn btn-outline-warning btn-light  rounded-5" onclick="window.location='manageUsers.php'"><i class="bi bi-person-badge"></i> <b>Manage Users</b></button>
                                </div>

                                <div class="col-12">
                                    <hr class="border border-3 border-light rounded-2">
                                </div>

                                <div class="col-10 d-grid offset-1 my-2">
                                    <span class="text-white fw-bold">Selling History</span><br>
                                    <button class="btn btn-outline-success btn-light rounded-5" onclick="window.location='sellingHistory.php'"><b>History</b></button>
                                </div>

                                <div class="col-12">
                                    <hr class="border border-3 border-light rounded-2">
                                </div>

                                <div class="col-12 my-3">
                                    <span class="text-white fw-bold">About Company</span><br><br>
                                    <span class="text-white">"New Tech" is a company that buys and sells quality electronic goods. Currently, they use a customer service service to order products over the phone. At the Annual General Meeting of the New
                                    Technology held on January 20, 2022, developed a web application to expand.Buy the electronics you want at the lowest prices.</span><br><br>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-9 col-12">
                            <div class="row my-2">

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-lg-8 col-9 mt-2 offset-lg-1">
                                            <input type="text" class="form-control border-1 border-dark" placeholder="Search Product..." id="text">
                                        </div>
                                        <div class="col-2 mt-2 d-grid">
                                            <button class="btn btn-outline-primary rounded rounded-5" onclick="findProduct(0);">Search</button>
                                        </div>

                                        <div class="col-lg-12 col-10" id="result">
                                            
                                        </div>

                                        <div class="col-lg-10 col-12 mt-5 offset-lg-1 border border-secondary rounded-5 border-1 bg-secondary d-lg-block d-none">  
                                            
                                            <div class="row">

                                                <div class="col-4 mt-2 mb-2">
                                                    <span class="form-label fw-bold text-white mx-3">Products</span><br>
                                                </div>

                                                <div class="col-2 mt-2">
                                                    <span class="form-label fw-bold text-white">PRICE</span><br>
                                                </div>

                                                <div class="col-1 mt-2">
                                                    <span class="form-label fw-bold text-white">QTY</span><br>
                                                </div>

                                                <div class="col-3 mt-2">
                                                    <span class="form-label fw-bold text-white">REGISTER DATE</span><br>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12" id="result2">
                                            <div class="row">

                                            <?php
                                        
                                            if(isset($_GET["page"])){
                                                $pageno = $_GET["page"];
                                            }else{
                                                $pageno = 1;
                                            }

                                            $product_rs = Database::search("SELECT * FROM `product`");
                                            $product_num = $product_rs->num_rows;

                                            $results_per_page = 10;
                                            $number_of_page = ceil($product_num/$results_per_page);

                                            $page_results = ($pageno - 1) * $results_per_page;

                                            $selected_rs = Database::search("SELECT * FROM `product` ORDER BY `datetime_added` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");

                                            $selected_num = $selected_rs->num_rows;

                                            for($x = 0; $x < $selected_num; $x++){
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

                                            <!-- pagination -->
                                            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
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

                                    </div>
                                </div>

                                <div class="col-12 mt-4 mb-5">
                                    <div class="row gap-1 justify-content-center">

                                        <!-- Category -->
                                                                                                
                                            <div class="col-12 text-center mb-3">
                                                <h4 class="text-primary fw-bold text-decoration-underline">Manage Categories</h4>
                                            </div>

                                            <?php

                                            $category_rs = Database::search("SELECT * FROM `category`");
                                            $category_num = $category_rs->num_rows;

                                            for ($x = 0; $x < $category_num; $x++) {
                                                $category_data = $category_rs->fetch_assoc();


                                            ?>

                                                <div class="col-12 col-lg-3 mt-1 border border-danger rounded rounded-5 mb-1" onclick="deleteCateogryModal('<?php $category_data['id'] ?>');">
                                                    <div class="row">

                                                        <div class="col-12 mt-2 mb-1">
                                                            <label class="form-label fw-bold fs-6"> <?php echo $category_data["name"]; ?></label>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>

                                            <!-- delete Category Modal -->
                                                <div class="modal" tabindex="-1" id="deleteCategoryModal<?php $category_data['id'] ?>">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <div class="modal-title mt-3 mx-3">
                                                                <span class="form-label fs-5 text-danger fw-bold"><i class="bi bi-exclamation-circle-fill text-danger"></i> Attention</span>
                                                                <button type="button" class="btn-close offset-7 offset-lg-8" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body mx-3">    
                                                                <div class="row g-3">   
                                                                    <span class="text-black fw-bold fs-6">You can delete or rename your Category. If you delete your Category, the related data can be Destroyed.</span>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer"> 
                                                                <button type="button" class="btn btn-danger rounded rounded-5" onclick="deleteCategory('<?php echo $category_data['id'] ?>');"><i class="bi bi-trash3-fill"></i> Delete</button>
                                                                <button type="button" class="btn btn-secondary rounded rounded-5" onclick="renameCategoryModal('<?php echo $category_data['id'] ?>');"><i class="bi bi-pencil"></i> Rename</button>                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--  delete Category Modal -->

                                            <!-- Rename Category Modal -->
                                                <div class="modal" tabindex="-1" id="renameCategoryModal<?php echo $category_data["id"] ?>">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <div class="modal-title mt-3 mx-3">
                                                                <span class="form-label fs-5 text-secondary fw-bold"><i class="bi bi-pencil text-secondary"></i> Rename</span>
                                                                <button type="button" class="btn-close offset-7 offset-lg-8" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <label class="form-label">New Category Name:</label>
                                                                    <input type="text" class="form-control" id="n" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer"> 
                                                                <button type="button" class="btn btn-primary" onclick="renameCategory('<?php echo $category_data['id'] ?>');">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--  Rename Category Modal -->
        
                                            <div class="col-12 col-lg-3 border border-success rounded rounded-5 mt-1" style="height:45px;" onclick="addNewCategory();">
                                                <div class="row">
                                                    <div class="col-9 mt-2 mb-2">
                                                        <label class="form-label fw-bold fs-6"> Add new Category</label>

                                                    </div>
                                                    <div class="col-3 mt-2">
                                                        <label class="form-label text-end mx-3 fs-5"><i class="bi bi-plus-square-fill text-success"></i></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Add Category Modal-->
                                                <div class="modal" tabindex="-1" id="addCategoryModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Add New Category</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <label class="form-label">New Category Name:</label>
                                                                    <input type="text" class="form-control" id="txt" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" onclick="saveCategory();">Save New Category</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--Add Category Modal-->

                                        <!-- Category -->

                                        <div class="col-12">
                                            <hr class="border border-2 rounded rounded-5 border-primary">
                                        </div>

                                        <!-- Brand -->
                                    
                                            <div class="col-12 text-center mb-3 mt-2">
                                                <h4 class="text-primary fw-bold text-decoration-underline">Manage Brands</h4>
                                            </div>

                                            <?php

                                            $brand_rs = Database::search("SELECT * FROM `brand`");
                                            $brand_num = $brand_rs->num_rows;

                                            for ($y = 0; $y < $brand_num; $y++) {
                                                $brand_data = $brand_rs->fetch_assoc();

                                                $c_rs = Database::search("SELECT * FROM `category` WHERE `id`='".$brand_data["category_id"]."'");
                                                $c_data = $c_rs->fetch_assoc();


                                            ?>

                                                <div class="col-12 col-lg-3 mt-1 border border-danger rounded rounded-5 mb-1" onclick="deleteBrandModal('<?php $brand_data['id'] ?>');">
                                                    <div class="row">

                                                        <div class="col-12 mt-2 mb-2">
                                                            <span class="form-label fw-bold fs-6"><?php echo $brand_data["name"]; ?></label>
                                                            <span class="form-label" style="font-size: 12px;">(<?php echo $c_data["name"]; ?>)</label>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>

                                            <!-- delete Brand Modal -->
                                                <div class="modal" tabindex="-1" id="deletebrandModal<?php $brand_data['id'] ?>">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <div class="modal-title mt-3 mx-3">
                                                                <span class="form-label fs-5 text-danger fw-bold"><i class="bi bi-exclamation-circle-fill text-danger"></i> Attention</span>
                                                                <button type="button" class="btn-close offset-7 offset-lg-8" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body mx-3">    
                                                                <div class="row g-3">   
                                                                    <span class="text-black fw-bold fs-6">You can delete or rename your brand. If you delete your brand, the related data can be Destroyed.</span>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer"> 
                                                                <button type="button" class="btn btn-danger rounded rounded-5" onclick="deleteBrand('<?php echo $brand_data['id'] ?>');"><i class="bi bi-trash3-fill"></i> Delete</button>
                                                                <button type="button" class="btn btn-secondary rounded rounded-5" onclick="renameBrandModal('<?php echo $brand_data['id'] ?>');"><i class="bi bi-pencil"></i> Rename</button>                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--  delete Brand Modal -->

                                            <!-- Rename Brand Modal -->
                                                <div class="modal" tabindex="-1" id="renameBrandModal<?php echo $brand_data["id"] ?>">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <div class="modal-title mt-3 mx-3">
                                                                <span class="form-label fs-5 text-secondary fw-bold"><i class="bi bi-pencil text-secondary"></i> Rename</span>
                                                                <button type="button" class="btn-close offset-7 offset-lg-8" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <label class="form-label">New Brand Name:</label>
                                                                    <input type="text" class="form-control" id="bname2" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer"> 
                                                                <button type="button" class="btn btn-primary" onclick="renameBrand('<?php echo $brand_data['id'] ?>');">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--  Rename Brand Modal -->
        
                                            <div class="col-12 col-lg-3 border border-success rounded rounded-5 mt-1" style="height:45px;" onclick="addNewBrand();">
                                                <div class="row">
                                                    <div class="col-9 mt-2 mb-2">
                                                        <label class="form-label fw-bold fs-6"> Add new Brand</label>
                                                    </div>
                                                    <div class="col-3 mt-2">
                                                        <label class="form-label text-end mx-3 fs-5"><i class="bi bi-plus-square-fill text-success"></i></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Add Brand Modal-->
                                                <div class="modal" tabindex="-1" id="addBrandModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Add New Brand</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                    
                                                                    <select class="form-select text-center" id="category">
                                                                        <option value="0">Select Category</option>
                                                                        <?php

                                                                        $category_rs = Database::search("SELECT * FROM `category`");
                                                                        $category_num = $category_rs->num_rows;

                                                                        for ($x = 0; $x < $category_num; $x++) {
                                                                            $category_data = $category_rs->fetch_assoc();
                                                                        ?>
                                                                            <option value="<?php echo $category_data["id"] ?>"><?php echo $category_data["name"] ?></option>
                                                                        <?php
                                                                        }

                                                                        ?>
                                                                    </select>

                                                                    <br>
                                                                    <label class="form-label">New Brand Name:</label>
                                                                    <input type="text" class="form-control" id="bname" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" onclick="saveBrand();">Save New Brand</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--Add Brand Modal-->

                                        <!-- Brand -->

                                        <div class="col-12">
                                            <hr class="border border-2 rounded rounded-5 border-primary">
                                        </div>

                                        <!-- Model -->
                                    
                                            <div class="col-12 text-center mb-3 mt-2">
                                                <h4 class="text-primary fw-bold text-decoration-underline">Manage Model</h4>
                                            </div>

                                            <?php
                                                
                                            $model_rs = Database::search("SELECT * FROM `model`");
                                            $model_num = $model_rs->num_rows;

                                            for($s = 0; $s < $model_num; $s++){
                                                $model_data = $model_rs->fetch_assoc();

                                                $b_rs = Database::search("SELECT * FROM `brand` WHERE `id`='".$model_data["brand_id"]."'");
                                                $b_data = $b_rs->fetch_assoc();

                                            ?>

                                                <div class="col-12 col-lg-3 mt-1 border border-danger rounded rounded-5 mb-1" onclick="deleteModelModal('<?php $model_data['id'] ?>');">
                                                    <div class="row">

                                                        <div class="col-12 mt-2 mb-2">
                                                            <span class="form-label fw-bold fs-6"><?php echo $model_data["name"]; ?></label>
                                                            <span class="form-label" style="font-size: 12px;">(<?php echo $b_data["name"]; ?>)</label>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>

                                            <!-- delete Model Modal -->
                                                <div class="modal" tabindex="-1" id="deleteModel<?php $model_data['id'] ?>">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <div class="modal-title mt-3 mx-3">
                                                                <span class="form-label fs-5 text-danger fw-bold"><i class="bi bi-exclamation-circle-fill text-danger"></i> Attention</span>
                                                                <button type="button" class="btn-close offset-7 offset-lg-8" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body mx-3">    
                                                                <div class="row g-3">   
                                                                    <span class="text-black fw-bold fs-6">You can delete or rename your Model. If you delete your Model, the related data can be Destroyed.</span>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer"> 
                                                                <button type="button" class="btn btn-danger rounded rounded-5" onclick="deleteModel('<?php echo $model_data['id'] ?>');"><i class="bi bi-trash3-fill"></i> Delete</button>
                                                                <button type="button" class="btn btn-secondary rounded rounded-5" onclick="renameModelModal('<?php echo $model_data['id'] ?>');"><i class="bi bi-pencil"></i> Rename</button>                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--  delete Model Modal -->

                                            <!-- Rename Model Modal -->
                                                <div class="modal" tabindex="-1" id="renameModelModal<?php echo $model_data["id"] ?>">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <div class="modal-title mt-3 mx-3">
                                                                <span class="form-label fs-5 text-secondary fw-bold"><i class="bi bi-pencil text-secondary"></i> Rename</span>
                                                                <button type="button" class="btn-close offset-7 offset-lg-8" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <label class="form-label">New Model Name:</label>
                                                                    <input type="text" class="form-control" id="mname2" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer"> 
                                                                <button type="button" class="btn btn-primary" onclick="renameModel('<?php echo $model_data['id'] ?>');">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--  Rename Model Modal -->
        
                                            <div class="col-12 col-lg-3 border border-success rounded rounded-5 mt-1" style="height:45px;" onclick="addNewModel();">
                                                <div class="row">
                                                    <div class="col-9 mt-2 mb-2">
                                                        <label class="form-label fw-bold fs-6"> Add new Model</label>
                                                    </div>
                                                    <div class="col-3 mt-2">
                                                        <label class="form-label text-end mx-3 fs-5"><i class="bi bi-plus-square-fill text-success"></i></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Add Model Modal-->
                                                <div class="modal" tabindex="-1" id="addModel">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Add New Model</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">

                                                                    <select class="form-select text-center" id="category1" onchange=load_brand_admin();>
                                                                        <option value="0">Select Category</option>
                                                                        <?php

                                                                        $category_rs = Database::search("SELECT * FROM `category`");
                                                                        $category_num = $category_rs->num_rows;

                                                                        for ($x = 0; $x < $category_num; $x++) {
                                                                            $category_data = $category_rs->fetch_assoc();
                                                                        ?>
                                                                            <option value="<?php echo $category_data["id"] ?>"><?php echo $category_data["name"] ?></option>
                                                                        <?php
                                                                        }

                                                                        ?>
                                                                    </select>
                                                                    <br>
                                                                    <select class="form-select text-center" id="brand">
                                                                        <option value="0">Select Brand</option>
                                                                        <?php
                                                
                                                                        $brand_rs = Database::search("SELECT * FROM `brand`");
                                                                        $brand_num = $brand_rs->num_rows;

                                                                        for($g = 0; $g < $brand_num; $g++){
                                                                            $brand_data = $brand_rs->fetch_assoc();                   
                                                                        ?>
                                                                            <option value="<?php echo $brand_data["id"] ?>"><?php echo $brand_data["name"] ?></option>
                                                                        <?php
                                                                        }

                                                                        ?>
                                                                    </select>

                                                                    <br>
                                                                    <label class="form-label">New Model Name:</label>
                                                                    <input type="text" class="form-control" id="mname" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" onclick="saveModel();">Save New Model</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--Add Model Modal-->

                                        <!-- Model -->
                                        

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

</html>

<?php

} else {
    echo ("You are Not a valid user");
}

?>