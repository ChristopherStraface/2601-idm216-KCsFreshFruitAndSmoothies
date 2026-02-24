<?php
    $target_id = $_GET['product_id'];

    include("../include/database.php");
    include("../include/fetch_products.php");

    $page_title = "Customization";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./table.css">
</head>
<body>
    <form 
        id="customize" 
        method="post" 
        action="process.php">
    </form>

    <h1><?= $page_title ?></h1>
    
    <?php
        $product_ids = array_column($products, 'id');
        $index = array_search($target_id, $product_ids);
        $target_item = $products[$index];
    ?>
    
    <table>
        <caption><?= $target_item["name"] ?></caption>
        <thead>
            <tr>
                <th>Category</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Size</td>
                <td><fieldset><?php
                    foreach ($target_item["prices"] as $size => $price) {
                        if ($price !== "Unavailable") { ?>
                            <div class="option">
                                <input 
                                    required
                                    type="radio"
                                    id="<?= $size ?>"
                                    name="size"
                                    value="<?= $size ?>"
                                    form="customize">
                                <label for="<?= $size ?>"><?= ucfirst($size) ?> $<?= $price ?></label>
                            </div><?php 
                        }
                   } ?>
                </fieldset></td>
            </tr>
            <tr>
                <td>Ingredients</td><?php
                    if ($target_item["ingredients"] !== "Unavailable") { ?>
                        <td><fieldset><?php 
                            foreach ($target_item["ingredients"] as $ingredient => $selection) { ?>
                                <div class="option">
                                    <input 
                                        required
                                        type="checkbox"
                                        id="<?= $ingredient ?>"
                                        name="ingredients[]"
                                        value="<?= $ingredient ?>"
                                        form="customize">
                                    <label for="<?= $ingredient ?>"><?= ucfirst($ingredient) ?></label>
                                </div><?php 
                            } ?>
                        </fieldset></td><?php
                    } else { ?>
                        <td class="unavailable">Unavailable</td><?php
                    } ?>
            </tr>
            <tr>
                <td>Add-ons</td><?php
                    if ($target_item["add_ons"] !== "Unavailable") { ?>
                        <td><fieldset><?php 
                            foreach ($target_item["add_ons"] as $add_on => $selection) { ?>
                                <div class="option">
                                    <input 
                                        required
                                        type="checkbox"
                                        id="<?= $add_on ?>"
                                        name="add_ons[]"
                                        value="<?= $add_on ?>"
                                        form="customize">
                                    <label for="<?= $add_on ?>"><?= ucfirst($add_on) ?> (+$1.00)</label>
                                </div><?php 
                            } ?>
                        </fieldset></td><?php
                    } else { ?>
                        <td class="unavailable">Unavailable</td><?php
                    } ?>
            </tr>
        </tbody>
    </table>

    <section class="buttons">
        <a href="./main.php" class="btn" onclick="uncheckAll()">Back to Menu</a>
        <button onclick="uncheckAll()">Reset</button>
        <button type="submit" form="customize" onclick="uncheckAll()">Add to Cart</button>
    </section>

    <script>
        // Uncheck everything.
        function uncheckAll() {
            const radios = document.querySelectorAll('input[type="radio"]');
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            radios.forEach(radio => {
                radio.checked = false;
            });
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    </script>
</body>
</html>
