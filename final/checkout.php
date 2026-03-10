<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout — KC's</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="app-container">

  <?php include './component/header.php' ?>

  <main class="main-content">
    <div class="screen active">

      <a href="bag.php" class="back-btn" style="position:fixed;top:24px;left:24px;z-index:200;text-decoration:none;display:flex;align-items:center;justify-content:center;width:36px;height:36px;">
        <svg viewBox="0 0 36 36" fill="none" style="width:36px;height:36px;">
          <path d="M22.5 9L13.5 18L22.5 27" stroke="#1A1A1A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </a>

      <div class="checkout-content">
        <h2 class="screen-title">Checkout</h2>

        <!-- Pick-Up Time -->
        <div class="section">
          <h3 class="section-title">Pick-Up Time</h3>
          <button class="pickup-option active" onclick="selectPickup(this, 'asap')">
            <span>ASAP (10-15 Minutes)</span>
            <div class="radio-btn"><div class="radio-dot"></div></div>
          </button>
          <button class="pickup-option" onclick="selectPickup(this, 'scheduled')">
            <span>Schedule Ahead</span>
            <div class="radio-btn"><div class="radio-dot"></div></div>
          </button>
          <div id="timePickerDropdown" class="time-picker-dropdown hidden">
            <label for="scheduledTime" class="time-picker-label">Select pickup time:</label>
            <select id="scheduledTime" class="time-picker-select"></select>
          </div>
        </div>

        <!-- Pick-up Name -->
        <div class="section">
          <h3 class="section-subtitle">Pick-up Name</h3>
          <input type="text" id="pickupName" class="text-input" placeholder="Name" autocomplete="given-name">
        </div>

        <!-- Payment -->
        <div class="section">
          <h3 class="section-title">Payment Method</h3>

          <button class="payment-option active" id="pay-credit" onclick="selectPayment(this, 'credit')">
            <div class="payment-left">
              <svg class="payment-icon" viewBox="0 0 36 24" fill="none">
                <path d="M3 0C1.34315 0 0 1.34315 0 3V21C0 22.6569 1.34315 24 3 24H33C34.6569 24 36 22.6569 36 21V3C36 1.34315 34.6569 0 33 0H3ZM0 6H36V8H0V6ZM4 14H12V16H4V14Z" fill="#1A1A1A"/>
              </svg>
              <span>Credit</span>
            </div>
            <div class="radio-btn"><div class="radio-dot"></div></div>
          </button>

          <button class="payment-option" id="pay-apple" onclick="selectPayment(this, 'apple')">
            <div class="payment-left">
              <span class="payment-icon apple-icon">
  <svg viewBox="-3 5 22 22" fill="none" width="18" height="18">
    <path d="M17.23 18.27C16.89 19.09 16.48 19.84 16 20.52C15.32 21.48 14.77 22.13 14.36 22.46C13.69 23.05 12.97 23.35 12.19 23.36C11.64 23.36 10.97 23.2 10.19 22.87C9.4 22.55 8.68 22.39 8.02 22.39C7.33 22.39 6.59 22.55 5.8 22.87C5.01 23.2 4.37 23.37 3.88 23.38C3.13 23.4 2.4 23.09 1.69 22.46C1.24 22.09 0.66 21.42 0 20.45C-0.71 19.4 -1.28 18.18 -1.72 16.79C-2.19 15.26 -2.43 13.79 -2.43 12.38C-2.43 10.76 -2.11 9.36 -1.47 8.19C-0.97 7.27 -0.29 6.55 0.57 6.02C1.43 5.49 2.38 5.22 3.42 5.21C4 5.21 4.75 5.39 5.67 5.74C6.58 6.09 7.17 6.27 7.43 6.27C7.62 6.27 8.28 6.06 9.39 5.64C10.44 5.25 11.34 5.09 12.08 5.15C14.03 5.3 15.5 6.07 16.47 7.47C14.77 8.54 13.93 10.02 13.95 11.92C13.97 13.42 14.5 14.68 15.54 15.68C16.01 16.15 16.54 16.51 17.14 16.77C17.01 17.15 16.87 17.51 16.72 17.86L17.23 18.27Z" fill="#1A1A1A"/>
  </svg>
</span>
              <span>Apple Pay</span>
            </div>
            <div class="radio-btn"><div class="radio-dot"></div></div>
          </button>

          <button class="payment-option" id="pay-venmo" onclick="selectPayment(this, 'venmo')">
            <div class="payment-left">
              <div class="payment-icon venmo-icon"><span>V</span></div>
              <span>Venmo</span>
            </div>
            <div class="radio-btn"><div class="radio-dot"></div></div>
          </button>
        </div>

        <!-- Tip -->
        <div class="section">
          <h3 class="section-title">Leave a tip for KC!</h3>
          <div class="tip-options">
            <button type="button" class="tip-btn"        data-tip="custom" onclick="selectTip(this)">Custom</button>
            <button type="button" class="tip-btn"        data-tip="15"     onclick="selectTip(this)">15%</button>
            <button type="button" class="tip-btn active" data-tip="20"     onclick="selectTip(this)">20%</button>
          </div>
          <div class="custom-tip-input-wrapper" id="customTipWrapper">
            <span class="custom-tip-prefix">$</span>
            <input type="number" id="customTipInput" class="custom-tip-input" placeholder="0.00" min="0" step="0.01" oninput="updateTotals()">
          </div>
        </div>

        <!-- Order Summary -->
        <div class="section">
          <h3 class="section-title">Order Summary</h3>
          <div class="checkout-order-items">
            <!-- Sample item — PHP will render real items here -->
            <div class="order-item">
              <div class="order-item-header">
                <span>1x P.B. Banana</span>
                <span>$6.50</span>
              </div>
              <div class="order-item-details">Medium, Banana, Peanut Butter</div>
            </div>
          </div>
          <div class="divider"></div>
          <div class="summary-row">
            <span>Subtotal</span>
            <span id="sumSubtotal">$6.50</span>
          </div>
          <div class="summary-row">
            <span>Tax</span>
            <span id="sumTax">$0.52</span>
          </div>
          <div class="summary-row">
            <span>Tip</span>
            <span id="sumTip">$1.30</span>
          </div>
          <div class="summary-row total-row">
            <span>Total</span>
            <span id="sumTotal">$8.32</span>
          </div>
        </div>

      <button class="place-order-btn" id="placeOrderBtn">Place Order</button>

      </div>
    </div>
  </main>

  <?php include './component/footer.php' ?> 

</div>

<!-- ── Apple Pay Modal ────────────────────────────────────────────────────── -->
<?php include './component/apple_pay.php' ?>

<script src="./checkout.js"></script>
</body>
</html>