<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

    $pageno = 0;

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Selling History | Tech Store</title>

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

                <div class="col-12 bg-dark">
                    
                    <div class="row">
                        <div class="col-12 mt-2 my-lg-4">
                            <h1 class="text-center text-white fw-bold">Selling History <i class="bi bi-clock"></i></h1>
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

                        <div class="col-9">
                            <div class="row my-2">


                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12">
                                           
                                            <div class="col-10 mt-5 offset-lg-1 offset-1 border border-secondary rounded-5 border-1 bg-secondary d-none d-lg-block">  
                                                <div class="row">

                                                    <div class="col-1 mt-2 mb-2 text-center">
                                                        <span class="form-label fw-bold text-white mx-3">id</span><br>
                                                    </div>

                                                    <div class="col-3 mt-2 mb-2 text-center">
                                                        <span class="form-label fw-bold text-white mx-3">NAME</span><br>
                                                    </div>

                                                    <div class="col-2 mt-2 text-center">
                                                        <span class="form-label fw-bold text-white">PRICE</span><br>
                                                    </div>

                                                    <div class="col-2 mt-2 text-center">
                                                        <span class="form-label fw-bold text-white">BUYER</span><br>
                                                    </div>

                                                    <div class="col-3 mt-2">
                                                        <span class="form-label fw-bold text-white">QTY</span><br>
                                                    </div>

                                                </div>
                                            </div>
                                    
                                        </div>

                                        <?php
                                        
                                            if(isset($_GET["page"])){
                                                $pageno = $_GET["page"];
                                            }else{
                                                $pageno = 1;
                                            }

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            $results_per_page = 20;
                                            $number_of_page = ceil($invoice_num/$results_per_page);

                                            $page_results = ($pageno - 1) * $results_per_page;

                                            $selected_rs = Database::search("SELECT * FROM `invoice` ORDER BY `date` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");

                                            $selected_num = $selected_rs->num_rows;

                                            for($x = 0; $x < $selected_num; $x++){
                                                $selected_data = $selected_rs->fetch_assoc();

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$selected_data["product_id"]."'");
                                                $product_data = $product_rs->fetch_assoc();

                                                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$selected_data["user_email"]."'");
                                                $user_data = $user_rs->fetch_assoc();

                                            ?>

                                            <div class="col-lg-10 mt-lg-1 mt-5 offset-lg-1 border border-secondary rounded-5 border-1 d-lg-block d-none" style="height:45px">                                        
                                                <div class="row">

                                                    <div class="col-lg-1 col-5 col-3 offset-lg-0 offset-1 mt-2 text-center">
                                                        <span class="fw-bold"><?php echo $selected_data["id"]; ?></span>   
                                                    </div>
                                                    <div class="col-lg-3 col-6 mt-2 text-center">
                                                        <span class="form-label fw-bold text-black"><?php echo $product_data["title"]; ?></span><br>
                                                    </div>

                                                    <div class="col-lg-2  col-4 mt-2">
                                                        <span class="form-label fw-bold text-danger ">Rs. <?php echo $selected_data["total"]; ?>.00</span><br>
                                                    </div>

                                                    <div class="col-lg-2 col-3 mt-2">
                                                        <span class="form-label fw-bold text-secondary"><?php echo $user_data["fname"] ." ". $user_data["lname"]; ?></span>
                                                    </div>

                                                    <div class="col-lg-1 col-3 mt-2">
                                                        <span class="form-label fw-bold text-secondary"><?php echo $selected_data["qty"]; ?></span>
                                                    </div>

                                                    <div class="col-lg-3 col-1 text-lg-end mt-1 rounded-5">
                                                        <select class="form-select rounded-5 bg-success text-white fw-bold" id="s" onchange="changeProductStatus('<?php echo $selected_data['id']; ?>');">
                                                            
                                                            <?php
                                                            
                                                            if($selected_data["status"] == 0){
                                                                ?>
                                                                <option value="0">Confirm Order</option>
                                                                <?php
                                                            }else if($selected_data["status"] == 1){
                                                                ?>
                                                                <option value="1">Packing</option>
                                                                <?php
                                                            }else if($selected_data["status"] == 2){
                                                                ?>
                                                                <option value="2">Dispatch</option>
                                                                <?php
                                                            }else if($selected_data["status"] == 3){
                                                                ?>
                                                                <option value="3">Dispatch</option>
                                                                <?php
                                                            }else if($selected_data["status"] == 4){
                                                                ?>
                                                                <option value="4">Deliverd</option>
                                                                <?php
                                                            }
                                                            
                                                            ?>
                                                        
                                                            <option value="0">Confirm Order</option>
                                                            <option value="1">Packing</option>
                                                            <option value="2">Dispatch</option>
                                                            <option value="3">Shipping</option>
                                                            <option value="4">Deliverd</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- Small Screen -->
                                                <div class="col-12 mt-5 border border-secondary rounded-5 border-1 d-lg-none d-block offset-2" style="height:150px">                                        
                                                    <div class="row">

                                                        <div class="col-3 mt-2 text-center">
                                                            <span class="fw-bold"><?php echo $selected_data["id"]; ?></span>   
                                                        </div>
                                                        <div class="col-9 text-center mt-2">
                                                            <span class="form-label fw-bold text-black"><?php echo $product_data["title"]; ?></span><br>
                                                        </div>

                                                        <div class="col-5 mt-2 text-center">
                                                            <span class="form-label fw-bold text-danger ">Rs. <?php echo $selected_data["total"]; ?>.00</span><br>
                                                        </div>

                                                        <div class="col-7 mt-2 text-center">
                                                            <span class="form-label fw-bold text-secondary"><?php echo $user_data["fname"] ." ". $user_data["lname"]; ?></span>
                                                        </div>

                                                        <div class="col-12 mt-2 text-center">
                                                            <span class="form-label fw-bold text-secondary"><?php echo $selected_data["qty"]; ?></span>
                                                        </div>

                                                        <div class="col-12 text-lg-end mt-1 rounded-5">
                                                            <select class="form-select rounded-5 bg-success text-white fw-bold" id="s" onchange="changeProductStatus('<?php echo $selected_data['id']; ?>');">
                                                                
                                                                <?php
                                                                
                                                                if($selected_data["status"] == 0){
                                                                    ?>
                                                                    <option value="0">Confirm Order</option>
                                                                    <?php
                                                                }else if($selected_data["status"] == 1){
                                                                    ?>
                                                                    <option value="1">Packing</option>
                                                                    <?php
                                                                }else if($selected_data["status"] == 2){
                                                                    ?>
                                                                    <option value="2">Dispatch</option>
                                                                    <?php
                                                                }else if($selected_data["status"] == 3){
                                                                    ?>
                                                                    <option value="3">Dispatch</option>
                                                                    <?php
                                                                }else if($selected_data["status"] == 4){
                                                                    ?>
                                                                    <option value="4">Deliverd</option>
                                                                    <?php
                                                                }
                                                                
                                                                ?>
                                                            
                                                                <option value="0">Confirm Order</option>
                                                                <option value="1">Packing</option>
                                                                <option value="2">Dispatch</option>
                                                                <option value="3">Shipping</option>
                                                                <option value="4">Deliverd</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            <!-- Small Screen -->

                                            <?php

                                            }
                                            
                                            ?>

                                            <!-- pagination -->
                                                <div class="offset-4 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
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