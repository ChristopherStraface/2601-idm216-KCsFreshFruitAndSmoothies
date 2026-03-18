<?php include "./include/database.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart<?= $page_title_abbreviation ?></title>
    <?php include "./include/styles.php" ?>
</head>
<body>
<div class="app-container">

    <?php include "./components/header.php" ?>

    <main class="main-content">
        <div class="screen active">

            <a href="./index.php" class="back-btn" style="position:fixed;top:24px;left:24px;z-index:200;text-decoration:none;display:flex;align-items:center;justify-content:center;width:36px;height:36px;">
                <?php add_icons("left_chevron") ?>
            </a>

            <div class="cart-content">
                <h2 class="screen-title">Your Items</h2>

                <?php if (empty($_SESSION['cart']["products"])) { ?>

                <div class="empty-cart" id="emptyState">
                    <p>Don't leave your cup empty!</p>
                    <a href="./index.php" class="secondary-btn" style="text-decoration:none;display:inline-block;text-align:center;">Start Mixing</a>
                </div>

                <?php } else { ?>

                <div class="cart-items" id="cartItems">

                    <?php 
                        foreach ($_SESSION["cart"]["products"] as $index => $item) {
                            // Stringify the ingredient and add-on lists
                            $selected_ingredients = isset($item["ingredients"]) ? implode(", ", $item["ingredients"]) : "";
                            $selected_add_ons = isset($item["add_ons"]) ? implode(", ", $item["add_ons"]) : "";

                            // Concatenate the ingredient and add-on lists
                            if (isset($item["ingredients"]) && isset($item["add_ons"])) {
                                $extras = $selected_ingredients . ", " . $selected_add_ons;
                            } elseif (isset($item["ingredients"]) || isset($item["add_ons"])) {
                                $extras = $selected_ingredients . $selected_add_ons;
                            } else {
                                $extras = "";
                            }
                            $_SESSION["cart"]["products"][$index]["extras"] = $extras;

                            $basic_info = get_item_info($item["id"], $products);
                    ?>

                    <div class="cart-item">
                        <img src="../images/<?= $basic_info["image"] ?>" alt="<?= $basic_info["name"] ?>" class="cart-item-image">
                        <div class="cart-item-details">
                            <div class="cart-item-header">
                                <div>
                                    <div class="cart-item-name"><?= $basic_info["name"] ?></div>
                                    <div class="cart-item-size"><?= ucfirst($item["size"]) ?></div>
                                </div>
                            </div>
                            <div class="cart-item-ingredients"><?= $extras ?></div>
                            <div class="cart-item-footer">
                                <div class="number-button" role="group" aria-label="Quantity selector">
                                    <a href="./cart_loop.php?action=decrease&index=<?= $index ?>" class="step-btn minus" aria-label="Decrease">−</a>
                                    <span class="value"><?= $item["count"] ?></span>
                                    <a href="./cart_loop.php?action=increase&index=<?= $index ?>" class="step-btn plus" aria-label="Increase">+</a>
                                </div>
                                <div class="cart-item-price">$<?= $item["unit_price"] ?></div>
                            </div>
                            <div class="item-actions">
                                <a href="./cart_loop.php?action=edit&index=<?= $index ?>" class="item-action-btn edit-btn">
                                    <?php add_icons("edit") ?>
                                    Edit
                                </a>
                                <a href="./cart_loop.php?action=remove&index=<?= $index ?>" class="item-action-btn remove-btn">Remove</a>
                            </div>
                        </div>
                    </div>

                </div>

                <?php } ?>

                <div class="cart-summary" id="cartSummary">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="subtotalAmount">$<?= $_SESSION["cart"]["calculation"]["subtotal"] ?></span>
                    </div>
                    <a href="./checkout.php" class="checkout-btn" style="text-decoration:none;display:block;text-align:center;">
                        Proceed to Checkout
                    </a>
                </div>

                <?php } ?>

            </div>
        </div>
    </main>

    <?php include "./components/footer.php" ?>

</div>
</body>
</html>
