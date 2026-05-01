<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin Signin | Tech Store</title>

        <link rel="icon" href="resource/logor.png"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body class="bg">

        <div id="cssLoader17" class="main-wrap main-wrap--white">
            <div class="cssLoader17"></div>
        </div>
        
        <div class="container-fluid vh-100 d-flex justify-content-center">
            <div class="row align-content-center">

            <!-- signin -->
                <div class="col-10 col-lg-10 offset-lg-1 offset-1 signin">
                    <div class="row g-4">
                    
                        <div class="col-12">
                            <div class="row">
                                <span><a href="index.php" class="text-dark"><i class="bi bi-arrow-left-circle-fill fs-2"></i></a></span>
                            </div>
                        </div>

                        <div class="col-12 mt-1">

                            <div class="col-10 col-lg-6 offset-lg-3 offset-1 signin text-center ">
                                <span class="fs-2 my-3">Welcome</span>
                            </div><br>

                            <p class="title2 text-center">Admin SignIn</p>

                        </div>

                        <div class="col-lg-10 col-10 offset-1 mt-3">
                            <input type="text" class="form-control" placeholder="Enter Email" id="email"/>
                        </div>

                        <div class="col-6 col-lg-6 offset-3 d-grid mb-5">
                            <button class="btn btn-dark rounded rounded-5 text-white text-uppercase" onclick="sendVerificationCode();">SignIN</button>
                        </div>
                    </div>
                </div>
                <!-- signin -->

                <!--  -->
                
                <div class="modal" tabindex="-1" id="verificationModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label>Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                        </div>
                    </div>
                </div>

                <!--  -->

            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

</html>