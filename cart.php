<?php

require "connection.php";
session_start();

if(isset($_SESSION["u"])){

    $email = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;
    $total_discount = 0;
    $a = 0;

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cart | Tech Store</title>

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

                <?php include "header.php"?>
              
                <div class="col-12">
                    <div class="row">

                        

                        <?php
                        
                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."'");
                        $cart_num = $cart_rs->num_rows;

                        if($cart_num == 0){

                        ?>

                            <!-- empty view -->
                            <div class="col-12">
                                <div class="row">
                                    <a href="home.php">
                                        <div class="col-12 emptyCart"></div>
                                    </a>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 fw-bold">
                                            You have no items in your Cart yet.
                                        </label>
                                    </div>
                                </div>
                            </div>  
                            <!-- empty view -->

                        <?php

                        }else{

                        ?>
                        <!-- product view -->>

                        <div class="col-12" style="background-color:#E9EBEE">
                            <div class="row">
                                <nav aria-label="breadcrumb" class="mt-3 ">
                                    <ol class="breadcrumb offset-lg-1">
                                        <li class="breadcrumb-item" style="font-size: 18px;"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page" style="font-size: 18px;">Cart</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <span class="form-label fs-1 fw-bolder offset-lg-1" style="font-family: 'Quicksand';">Shopping Cart <i class="bi bi-cart3 text-primary"></i></span>
                        </div>

                            <div class="col-lg-10 col-12 offset-lg-1 offset-0 mt-5">
                                <table class="table">

                                    <thead>
                                        <tr class="bg-primary" style="font-family: 'Quicksand';">
                                            <th class="text-center text-white d-none d-lg-block">#</th>
                                            <th class="text-center text-white">Image</th>
                                            <th class="text-center text-white">Prodcut</th>
                                            <th class="text-center text-white">Price</th>
                                            <th class="text-center text-white">Qty</th>
                                            <th class="text-center text-white">Total</th>
                                            <th class="text-center text-white">Discount</th>
                                            <th class="text-center text-white">remove</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php 
                                        
                                        for($x = 0; $x < $cart_num; $x++){

                                            $cart_data = $cart_rs->fetch_assoc();

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$cart_data["product_id"]."'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $total2 = $product_data["price"] * $cart_data["qty"];   
                                            $discount = ($total2 / 100) * $product_data["discount"];

                                            $total = $total + ($product_data["price"] * $cart_data["qty"]);
                                            $total_discount = $total_discount + ($total2 / 100) * $product_data["discount"];

                                            $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN 
                                            `city` ON user_has_address.city_id=city.id INNER JOIN `district` ON city.district_id=district.id WHERE 
                                            `user_email`='".$email."'");
                                            $address_data = $address_rs->fetch_assoc();

                                            if($address_data["did"] == 2){
                                                $shipping = $shipping + $product_data["delivery_fee_colombo"];
                                            }else{
                                                $shipping = $shipping + $product_data["delivery_fee_other"];
                                            }

                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$product_data["id"]."'");
                                            $image_data = $image_rs->fetch_assoc();

                                            $subTotal =  $total + $shipping - $total_discount;


                                        ?>

                                            <tr style="height: 80px;">
                                                <td class="text-dark text-center pt-4 fs-5 border border-2 d-none d-lg-block" style="height: 80px;"><?php echo $x + 1; ?></td>
                                                <td class="text-center border border-2"><img src="<?php echo $image_data["code"]; ?>" style="height: 60px"></td>
                                                <td class="fw-bold text-center pt-4 border border-2"><?php echo $product_data["title"]; ?></td>
                                                <td class="fw-bold text-center pt-4 border border-2">Rs. <?php echo $product_data["price"]; ?>.00</td>
                                                <td class="fw-bold text-center pt-4 border border-2"><input type="number" value="<?php echo $cart_data["qty"]; ?>" style="width: 50px"></td>
                                                <td class="fw-bold text-center pt-4 border border-2">Rs.<?php echo $total2 ?>.00</td>
                                                <?php
                                                
                                                if($product_data["discount"] == 0){
                                                    ?>
                                                    <td class="fw-bold text-center text-secondary pt-4 border border-2">No Discount</td>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <td class="fw-bold text-center pt-4 border border-2">Rs.<?php echo $discount ?>.00</td>
                                                    <?php
                                                }

                                                ?>
                                                <td class="fw-bold text-center pt-4 border border-2"><a><i class="bi bi-trash-fill text-danger fs-5"></i></a></td>
                                            </tr>

                                        <?php

                                        }
                                        
                                        ?>
                                        
                                    </tbody>
                                
                                </table>
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="modal" tabindex="-1" id="checkoutModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body" id="result">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-4 col-12 offset-lg-7 offset-lg-4" style="margin-top:-60px">
                                <table class="table">

                                    <thead>
                                        <tr style="background-color: #eb7222; font-family: 'Quicksand';">
                                            <th class="text-white fs-5">Cart Total</th>
                                            <th class="text-white fs-5"></th>
                                        </tr>
                                    </thead>

                                    <tbody class="border border-2">
                                        <tr style="height: 40px;">
                                            <td class=" fw-bold">Items  <?php echo($cart_num) ?></td><br>
                                            <td class="text-end fw-bold text-secondary">Rs. <?php echo($total) ?>.00</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Shipping</td><br>
                                            <td class="text-end fw-bold text-secondary">Rs. <?php echo($shipping) ?>.00</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Total Discount</td><br>
                                            <td class="text-end fw-bold text-secondary">Rs. <?php echo($total_discount) ?>.00</td>
                                        </tr>
                                    </tbody>

                                    <tfoot class="border border-2">
                                        <tr style="height: 80px;">
                                            <td class="fw-bold fs-5">Sub Total</td><br>
                                            <td class="text-end fw-bold text-secondary fs-5">Rs. <?php echo $total + $shipping - $total_discount; ?>.00</td>
                                        </tr>
                                    </tfoot>
                                                                
                                </table>

                                <div class="col-12 d-grid">
                                    <button class="btn btn-success text-white fw-bold fs-5" onclick="checkout('<?php echo($subTotal) ?>');">CHECKOUT</button>
                                </div>

                            </div>

                 
                            <!-- product view -->
                        <?php

                        }
                        
                        ?>

                    </div>
                </div>

                <?php
                }else{

                    header("location:index.php");

                }                
                ?>

                <?php include "footer.php"; ?>
            </div>
        </div>

        <script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

</html>