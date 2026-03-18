<?php 
    include "./include/database.php";

    $target_id = $_GET["id"];
    $target_item = get_item_info($target_id, $products);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize<?= $page_title_abbreviation ?></title>
    <?php include "./include/styles.php" ?>
</head>
<body>
<div class="app-container">

    <?php include "./components/header.php" ?>

    <form action="./cart_prep.php" id="customize" method="post">
        <input type="hidden" name="id" value="<?= $target_id ?>">
    </form>

    <main class="main-content">
        <div class="screen active">

            <a href="./index.php" class="back-btn" style="position:fixed;top:24px;left:24px;z-index:200;text-decoration:none;display:flex;align-items:center;justify-content:center;width:36px;height:36px;">
                <?php add_icons("left_chevron") ?>
            </a>

            <div class="customize-content">
                <h2 class="screen-title" id="itemTitle"><?= $target_item["name"] ?></h2>

                <div class="customize-image">
                    <img id="itemImage" src="../images/<?= $target_item["image"] ?>" alt="<?= $target_item["name"] ?>">
                </div>

                <!-- Size -->
                <div class="section">
                    <h3 class="section-title">Select Size</h3>
                    <div class="size-options">

                    <?php
                        foreach ($target_item["prices"] as $size => $price) {
                            if ($price) {
                    ?>

                        <label class="size-btn" data-size="<?= ucfirst($size) ?>" data-price="<?= $price ?>" onclick="selectSize(this)">
                            <span class="size-label"><?= ucfirst($size) ?></span>
                            <input type="radio" name="size" value="<?= $size ?>" form="customize" style="appearance: none;">
                            <span class="size-price">$<?= $price ?></span>
                        </label>
                    
                    <?php } } ?>

                    </div>
                </div>

                <?php if ($target_item["ingredients"]) {?>

                <!-- Ingredients -->
                <div class="section">
                    <h3 class="section-title">Ingredients (Select 1-3)</h3>
                    <div class="checkbox-grid ingredients">

                    <?php foreach ($target_item["ingredients"] as $ingredient) { ?>
                        <label class="checkbox-label">
                            <input type="checkbox" class="ingredient-checkbox" form="customize" name="ingredients[]" value="<?= $ingredient ?>">
                            <span class="checkbox-custom"></span><span><?= $ingredient ?></span>
                        </label>
                    
                    <?php } ?>

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
                    
                    <?php foreach ($target_item["add_ons"] as $add_on) { ?>

                        <label class="checkbox-label">
                            <input type="checkbox" class="addon-checkbox" form="customize" name="add_ons[]" value="<?= $add_on ?>" onchange="updateTotal()">
                            <span class="checkbox-custom"></span><span><?= $add_on ?></span>
                        </label>
                    
                    <?php } ?>
                    
                    </div>
                </div>

                <?php } ?>

                <button type="submit" form="customize" class="add-to-cart-btn" style="text-decoration:none;">
                    <span>Add to Cart</span>
                    <span id="totalPrice">$0.00</span>
                </button>
            </div>

        </div>
    </main>

    <?php include "./components/footer.php" ?>

</div>
<script>
    <?php 
        $catalogue = [];
        foreach ($products as $product) { 
            $catalogue[$product["id"]] = [
                "name" => $product["name"],
                "image" => "../images/" . $product["image"],
                "defaults" => []
            ];
        }
    ?>
const catalogue = <?= json_encode($catalogue) ?>;

let currentPrice = 0.00;

// Read item from URL
const params = new URLSearchParams(window.location.search);
const itemID = params.get('id');
const itemName = catalogue[itemID]["name"];
const data = catalogue[itemID];

// Pre-check defaults
data.defaults.forEach(val => {
    const cb = document.querySelector(`input[value="${val}"]`);
    if (cb) cb.checked = true;
});

function selectSize(btn) {
    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    currentPrice = parseFloat(btn.dataset.price);
    updateTotal();
}

function updateTotal() {
    const addons = document.querySelectorAll('.addon-checkbox:checked').length;
    document.getElementById('totalPrice').textContent = '$' + (currentPrice + addons).toFixed(2);
}

// Select the submit button
const submitButton = document.querySelector('.add-to-cart-btn');

// Select the ingredients section
const ingredientsSection = document.querySelectorAll('div.ingredients');

// When submitting the form, check if the order is properly set
submitButton.addEventListener('click', (event) => {
    // Select all clicked size buttons
    const sizeButtons = document.querySelectorAll('.size-btn.active');
    // Must have one of the size buttons clicked
    if (sizeButtons.length < 1) {
        alert('You need to select a size.');
        event.preventDefault();
    }

    // Select all ingredient checkboxes
    const ingredientsCheckboxes = document.querySelectorAll('.ingredient-checkbox:checked');
    // If there is an ingredients section
    if (ingredientsSection.length === 1) {
        if (ingredientsCheckboxes.length === 0) {
            // Must select at least one ingredient
            alert('You need to select at least one (1) ingredient.');
            event.preventDefault();
        } else if (ingredientsCheckboxes.length > 3) {
            // Must select at most three ingredients
            alert('You may not select more than three (3) ingredients.');
            event.preventDefault();
        }
    }
});
</script>
</body>
</html>
