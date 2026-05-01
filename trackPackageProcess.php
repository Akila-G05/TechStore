<?php

require "connection.php";

$search = $_GET["text"];

$invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$search."'");
$invoice_num = $invoice_rs->num_rows;

if(empty($search)){
    echo("1");
}else if($invoice_num == 0){
    echo("2");
}else if($invoice_num > 0){

    $invoice_data = $invoice_rs->fetch_assoc();

    ?>

    <div class="col-12">
        <div class="row">

            <span class="form-label fs-5 fw-bold mt-3 mb-1">ORDER ID : <?php echo $invoice_data["order_id"]; ?></span><br>

            <div class="col-8 mb-3">
                <span class="form-label">Status : </span>  
                
                <?php
                
                if($invoice_data["status"] == 0){
                    ?>
                    <span class="form-label text-danger fw-bold">Order Confirmed</span> 
                    <?php
                }else if($invoice_data["status"] == 1){
                    ?>
                    <span class="form-label text-warning fw-bold">Packing</span> 
                    <?php
                }else if($invoice_data["status"] == 2){
                    ?>
                    <span class="form-label text-info fw-bold">Dispatch</span> 
                    <?php
                }else if($invoice_data["status"] == 3){
                    ?>
                    <span class="form-label text-primary fw-bold">Shipping</span> 
                    <?php
                }else if($invoice_data["status"] == 4){
                    ?>
                    <span class="form-label text-Success fw-bold">Deliverd</span> 
                    <?php
                }

                ?>
            </div>

        </div>
    </div>

    <?php

}

?>