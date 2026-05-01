<?php

require "connection.php";
session_start();

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Purchsed History | Tech Store</title>

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
            
                <?php include "header.php";?>

                <div class="col-lg-12 col-12">
                    <div class="row my-2">

                        <div class="col-12" style="background-color:#E9EBEE">
                            <div class="row">
                                <nav aria-label="breadcrumb" class="mt-3 ">
                                    <ol class="breadcrumb offset-lg-1">
                                        <li class="breadcrumb-item" style="font-size: 18px;"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page" style="font-size: 18px;">Purchsed History</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                        <div class="col-12 mt-3 mb-4 text-center">
                            <span class="form-label fs-1 fw-bolder" style="font-family: 'Quicksand';">Purchsed History<i class="bi bi-clock-history text-primary"></i></span>
                        </div>

                        <?php
                        if(isset($_SESSION["u"])){
                            
                            $email = $_SESSION["u"]["email"];

                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='".$email."'");
                            $invoice_num = $invoice_rs->num_rows;

                            if($invoice_num == 0){

                            ?>
                                <div class="col-12 bg-body text-center" style="height: 450px;">
                                    <span class="fs-1 fw-bolder text-black-50 d-block" style="margin-top: 200px;">
                                        You have not purchased any product yet....
                                    </span>
                                </div>
                            <?php

                            }else{

                            ?>
 
                                <div class="col-10 mt-2 mb-2 offset-lg-1 offset-1 border border-secondary rounded-5 border-1 bg-secondary d-none d-lg-block">              
                                    <div class="row">
                                        <div class="col-4 mt-2 mb-2">
                                            <span class="form-label fw-bold text-white mx-3 text-uppercase">Order Details</span>
                                        </div>

                                        <div class="col-1 mt-2">
                                            <span class="form-label fw-bold text-white text-uppercase">QTY</span>
                                        </div>

                                        <div class="col-2 mt-2">
                                            &nbsp;&nbsp;
                                            <span class="form-label fw-bold text-center text-white text-uppercase mx-4">TOTAL</span>
                                        </div>

                                        <div class="col-3 mt-2">
                                            <span class="form-label fw-bold text-white text-uppercase offset-1">Purchase Date</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <?php
                                        
                                        for($x = 0; $x < $invoice_num; $x++){

                                            $invoice_data = $invoice_rs->fetch_assoc();

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$invoice_data["product_id"]."'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$product_data["id"]."'");
                                            $img_data = $img_rs->fetch_assoc();

                                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$invoice_data["user_email"]."'");
                                            $seller_data = $seller_rs->fetch_assoc();

                                        ?>
                                            <!-- product -->

                                            <div class="col-lg-10 col-10 mt-2 offset-lg-1 offset-1 border border-secondary rounded-5 border-1">              
                                                <div class="row">

                                                    <div class="col-lg-4 col-11 mx-2 my-2 border border-2 rounded rounded-5 rounded-end">
                                                        <div class="row">

                                                            <div class="col-lg-5 col-12 offset-lg-0 offset-2 mt-4 mb-3">
                                                                <img src="<?php echo $img_data["code"]; ?>" class="img-fluid rounded-start" style = "height: 80px;">
                                                            </div>
                                                            
                                                            <div class="col-lg-7 col-12 mt-lg-2 mt-4 mb-4">
                                                                <div class="card-body mt-1">
                                                                    <span class="card-title fw-bold fs-5 text-primary"><?php echo $product_data["title"]; ?></span><br>
                                                                    <span class="card-title text-black fw-bold" style="font-size: 14px;">Seller : </span>
                                                                    <span class="card-title text-secondary fw-bold" style="font-size: 14px;"><?php echo $seller_data["fname"] ." ". $seller_data["lname"]; ?></span><br>
                                                                    <span class="card-title text-black fw-bold" style="font-size: 14px;">Price : </span>
                                                                    <span class="card-title text-secondary fw-bold" style="font-size: 14px;">Rs. <?php echo $product_data["price"]; ?>.00</span><br>
                                                                    <span class="card-title text-black fw-bold" style="font-size: 14px;">ORDER ID : </span>
                                                                    <span class="card-title text-secondary fw-bold" style="font-size: 14px;"><?php echo $invoice_data["order_id"]; ?></span><br>
                                                                        
                                                                    <!-- small screen -->
                                                                    <div class="row d-lg-none d-block">
                                                                        <div class="col-12">
                                                                            <span class="card-title text-black fw-bold" style="font-size: 14px;">QTY : </span>
                                                                            <span class="card-title text-secondary fw-bold" style="font-size: 14px;"><?php echo $invoice_data["qty"]; ?></span><br>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span class="card-title text-black fw-bold" style="font-size: 14px;">Total : </span>
                                                                            <span class="card-title text-secondary fw-bold" style="font-size: 14px;">Rs. <?php echo $invoice_data["total"]; ?>.00</span><br>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span class="card-title text-black fw-bold" style="font-size: 14px;">Purchase Date : </span>
                                                                            <span class="card-title text-secondary fw-bold" style="font-size: 14px;"><?php echo $invoice_data["date"]; ?></span><br>
                                                                        </div>
                                                                        <div class="col-12 d-grid my-2">
                                                                            <button class="btn btn-secondary text-white"><i class="bi bi-info-circle-fill"></i> Feedback</button>
                                                                        </div>
                                                                        <div class="col-12 d-grid my-2">
                                                                            <button class="btn btn-danger text-white"  onclick="deleteFromHistory('<?php echo $invoice_data['id']; ?>');"><i class="bi bi-trash3-fill"></i> Delete</button>
                                                                        </div>
                                                                    </div>
                                                                    <!-- small screen -->     

                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-1 mt-5 d-lg-block d-none">
                                                        <span class="form-label fs-5"><?php echo $invoice_data["qty"]; ?></span>
                                                    </div>

                                                    <div class="col-lg-2 mt-5 d-lg-block d-none">
                                                        <span class="form-label">Rs. <?php echo $invoice_data["total"]; ?>.00</span>
                                                    </div>

                                                    <div class="col-lg-2 mt-5 d-lg-block d-none">
                                                        <span class="form-label"><?php echo $invoice_data["date"]; ?></span>
                                                    </div>

                                                    <div class="col-lg-2 my-1 d-lg-block d-none">

                                                        <div class="row d-grid mx-2">
                                                            <button class="btn btn-secondary text-white my-3" onclick="addFeddback('<?php echo $invoice_data['product_id']; ?>');"><i class="bi bi-info-circle-fill"></i> Feedback</button>
                                                        </div>
                                                        <div class="row d-grid mx-2">
                                                            <button class="btn btn-danger text-white" onclick="deleteFromHistory('<?php echo $invoice_data['id']; ?>');"><i class="bi bi-trash3-fill"></i> Delete</button>
                                                        </div>
                                                        
                                                    </div>
                                                        
                                                </div>
                                            </div>  

                                            <!-- product -->

                                            <!-- modal -->
                                            <div class="modal fade" role="dialog" id="feedbackModal<?php echo $invoice_data['product_id']; ?>">

                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                <div class="modal-header bg-primary">
                                                    <h3 class="text-white">Feedback Request</h3>
                                                </div>

                                                <div class="modal-body text-center">
                                                    <i class="far fa-file-alt fa-4x mb-3 animated rotateIn icon1"></i>
                                                    <h3>Your opinion matters</h3>
                                                    <h5>Help us improve our product? </h5>
                                                    <hr>
                                                    <h6>Your Rating</h6>
                                                </div>

                                                <div class="form-check mb-4">
                                                    <input name="feedback" type="radio" id="type1<?php echo $invoice_data['product_id']; ?>">
                                                    <label class="ml-3">Very good &nbsp;&nbsp;&nbsp;
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                    </label>
                                                </div>
                                                <div class="form-check mb-4">
                                                    <input name="feedback" type="radio" id="type2<?php echo $invoice_data['product_id']; ?>">
                                                    <label class="ml-3">Good &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                    </label>
                                                </div>
                                                <div class="form-check mb-4">
                                                    <input name="feedback" type="radio" id="type3<?php echo $invoice_data['product_id']; ?>">
                                                    <label class="ml-3">Mediocre &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                    </label>
                                                </div>
                                                <div class="form-check mb-4">
                                                    <input name="feedback" type="radio" id="type4<?php echo $invoice_data['product_id']; ?>">
                                                    <label class="ml-3">Bad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                    </label>
                                                </div>
                                                <div class="form-check mb-4">
                                                    <input name="feedback" type="radio" id="type5<?php echo $invoice_data['product_id']; ?>">
                                                    <label class="ml-3">Very Bad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                    </label>
                                                </div>

                                                <div class="text-center">
                                                    <h4>Feedback</h4>
                                                </div>
                                                <textarea type="textarea" class="form-control" placeholder="Your Message" rows="3" id="text<?php echo $invoice_data['product_id']; ?>"></textarea>

                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" onclick="sendFeedback('<?php echo $invoice_data['product_id']; ?>');">Send<i class="fa fa-paper-plane"></i></button>
                                                    <button class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                                </div>

                                                </div>

                                            </div>

                                            </div>
                                            <!-- modal -->

                                        <?php

                                        }
                                        
                                        ?>

                                        <div class="col-lg-3 col-10 mt-4 offset-lg-8 offset-1">
                                            <div class="row d-grid">
                                                <button class="btn btn-danger text-white rounded rounded-5" onclick="deleteAllFromHistory();"><i class="bi bi-trash3-fill"></i> Clear All Records</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                        <?php

                            }

                        ?>

                        <?php
                        }else{

                            ?>
                            <div class="col-12 bg-body text-center" style="height: 450px;">
                                <span class="fs-1 fw-bolder text-black-50 d-block" style="margin-top: 200px;">
                                    Please Signin and Try Again....
                                </span>
                            </div>
                            <?php

                        }
                        ?>
                        
                    </div>
                </div>
                   
                <?php include "footer.php"?>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        
    </body>

</html>


