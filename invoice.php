<?php

require "connection.php";
session_start();

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Invoice | New-Tech</title>

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

            <?php
            
            if(isset($_SESSION["u"])){

                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];

                $subTotal = 0;
                $fullDiscount = 0;

            ?>
                <div class="col-12" id="page">
                    <div class="row">

                        <div class="col-12 border border-1 border-dark border-end-0" style="background-color:#E9EBEE">
                            <div class="row">

                                <div class="col-lg-10 col-12 my-lg-4 my-2">
                                    <h1 class="text-center text-dark fw-bold mt-3 offset-lg-3">Invoice <i class="bi bi-clock-history"></i></h1>
                                </div>

                                <div class="col-lg-2 col-12 mt-lg-3 mt-2 offset-lg-0 text-center">
                                    <span class="text-end text-dark fw-bold">Tech Store</span><br>
                                    <span class="text-end text-dark mt-1" style="font-size:13px;">Colombo10 ,Sri Lanka</span><br>
                                    <span class="text-end" style="font-size:13px;">+9457 8556656</span><br>
                                    <span class="text-end" style="font-size:13px;">newtech@gmail.com</span><br>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="row">

                                <div class="col-lg-8 col-6">

                                    <?php

                                    $address_rs = Database::Search("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."'");
                                    $address_data = $address_rs->fetch_assoc();

                                    ?>

                                    <span class="form-label fw-bold fs-3">Billing To</span><br>
                                    <span class="form-label fw-bold fs-5 mt-2"><?php echo $_SESSION["u"]["fname"] ." ".  $_SESSION["u"]["lname"] ?></span><br>

                                    <div class="row">
                                        <div class="col-12 mt-2">
                                            <span class="form-label"><?php echo $address_data["line_1"] ?></span><br>
                                            <span class="form-label"><?php echo $address_data["line_2"];  ?></span><br>
                                            <span class="form-label">TEL : <?php echo $_SESSION["u"]["mobile"] ?></span><br>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-4 col-6">

                                    <div class="col-lg-7 col-12 offset-lg-4 text-center border border-1 my-2">
                                        <span class="fw-bold fs-3 ">INVOICE</span><br>
                                    </div>

                                    <?php
                                    
                                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$oid."'");
                                    $invoice_data = $invoice_rs->fetch_assoc();
                                    
                                    ?>

                                    <div class="col-lg-7 col-10 offset-lg-4 mt-2">
                                        <span class="form-label text-secondary fw-bold">Invoice No : </span>
                                        <span class="form-label">#<?php echo $invoice_data["id"];  ?></span><br>
                                        <span class="form-label text-secondary fw-bold">Due Date : </span>
                                        <span class="form-label"><?php echo $invoice_data["date"];  ?></span><br>
                                        <span class="form-label text-secondary fw-bold">Bill No : </span>
                                        <span class="form-label"><?php echo $invoice_data["order_id"];  ?></span><br>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 mt-4 rounded rounded-5 bg-primary fw-bold border border-2">
                                    <div class="row">

                                        <div class="col-lg-2 my-2  d-none d-lg-block">
                                            <span class="form-label text-dark mx-3">No.</span><br>
                                        </div>

                                        <div class="col-lg-4 col-3 my-2">
                                            <span class="form-label text-dark mx-3">ITEM</span><br>
                                        </div>

                                        <div class="col-lg-2 col-3 my-2">
                                            <span class="form-label text-dark mx-3">UNIT PRICE</span><br>
                                        </div>

                                        <div class="col-2 my-2 ">
                                            <span class="form-label text-dark mx-3">QTY</span><br>
                                        </div>

                                        <div class="col-2 my-2">
                                            <span class="form-label text-dark mx-3">DISCOUNT</span><br>
                                        </div>

                                    </div>
                                </div>
                                

                                <?php
                                        
                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$umail."'");
                                $cart_data = $cart_rs->fetch_assoc(); 

                                $invoice_rs2 = Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$oid."'");
                                
                                for($x = 0; $x < $invoice_rs2->num_rows; $x++){

                                    $invoice_data2 = $invoice_rs2->fetch_assoc();

                                ?>
        <!-- Product -->
                                    <div class="col-12 mt-2 border rounded rounded-5">
                                        <div class="row">

                                            <div class="col-2 my-2 d-none d-lg-block">
                                                <span class="form-label  mx-3"><?php echo $invoice_data2["order_id"];  ?></span><br>
                                            </div>

                                            <?php
                                            
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$invoice_data2["product_id"]."'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $total = $invoice_data2["total"];
                                            $qty = $invoice_data2["qty"];
                                            $d = $product_data["discount"];

                                            $subTotal = $subTotal + ($total * $invoice_data2["qty"]);
                                            $discount = ($product_data["price"] / 100) * $d;

                                            $fullDiscount = $fullDiscount + ($discount * $qty);
                                            $total_discount = $discount * $qty;

                                            
                                            $total2 = $subTotal - $fullDiscount;
                                            
                                            ?>

                                            <div class="col-lg-4 col-3 my-2">
                                                <span class="form-label mx-3"><?php echo $product_data["title"];  ?></span><br>
                                            </div>

                                            <div class="col-lg-2 col-3 my-2">
                                                <span class="form-label mx-3">Rs. <?php echo $product_data["price"];  ?>.00</span><br>
                                            </div>

                                            <div class="col-2 my-2">
                                                <span class="form-label mx-3"><?php echo $invoice_data2["qty"];  ?></span><br>
                                            </div>

                                            <div class="col-2 my-2">
                                                <span class="form-label mx-3">Rs. <?php echo $total_discount  ?>.00</span><br>
                                            </div>

                                            
                                        </div>
                                    </div>

                                <?php
                                        
                                }

                                ?>

                            </div>
                        </div>
        <!-- Product -->

                        <div class="col-12">
                            <div class="row">

                                <div class="col-lg-4 col-12 mt-4 border border-1 offset-lg-8 ">

                                    <div class="col-12 my-1">
                                        <div class="row">
                                            <div class="col-8">
                                                <span class="form-label fs-5 fw-bold">SUBTOTAL</span><span>(with delivery)</span>
                                            </div>
                                            <div class="col-4">
                                                <span class="form-label ">Rs. <?php echo $subTotal; ?>.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 my-1">
                                        <div class="row">
                                            <div class="col-8">
                                                <span class="form-label fs-5 fw-bold">Discount</span>
                                            </div>
                                            <div class="col-4">
                                                <span class="form-label">Rs. <?php echo $fullDiscount; ?>.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 my-3 text-primary border border-4 border-dark border-bottom-0 border-end-0 border-start-0">
                                        <div class="row">
                                            <div class="col-8">
                                                <span class="form-label fs-5 fw-bold">Grand Total</span>
                                            </div>
                                            <div class="col-4 mt-1">
                                                <span class="form-label">Rs. <?php echo $total2; ?>.00</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
            
                            </div>
                        </div>

                        <div class="col-12 my-4">
                            <div class="row">

                                <div class="col-lg-12 col-6">

                                    <span class="form-label fw-bold fs-3">Thank You...</span><br>
                                    <span class="form-label mt-2">Purchased item can return before 7 days of delivery.</span><br>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 btn-toolbar justify-content-end border border-2 border-end-0 border-start-0 border-bottom-0 border-dark">

                    <button class="btn btn-dark me-2 mt-3" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
                    <button class="btn btn-danger me-2 mt-3"><i class="bi bi-filetype-pdf" onclick="savePDF();"></i> Export as PDF</button>
              
                </div>

            <?php
            }
            ?>

                <?php include "footer.php"; ?>
                    
            </div>
        </div>
        
        <script src="html2pdf.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="script.js"></script>
    </body>

</html>