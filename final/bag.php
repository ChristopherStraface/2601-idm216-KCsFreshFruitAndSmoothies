<?php
    include './database.php';

    // Avoid doing the calculation right after receiving the data from the previous page

    // Set subtotal to 0
    $_SESSION['subtotal'] = 0;

    // Loop through all items in the cart
    foreach ($_SESSION['cart'] as $item) {
        // Fetch the product's information
        $target_item = get_item_info($item["id"], $products);
        // Find the corresponding price
        $item_price = $target_item["prices"][$item["size"]];
        // Add the item subtotal to the overall subtotal
        $_SESSION['subtotal'] += $item_price * $item["count"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bag — KC's</title>

    <!-- Fetch fonts and general CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div class="app-container">

        <?php include './component/header.php' ?>

        <main class="main-content"><div class="screen active">

            <!-- Return to the homepage -->
            <a href="./index.php" class="back-btn" style="position:fixed;top:24px;left:24px;z-index:200;text-decoration:none;display:flex;align-items:center;justify-content:center;width:36px;height:36px;">
                <svg viewBox="0 0 36 36" fill="none" style="width:36px;height:36px;">
                    <path d="M22.5 9L13.5 18L22.5 27" stroke="#1A1A1A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                </svg>
            </a>

            <div class="bag-content">

                <h2 class="screen-title">Your Items</h2>
                
                <?php if ($_SESSION['cart']) { ?>

                    <!-- If cart is not empty -->
                    <div class="cart-items" id="cartItems">
                    
                        <?php
                            // Loop through all items in the cart
                            foreach ($_SESSION['cart'] as $index => $item) {

                                // Fetch the targeted product information
                                $target_item = get_item_info($item["id"], $products);

                                // Stringify the ingredient and add-on lists
                                $selected_ingredients = isset($item["ingredients"]) ? implode(", ", $item["ingredients"]) : "";
                                $selected_add_ons = isset($item["add_ons"]) ? implode(", ", $item["add_ons"]) : "";

                                // Concatenate the ingredient and add-on lists
                                if ($selected_ingredients && $selected_add_ons) {
                                    $extras = $selected_ingredients . ", " . $selected_add_ons;
                                } else if ($selected_ingredients) {
                                    $extras = $selected_ingredients;
                                } else if ($selected_add_ons) {
                                    $extras = $selected_add_ons;
                                } else {
                                    $extras = "";
                                }

                                // Fetch the price for the corresponding size
                                $item_price = $target_item["prices"][$item["size"]];
                        ?>

                            <div class="cart-item">

                                <!-- Add product image -->
                                <img src="./images/<?= $target_item["image"] ?>" alt="<?= $target_item["name"] ?>" class="cart-item-image">

                                <div class="cart-item-details">

                                    <div class="cart-item-header"><div>

                                        <!-- Add product name -->
                                        <div class="cart-item-name"><?= $target_item["name"] ?></div>

                                        <!-- Add product size -->
                                        <div class="cart-item-size"><?= ucfirst($item["size"]) ?></div>

                                    </div></div>

                                    <!-- Show ingredients and add-ons -->
                                    <div class="cart-item-ingredients"><?= $extras ?></div>

                                    <div class="cart-item-footer">

                                        <!-- Reroute all processes through the bag functions page -->
                                        <div class="number-button" role="group" aria-label="Quantity selector">

                                            <a href="./bag_functions.php?index=<?= $index ?>&action=minus" class="step-btn minus" aria-label="Decrease">−</a>

                                            <span class="value"><?= $item["count"] ?></span>

                                            <a href="./bag_functions.php?index=<?= $index ?>&action=plus" class="step-btn plus" aria-label="Increase">+</a>

                                        </div>

                                        <!-- Show singular item price -->
                                        <div class="cart-item-price">$<?= $item_price ?></div>

                                    </div>

                                    <div class="item-actions">

                                        <!-- For editing, have the user restart the customization process -->
                                        <a href="./customize.php?id=<?= $item["id"] ?>" class="item-action-btn edit-btn" style="text-decoration:none;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                            </svg>
                                            Edit
                                        </a>

                                        <!-- Reroute the removal process through the bag functions page -->
                                        <a href="./bag_functions.php?remove=<?= $index ?>" class="item-action-btn remove-btn">Remove</a>

                                    </div>

                                </div>

                            </div>

                        <?php } ?>

                    </div>

                <?php } else { ?>

                    <!-- If the cart is empty -->
                    <div class="empty-cart" id="emptyState" style="display:none;">

                        <p>Don't leave your cup empty!</p>

                        <a href="./index.php" class="secondary-btn" style="text-decoration:none;display:inline-block;text-align:center;">Start Mixing</a>

                    </div>

                <?php } ?>

                <div class="cart-summary" id="cartSummary">

                    <div class="summary-row">

                        <span>Subtotal</span>

                        <span id="subtotalAmount">$<?= number_format($_SESSION['subtotal'], 2) ?></span>

                    </div>

                    <!-- Go to the checkout page -->
                    <a href="./checkout.php" class="checkout-btn" style="text-decoration:none;display:block;text-align:center;">Proceed to Checkout</a>

                </div>

            </div>

        </div></main>

        <?php include './component/footer.php' ?> 

    </div>
</body>
</html>
