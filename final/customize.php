<?php 
  include './database.php';

  $target_item = get_item_info($_GET['id'], $products);
?>

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

  <form action="bag.php" method="post" id="customize"></form>

  <input type="hidden" form="customize" name="count" value="1">

  <input type="hidden" form="customize" name="id" value="<?= $target_item["id"] ?>">

  <main class="main-content">
    <div class="screen active">

      <a href="index.php" class="back-btn" style="position:fixed;top:24px;left:24px;z-index:200;text-decoration:none;display:flex;align-items:center;justify-content:center;width:36px;height:36px;">
        <svg viewBox="0 0 36 36" fill="none" style="width:36px;height:36px;">
          <path d="M22.5 9L13.5 18L22.5 27" stroke="#1A1A1A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </a>

      <div class="customize-content">
        <h2 class="screen-title" id="itemTitle"><?= $target_item["name"] ?></h2>

        <div class="customize-image">
          <img id="itemImage" src="./images/<?= $target_item["image"] ?>" alt="<?= $target_item["name"] ?>">
        </div>

        <!-- Size -->
        <div class="section">
          <h3 class="section-title">Select Size</h3>
          <div class="size-options">

          <?php
            foreach ($target_item["prices"] as $size => $price) {
              if ($price) {
          ?>

            <label class="size-btn" data-size="<?= ucfirst($size) ?>" data-price="<?= $price ?>" onclick="selectSize(this)" >
              <span class="size-label"><?= ucfirst($size) ?></span>
              <input type="radio" form="customize" name="size" value="<?= $size ?>" class="size-label">
              <span class="size-price">$<?= $price ?></span>
            </label>
          
          <?php
            } }
          ?>

          </div>
        </div>

        <?php
          if ($target_item["ingredients"]) {
        ?>

        <!-- Ingredients -->
        <div class="section ingredients">
          <h3 class="section-title">Ingredients</h3>
          <div class="checkbox-grid">
          <?php
            foreach ($target_item["ingredients"] as $ingredient) {
          ?>

            <label class="checkbox-label">
              <input type="checkbox" class="ingredient-checkbox" value="<?= $ingredient ?>" form="customize" name="ingredients[]" value="<?= $ingredient ?>">
              <span class="checkbox-custom"></span><span><?= $ingredient ?></span>
            </label>

          <?php
            }
          ?>
          </div>
        </div>

        <?php
          }

          if ($target_item["add_ons"]) {
        ?>

        <!-- Add-ons -->
        <div class="section">
          <h3 class="section-title">Add-ons (+$1.00 each)</h3>
          <div class="checkbox-grid">
          <?php
            foreach ($target_item["add_ons"] as $add_on) {
          ?>

            <label class="checkbox-label">
              <input type="checkbox" class="addon-checkbox" value="<?= $add_on ?>" onchange="updateTotal()" form="customize" name="add_ons[]" value="<?= $add_on ?>">
              <span class="checkbox-custom"></span><span><?= $add_on ?></span>
            </label>
          
          <?php
            }
          ?>
          </div>
        </div>

        <?php
          }
        ?>

        <button type="submit" form="customize" class="add-to-bag-btn" style="text-decoration:none;">
          <span>Add to Bag</span>
          <span id="totalPrice">$5.50</span>
        </button>
      </div>

    </div>
  </main>

  <?php include './component/footer.php' ?> 

</div>
<script>
  const form = document.getElementById('customize');
  const ingredientsSection = document.querySelectorAll('div.ingredients');
  form.addEventListener('submit', (event) => {
    const ingredientsCheckboxes = document.querySelectorAll('.ingredient-checkbox:checked');
    if (ingredientsSection.length === 1) {
      if (ingredientsCheckboxes.length === 0) {
        alert('You need to select at least one (1) ingredient.');
        event.preventDefault();
      } else if (ingredientsCheckboxes.length > 3) {
        alert('You may not select more than three (3) ingredients.');
        event.preventDefault();
      }
    }
  });
</script>
<script src="./customize.js"></script>
</body>
</html>
