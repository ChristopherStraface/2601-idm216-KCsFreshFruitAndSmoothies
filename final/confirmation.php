<?php include './database.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmed — KC's</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="confirmation.css">
</head>
<body>
<div class="app-container">

  <?php include './component/header.php' ?>

  <main class="main-content">
    <div class="screen active">
      <div class="confirmation-content">

        <!-- Hero order number -->
        <div class="confirm-hero">
          <p class="confirm-hero-eyebrow">Your Order</p>
          <div class="confirm-order-number" id="orderNumber">—</div>
          <p class="confirm-order-label">Order Number</p>
          <div class="confirm-pickup-pill">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <path d="M12 6v6l4 2"/>
            </svg>
            Pick up at <strong id="pickupTime" style="margin-left:4px">—</strong>
          </div>
        </div>

        <!-- Friendly message -->
        <p class="confirm-message">KC's on it! 🍓</p>
        <p class="confirm-submessage">Head over when you're ready — we'll have it waiting.</p>

        <!-- Order summary card -->
        <div class="confirmation-summary">
          <h3 class="section-title" style="margin-bottom:14px">What's in your bag</h3>
          <div id="confirmationOrderItems" class="confirmation-order-items"></div>
          <div class="divider"></div>
          <div class="summary-row"><span>Subtotal</span><span id="confirmSubtotal">$0.00</span></div>
          <div class="summary-row"><span>Tax</span><span id="confirmTax">$0.00</span></div>
          <div class="summary-row"><span>Tip</span><span id="confirmTip">$0.00</span></div>
          <div class="summary-row total-row"><span>Total</span><span id="confirmTotal">$0.00</span></div>
        </div>

        <button id="returnHomeBtn" class="return-home-btn">Back to the Menu</button>

        <button id="pickedUpBtn" class="picked-up-btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;flex-shrink:0;">
            <path d="M20 6L9 17l-5-5"/>
          </svg>
          I picked up my order
        </button>

      </div>
    </div>
  </main>

  <?php include './component/footer.php' ?>

</div>
<script src="./confirmation.js"></script>
</body>
</html>