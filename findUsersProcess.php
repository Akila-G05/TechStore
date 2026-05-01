<?php

require "connection.php";

$txt = $_POST["txt"];

$query = "SELECT * FROM `user`";

if(!empty($txt)){
    $query .= " WHERE `fname` LIKE '%" . $txt . "%' OR `lname` LIKE '%" . $txt . "%'";
}

?>

<div class="align-items-start">

    <?php
    
    if ("0" != ($_POST["page"])) {
        $pageno = $_POST["page"];
    } else {
        $pageno = 1;
    }

    $user_rs = Database::search($query);
    $user_num = $user_rs->num_rows;

    $results_per_page = 10;
    $number_of_page = ceil($user_num/$results_per_page);

    $page_results = ($pageno - 1) * $results_per_page;

    $selected_rs = Database::search($query . " ORDER BY `joined_date` DESC LIMIT ".$results_per_page." OFFSET ".$page_results."");
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

    </div>