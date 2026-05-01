<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tech Store</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="style.css"/>

        <link rel="icon" href="resource/logor.png"/>

    </head>

    <body class="main-body">

        <div id="cssLoader17" class="main-wrap main-wrap--white">
            <div class="cssLoader17"></div>
        </div>
        
        <div class="container-fluid vh-100 d-flex justify-content-center">
            <div class="row align-content-center">

                <!-- header -->
                <div class="col-12">
                    <div class="row">
                    <div class="col-12 logo"> </div>
                        <div class="col-12">
                            <p class="text-center title1">Hi,Welcome to Tech Store</p>
                        </div>
                    </div>
                </div>
                <!-- header -->

                <!-- content -->
                <div class="col-12 p-3 " id="signUpBox">
                    <div class="row">

                        <div class="col-6 d-none d-lg-block image"></div>

                        <div class="col-12 col-lg-6 wrapper">
                            <div class="row g-2">
                                <div class="col-12">
                                    <p class="title2">Create New Account</p>
                                </div>
                                
                               <!--  -->
                               <div class="col-12 d-none" id="msgdiv" >                              
                                    <div class="alert alert-danger d-flex align-items-center" role="alert" id="alertdiv">
                                        <div>
                                            <i class="bi bi-x-octagon-fill" id="msg"></i>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->

                                <div class="col-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fn"/>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="ln"/>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" id="e"/>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" id="pw"/>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="m"/>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Gender</label>
                                    <select class="form-select" id="g">
                                    <?php

                                    require "connection.php"; 

                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;

                                    for($x=0; $x<$n; $x++){
                                        $d = $rs->fetch_assoc();
                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"];?></option>

                                    <?php
                                    }
                                    ?>

                                    </select>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-primary" onclick="signup();">Sign Up</button>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-dark" onclick="changeView();">Already have an account?Sign In</button>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 p-3 d-none" id="signInBox">
                    <div class="row">

                        <div class="col-6 d-none d-lg-block image"></div>

                        <div class="col-12 col-lg-6 wrapper" >
                            <div class="row g-2">
                                <div class="col-12">
                                    <p class="title2">Log In</p>
                                </div>

                                 <!--  -->
                               <div class="col-12 d-none" id="msgdiv2" >                              
                                    <div class="alert alert-danger d-flex align-items-center" role="alert" id="alertdiv">
                                        <div>
                                            <i class="bi bi-x-octagon-fill" id="msg2"></i>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->

                                <?php
                                
                                $email = "";
                                $password ="";

                                if(isset($_COOKIE["email"])){
                                    $email = $_COOKIE["email"];
                                }
                                
                                if(isset($_COOKIE["password"])){
                                    $password = $_COOKIE["password"];
                                }

                                ?>

                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email2" value="<?php echo($email); ?>"/>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" id="p2" value="<?php echo($password); ?>"/>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="r">
                                        <label class="form-check-label">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="link-primary" onclick="forgotPw();">Forgot Password?</a>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-success" onclick="signIn();">Log In</button>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-danger" onclick="changeView();">New to New Tech?Join Now</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="row">
                                <a href="adminSignin.php" class="text-black text-end">Admin Signin</a>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- content -->

                <!-- modal -->
           
                <div class="modal" tabindex="-1" id="forgotPasswordModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reset Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">    
                                <div class="row g-3">
                                    
                                    <span class="text-success">Verification Code has sent to your Email. Please check your inbox.</span>
                                    <div class="col-6">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="npi"/>
                                            <button class="btn btn-outline-secondary" type="button" onclick="ShowPassword();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Re-type Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="rnp"/>
                                            <button class="btn btn-outline-secondary" type="button" onclick="ShowPassword2();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Verification Code</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="vc"/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                            </div>
                        </div>

                    </div>
                </div>
            
                <!-- modal -->

                <!-- footer -->

                <div class="col-12 fixed-bottom d-none d-lg-block">
                    <p class="text-center">&copy; 2022 TechStore.lk || All Right Reserved </p>
                </div>


                <!-- footer -->

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

</html>