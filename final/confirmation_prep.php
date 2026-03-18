<?php
    include "./include/database.php";

    if (isset($_POST)) {
        $order_number = $_POST["order_number"];
        $grand_subtotal = $_SESSION["cart"]["calculation"]["subtotal"];
        $customer_name = $_POST["customer_name"] ?: "";

        $tip_percentage_string = $_POST["tip"] ?: "";
        $tip_percentage = intval($tip_percentage_string);
        $tip_rate = $tip_percentage / 100;
    }

    $cart_content = $_SESSION["cart"];

    $_SESSION["receipt"]["order_number"] = $order_number;
    $_SESSION["receipt"]["grand_subtotal"] = $grand_subtotal;
    $_SESSION["receipt"]["information"] = $cart_content;
    $_SESSION["cart"] = $cart_default;

    $_SESSION["receipt"]["tip_rate"] = $tip_rate;

    header('Location: ./confirmation.php');
    exit;
?>
