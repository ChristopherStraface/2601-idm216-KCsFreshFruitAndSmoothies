<?php
    include("../include/database.php");
    include("../include/fetch_products.php");
    include("../include/build_form.php");

    // The tax rate in Philly is 6% state plus 2% local, subject to change.
    $tax_rate = 0.08;

    // Change a snake-case string to displayed item name.
    function de_snake_case($string) {
        $add_space = str_replace("_", " ", $string);
        $final_string = ucwords($add_space);
        return $final_string;
    }

    // Create empty variables to store receipt information.
    $selected_items = [];
    $cart_list = [];
    $subtotal = 0;

    if (isset($_POST['selected_items'])) {
        $selected_items = $_POST['selected_items'];
    }

    // For each selected item, find the corresponding sub-array in the form and increase the count. 
    foreach ($selected_items as $selected_item) {
        if (array_key_exists($selected_item, $form)) {
            $form[$selected_item]["count"] += 1;
        }
    }

    foreach ($form as $product_code => $form_item) {
        if ($form_item["count"] > 0) {
            // De-construct the product ID and size.
            $pcode_array = explode("-", $product_code);
            $product_id = $pcode_array[0];
            $product_size = de_snake_case($pcode_array[1]);

            // Calculate price for each item and add to subtotal.
            $item_total = number_format($form_item["price"] * $form_item["count"], 2);
            $subtotal += $item_total;

            $cart_list_item = [
                "id" => $product_id,
                "name" => $form_item["name"],
                "size" => $product_size,
                "unit_price" => $form_item["price"],
                "count" => $form_item["count"],
                "item_total" => $item_total
            ];
            array_push($cart_list, $cart_list_item);
        }
    }

    // Calculate total.
    $subtotal = number_format($subtotal, 2);
    $tax = number_format($subtotal * $tax_rate, 2);
    $total = number_format($subtotal + $tax, 2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KC's - Receipt</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./table.css">
</head>
<body>
    <table>
        <caption>Your Receipt</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Size</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart_list as $cart_list_item) { ?>
                <tr>
                    <td><?= $cart_list_item["id"] ?></td>
                    <td><?= $cart_list_item["name"] ?></td>
                    <td><?= $cart_list_item["size"] ?></td>
                    <td>$<?= $cart_list_item["item_total"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="total">
                <td>Subtotal</td>
                <td></td>
                <td></td>
                <td>$<?= $subtotal ?></td>
            </tr>
            <tr>
                <td>Tax (8%)</td>
                <td></td>
                <td></td>
                <td>$<?= $tax ?></td>
            </tr>
            <tr class="total">
                <td>Total</td>
                <td></td>
                <td></td>
                <td>$<?= $total ?></td>
            </tr>
        </tfoot>
    </table>

    <a href="main.php">Return to Menu</a>
</body>
</html>
