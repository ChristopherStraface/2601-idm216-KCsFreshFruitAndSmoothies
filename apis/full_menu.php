<?php
    header('Content-Type: application/json');

    include("../include/database.php");
    include("../include/fetch_products.php");
        
    $json = json_encode($products);
    echo $json;
?>
