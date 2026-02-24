<?php
    include("../include/database.php");
    include("../include/fetch_products.php");

    $page_title = "KC's - Main Menu Items";
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
        id="order_process" 
        method="POST" 
        action="process.php">
    </form>

    <table>
        <caption><?= $page_title ?></caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Small</th>
                <th>Medium</th>
                <th>Large</th>
            </tr>
        </thead>
        <tbody><?php 
            foreach ($products as $product) { ?>
                <tr>
                    <td><?= $product["id"] ?></td>
                    <td><?= $product["name"] ?></td>
                    
                    <!-- Cell that contains the product image -->
                    <td><picture>
                        <source 
                            srcset="images/<?= $product["image"] ?>" 
                            type="image/avif"
                        >

                        <img 
                            src="images/<?= $product["fallback"] ?>" 
                            alt="Image of <?= $product["name"] ?>"
                        >
                    </picture></td>
                    
                    <!-- Cells that contain the price info --><?php 
                    foreach ($product["prices"] as $key => $value) {
                        if ($value === "Unavailable") { ?>
                            <td class="unavailable">Unavailable</td><?php 
                        } else { 
                            // Combine the product ID and its portion size because one input field cannot send multiple values at the same time. 
                            $product_code = $product["id"] . "-" . $key; ?>

                            <td><section class="options">
                                <p>$<?= $value?></p>

                                <input 
                                    type="checkbox" 
                                    name="selected_items[]" 
                                    value="<?= $product_code ?>" 
                                    form="order_process"
                                >
                            </section></td><?php
                        }
                    } ?>

                </tr><?php 
            } ?>
        </tbody>
    </table>

    <section class="buttons">
        <button onclick="uncheckAll()">Reset</button>
        <button type="submit" form="order_process">Order</button>
    </section>

    <script>
        // Uncheck all checkboxes.
        function uncheckAll() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    </script>
</body>
</html>
