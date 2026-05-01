<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Add Product | Tech Store</title>

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

                <div class="col-12 my-2">
                    <div class="row">
                        <div class="col-2 text-start mt-2">
                            <a href="myProduct.php"><i class="bi bi-arrow-left-circle-fill fs-2"></i></a>
                        </div>
                        <div class="col-10 mt-1 mt-lg-0" style="font-family: 'Quicksand'">
                            <span class="form-label fs-1 fw-bold text-primary offset-lg-3">Add New Product</span>
                        </div>
                    </div>
                </div>

                <div class="col-12" style="background-color:#E9EBEE">
                    <div class="row">
                    <!-- 1 -->
                        <div class="col-lg-4 col-12 my-3">
                            <div class="row">
                                <div class="col-lg-11 col-12 text-start bg-white">
                                    <div class="row">
                                    
                                        <div class="col-10 mt-3">
                                            <span class="form-label fs-5 fw-bold">Category</span>
                                            <select class="form-select text-center bg-light border-0 border-bottom offset-1 mb-2 mt-2" id="category" onchange="load_brand();">
                                                <option value="0">Select Category</option>

                                                <?php
                                                
                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;

                                                for($x = 0; $x < $category_num; $x++){
                                                    $category_data = $category_rs->fetch_assoc();
                                                
                                                ?>

                                                    <option value="<?php echo($category_data["id"]); ?>"><?php echo($category_data["name"]); ?></option>

                                                <?php
                                                    
                                                }

                                                ?>


                                            </select>
                                        </div>
                                            
                                        <div class="col-10 mt-3">
                                            <span class="form-label fs-5 fw-bold">Brand</span>
                                            <select class="form-select text-center bg-light border-0 border-bottom offset-1 mb-2 mt-2" id="brand" onchange="load_model();">
                                                <option value="0">All Brands</option>
                                                
                                                <?php
                                                
                                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                                $brand_num = $brand_rs->num_rows;

                                                for($y = 0; $y < $brand_num; $y++){
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                
                                                ?>

                                                    <option value="<?php echo($brand_data["id"]); ?>"><?php echo($brand_data["name"]); ?></option>

                                                <?php
                                                    
                                                }

                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-10 mt-3">
                                            <span class="form-label fs-5 fw-bold">Model</span>
                                            <select class="form-select text-center bg-light border-0 border-bottom offset-1 mb-2 mt-2" id="model">
                                                <option values="0">All Models</option>

                                                <?php
                                                
                                                $model_rs = Database::search("SELECT * FROM `model`");
                                                $model_num = $model_rs->num_rows;

                                                for($s = 0; $s < $model_num; $s++){
                                                    $model_data = $model_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo($model_data["id"]); ?>"><?php echo($model_data["name"]); ?></option>

                                                <?php

                                                }
                                                
                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <hr class="border border-2 border-primary rounded rounded-5 ">
                                        </div>

                                        <div class="col-12">
                                            <div class="col-12">
                                                <span class="form-label fs-5 fw-bold ">Condition</span>
                                            </div>    
                                            <div class="form-check form-check-inline col-4 offset-2 mb-2 mt-2">
                                                <input class="form-check-input" type="radio" id="b" value="option1" name="c" checked>
                                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                            </div>
                                            <div class="form-check form-check-inline col-3">
                                                <input class="form-check-input" type="radio" id="u" value="option2" name="c">
                                                <label class="form-check-label fw-bold" for="u">Used</label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <hr class="border border-2 border-primary rounded rounded-5 ">
                                        </div>

                                        <div class="col-10">
                                            <span class="form-label fs-5 fw-bold ">Colour</span>
                                            <select class="form-select text-center bg-light border-0 border-bottom offset-1 mt-2" id="clr">
                                                <option value="0">Select Colour</option>

                                                <?php
                                            
                                                $clr_rs = Database::search("SELECT * FROM `colour`");
                                                $clr_num = $clr_rs->num_rows;

                                                for($a = 0; $a < $clr_num; $a++){
                                                    $clr_data = $clr_rs->fetch_assoc();
                                                    
                                                ?>

                                                    <option value="<?php echo($clr_data["id"]); ?>"><?php echo($clr_data["name"]); ?></option>

                                                <?php
                                                }
                                                ?>

                                            </select>  
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group mb-2 mt-2 mb-3">
                                                <input type="text" class="form-control" placeholder="Add new Colour" id="clr_in"/>
                                                <button class="btn btn-outline-primary" type="button" id="button-addon2">+ Add</button>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <hr class="border border-2 border-primary rounded rounded-5 ">
                                        </div>

                                        <div class="col-12">
                                            <span class="form-label fs-5 fw-bold ">Payment Methods</span>
                                            <div class="row mt-2 mb-3">
                                                <div class="col-3 pm pm1"></div>
                                                <div class="col-3 pm pm2"></div>
                                                <div class="col-3 pm pm3"></div>
                                                <div class="col-3 pm pm4"></div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- 1 -->

                    <!-- 2 -->
                        <div class="col-lg-8 col-12 my-3">
                            <div class="row">
                                <div class="col-12 text-start bg-white">
                                    <div class="row">
                                    
                                        <div class="col-12 col-lg-10 mt-3">
                                            <span class="form-label fs-5 fw-bold ">Product Title</span>
                                            <input type="text" class="form-control offset-lg-1 mb-2 mt-2" id="title">
                                        </div>

                                        <div class="col-12 col-lg-10 mt-3">
                                            <span class="form-label fs-5 fw-bold ">Quantity</span>
                                            <input type="number" class="form-control offset-lg-1 mb-2 mt-2" value="0" min="0" id="qty">
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="row">

                                                <div class="col-12 col-lg-6 border-end border-primary">
                                                    <div class="row">

                                                        <span class="form-label fs-5 fw-bold ">Price Per Item</span>
                                                        <div class="col-10 offset-1">
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text">Rs.</span>
                                                                    <input type="text" class="form-control" id="cost">
                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row">
                                                      
                                                        <span class="form-label fs-5 fw-bold ">Discount</span>
                                                        <div class="col-10 offset-1">
                                                            <div class="input-group mb-2">
                                                                <input type="text" class="form-control" id="dis">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="row">
                                                <span class="form-label fs-5 fw-bold ">Delivery Fee</span>

                                                <div class="col-12 col-lg-6 border-end border-primary">
                                                    <div class="row">
                                                        
                                                        <label class="form-label">In Colombo</label>
                                                        <div class="col-10 offset-1">
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text">Rs.</span>
                                                                <input type="text" class="form-control" id="dwc">
                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row">
                                                      
                                                        <label class="form-label">Out Of Colombo</label>
                                                        <div class="col-10 offset-1">
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text">Rs.</span>
                                                                <input type="text" class="form-control" id="doc">
                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-10 mt-3 mb-2">
                                            <span class="form-label fs-5 fw-bold ">Description</span>
                                            <textarea cols="30" rows="11" class="form-control offset-lg-1 mb-2 mt-2" id="desc"></textarea>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- 2 -->

                    <!-- 3 -->
                    <div class="col-12 bg-white my-2 mb-4">
                        <div class="row">

                            <div class="col-12 mt-3">
                            <span class="form-label fs-4 fw-bold ">Product Image</span>
                            </div>

                            <div class="offset-lg-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-4 border border-primary rounded">
                                        <img src="resource/payment method images/addproductimg.svg" class="img-fluid" style="height: 300px;" id="i0"/>
                                    </div>
                                    <div class="col-4 border border-primary rounded">
                                        <img src="resource/payment method images/addproductimg.svg" class="img-fluid" style="height: 300px;" id="i1"/>
                                    </div>
                                    <div class="col-4 border border-primary rounded">
                                        <img src="resource/payment method images/addproductimg.svg" class="img-fluid" style="height: 300px;" id="i2"/>
                                    </div>
                                </div>
                            </div>

                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                <input type="file" class="d-none" id="imageUploader" multiple>
                                <label for="imageUploader" class="col-12 btn btn-primary" onclick="changeUploadImage();">Upload Images</label>
                            </div>

                            <div class="col-12">
                                <hr class="border-success"/>
                            </div>


                            <div class="col-12">
                                <label class="form-label fw-bold" style="font-size: 20px;">Notice...</label><br/>
                                <label class="form-label">
                                    We are takin 5% of the product from price from every product as a service charge.
                                </label>
                            </div>

                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-4">
                                <button class="btn btn-success" onclick="addProduct();">Save Product</button>
                            </div>

                        </div>
                    </div>
                    <!-- 3 -->
 
                    </div>
                </div>


                <?php include "footer.php"; ?>
               
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

</html>