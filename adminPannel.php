<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

?>

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

    <body>

        <div id="cssLoader17" class="main-wrap main-wrap--white">
            <div class="cssLoader17"></div>
        </div>
        
        <div class="container-fluid d-block">
            <div class="row">

                <div class="col-12 bg-dark">
                    <div class="row">
                        <div class="col-12 col-lg-10 mt-2 my-lg-4">
                            <h1 class="offset-lg-6 offset-3 text-white fw-bold">Admin Pannel <i class="bi bi-person-circle"></i></h1>
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
                                    <button class="btn btn-outline-primary btn-light rounded-5" onclick="window.location='manageProducts.php'"><i class="bi bi-gear-wide-connected"></i> <b>Manage Products</b></button>
                                </div>
                                <div class="col-10 d-grid offset-1 my-2">
                                    <button class="btn btn-outline-warning btn-light rounded-5" onclick="window.location='manageUsers.php'"><i class="bi bi-person-badge"></i> <b>Manage Users</b></button>
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

                        <div class="col-12 col-lg-9 mt-4">
                            <div class="row">

                                <div class="col-11 mx-lg-4 mx-5">
                                    <div class="row gap-5">

                                        <?php
                                        
                                        $today = date("Y-m-d");
                                        $thismonth = date("m");
                                        $thisyear = date("Y");

                                        $a = "0";
                                        $b = "0";
                                        $c = "0";
                                        $e = "0";
                                        $f = "0";
                                        $p = "0";

                                        $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                        $invoice_num = $invoice_rs->num_rows;

                                        for ($x = 0; $x < $invoice_num; $x++) {
                                            $invoice_data = $invoice_rs->fetch_assoc();

                                            $f = $f + $invoice_data["qty"]; //total qty

                                            $d = $invoice_data["date"];
                                            $splitDate = explode(" ", $d); //separate date from time
                                            $pdate = $splitDate[0]; //sold date

                                            if ($pdate == $today) {
                                                $a = $a + $invoice_data["total"];
                                                $c = $c + $invoice_data["qty"];
                                            }

                                            $splitMonth = explode("-", $pdate); //separate date as year,month & date
                                            $pyear = $splitMonth[0]; //year
                                            $pmonth = $splitMonth[1]; //month

                                            if ($pyear == $thisyear) {
                                                if ($pmonth == $thismonth) {
                                                    $b = $b + $invoice_data["total"];
                                                    $e = $e + $invoice_data["qty"];
                                                    $p = $p + ($invoice_data["total"] / 100) * 5;
                                                }
                                            }

                                        }
                                        
                                        ?>

                                    <div class="col-lg-3 col-12 mx-lg-2 offset-1 offset-lg-0">
                                        <div class="card border-0" style="width: 18rem; background-image: linear-gradient(230deg, #759bff, #843cf6); font-family: 'Quicksand';">
                                            <div class="card-body text-center">
                                                <h5 class="card-title fs-4 text-white fw-bold">Daily Earnings</h5>
                                                <p class="card-text fs-6 text-white my-2">Rs. <?php echo $a; ?>.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12 mx-lg-4 offset-1 offset-lg-0">
                                        <div class="card border-0" style="width: 18rem; background-image: linear-gradient(230deg, #fc5286, #fbaaa2); font-family: 'Quicksand';">
                                            <div class="card-body text-center">
                                                <h5 class="card-title fs-4 text-white fw-bold">Monthly Earnings</h5>
                                                <p class="card-text fs-6 text-white my-2">Rs. <?php echo $b; ?>.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12 mx-lg-2 offset-1 offset-lg-0">
                                        <div class="card border-0" style="width: 18rem; background-image: linear-gradient(230deg, #ffc480, #ff763b); font-family: 'Quicksand';">
                                            <div class="card-body text-center">
                                                <h5 class="card-title fs-4 text-white fw-bold">Today Sellings</h5>
                                                <p class="card-text fs-6 text-white my-2"><?php echo $c; ?> Items</p>
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                                <div class="col-11 mx-lg-4 mx-5 mt-lg-3 mt-5">
                                    <div class="row gap-5">

                                    <div class="col-lg-3 col-12 mx-lg-2 offset-1 offset-lg-0">
                                        <div class="card border-0" style="width: 18rem;     background-image: linear-gradient(230deg, #d96f6f, #bd0101); font-family: 'Quicksand';">
                                            <div class="card-body text-center">
                                                <h5 class="card-title fs-4 text-white fw-bold">Monthly Sellings</h5>
                                                <p class="card-text fs-6 text-white my-2"><?php echo $e; ?> Items</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12 mx-lg-4 offset-1 offset-lg-0">
                                        <div class="card border-0" style="width: 18rem; background-image: linear-gradient(230deg, #6fd96f, #03b203); font-family: 'Quicksand';">
                                            <div class="card-body text-center">
                                                <h5 class="card-title fs-4 text-white fw-bold">Total Selling</h5>
                                                <p class="card-text fs-6 text-white my-2"><?php echo $f; ?> Items</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12 mx-lg-2 offset-1 offset-lg-0">
                                        <div class="card border-0" style="width: 18rem; background-image: linear-gradient(230deg, #cb80ff, #9e0099); font-family: 'Quicksand';">
                                            <div class="card-body text-center">
                                                <h5 class="card-title fs-4 text-white fw-bold">Total Engagements</h5>
                                                    <?php
                                                    $user_rs = Database::search("SELECT * FROM `user`");
                                                    $user_num = $user_rs->num_rows;
                                                    ?>
                                                <p class="card-text fs-6 text-white my-2"><?php echo $user_num; ?> Members</p>
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="row">

                                        <div class="col-lg-8 col-10 offset-1 text-center bg-black offset-lg-2" style="background-image: linear-gradient(230deg, #406af7, #16003c); font-family: 'Quicksand';">
                                            <div class="row">
                                                <span class="fs-2 my-2 text-white">Monthly Profit</span>
                                                <p class="fs-6 text-white mb-3">Rs. <?php echo $p; ?>.00</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 bg-dark mt-4" style="font-family: 'Quicksand';">
                                    <div class="row">
                                        <div class="col-4 my-3 text-center">
                                            <span class="text-start text-white fs-4">Total Active Time</span>
                                        </div>
                                        <div class="col-8 my-3 text-end ">
                                            
                                            <?php

                                            $start_date = new DateTime("2022-09-27 00:00:00");

                                            $tdate = new DateTime();
                                            $tz = new DateTimeZone("Asia/Colombo");
                                            $tdate->setTimezone($tz);

                                            $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                            $difference = $end_date->diff($start_date);

                                            ?>

                                            <span class="text-warning fs-4">
                                            <?php
                                            echo $difference->format('%Y') . "Y - " . $difference->format('%m') . "M - " .
                                                $difference->format('%d') . "D | " . $difference->format('%H') . "H : " .
                                                $difference->format('%i') . "M : " . $difference->format('%s') . "S ";
                                            ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mx-4 col-10 col-lg-5 my-4 rounded bg-body">
                                    <div class="row g-1">
                                        <div class="col-12 text-center">
                                            <label class="form-label fs-4 fw-bold">Mostly Sold Item</label>
                                        </div>

                                            <?php
                                            $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence`
                                            FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY
                                            `value_occurence` DESC LIMIT 1");

                                            $freq_num = $freq_rs->num_rows;
                                            if ($freq_num > 0) {
                                                $freq_data = $freq_rs->fetch_assoc();

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                                $image_data = $image_rs->fetch_assoc();

                                                $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE
                                                `product_id`='" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                                $qty_data = $qty_rs->fetch_assoc();
                                            ?>
                                        
                                            <div class="col-10 text-center shadow offset-1">
                                                <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                            </div>
                                            <div class="col-12 text-center">
                                                <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span><br />
                                                <span class="fs-6"><?php echo $product_data["qty"]; ?> items</span><br />
                                                <span class="fs-6">Rs. <?php echo $product_data["price"]; ?>.00</span>
                                            </div>
                                            
                                            <?php
                                            }else{

                                                ?>
                                                <div class="col-10 text-center shadow offset-1">
                                                    <img src="resource/empty.svg" class="img-fluid rounded-top" style="height: 250px;" />
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span class="fs-5 fw-bold">-----</span><br />
                                                    <span class="fs-6">--- items</span><br />
                                                    <span class="fs-6">Rs. ----- .00</span>
                                                </div>
                                                <?php

                                            }
                                            ?>
                                        
                                        <div class="col-12">
                                            <div class="frist-palce"></div>
                                        </div>
            
                                    </div>
                                </div>
                                <div class="offset-1 col-10 col-lg-5 my-3 rounded bg-body">
                                    <div class="row g-1">
                                        <div class="col-12 text-center">
                                            <label class="form-label fs-4 fw-bold">Mostly Famouse Seller</label>
                                        </div>

                                            <?php

                                            if ($freq_num > 0) {

                                                $profile_rs = Database::search("SELECT * FROM `profile_image` WHERE
                                            `user_email`='" . $product_data["user_email"] . "'");
                                                $profile_data = $profile_rs->fetch_assoc();

                                                $user_rs1 = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                $user_data1 = $user_rs1->fetch_assoc();

                                            ?>
                                        
                                                <div class="col-10 text-center offset-1 shadow">
                                                    <img src="<?php echo $profile_data["path"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span class="fs-5 fw-bold"><?php echo $user_data1["fname"]." ".$user_data1["lname"]; ?></span><br />
                                                    <span class="fs-6"><?php echo $user_data1["email"]; ?></span><br />
                                                    <span class="fs-6"><?php echo $user_data1["mobile"]; ?></span>
                                                </div>

                                            <?php
                                            }else{

                                                ?>

                                                <div class="col-10 text-center offset-1 shadow">
                                                    <img src="resource/empty.svg" class="img-fluid rounded-top" style="height: 250px;" />
                                                </div>
                                                <div class="col-12 text-center">
                                                    <span class="fs-5 fw-bold">---- ----</span><br />
                                                    <span class="fs-6">----@gmail.com</span><br />
                                                    <span class="fs-6">----------</span>
                                                </div>

                                                <?php
                                                
                                            }
                                            ?>
                                        
                                        <div class="col-12">
                                            <div class="frist-palce"></div>
                                        </div>
            
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