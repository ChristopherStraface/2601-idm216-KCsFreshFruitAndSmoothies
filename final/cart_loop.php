<?php
    include "./include/database.php";

    if (isset($_GET["action"]) && isset($_GET["index"])) {
        $action = $_GET["action"];
        $item_index = $_GET["index"];
        $action_item = $_SESSION["cart"]["products"][$item_index];
        $item_id = $action_item["id"];
        $current_count = $action_item["count"];
        $unit_price = $action_item["unit_price"];

        switch ($action) {
            case "decrease":
                if ($current_count > 1) {
                    $current_count -= 1;
                    $_SESSION["cart"]["products"][$item_index]["count"] = $current_count;
                    $_SESSION["cart"]["products"][$item_index]["item_subtotal"] = number_format($unit_price * $current_count, 2);
                }
                break;
            case "increase":
                $current_count += 1;
                $_SESSION["cart"]["products"][$item_index]["count"] = $current_count;
                $_SESSION["cart"]["products"][$item_index]["item_subtotal"] = number_format($unit_price * $current_count, 2);
                break;
            case "edit":
                unset($_SESSION["cart"]["products"][$item_index]);
                break;
            case "remove":
                unset($_SESSION["cart"]["products"][$item_index]);
                break;
            default: return null;
        }

        $_SESSION["cart"]["products"] = array_values($_SESSION["cart"]["products"]);
    }

    redo_subtotal();

    // Go to other pages
    switch ($action) {
        case "edit":
            header('Location: ./customize.php?id=' . $item_id);
            break;
        default: 
            header('Location: ./cart.php');
    }
    exit;
?>
