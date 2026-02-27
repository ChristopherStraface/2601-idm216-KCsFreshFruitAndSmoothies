<?php
    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_POST)) {
        $_SESSION['cart'][] = $_POST;
    }

    include("../include/database.php");
    include("../include/fetch_products.php");

    // The tax rate in Philly is 6% state plus 2% local, subject to change.
    $tax_rate = 0.08;

    $page_title = "Cart";
    $subtotal = 0;

    $product_ids = array_column($products, 'id');

    function stringify($array) {
        if (isset($array)) {
            $string = implode(", ", $array);
            return $string;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./table.css">
</head>
<body>
    <h1><?= $page_title ?></h1>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Size</th>
                <th>Ingredients</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody><?php 
            foreach ($_SESSION['cart'] as $cart_item) {
                print_r($cart_item);
                $index = array_search($cart_item["id"], $product_ids);
                $target_item = $products[$index]; ?>
                <tr>
                    <?php
                        if (isset($cart_item["ingredients"])) { 
                            $stringified_ingredients = stringify($cart_item["ingredients"]);
                        } else {
                            $stringified_ingredients = "";
                        }
                        $row_price = $target_item["prices"][$cart_item["size"]];
                    ?>
                    <td><?= $target_item["id"] ?></td>
                    <td><?= $target_item["name"] ?></td>
                    <td><?= ucfirst($cart_item["size"]) ?></td>
                    <td><?= $stringified_ingredients; ?></td>
                    <td>$<?= $row_price ?></td>
                    <?php $subtotal += $row_price; ?>
                </tr><?php 
                
                if (isset($cart_item["add_ons"])) { 
                    foreach ($cart_item["add_ons"] as $add_on) { ?>
                        <tr>
                            <td></td>
                            <td>Add-on</td>
                            <td></td>
                            <td><?= $add_on ?></td>
                            <td>$1.00</td>
                            <?php $subtotal += 1.00; ?>
                        </tr><?php 
                    }
                }
            } ?>

            <tfoot>
            <tr class="total">
                <td></td>
                <td>Subtotal</td>
                <td></td>
                <td></td>
                <td>$<?= number_format($subtotal, 2) ?></td>
            </tr>
            <tr>
                <?php $tax = $subtotal * $tax_rate; ?>
                <td></td>
                <td>Tax</td>
                <td></td>
                <td>6% State, 2% Local</td>
                <td>$<?= number_format($tax, 2) ?></td>
            </tr>
            <tr class="total">
                <?php $total = $subtotal + $tax; ?>
                <td></td>
                <td>Total</td>
                <td></td>
                <td></td>
                <td>$<?= number_format($total, 2) ?></td>
            </tr>
        </tfoot>
        </tbody>
    </table>

    <form 
        id="clear_cart"
        method="post"
        action="./clear_cart.php">
    </form>

    <section class="buttons">
        <a href="./main.php" class="btn">Back to Menu</a>
        <button type="submit" form="clear_cart">Checkout</button>
    </section>
</body>
</html>
