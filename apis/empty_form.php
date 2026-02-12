<?php
    header('Content-Type: application/json');

    include("../include/database.php");
    include("../include/fetch_products.php");
    include("../include/build_form.php");
        
    $json = json_encode($form);
    echo $json;
?>
