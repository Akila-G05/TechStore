
<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home | Tech Store</title>

        <link rel="icon" href="resource/logor.png"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body>

        <div class="container-fluid" style="background-color: #fafbfd;">
            <div class="row">

                <div id="cssLoader17" class="main-wrap main-wrap--white">
                    <div class="cssLoader17"></div>
                </div>

                <?php include "header.php"; ?>

                <div class="col-12 mt-5">
                    <div class="row">

                        <div class="col-9 mx-auto border border-2 bg-white">
                            <div class="row">

                                <span class="form-label fs-4 fw-bold mt-2 mb-3">Track Your Package</span><br>

                                <div class="col-8 mb-4">
                                    <input class="form-control" type="text" placeholder="ENTER YOUR ORDER ID..." id="search" required>      
                                </div>

                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary text-white fw-bold rounded-5" onclick="trackPackage();">Search</button>
                                </div>

                            </div>
                        </div>

                        <div class="col-9 mx-auto border border-2 bg-white mt-5" id="result">

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
    </body>

</html>