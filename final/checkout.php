<?php 
    include "./include/database.php";

    $grand_subtotal = $_SESSION["cart"]["calculation"]["subtotal"];

    function get_random_letter() {
        $characters = "ABCDEFGHJKLMNPRSTUVWXYZ";
        $randomIndex = random_int(0, strlen($characters) - 1);
        return $characters[$randomIndex];
    }
    $order_number = get_random_letter() . mt_rand(1, 999);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout<?= $page_title_abbreviation ?></title>
    <?php include "./include/styles.php" ?>
</head>
<body>
<div class="app-container">

    <?php include "./components/header.php" ?>

    <form action="confirmation_prep.php" method="post" id="checkout">
        <input type="hidden" name="order_number" value="<?= $order_number ?>">
    </form>

    <main class="main-content">
        <div class="screen active">

            <a href="cart.php" class="back-btn" style="position:fixed;top:24px;left:24px;z-index:200;text-decoration:none;display:flex;align-items:center;justify-content:center;width:36px;height:36px;">
                <?php add_icons("left_chevron") ?>
            </a>

            <div class="checkout-content">
                <h2 class="screen-title">Checkout</h2>

                <!-- Pick-Up Time -->
                <div class="section">
                    <h3 class="section-title">Pick-Up Time</h3>
                    <button class="pickup-option active">
                        <span>ASAP (10-15 Minutes)</span>
                        <div class="radio-btn"><div class="radio-dot"></div></div>
                    </button>
                    <button class="pickup-option disabled">
                        <span>Schedule Ahead</span>
                        <div class="radio-btn"><div class="radio-dot"></div></div>
                    </button>
                </div>

                <!-- Pick-up Name -->
                <div class="section">
                    <h3 class="section-subtitle">Pick-up Name</h3>
                    <input type="text" id="pickupName" class="text-input" placeholder="ex. Jordan Doe" autocomplete="given-name" form="checkout" name="customer_name">
                </div>

                <!-- Payment -->
                <div class="section">
                    <h3 class="section-title">Payment Method</h3>

                    <button class="payment-option active" id="pay-apple" onclick="selectPayment(this, 'apple')">
                        <div class="payment-left">
                            <span class="payment-icon apple-icon">
                                <?php add_icons("apple") ?>
                            </span>
                            <span>Apple Pay</span>
                        </div>
                        <div class="radio-btn"><div class="radio-dot"></div></div>
                    </button>

                    <button class="payment-option disabled" id="pay-venmo">
                        <div class="payment-left">
                            <div class="payment-icon venmo-icon"><span>V</span></div>
                            <span>Venmo</span>
                        </div>
                        <div class="radio-btn"><div class="radio-dot"></div></div>
                    </button>

                    <button class="payment-option disabled" id="pay-credit">
                        <div class="payment-left">
                            <?php add_icons("credit_card") ?>
                            <span>Credit Card</span>
                        </div>
                        <div class="radio-btn"><div class="radio-dot"></div></div>
                    </button>
                </div>

                <!-- Order Summary -->
                <div class="section">
                    <h3 class="section-title">Order Summary</h3>
                    <div class="checkout-order-items">
                        <?php 
                            foreach ($_SESSION["cart"]["products"] as $item) {
                                if ($item["extras"]) {
                                    $concatenated_info = ucfirst($item["size"]) . ", " . $item["extras"];
                                } else {
                                    $concatenated_info = ucfirst($item["size"]);
                                }
                                $basic_info = get_item_info($item["id"], $products);
                                $item_name = $basic_info["name"];
                        ?>
                        <div class="order-item">
                            <div class="order-item-header">
                                <span><?= $item["count"] ?>x <?= $item_name ?></span>
                                <span>$<?= $item["item_subtotal"] ?></span>
                            </div>
                            <div class="order-item-details"><?= $concatenated_info ?></div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="divider"></div>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="sumSubtotal">$<?= $grand_subtotal ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Tax</span>
                        <span id="sumTax">$<?= number_format($grand_subtotal * $tax_rate, 2) ?></span>
                    </div>
                    <div class="summary-row total-row">
                        <span>Total</span>
                        <span id="sumTotal">$<?= number_format($grand_subtotal * (1 + $tax_rate), 2) ?></span>
                    </div>
                </div>

                <!-- Tip -->
                <div class="section">
                    <h3 class="section-title">Leave a tip for KC!</h3>
                    <div class="tip-options">
                        <label class="tip-btn" onclick="selectTip(this)">
                            No Tip
                            <input type="radio" form="checkout" name="tip" value="0" style="appearance: none;">
                        </label>

                        <label class="tip-btn" onclick="selectTip(this)">
                            15%
                            <input type="radio" form="checkout" name="tip" value="15" style="appearance: none;">
                        </label>

                        <label class="tip-btn" onclick="selectTip(this)">
                            20%
                            <input type="radio" form="checkout" name="tip" value="20" style="appearance: none;">
                        </label>
                    </div>
                </div>

            <button class="place-order-btn" id="placeOrderBtn">Place Order</button>

            </div>
        </div>
    </main>

    <?php include "./components/footer.php" ?>

</div>

<!-- Apple Pay Modal  -->
<div id="applePayOverlay">
    <div id="applePaySheet">
        <div class="ap-topbar"><div class="ap-notch"></div></div>
        <div class="ap-header">
            <div class="ap-logo">
                <?php add_icons("apple_pay") ?>
                <span>Pay</span>
            </div>
            <div class="ap-merchant">KC's Fresh Fruit &amp; Smoothies</div>
            <div class="ap-amount" id="apAmount">$<?= number_format($grand_subtotal * (1 + $tax_rate), 2) ?></div>
        </div>
        <div class="ap-card-section">
            <div class="ap-card">
                <div class="ap-card-top">
                    <div class="ap-card-bank">Chase</div>
                    <div class="ap-card-chip"></div>
                </div>
                <div class="ap-card-bottom">
                    <div class="ap-card-dots">•••• •••• •••• 4242</div>
                    <?php add_icons("visa") ?>
                </div>
            </div>
            <div class="ap-card-label">Visa ···· 4242</div>
        </div>
        <div class="ap-faceid-section" id="apFaceIdSection">
            <div class="ap-faceid-ring" id="apFaceIdRing">
                <div class="ap-faceid-icon" id="apFaceIdIcon">
                    <?php add_icons("face_id") ?>
                </div>
            </div>
            <p onclick="submitForm()" class="ap-faceid-label" id="apFaceIdLabel" style="cursor: pointer;">Click me to pay</p>
        </div>
        <div class="ap-success-section hidden" id="apSuccessSection">
            <div class="ap-success-ring">
                <?php add_icons("apple_pay_success") ?>
            </div>
            <p class="ap-success-label">Done</p>
        </div>
        <button class="ap-cancel-btn" id="apCancelBtn">Cancel</button>
    </div>
</div>

<script>
    document.getElementById('apCancelBtn').addEventListener('click', () => {
        document.getElementById('applePayOverlay').classList.remove('active');
    });

    function submitForm() {
        simulateFaceIdScan();
    }

    function selectTip(btn) {
        document.querySelectorAll('.tip-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    document.getElementById('placeOrderBtn').addEventListener('click', function(e) {
    e.preventDefault();
    openApplePaySheet();
});

function openApplePaySheet() {
    const total = <?= number_format($grand_subtotal * (1 + $tax_rate), 2) ?>;
    document.getElementById('apAmount').textContent = '$' + total.toFixed(2);
    document.getElementById('apFaceIdSection').classList.remove('hidden');
    document.getElementById('apSuccessSection').classList.add('hidden');
    document.getElementById('apFaceIdRing').classList.remove('scanning', 'success');
    document.getElementById('apFaceIdIcon').classList.remove('scanning');
    document.getElementById('apCancelBtn').classList.remove('hidden');
    document.getElementById('applePayOverlay').classList.add('active');
}

function simulateFaceIdScan() {
    const ring = document.getElementById('apFaceIdRing');
    const icon = document.getElementById('apFaceIdIcon');
    const label = document.getElementById('apFaceIdLabel');

    label.textContent = 'Scanning...';
    ring.classList.add('scanning');
    icon.classList.add('scanning');

    setTimeout(() => {
        ring.classList.remove('scanning');
        ring.classList.add('success');
        icon.classList.remove('scanning');

        setTimeout(() => {
            document.getElementById('apFaceIdSection').classList.add('hidden');
            document.getElementById('apCancelBtn').classList.add('hidden');
            document.getElementById('apSuccessSection').classList.remove('hidden');

            const circle = document.querySelector('.ap-check-circle');
            const checkPath = document.querySelector('.ap-check-path');
            
            if (circle && checkPath) {
                circle.style.strokeDasharray = '176';
                circle.style.strokeDashoffset = '176';
                checkPath.style.strokeDasharray = '40';
                checkPath.style.strokeDashoffset = '40';

                requestAnimationFrame(() => requestAnimationFrame(() => {
                    circle.style.transition = 'stroke-dashoffset 0.4s ease';
                    circle.style.strokeDashoffset = '0';
                    setTimeout(() => {
                        checkPath.style.transition = 'stroke-dashoffset 0.3s ease';
                        checkPath.style.strokeDashoffset = '0';
                    }, 200);
                }));
            }

            setTimeout(() => {
                const overlay = document.getElementById('applePayOverlay');
                if (overlay) overlay.classList.remove('active');

                document.querySelector('form#checkout').submit();
            }, 1400);
        }, 300);
    }, 1800);
}

</script>
</body>
</html>