<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customize — KC's</title>
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

      <a href="index.html" class="back-btn" style="position:fixed;top:24px;left:24px;z-index:200;text-decoration:none;display:flex;align-items:center;justify-content:center;width:36px;height:36px;">
        <svg viewBox="0 0 36 36" fill="none" style="width:36px;height:36px;">
          <path d="M22.5 9L13.5 18L22.5 27" stroke="#1A1A1A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </a>

      <div class="customize-content">
        <h2 class="screen-title" id="itemTitle">Custom Smoothie</h2>

        <div class="customize-image">
          <img id="itemImage" src="./img/smoothie.avif" alt="Smoothie">
        </div>

        <!-- Size -->
        <div class="section">
          <h3 class="section-title">Select Size</h3>
          <div class="size-options">
            <button class="size-btn" data-size="Small" data-price="4.50" onclick="selectSize(this)">
              <span class="size-label">Small</span>
              <span class="size-price">$4.50</span>
            </button>
            <button class="size-btn active" data-size="Medium" data-price="5.50" onclick="selectSize(this)">
              <span class="size-label">Medium</span>
              <span class="size-price">$5.50</span>
            </button>
            <button class="size-btn" data-size="Large" data-price="6.50" onclick="selectSize(this)">
              <span class="size-label">Large</span>
              <span class="size-price">$6.50</span>
            </button>
          </div>
        </div>

        <!-- Ingredients -->
        <div class="section">
          <h3 class="section-title">Ingredients</h3>
          <div class="checkbox-grid">
            <label class="checkbox-label">
              <input type="checkbox" class="ingredient-checkbox" value="Strawberry">
              <span class="checkbox-custom"></span><span>Strawberry</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" class="ingredient-checkbox" value="Banana">
              <span class="checkbox-custom"></span><span>Banana</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" class="ingredient-checkbox" value="Mango">
              <span class="checkbox-custom"></span><span>Mango</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" class="ingredient-checkbox" value="Blueberry">
              <span class="checkbox-custom"></span><span>Blueberry</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" class="ingredient-checkbox" value="Pineapple">
              <span class="checkbox-custom"></span><span>Pineapple</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" class="ingredient-checkbox" value="Spinach">
              <span class="checkbox-custom"></span><span>Spinach</span>
            </label>
          </div>
        </div>

        <!-- Add-ons -->
        <div class="section">
          <h3 class="section-title">Add-ons (+$1.00 each)</h3>
          <div class="checkbox-grid">
            <label class="checkbox-label">
              <input type="checkbox" class="addon-checkbox" value="Protein Powder" onchange="updateTotal()">
              <span class="checkbox-custom"></span><span>Protein Powder</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" class="addon-checkbox" value="Chia Seeds" onchange="updateTotal()">
              <span class="checkbox-custom"></span><span>Chia Seeds</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" class="addon-checkbox" value="Peanut Butter" onchange="updateTotal()">
              <span class="checkbox-custom"></span><span>Peanut Butter</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" class="addon-checkbox" value="Honey" onchange="updateTotal()">
              <span class="checkbox-custom"></span><span>Honey</span>
            </label>
          </div>
        </div>

        <a href="bag.html" class="add-to-bag-btn" style="text-decoration:none;">
          <span>Add to Bag</span>
          <span id="totalPrice">$5.50</span>
        </a>
      </div>

    </div>
  </main>

  <?php include './component/footer.php' ?> 

</div>
<script src="./customize.js"></script>
</body>
</html>
