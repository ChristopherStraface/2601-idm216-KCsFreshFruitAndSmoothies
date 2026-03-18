<?php 
    include "./include/database.php";

    $grand_subtotal = $_SESSION["receipt"]["grand_subtotal"];
    $tip_rate = $_SESSION["receipt"]["tip_rate"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed<?= $page_title_abbreviation ?></title>
    <?php include "./include/styles.php" ?>
    <link rel="stylesheet" href="./confirmation.css">
</head>
<body>
<div class="app-container">

    <?php include "./components/header.php" ?>

    <main class="main-content">
        <div class="screen active">
            <div class="confirmation-content">

                <!-- Hero order number -->
                <div class="confirm-hero">
                    <p class="confirm-hero-eyebrow">Your Order</p>
                    <div class="confirm-order-number" id="orderNumber"><?= $_SESSION["receipt"]["order_number"] ?></div>
                    <p class="confirm-order-label">Order Number</p>
                    <div class="confirm-pickup-pill">
                        <?php add_icons("confirm_pickup") ?>
                        Pick up in 15 minues</strong>
                    </div>
                </div>

                <!-- Friendly message -->
                <p class="confirm-message">KC's on it! 🍓</p>
                <p class="confirm-submessage">Head over when you're ready — we'll have it waiting.</p>

                <!-- Order summary card -->
                <div class="confirmation-summary">
                    <h3 class="section-title" style="margin-bottom:14px">What's in your cart</h3>
                    <div id="confirmationOrderItems" class="confirmation-order-items"></div>
                    <div class="divider"></div>
                    <div class="summary-row"><span>Subtotal</span><span id="confirmSubtotal">$<?= $grand_subtotal ?></span></div>
                    <div class="summary-row"><span>Tax</span><span id="confirmTax">$<?= number_format($grand_subtotal * $tax_rate, 2) ?></span></div>
                    <div class="summary-row total-row"><span>Total</span><span id="confirmTotal">$<?= number_format($grand_subtotal * (1 + $tax_rate), 2) ?></span></div>
                    <div class="summary-row"><span>Tip (Pending)</span><span id="confirmTip">$<?= number_format($grand_subtotal * $tip_rate, 2) ?></span></div>
                </div>

                <button onclick="window.location.href='./index.php'" id="returnHomeBtn" class="return-home-btn">Back to the Menu</button>

                <a href="./clear_receipt.php" id="pickedUpBtn" class="picked-up-btn">
                    <?php add_icons("check") ?>
                    I picked up my order
                </a>

            </div>
        </div>
    </main>

    <?php include "./components/footer.php" ?>

</div>
</body>
</html>