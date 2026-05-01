<?php
session_start();
require "connection.php";

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Profile | Tech Store</title>

        <link rel="icon" href="resource/logor.png"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body >

        <div class="container-fluid" style="background-color:white;">
            <div class="row">

                <div id="cssLoader17" class="main-wrap main-wrap--white">
                    <div class="cssLoader17"></div>
                </div>

                <?php include "header.php"; 

                if(isset($_SESSION["u"])){

                ?>

                <div class="col-12" style="background-color:#e9ebeeee">
                    <div class="row">

                        <?php    

                        $email = $_SESSION["u"]["email"];

                        $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON
                        gender.id=user.gender_id WHERE `email`='".$email."'");

                        $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$email."'");

                        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                        user_has_address.city_id=city.id INNER JOIN `district` ON 
                        city.district_id=district.id INNER JOIN `province` ON 
                        district.province_id=province.id WHERE `user_email`='" . $email . "'");

                        $data = $details_rs->fetch_assoc();
                        $image_data = $image_rs->fetch_assoc();
                        $address_data = $address_rs->fetch_assoc();
                                
                        ?>

                        <div class="col-lg-5 mx-lg-3">
                            <div class="row">

                            <div class="col-10 offset-1 bg-white rounded rounded-5 my-3 " id="profile_img">
                                <div class="row">
                                
                                    <div class="col-12 text-center my-3">

                                        <?php     
                                        if(empty($image_data["path"])){
                                        ?>

                                            <img src="resource/user.svg" class="rounded rounded-5 mt-6" style="width:150px" id="viewImg"/>

                                        <?php
                                        }else{
                                        ?>

                                            <img src="<?php echo($image_data["path"]); ?>" class="rounded rounded-5 mt-6" style="width:150px" id="viewImg"/>

                                        <?php
                                        }  
                                        ?>

                                        <p class="form-label fs-5 mt-2"><?php echo $_SESSION["u"]["fname"] ." ". $_SESSION["u"]["lname"]; ?></p>
                                        <p class="form-label text-secondary fw-bold"><?php echo $email; ?></p>

                                        <input type="file" class="d-none" id="profileimg" accept="img/*"/>
                                        <label for="profileimg" class="btn btn-primary mt-3" onclick="changeImage();">Update Profile Image</label>

                                        <br>

                                        <button class="btn btn-success rounded rounded-5 mt-3" onclick="profileSetting();">Profile Setting &rarr;</button>

                                    </div>

                                </div>
                            </div>

                            <div class="col-10 offset-1 bg-white rounded rounded-5 my-3 d-none" id="profile_desc">
                                <div class="row">

                                    <span class="form-label fw-bold fs-5 mt-3 mx-2">User Description</span>

                                    <hr class="border border-2 border-dark">
                                
                                    <div class="col-12 text-center mb-3">
                                        <textarea cols="30" rows="10" class="form-control rounded rounded-5" id="desc"><?php echo($data["description"]); ?></textarea>
                                    </div>

                                </div>
                            </div>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">

                            <div class="col-12 bg-white rounded rounded-5 my-3 d-none" id="profile">
                                <div class="row">

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <h4 class="fw-bold">Profile Setting</h4>
                                    </div>

                                    <div class="row mt-3 mx-1 ">

                                        <div class="col-6">
                                            <label class="form-label">Frist Name</label>
                                            <input type="text" class="form-control form-control-solid placeholder-no-fix valid" value="<?php echo($data["fname"]); ?>" id="fname">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control" value="<?php echo($data["lname"]); ?>" id="lname">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" value="<?php echo($data["mobile"]); ?>" id="mobile">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" value="<?php echo($data["password"]); ?>" readonly >
                                                <span class="input-group-text bg-primary" id="basic-addon2">
                                                    <i class="bi bi-eye-slash text-white"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" value="<?php echo($data["email"]); ?>" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Registered Date</label>
                                            <input type="text" class="form-control" value="<?php echo($data["joined_date"]); ?>" readonly>
                                        </div>


                                        <?php                              
                                        if(!empty($address_data["line_1"])){
                                        ?>
                                            <div class="col-12">
                                                <label class="form-label">Address Line 01</label>
                                                <input type="text" class="form-control" value="<?php echo($address_data["line_1"]); ?>" id="line1"/>
                                            </div>

                                        <?php
                                        }else{
                                        ?>

                                            <div class="col-12">
                                                <label class="form-label">Address Line 01</label>
                                                <input type="text" class="form-control" id="line1"/>
                                            </div>

                                        <?php
                                        }
                                        ?>


                                        <?php 
                                        if(!empty($address_data["line_2"])){
                                        ?>

                                            <div class="col-12">
                                                <label class="form-label">Address Line 02</label>
                                                <input type="text" class="form-control" value="<?php echo($address_data["line_2"]); ?>" id="line2"/>
                                            </div>

                                        <?php
                                        }else{
                                        ?>

                                            <div class="col-12">
                                                <label class="form-label">Address Line 02</label>
                                                <input type="text" class="form-control" id="line2"/>
                                            </div>

                                        <?php
                                        }
                                        ?>


                                        <?php
                                        $province_rs = Database::search("SELECT * FROM `province`");
                                        $district_rs = Database::search("SELECT * FROM `district`");
                                        $city_rs = Database::search("SELECT * FROM `city`");
                                        ?>


                                        <div class="col-6">
                                            <label class="form-label">Province</label>
                                            <select class="form-select" id="province">
                                                <option value="0">Select Province</option>

                                                <?php
                                                    $province_num = $province_rs->num_rows;
                                                    for($x = 0; $x < $province_num; $x++){
                                                        $province_data = $province_rs->fetch_assoc();
                                                ?>

                                                    <option value="<?php echo $province_data["id"]; ?>" <?php
                                                    if (!empty($address_data["province_id"])) {

                                                        if ($province_data["id"] == $address_data["province_id"]) {
                                                            ?>selected<?php
                                                            }
                                                        }

                                                    ?>><?php echo $province_data["name"]; ?></option>

                                                <?php
                                                    }
                                                ?> 
                                                
                                            </select>
                                        </div>


                                        <div class="col-6">
                                            <label class="form-label">District</label>
                                            <select class="form-select" id="district">
                                                <option value="0">Select District</option>

                                                <?php
                                                    $district_num = $district_rs->num_rows;
                                                    for($x = 0; $x < $district_num; $x++){
                                                        $district_data = $district_rs->fetch_assoc();
                                                ?>

                                                    <option value="<?php echo $district_data["id"]; ?>" <?php
                                                    if (!empty($address_data["district_id"])) {

                                                        if ($district_data["id"] == $address_data["district_id"]) {
                                                            ?>selected<?php
                                                            }
                                                        }

                                                    ?>><?php echo $district_data["name"]; ?></option>

                                                <?php
                                                    }
                                                ?> 
                                                
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label class="form-label">City</label>
                                            <select class="form-select" id="city">
                                                <option value="0">Select City</option>

                                                <?php
                                                    $city_num = $city_rs->num_rows;
                                                    for($x = 0; $x < $city_num; $x++){
                                                        $city_data = $city_rs->fetch_assoc();
                                                ?>

                                                    <option value="<?php echo $city_data["id"]; ?>" <?php
                                                    if (!empty($address_data["city_id"])) {

                                                        if ($city_data["id"] == $address_data["city_id"]) {
                                                            ?>selected<?php
                                                            }
                                                        }

                                                    ?>><?php echo $city_data["name"]; ?></option>

                                                <?php
                                                    }
                                                ?> 
                                                
                                            </select>
                                        </div>

                                        <?php
                                        if(!empty($address_data["postal_code"])){
                                        ?>

                                            <div class="col-6">
                                                <label class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" value="<?php echo($address_data["postal_code"]); ?>" id="pcode"/>
                                            </div>

                                        <?php
                                        }else{
                                        ?>

                                            <div class="col-6">
                                                <label class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" id="pcode"/>
                                            </div>

                                        <?php
                                        } 
                                        ?>
                                        
                                        <div class="col-12">
                                            <label class="form-label">Gender</label>
                                            <input type="text" class="form-control" value="<?php echo($data["gender_name"]); ?>" readonly>
                                        </div>
                                        <div class="col-12 d-grid mt-3">
                                            <button class="btn btn-primary mb-3" onclick="updateProfile();">Update My Profile</button>
                                        </div>

                                        <div class="col-12 mb-2 text-center">
                                            <span class="text-secondary">You should update your profile for successful payment!!</span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            </div>
                        </div>

                    </div>
                </div>

                <?php
                }
                ?>

                <?php include "footer.php"; ?>
                
            </div>
        </div>   
        
        
        <script src="bootstrap.bundle.js"></script>

    </body>

</html>
