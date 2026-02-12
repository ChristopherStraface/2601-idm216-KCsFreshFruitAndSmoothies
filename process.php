<?php
    include("include/database.php");
    include("include/fetch_products.php");
    include("include/build_form.php");

    $tax_rate = 8;

    $selected_items = [];

    if (isset($_POST['selected_items'])) {
        $selected_items = $_POST['selected_items'];
    }

    foreach ($selected_items as $selected_item) {
        if (array_key_exists($selected_item, $form)) {
            $form[$selected_item]["count"] += 1;
        }
    }

    $cart_list = [];
    $subtotal = 0;

    foreach ($form as $key => $form_item) {
        if ($form_item["count"] > 0) {
            $type_array = explode("_", $key);
            $product_id = $type_array[0];
            $product_size = $type_array[1];

            $item_total = $form_item["price"] * $form_item["count"];
            $subtotal += $item_total;

            $cart_list_item = [
                "id" => $type_array[0],
                "name" => $form_item["name"],
                "size" => $type_array[1],
                "unit_price" => $form_item["price"],
                "count" => $form_item["count"],
                "item_total" => $item_total
            ];
            array_push($cart_list, $cart_list_item);
        }
    }

    $tax = number_format($subtotal * $tax_rate / 100, 2);
    $total = number_format($subtotal + $tax, 2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="table.css">
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
                    <td><?= ucfirst($cart_list_item["size"]) ?></td>
                    <td><?= number_format($cart_list_item["item_total"], 2) ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="total">
                <td>Subtotal</td>
                <td></td>
                <td></td>
                <td><?= number_format($subtotal, 2) ?></td>
            </tr>
            <tr>
                <td>Tax (8%)</td>
                <td></td>
                <td></td>
                <td><?= $tax ?></td>
            </tr>
            <tr class="total">
                <td>Total</td>
                <td></td>
                <td></td>
                <td><?= $total ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
