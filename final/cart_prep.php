<?php
    include "./include/database.php";

    if (isset($_POST)) {
        // Receive new item from the customization page
        $added_item = $_POST;
        // Set the count of the new item to 1
        $added_item["count"] = 1;

        // Count the number of add-ons applied to the new item
        if (isset($added_item["add_ons"])) {
            $add_on_count = count($added_item["add_ons"]);
        } else {
            $add_on_count = 0;
        }
        
        // Fetch all product information about the new item
        $target_item = get_item_info($added_item["id"], $products);
        // Find the correct raw price for the corresponding size
        $target_size = $added_item["size"];
        $price_raw = $target_item["prices"][$target_size];

        // Find the unit subtotal of the new item
        $item_subtotal = $price_raw + $add_on_count;
        $item_multiply = $item_subtotal;

        // Add the raw price to the cart
        $added_item["unit_price"] = number_format($item_subtotal, 2);
        $added_item["item_subtotal"] = number_format($item_multiply, 2);

        // Add the new item to the cart
        array_push($_SESSION["cart"]["products"], $added_item);
    }

    redo_subtotal();

    // Go to other pages
    header('Location: ./cart.php');
    exit;
?>
