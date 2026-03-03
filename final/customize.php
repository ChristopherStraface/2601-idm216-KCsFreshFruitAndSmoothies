<?php
    session_start();

    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }

    $cart_count = count($_SESSION['cart']);
    
    $target_id = $_GET['item_id'];

    include("../include/database.php");
    include("../include/fetch_products.php");

    $product_ids = array_column($products, 'id');
    $index = array_search($target_id, $product_ids);
    $target_item = $products[$index];
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

  <?php include("./components/header.php"); ?>

  <form 
    id="customize" 
    method="post" 
    action="bag.php">
  </form>

  <input type="hidden" name="id" value="<?= $target_id ?>" form="customize">
  <input type="hidden" name="size" id="sizeInput" form="customize">

  <main class="main-content">
    <div class="screen active">

      <a href="index.php" class="back-btn" style="position:fixed;top:72px;left:24px;z-index:200;text-decoration:none;display:flex;align-items:center;justify-content:center;width:36px;height:36px;">
        <svg viewBox="0 0 36 36" fill="none" style="width:36px;height:36px;">
          <path d="M22.5 9L13.5 18L22.5 27" stroke="#1A1A1A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </a>

      <div class="customize-content">
        <h2 class="screen-title" id="itemTitle"><?= $target_item["name"] ?></h2>

        <div class="customize-image">
          <img id="itemImage" src="../images/<?= $target_item["image"] ?>" alt="Smoothie">
        </div>

        <!-- Size -->
        <div class="section">
          <h3 class="section-title">Select Size</h3>
          <div class="size-options">
            <?php
              foreach ($target_item["prices"] as $size => $price) {
                if ($price !== "Unavailable") { ?>

              <button type="button" class="size-btn" data-size="<?= $size ?>" data-price="<?= $price ?>" onclick="sizeInput.value = '<?= $size ?>'; selectSize(this)">
                <span class="size-label"><?= ucfirst($size) ?></span>
                <span class="size-price">$<?= $price ?></span>
              </button>
            <?php } }?>
          </div>
        </div>

        <?php if ($target_item["ingredients"] !== "Unavailable") { ?>
        <!-- Ingredients -->
        <div class="section">
          <h3 class="section-title">Ingredients</h3>
          <div class="checkbox-grid">

            <?php foreach ($target_item["ingredients"] as $ingredient => $selection) { ?>

            <label class="checkbox-label">
              <input 
                type="checkbox" 
                class="ingredient-checkbox" 
                name="ingredients[]" 
                value="<?= $ingredient ?>" 
                form="customize">
              <span class="checkbox-custom"></span><span><?= $ingredient ?></span>
            </label>

            <?php } ?>

          </div>
        </div>
        <?php } ?>

        <?php if ($target_item["add_ons"] !== "Unavailable") { ?>
        <!-- Add-ons -->
        <div class="section">
          <h3 class="section-title">Add-ons (+$1.00 each)</h3>
          <div class="checkbox-grid">

            <?php foreach ($target_item["add_ons"] as $add_on => $selection) { ?>

            <label class="checkbox-label">
              <input 
                type="checkbox" 
                class="addon-checkbox" form="customize" 
                name="add_on[]" 
                value="<?= $add_on ?>" 
                onchange="updateTotal()">
              <span class="checkbox-custom"></span><span><?= $add_on ?></span>
            </label>

            <?php } ?>

          </div>
        </div>
        <?php } ?>

        <button type="submit" form="customize" class="add-to-bag-btn" style="text-decoration:none;">
          <span>Add to Bag</span>
          <span id="totalPrice">$0.00</span>
        </button>
      </div>

    </div>
  </main>

  <?php include("./components/footer.php"); ?>

</div>
<script>
let currentPrice = 0;
const allSizeBtns = document.querySelectorAll('.size-btn');
const sizeInput = document.getElementById('sizeInput');

function selectSize(btn) {
  allSizeBtns.forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  currentPrice = parseFloat(btn.dataset.price);
  updateTotal();
}

function updateTotal() {
  const addons = document.querySelectorAll('.addon-checkbox:checked').length;
  document.getElementById('totalPrice').textContent = '$' + (currentPrice + addons).toFixed(2);
}
</script>
</body>
</html>
