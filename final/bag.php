<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Bag — KC's</title>
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

      <a href="index.php" class="back-btn" style="position:fixed;top:24px;left:24px;z-index:200;text-decoration:none;display:flex;align-items:center;justify-content:center;width:36px;height:36px;">
        <svg viewBox="0 0 36 36" fill="none" style="width:36px;height:36px;">
          <path d="M22.5 9L13.5 18L22.5 27" stroke="#1A1A1A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </a>

      <div class="bag-content">
        <h2 class="screen-title">Your Items</h2>

        <!-- Empty state (shown when no items) -->
        <div class="empty-cart" id="emptyState" style="display:none;">
          <p>Don't leave your cup empty!</p>
          <a href="index.php" class="secondary-btn" style="text-decoration:none;display:inline-block;text-align:center;">Start Mixing</a>
        </div>

        <!-- Sample item (remove/replace when wiring to PHP) -->
        <div class="cart-items" id="cartItems">

          <div class="cart-item">
            <img src="./img/pb_banana.avif" alt="P.B. Banana" class="cart-item-image">
            <div class="cart-item-details">
              <div class="cart-item-header">
                <div>
                  <div class="cart-item-name">P.B. Banana</div>
                  <div class="cart-item-size">Medium</div>
                </div>
              </div>
              <div class="cart-item-ingredients">Banana, Peanut Butter</div>
              <div class="cart-item-footer">
                <div class="number-button" role="group" aria-label="Quantity selector">
                  <button class="step-btn minus" onclick="changeQty(this, -1)" aria-label="Decrease">−</button>
                  <span class="value">1</span>
                  <button class="step-btn plus" onclick="changeQty(this, 1)" aria-label="Increase">+</button>
                </div>
                <div class="cart-item-price">$6.50</div>
              </div>
              <div class="item-actions">
                <a href="customize.php?item=P.B.+Banana" class="item-action-btn edit-btn" style="text-decoration:none;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                  </svg>
                  Edit
                </a>
                <button class="item-action-btn remove-btn" onclick="removeItem(this)">Remove</button>
              </div>
            </div>
          </div>

        </div>

        <div class="cart-summary" id="cartSummary">
          <div class="summary-row">
            <span>Subtotal</span>
            <span id="subtotalAmount">$6.50</span>
          </div>
          <a href="checkout.php" class="checkout-btn" style="text-decoration:none;display:block;text-align:center;">
            Proceed to Checkout
          </a>
        </div>

      </div>
    </div>
  </main>

  <?php include './component/footer.php' ?> 

</div>
<script src="./bag.js"></script>
</body>
</html>
