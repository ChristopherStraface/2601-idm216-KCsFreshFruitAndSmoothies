<?php 
    include './database.php';

    // Fetch the targeted product information
    $target_item = get_item_info($_GET['id'], $products);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize — KC's</title>

    <!-- Fetch fonts and general CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div class="app-container">

    <?php include './component/header.php' ?>

    <form action="./bag_functions.php" method="post" id="customize">
        <!-- When customizing items, do not allow selecting multiple -->
        <input type="hidden" form="customize" name="count" value="1">
        <!-- Pass the item's id to cart later -->
        <input type="hidden" form="customize" name="id" value="<?= $target_item["id"] ?>">
    </form>

    <main class="main-content"><div class="screen active">

        <!-- Return to the homepage -->
        <a href="./index.php" class="back-btn" style="position:fixed;top:24px;left:24px;z-index:200;text-decoration:none;display:flex;align-items:center;justify-content:center;width:36px;height:36px;">
            <svg viewBox="0 0 36 36" fill="none" style="width:36px;height:36px;">
                <path d="M22.5 9L13.5 18L22.5 27" stroke="#1A1A1A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            </svg>
        </a>

        <div class="customize-content">
            <h2 class="screen-title" id="itemTitle"><?= $target_item["name"] ?></h2>

            <!-- Add item image -->
            <div class="customize-image">
                <img id="itemImage" src="./images/<?= $target_item["image"] ?>" alt="<?= $target_item["name"] ?>">
            </div>

            <!-- Size selection -->
            <div class="section">
                <h3 class="section-title">Select Size</h3>

                <!-- Size selection is available for all items -->
                <div class="size-options">

                    <?php
                        foreach ($target_item["prices"] as $size => $price) {
                            // For non-existent sizes, the price will be 0
                            if ($price) {
                    ?>

                        <label class="size-btn" data-size="<?= ucfirst($size) ?>" data-price="<?= $price ?>" onclick="selectSize(this, <?= $price ?>)" >

                            <!-- Size indicator -->
                            <span class="size-label"><?= ucfirst($size) ?></span>

                            <!-- Hidden radio button -->
                            <input type="radio" form="customize" name="size" value="<?= $size ?>" class="size-label">

                            <!-- Price indicator -->
                            <span class="size-price">$<?= $price ?></span>
                            
                        </label>
                    
                    <?php } } ?>

                </div>
            </div>


            <!-- If the item allows customizing ingredients -->
            <?php if ($target_item["ingredients"]) { ?>

                <div class="section ingredients">

                    <h3 class="section-title">Ingredients (Select 1-3 items)</h3>

                    <div class="checkbox-grid">

                        <?php foreach ($target_item["ingredients"] as $ingredient) { ?>

                            <label class="checkbox-label">

                                <input type="checkbox" class="ingredient-checkbox" value="<?= $ingredient ?>" form="customize" name="ingredients[]" value="<?= $ingredient ?>">

                                <span class="checkbox-custom"></span>

                                <span><?= $ingredient ?></span>

                            </label>

                        <?php } ?>

                    </div>
                </div>

            <?php
                }

                // If the item allows adding add-ons
                if ($target_item["add_ons"]) {
            ?>

                <div class="section">

                    <h3 class="section-title">Add-ons (+$1.00 each)</h3>

                    <div class="checkbox-grid">

                        <?php foreach ($target_item["add_ons"] as $add_on) { ?>

                            <label class="checkbox-label">

                                <input type="checkbox" class="addon-checkbox" value="<?= $add_on ?>" onchange="updateTotal()" form="customize" name="add_ons[]" value="<?= $add_on ?>">

                                <span class="checkbox-custom"></span>

                                <span><?= $add_on ?></span>

                            </label>
                        
                        <?php } ?>

                    </div>
                </div>

            <?php } ?>

            <!-- Summit and go to cart -->
            <button type="submit" form="customize" class="add-to-bag-btn" style="text-decoration:none;">

                <span>Add to Bag</span>

                <span id="totalPrice">$0.00</span>

            </button>

        </div>

    </div></main>

    <?php include './component/footer.php' ?> 

    </div>

    <script>
        // Set a variable for the price
        let basePrice = 0;

        function updateTotal() {
            // Count the number of checked add-ons
            const addOnsCount = document.querySelectorAll('.addon-checkbox:checked').length;
            // Calculate the subtotal for each item
            const tempTotal = basePrice + addOnsCount;
            // Keep two decimal places
            const tempTotalRounded = tempTotal.toFixed(2);
            // Update the DOM
            document.getElementById('totalPrice').textContent = "$" + tempTotalRounded;
        }

        // Select all size buttons
        const sizeButtons = document.querySelectorAll('.size-btn');

        function selectSize(element, itemBasePriceAsString) {
            // In case some data are passed in as strings
            const itemBasePrice = parseFloat(itemBasePriceAsString);
            basePrice = itemBasePrice;
            updateTotal();
            // Add the active class name to the most recently clicked button
            sizeButtons.forEach(button => {
                button.classList.remove('active');
            });
            element.classList.add('active');
        }

        // Select form-related elements
        const form = document.getElementById('customize');
        const ingredientsSection = document.querySelectorAll('div.ingredients');

        // When submitting the form, check if the order is properly set
        form.addEventListener('submit', (event) => {
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
