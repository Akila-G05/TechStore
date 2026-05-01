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

        <title>Manage Users | Tech Store</title>

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
                            <h1 class="text-center text-white fw-bold">Manage Users <i class="bi bi-person-badge"></i></h1>
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

                                        <div class="col-lg-8 col-9 mt-2 offset-lg-1 offset-1 ">
                                            <input type="text" class="form-control border-1 border-dark" placeholder="Enter username..." id="text">
                                        </div>
                                        <div class="col-2 mt-2 d-grid">
                                            <button class="btn btn-outline-primary rounded rounded-5" onclick="findusers(0)">Search</button>
                                        </div>

                                        <div class="col-12">
                                           
                                            <div class="col-10 mt-5 offset-lg-1 offset-1 border border-secondary rounded-5 border-1 bg-secondary d-none d-lg-block">  
                                                <div class="row">

                                                    <div class="col-4 mt-2 mb-2 offset-1">
                                                        <span class="form-label fw-bold text-white mx-3">NAME</span><br>
                                                    </div>

                                                    <div class="col-2 mt-2">
                                                        <span class="form-label fw-bold text-white">MOBILE</span><br>
                                                    </div>

                                                    <div class="col-3 mt-2">
                                                        <span class="form-label fw-bold text-white">REGISTER DATE</span><br>
                                                    </div>

                                                </div>
                                            </div>
                                    
                                        </div>

                                        <div class="col-12" id="result">
                                            <div class="align-items-start">

                                            <?php
                                            
                                            if(isset($_GET["page"])){
                                                $pageno = $_GET["page"];
                                            }else{
                                                $pageno = 1;
                                            }

                                            $user_rs = Database::search("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;

                                            $results_per_page = 10;
                                            $number_of_page = ceil($user_num/$results_per_page);

                                            $page_results = ($pageno - 1) * $results_per_page;

                                            $selected_rs = Database::search("SELECT * FROM `user` ORDER BY `joined_date` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");
                                            $selected_num = $selected_rs->num_rows;

                                            for($x = 0; $x < $selected_num; $x++){
                                                $selected_data = $selected_rs->fetch_assoc();

                                                $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$selected_data["email"]."'");
                                                $img_data = $img_rs->fetch_assoc();

                                                $d = $selected_data["joined_date"];
                                                $splitDate = explode(" ",$d);
                                                $date = $splitDate[0];

                                            ?>
                                        
                                            <div class="col-lg-10 col-12 mt-1 offset-lg-1 offset-1 border border-secondary rounded-5 border-1 ">                                        
                                                <div class="row">

                                                    <div class="col-lg-1 col-3 offset-lg-0 offset-1">
                                                        <?php
                                                        if(isset($img_data["path"])){

                                                            ?>
                                                            <img src="<?php echo $img_data["path"]; ?>" class="rounded rounded-5" style="width:55px"/>  
                                                            <?php

                                                        }else{

                                                            ?>
                                                            <img src="resource/user.svg" class="rounded rounded-5" style="width:55px"/>  
                                                            <?php

                                                        } 
                                                        ?>
                                                    </div>
                                                    
                                                    <div class="col-lg-4 col-6 mt-1">
                                                        <span class="form-label fw-bold text-black"><?php echo $selected_data["fname"]." ".$selected_data["lname"] ?></span><br>
                                                        <span class="form-label fw-bold text-secondary" style="font-size: 13px;"><?php echo $selected_data["email"]; ?></span>
                                                    </div>

                                                    <div class="col-lg-2 offset-lg-0 offset-1 col-4 mt-3">
                                                        <span class="form-label fw-bold "><?php echo $selected_data["mobile"]; ?></span>
                                                    </div>

                                                    <div class="col-lg-3 col-3 mt-3">
                                                        <span class="form-label fw-bold text-secondary"><?php echo $date; ?></span>
                                                    </div>

                                                    <div class="col-2 mt-2 ">
                                                        <?php

                                                        if($selected_data["status"] == 0) {

                                                            ?>
                                                            <button class="btn btn-danger rounded-5" id="ub<?php echo ($selected_data['email']); ?>" onclick="blockUser('<?php echo ($selected_data['email']) ?>');">Block</button>
                                                            <?php

                                                        }else{

                                                            ?>
                                                            <button class="btn btn-success rounded-5" id="ub<?php echo ($selected_data['email']); ?>" onclick="blockUser('<?php echo ($selected_data['email']) ?>');">Unblock</button>
                                                            <?php

                                                        }

                                                        ?>
                                                    </div>

                                                </div>
                                            </div>

                                            <?php

                                            }
                                            
                                            ?>

                                           
                                              
                                            <!-- pagination -->
                                            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
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